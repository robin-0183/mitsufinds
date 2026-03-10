<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'mxtsu') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: #000000;
                color: #f9fafb;
            }

            .shell {
                max-width: 1200px;
                margin: 0 auto;
                padding: 1.25rem 1.5rem 3rem;
            }

            header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 1.5rem;
                gap: 1.5rem;
            }

            .brand {
                position: fixed;
                top: 1.25rem;
                left: 1.5rem;
                z-index: 30;
                font-size: 1.1rem;
                font-weight: 400;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .top-bar-left {
                min-width: 140px;
            }

            .top-bar-center {
                flex: 1;
                display: flex;
                justify-content: center;
                padding-right: 14rem;
            }

            .top-nav {
                display: inline-flex;
                align-items: center;
                gap: 2.4rem;
                padding: 0.9rem 2.6rem;
                border-radius: 999px;
                background: #1a1a1a;
                border: 1px solid #404040;
            }

            .top-nav-item {
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                font-size: 1rem;
                font-weight: 700;
                opacity: 0.96;
                cursor: pointer;
                display: inline-block;
                transition: transform 0.2s ease;
            }

            .top-nav-item:hover {
                transform: scale(1.12);
            }

            .top-nav:focus,
            .top-nav-item:focus,
            .top-nav a:focus,
            .top-nav a:active,
            .admin-link:focus,
            .brand:focus,
            .welcome-cta:focus {
                outline: none;
            }

            .top-nav-item + .top-nav-item {
                position: relative;
            }

            .top-nav-item + .top-nav-item::before {
                content: '';
                position: absolute;
                left: -0.5rem;
                top: 50%;
                transform: translateY(-50%);
                width: 1px;
                height: 0.9rem;
                background: #404040;
            }

            .admin-link {
                position: fixed;
                left: 1.5rem;
                bottom: 1.5rem;
                padding: 0.55rem 1.1rem;
                border-radius: 999px;
                border: 1px solid #000000;
                font-size: 0.85rem;
                text-decoration: none;
                color: #e5e7eb;
                background: #000000;
                z-index: 9999;
                outline: none;
            }

            .admin-link:hover {
                background: #000000;
                border-color: #000000;
            }

            .section {
                margin-bottom: 2.5rem;
            }

            .section-title {
                font-size: 1.1rem;
                font-weight: 500;
                margin-bottom: 0.9rem;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: #9ca3af;
            }

            .grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 1.5rem;
            }

            .card {
                border-radius: 1rem;
                overflow: hidden;
                background: radial-gradient(circle at top, #111827, #020617);
                border: 1px solid #1f2933;
                display: flex;
                flex-direction: column;
                min-height: 260px;
            }

            .card-image {
                position: relative;
                padding-top: 60%;
                background: #020617;
                overflow: hidden;
            }

            .card-image img {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .card-body {
                padding: 1rem 1.1rem 1.1rem;
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                flex: 1;
            }

            .card-title {
                font-size: 1rem;
                font-weight: 500;
            }

            .card-description {
                font-size: 0.9rem;
                opacity: 0.8;
                line-height: 1.4;
            }

            .card-footer {
                margin-top: auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 0.75rem;
            }

            .price {
                font-weight: 600;
                font-size: 0.95rem;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.45rem 0.9rem;
                border-radius: 999px;
                border: none;
                font-size: 0.85rem;
                font-weight: 500;
                cursor: pointer;
                text-decoration: none;
            }

            .btn-primary {
                background: #f97316;
                color: #020617;
            }

            .btn-primary:hover {
                background: #fdba74;
            }

            .empty {
                margin-top: 3rem;
                text-align: center;
                opacity: 0.75;
                font-size: 0.95rem;
            }

            .welcome-overlay {
                position: fixed;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(0, 0, 0, 0.35);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                z-index: 50;
                opacity: 1;
                transition: opacity 220ms ease-out;
            }

            .welcome-overlay--hidden {
                opacity: 0;
                pointer-events: none;
            }

            .welcome-modal {
                width: 420px;
                max-width: 92vw;
                border-radius: 1.5rem;
                background: #050608;
                border: none;
                padding: 2.25rem 2rem 1.9rem;
                box-shadow: none;
                position: relative;
                text-align: center;
                transform: translateY(10px) scale(0.97);
                opacity: 0;
                transition:
                    transform 220ms ease-out,
                    opacity 220ms ease-out;
            }

            .welcome-overlay:not(.welcome-overlay--hidden) .welcome-modal {
                transform: translateY(0) scale(1);
                opacity: 1;
            }

            .welcome-close {
                position: absolute;
                top: 0.65rem;
                right: 0.75rem;
                border: none;
                background: transparent;
                color: #9ca3af;
                font-size: 1.1rem;
                cursor: pointer;
            }

            .welcome-icon {
                width: 40px;
                height: 40px;
                border-radius: 999px;
                background: #111827;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 0.9rem;
                font-size: 1.1rem;
            }

            .welcome-title {
                font-size: 1.1rem;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                margin-bottom: 0.9rem;
            }

            .welcome-divider {
                width: 40px;
                height: 2px;
                background: #4b5563;
                margin: 0 auto 0.9rem;
            }

            .welcome-text {
                font-size: 0.9rem;
                line-height: 1.4;
                margin-bottom: 1.1rem;
            }

            .welcome-text strong {
                font-weight: 700;
            }

            .welcome-cta {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                border-radius: 999px;
                border: none;
                padding: 0.65rem 1rem;
                background: #f97316;
                color: #020617;
                font-size: 1.05rem;
                font-weight: 700;
                cursor: pointer;
                margin-bottom: 0.9rem;
            }

            .welcome-cta:hover {
                background: #fdba74;
            }

            .welcome-footnote {
                font-size: 0.75rem;
                opacity: 0.7;
            }
        </style>
    </head>
    <body>
        <div class="shell">
            <header>
                <div class="top-bar-left" aria-hidden="true"></div>
                <a href="{{ route('home') }}" class="brand" style="text-decoration:none; color:inherit;">MxtsuFinds</a>

                <div class="top-bar-center">
                    <nav class="top-nav">
                        <a href="{{ route('products.index') }}" class="top-nav-item" style="text-decoration:none; color:inherit;">
                            Products
                        </a>
                        <a href="{{ route('trusted-sellers') }}" class="top-nav-item" style="text-decoration:none; color:inherit;">
                            Trusted sellers
                        </a>
                        <a href="{{ route('links') }}" class="top-nav-item" style="text-decoration:none; color:inherit;">
                            Links
                        </a>
                    </nav>
                </div>

                <a href="{{ url('/login') }}" class="admin-link" id="login-link" data-login-url="{{ url('/login') }}">
                    Login
                </a>
            </header>

            @if (! $products->isEmpty())
                @php
                    $sections = [
                        'hoodies' => 'Hoodies',
                        'tees' => 'Tees',
                        'jeans_sweats' => 'Jeans / Sweats',
                        'jewelry' => 'Jewelry',
                    ];
                @endphp

                @foreach ($sections as $key => $label)
                    @php
                        $sectionProducts = $products->where('category', $key);
                    @endphp

                    @if ($sectionProducts->isNotEmpty())
                        <section class="section">
                            <h2 class="section-title">{{ $label }}</h2>

                            <div class="grid">
                                @foreach ($sectionProducts as $product)
                                    <article class="card">
                                        @if ($product->image_url)
                                            <div class="card-image">
                                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                            </div>
                                        @endif

                                        <div class="card-body">
                                            <h3 class="card-title">{{ $product->name }}</h3>

                                            @if ($product->description)
                                                <p class="card-description">
                                                    {{ Str::limit($product->description, 120) }}
                                                </p>
                                            @endif

                                            <div class="card-footer">
                                                @if ($product->price)
                                                    <span class="price">${{ number_format($product->price, 2) }}</span>
                                                @else
                                                    <span class="price">ACBuy deal</span>
                                                @endif

                                                <a href="{{ $product->affiliate_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                                                    View on ACBuy
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endif
                @endforeach
            @endif
        </div>

        <div id="welcome-overlay" class="welcome-overlay welcome-overlay--hidden">
            <div class="welcome-modal">
                <button type="button" class="welcome-close" data-dismiss="welcome-modal">&times;</button>
                <div class="welcome-icon">🎁</div>
                <div class="welcome-title">Sign Up to Acbuy for $550 worth of shipping coupons !</div>
                <div class="welcome-divider"></div>
                <p class="welcome-text">
                    Sign up to ACBuy here to get
                    <strong>$550 worth of free shipping coupons</strong>.
                </p>
                <a
                    href="https://www.acbuy.com/login?loginStatus=register&code=ZSTSLZ"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="welcome-cta"
                    data-dismiss="welcome-modal"
                    style="text-decoration:none;"
                >
                    Claim my coupons
                </a>
                <div class="welcome-footnote">
                    * Limited time offer for new members
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var overlay = document.getElementById('welcome-overlay');
                if (!overlay) {
                    return;
                }

                function hideOverlay() {
                    overlay.classList.add('welcome-overlay--hidden');
                }

                // Smooth entrance on initial page load
                window.setTimeout(function () {
                    overlay.classList.remove('welcome-overlay--hidden');
                }, 80);

                var loginLink = document.getElementById('login-link');
                if (loginLink) {
                    loginLink.addEventListener('click', function (event) {
                        var url = loginLink.getAttribute('data-login-url') || loginLink.getAttribute('href');
                        if (url) {
                            event.preventDefault();
                            window.location.href = url;
                        }
                    });
                }

                overlay.addEventListener('click', function (event) {
                    if (event.target === overlay) {
                        hideOverlay();
                    }
                });

                var dismissButtons = overlay.querySelectorAll('[data-dismiss=\"welcome-modal\"]');
                dismissButtons.forEach(function (button) {
                    button.addEventListener('click', hideOverlay);
                });
            });
        </script>
    </body>
</html>
