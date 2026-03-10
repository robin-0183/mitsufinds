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

    <a href="{{ route('dev-login') }}" class="dev-btn" id="dev-btn" aria-label="Login" style="text-decoration:none;color:inherit;display:inline-block;">Login</a>

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
        })();
    </script>
</body>
</html>
