<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coming Soon — {{ config('app.name', 'mxtsu') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #000000;
            color: #f9fafb;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .coming-soon-content {
            text-align: center;
            padding: 2rem;
        }

        .coming-soon-title {
            font-family: 'Oswald', system-ui, sans-serif;
            font-size: clamp(2.5rem, 8vw, 4.5rem);
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            margin: 0 0 0.5rem;
        }

        .coming-soon-sub {
            font-size: 1.1rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            opacity: 0.85;
        }

        .countdown {
            margin-top: 2rem;
            font-family: 'Oswald', system-ui, sans-serif;
            font-size: clamp(1.5rem, 4vw, 2.25rem);
            font-weight: 600;
            letter-spacing: 0.15em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
        }

        .countdown.is-finished {
            opacity: 0.7;
        }

        .countdown span {
            min-width: 2ch;
        }

        .dev-btn {
            position: fixed;
            bottom: 1rem;
            left: 1rem;
            z-index: 100;
            padding: 0.4rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            color: rgba(255, 255, 255, 0.6);
            background: transparent;
            border: 1px solid #333;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: color 0.2s, border-color 0.2s;
        }

        .dev-btn:hover {
            color: #fff;
            border-color: #555;
        }

        .dev-btn:focus {
            outline: none;
            border-color: #666;
        }

        .dev-overlay {
            position: fixed;
            inset: 0;
            z-index: 200;
            background: rgba(0, 0, 0, 0.85);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s, visibility 0.2s;
        }

        .dev-overlay.is-open {
            opacity: 1;
            visibility: visible;
        }

        .dev-modal {
            background: #111;
            border: 1px solid #333;
            border-radius: 0.5rem;
            padding: 1.5rem 2rem;
            max-width: 340px;
            width: 100%;
        }

        .dev-modal h2 {
            margin: 0 0 1rem;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .dev-modal form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .dev-modal input[type="password"] {
            width: 100%;
            padding: 0.6rem 0.75rem;
            font-size: 1rem;
            color: #fff;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 0.25rem;
        }

        .dev-modal input[type="password"]:focus {
            outline: none;
            border-color: #555;
        }

        .dev-modal input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .dev-modal .error {
            font-size: 0.875rem;
            color: #e57373;
        }

        .dev-modal .actions {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }

        .dev-modal button[type="button"].dev-cancel {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            background: transparent;
            border: 1px solid #444;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .dev-modal button[type="submit"] {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #000;
            background: #fff;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .dev-modal button:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="coming-soon-content">
        <h1 class="coming-soon-title">Coming Soon</h1>
        <p class="coming-soon-sub">Mxtsu is cooking !</p>
        <div class="countdown" id="countdown" aria-live="polite">
            <span id="countdown-days">00</span>:<span id="countdown-hours">00</span>:<span id="countdown-mins">00</span>:<span id="countdown-secs">00</span>
        </div>
    </div>

    <button type="button" class="dev-btn" id="dev-btn" aria-label="Developer settings">Settings (dev)</button>

    <div class="dev-overlay" id="dev-overlay" aria-hidden="true">
        <div class="dev-modal" role="dialog" aria-labelledby="dev-modal-title">
            <h2 id="dev-modal-title">Developer access</h2>
            <form method="post" action="{{ route('dev-auth') }}">
                @csrf
                @if ($errors->has('dev_password'))
                    <p class="error" role="alert">{{ $errors->first('dev_password') }}</p>
                @endif
                <input type="password" name="dev_password" placeholder="Developer password" required autofocus>
                <div class="actions">
                    <button type="button" class="dev-cancel" id="dev-cancel">Cancel</button>
                    <button type="submit">Enter</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function () {
            var seventyTwoHours = 72 * 60 * 60 * 1000;
            var endTime = Date.now() + seventyTwoHours;
            var el = document.getElementById('countdown');
            var daysEl = document.getElementById('countdown-days');
            var hoursEl = document.getElementById('countdown-hours');
            var minsEl = document.getElementById('countdown-mins');
            var secsEl = document.getElementById('countdown-secs');

            function pad(n) { return (n < 10 ? '0' : '') + n; }

            function tick() {
                var left = Math.max(0, endTime - Date.now());
                if (left <= 0 && el) {
                    el.classList.add('is-finished');
                    if (daysEl) daysEl.textContent = '00';
                    if (hoursEl) hoursEl.textContent = '00';
                    if (minsEl) minsEl.textContent = '00';
                    if (secsEl) secsEl.textContent = '00';
                    return;
                }
                var s = Math.floor((left / 1000) % 60);
                var m = Math.floor((left / 60000) % 60);
                var h = Math.floor((left / 3600000) % 24);
                var d = Math.floor(left / 86400000);
                if (daysEl) daysEl.textContent = pad(d);
                if (hoursEl) hoursEl.textContent = pad(h);
                if (minsEl) minsEl.textContent = pad(m);
                if (secsEl) secsEl.textContent = pad(s);
            }

            tick();
            setInterval(tick, 1000);

            var btn = document.getElementById('dev-btn');
            var overlay = document.getElementById('dev-overlay');
            var cancel = document.getElementById('dev-cancel');

            if (btn && overlay) {
                btn.addEventListener('click', function () {
                    overlay.classList.add('is-open');
                    overlay.setAttribute('aria-hidden', 'false');
                });
            }

            function closeOverlay() {
                if (overlay) {
                    overlay.classList.remove('is-open');
                    overlay.setAttribute('aria-hidden', 'true');
                }
            }

            if (cancel) cancel.addEventListener('click', closeOverlay);
            if (overlay) {
                overlay.addEventListener('click', function (e) {
                    if (e.target === overlay) closeOverlay();
                });
            }
        })();
    </script>
</body>
</html>
