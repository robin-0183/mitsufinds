<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <title>Links · {{ config('app.name', 'mxtsu') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            html { font-size: 90%; }
            * { box-sizing: border-box; }
            body {
                margin: 0;
                font-family: 'Oswald', system-ui, sans-serif;
                background: #000000;
                color: #f9fafb;
                position: relative;
            }
            .links-above-footer {
                flex: 1;
            }
            .page-load-overlay {
                position: fixed;
                inset: 0;
                z-index: 9999;
                background: rgba(0, 0, 0, 0.85);
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 1;
                visibility: visible;
                transition: opacity 0.25s ease, visibility 0.25s ease;
            }
            .page-load-overlay.is-hidden {
                opacity: 0;
                visibility: hidden;
            }
            .page-load-spinner {
                width: 48px;
                height: 48px;
                border: 3px solid rgba(255, 255, 255, 0.2);
                border-top-color: #fff;
                border-radius: 50%;
                animation: page-load-spin 0.8s linear infinite;
            }
            @keyframes page-load-spin {
                to { transform: rotate(360deg); }
            }
            .shell {
                position: relative;
                z-index: 1;
                max-width: 1200px;
                margin: 0 auto;
                padding: 2rem 1.5rem 3rem;
            }
            .back-link {
                position: fixed;
                top: 1.25rem;
                left: 1.5rem;
                z-index: 11;
                display: inline-flex;
                align-items: center;
                gap: 0.3rem;
                font-size: 0.9rem;
                font-weight: 700;
                color: #ffffff;
                text-decoration: none;
                outline: none;
            }
            .back-link:hover { color: #e5e7eb; }
            .back-link:focus { outline: none; }
            .title {
                font-size: 1.75rem;
                font-weight: 600;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }
            .links-intro {
                margin-top: 1rem;
                opacity: 0.8;
                font-weight: 500;
                letter-spacing: 0.02em;
            }
            .discord-card {
                margin-top: 2.5rem;
                max-width: 420px;
                padding: 2rem 2rem 2.25rem;
                background: #000000;
                border-radius: 1rem;
                border: none;
                text-align: center;
                transition: transform 0.25s ease;
            }
            .discord-card:hover {
                transform: scale(1.02);
            }
            .discord-card a {
                text-decoration: none;
                color: inherit;
                display: block;
                outline: none;
            }
            .discord-card-text {
                font-size: 1.05rem;
                font-weight: 600;
                color: #f9fafb;
                line-height: 1.4;
                letter-spacing: 0.02em;
            }
        </style>
    </head>
    <body class="has-footer">
        <div class="page-main">
        @include('partials.stars-bg')
        <div class="page-load-overlay" id="page-load-overlay" aria-hidden="false">
            <div class="page-load-spinner" aria-hidden="true"></div>
        </div>
        <div class="links-above-footer">
            <div class="shell">
                <a href="{{ route('home') }}" class="back-link">&larr; Back to home</a>
                <h1 class="title">Links</h1>
                <p class="links-intro">Useful links will go here.</p>

                <div class="discord-card">
                    <a href="https://discord.gg/zjHfxED6" target="_blank" rel="noopener noreferrer">
                        <span class="discord-card-text">Join my discord for more coupons and finds !</span>
                    </a>
                </div>
            </div>
        </div>
        </div>
        @include('partials.footer')
        <script>
            (function () {
                var overlay = document.getElementById('page-load-overlay');
                if (overlay) {
                    window.setTimeout(function () {
                        overlay.classList.add('is-hidden');
                        overlay.setAttribute('aria-hidden', 'true');
                    }, 1200);
                }
            })();
        </script>
    </body>
</html>
