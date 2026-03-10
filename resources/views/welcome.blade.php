<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                min-height: 100vh;
                background: #000000;
                color: #ffffff;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .shell {
                max-width: 640px;
                width: 100%;
                padding: 2.5rem 1.5rem;
                text-align: center;
            }

            h1 {
                font-size: 2.25rem;
                font-weight: 600;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                margin-bottom: 1.5rem;
            }

            .item {
                font-size: 1rem;
                margin-bottom: 0.75rem;
            }

            .highlight {
                font-weight: 600;
            }
        </style>
    </head>
    <body>
        <div class="shell">
            <h1>Welcome</h1>
            <p class="item">
                <span class="highlight">TikTok site</span> – find all the products and content from my TikTok.
            </p>
            <p class="item">
                <span class="highlight">Discord server</span> – join the community, ask questions, and get support.
            </p>
            <p class="item">
                <span class="highlight">$550 worth of shipping coupons</span> – exclusive deals available through my affiliate program.
            </p>
        </div>
    </body>
</html>
