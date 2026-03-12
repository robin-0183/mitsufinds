<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DMCA &amp; Privacy · {{ config('app.name', 'mxtsu') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            html { font-size: 96%; }
            * { box-sizing: border-box; }
            body {
                margin: 0;
                font-family: 'Oswald', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
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
                font-size: 1.9rem;
                font-weight: 600;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }
            .dmca-updated {
                font-size: 1rem;
                color: #9ca3af;
                margin-top: 0.5rem;
                margin-bottom: 1.5rem;
            }
            .dmca-intro {
                font-size: 1.05rem;
                margin-bottom: 1rem;
                line-height: 1.7;
                opacity: 0.95;
            }
            .dmca-section-title {
                font-size: 1.3rem;
                font-weight: 700;
                margin-top: 1.75rem;
                margin-bottom: 0.75rem;
            }
            .dmca-email-link {
                color: #60a5fa;
                text-decoration: none;
            }
            .dmca-email-link:hover {
                text-decoration: underline;
            }
            .dmca-subject-label {
                font-size: 0.8rem;
                color: #9ca3af;
                margin-top: 1rem;
                margin-bottom: 0.35rem;
            }
            .dmca-subject-box {
                display: inline-block;
                background: #1f2937;
                color: #f9fafb;
                padding: 0.5rem 0.75rem;
                border-radius: 0.375rem;
                font-size: 0.9rem;
            }
            .dmca-list {
                margin: 0.75rem 0 0 1.25rem;
                padding: 0;
                line-height: 1.8;
            }
            .dmca-list li {
                margin-bottom: 0.5rem;
            }
            .dmca-column {
                max-width: 900px;
                margin: 0 auto;
            }
            .dmca-affiliate-note {
                margin-top: 2rem;
                padding-top: 1.5rem;
                border-top: 1px solid rgba(156, 163, 175, 0.4);
                font-size: 0.9rem;
                line-height: 1.5;
                color: #d1d5db;
                text-align: left;
            }
        </style>
    </head>
    <body>
        @include('partials.stars-bg')
        <div class="page-load-overlay" id="dmca-page-load-overlay" aria-hidden="false">
            <div class="page-load-spinner" aria-hidden="true"></div>
        </div>
        <div class="shell">
            <div class="dmca-column">
                <a href="{{ route('home') }}" class="back-link">&larr; Back to home</a>
                <h1 class="title">DMCA and Content Removal Policy</h1>
                <p class="dmca-updated">Last Updated: November 2025</p>

                <p class="dmca-intro">mitsufinds respects intellectual property rights and complies with digital content laws.</p>
                <p class="dmca-intro">User content is uploaded by individuals, and mitsufinds does not review or verify content.</p>
                <p class="dmca-intro">If you believe your copyright or trademark rights are infringed, you may request removal.</p>

                <h2 class="dmca-section-title">1. How to Submit a Removal Request</h2>
                <p class="dmca-intro">Email us at: <a href="mailto:mitsuguuu325@gmail.com" class="dmca-email-link">mitsuguuu325@gmail.com</a></p>
                <p class="dmca-subject-label">SUBJECT LINE</p>
                <p><span class="dmca-subject-box">DMCA Takedown Request</span></p>
                <p class="dmca-intro" style="margin-top: 1rem;">Please include the following in your request:</p>
                <ul class="dmca-list">
                    <li>Detailed description of the copyrighted work</li>
                    <li>The specific URL(s) of the content you want removed</li>
                    <li>Your contact information (name, email, phone)</li>
                    <li>A statement of good faith belief</li>
                    <li>Electronic or physical signature</li>
                </ul>
            </div>
        </div>
        <script>
            (function () {
                var overlay = document.getElementById('dmca-page-load-overlay');
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
