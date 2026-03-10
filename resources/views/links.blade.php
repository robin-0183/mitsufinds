<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Links · {{ config('app.name', 'mxtsu') }}</title>
        <style>
            * { box-sizing: border-box; }
            body {
                margin: 0;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: #000000;
                color: #f9fafb;
            }
            .shell {
                max-width: 1200px;
                margin: 0 auto;
                padding: 2rem 1.5rem 3rem;
            }
            .back-link {
                display: inline-flex;
                font-size: 0.85rem;
                color: #9ca3af;
                text-decoration: none;
                margin-bottom: 1rem;
            }
            .back-link:hover { color: #e5e7eb; }
            .title {
                font-size: 1.5rem;
                font-weight: 600;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
        <div class="shell">
            <a href="{{ route('home') }}" class="back-link">← Back to home</a>
            <h1 class="title">Links</h1>
            <p style="margin-top: 1rem; opacity: 0.8;">Useful links will go here.</p>
        </div>
    </body>
</html>
