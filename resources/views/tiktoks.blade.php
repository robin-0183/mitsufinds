<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <title>TikTok videos · {{ config('app.name', 'mxtsu') }}</title>
        <style>
            html { font-size: 90%; }
            * { box-sizing: border-box; }
            body {
                margin: 0;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: #000000;
                color: #f9fafb;
                position: relative;
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
                font-size: 1.5rem;
                font-weight: 600;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .videos-grid {
                margin-top: 2.5rem;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: flex-start;
                gap: 2rem;
            }

            .video-card {
                width: 320px;
                max-width: 100%;
                background: radial-gradient(circle at top, #111827, #020617);
                border-radius: 1.5rem;
                padding: 0.75rem 0.75rem 1.1rem;
                border: 1px solid #111827;
                box-shadow:
                    0 18px 40px rgba(0, 0, 0, 0.95),
                    0 0 30px rgba(15, 23, 42, 0.9);
                overflow: hidden;
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }

            .video-card:hover {
                transform: translateY(-6px) scale(1.03);
                box-shadow:
                    0 24px 56px rgba(0, 0, 0, 1),
                    0 0 40px rgba(15, 23, 42, 1);
            }

            .video-title {
                font-size: 1rem;
                font-weight: 600;
                margin: 0 0 0.35rem;
            }

            .video-embed {
                border-radius: 1.25rem;
                overflow: hidden;
            }

            .video-embed iframe {
                width: 100% !important;
                max-width: 100% !important;
                border-radius: 1.25rem;
            }
        </style>
    </head>
    <body class="has-footer">
        <div class="page-main">
        @include('partials.stars-bg')
        <div class="page-load-overlay" id="page-load-overlay" aria-hidden="false">
            <div class="page-load-spinner" aria-hidden="true"></div>
        </div>
        <div class="shell">
            <a href="{{ route('home') }}" class="back-link">&larr; Back to home</a>
            <h1 class="title">TikTok videos</h1>

            @if($videos->isEmpty())
                <p style="margin-top: 1rem; opacity: 0.8;">No TikTok videos yet. Add some from the admin panel.</p>
            @else
                <div class="videos-grid">
                    @foreach ($videos as $video)
                        <article class="video-card">
                            <div class="video-title">{{ $video->title }}</div>
                            <div class="video-embed">
                                {!! $video->embed_html !!}
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
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

