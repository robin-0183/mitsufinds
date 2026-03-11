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

            .hero-center {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 60vh;
                width: 100%;
                padding: 16rem 0 2rem;
            }

            .discord-cta-wrap {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 2rem 2rem 0.5rem;
                gap: 3rem;
                width: 100%;
                margin-left: -4rem;
                margin-top: 3rem;
            }

            .discord-cta {
                max-width: 420px;
                padding: 2rem 2.5rem;
                background: #0a0a0a;
                border-radius: 1rem;
                border: 1px solid rgba(255, 255, 255, 0.35);
                box-shadow:
                    0 0 20px rgba(255, 255, 255, 0.2),
                    0 0 40px rgba(255, 255, 255, 0.12),
                    inset 0 0 0 1px rgba(255, 255, 255, 0.08);
                text-align: center;
                transition: transform 0.25s ease;
            }

            .discord-cta:hover {
                transform: scale(1.08);
            }

            .discord-cta a {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                color: #f9fafb;
                text-decoration: none;
                font-size: 1.1rem;
                font-weight: 700;
                text-shadow:
                    0 0 12px rgba(255, 255, 255, 0.9),
                    0 0 24px rgba(255, 255, 255, 0.5),
                    0 0 36px rgba(255, 255, 255, 0.3);
            }

            @keyframes arrow-bounce {
                0%, 100% { transform: translateX(0) scale(1); }
                50% { transform: translateX(8px) scale(1.2); }
            }

            .discord-cta-arrow {
                color: #fff;
                font-size: 1.1rem;
                text-shadow:
                    0 0 10px rgba(255, 255, 255, 0.9),
                    0 0 20px rgba(255, 255, 255, 0.5);
                display: inline-block;
                transition: transform 0.2s ease;
            }

            .discord-cta:hover .discord-cta-arrow {
                animation: arrow-bounce 0.6s ease infinite;
            }

            .discord-cta-sub {
                display: block;
                margin-top: 0.75rem;
                font-size: 0.65rem;
                font-weight: 600;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: #6b7280;
            }

            .tiktok-cta {
                max-width: 420px;
                padding: 2rem 2.5rem;
                background: #0a0a0a;
                border-radius: 1rem;
                border: 1px solid rgba(255, 255, 255, 0.35);
                box-shadow:
                    0 0 20px rgba(255, 255, 255, 0.2),
                    0 0 40px rgba(255, 255, 255, 0.12),
                    inset 0 0 0 1px rgba(255, 255, 255, 0.08);
                text-align: center;
                transition: transform 0.25s ease;
            }

            .tiktok-cta:hover {
                transform: scale(1.08);
            }

            .tiktok-cta a {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                color: #f9fafb;
                text-decoration: none;
                font-size: 1.1rem;
                font-weight: 700;
                text-shadow:
                    0 0 12px rgba(255, 255, 255, 0.9),
                    0 0 24px rgba(255, 255, 255, 0.5),
                    0 0 36px rgba(255, 255, 255, 0.3);
            }

            .tiktok-cta-arrow {
                color: #fff;
                font-size: 1.1rem;
                text-shadow:
                    0 0 10px rgba(255, 255, 255, 0.9),
                    0 0 20px rgba(255, 255, 255, 0.5);
                display: inline-block;
                transition: transform 0.2s ease;
            }

            .tiktok-cta:hover .tiktok-cta-arrow {
                animation: arrow-bounce 0.6s ease infinite;
            }

            .tiktok-cta-sub {
                display: block;
                margin-top: 0.75rem;
                font-size: 0.65rem;
                font-weight: 600;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: #6b7280;
            }

            .category-strip {
                display: flex;
                flex-wrap: nowrap;
                justify-content: center;
                align-items: stretch;
                gap: 4rem;
                margin-top: 22vh;
                margin-bottom: 2rem;
                width: 100%;
            }

            .category-card {
                display: flex;
                flex-direction: column;
                flex: 1;
                min-width: 0;
                max-width: 400px;
                background: #1a1a1a;
                border: 1px solid #2a2a2a;
                border-radius: 1rem;
                overflow: hidden;
                text-decoration: none;
                color: #f9fafb;
                transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .category-card:hover {
                border-color: #404040;
                transform: scale(1.03);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
            }

            .category-card-image {
                aspect-ratio: 1;
                background: #0f0f0f;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
            }

            .category-card-image img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            .category-card-label {
                padding: 1rem 1.25rem;
                font-size: 1.1rem;
                font-weight: 700;
                text-align: center;
                background: #1a1a1a;
                letter-spacing: 0.3em;
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
                width: 1260px;
                max-width: 96vw;
                border-radius: 2.25rem;
                background: #050608;
                border: none;
                padding: 4rem 3.5rem 3.5rem;
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
                top: 1rem;
                right: 1rem;
                border: none;
                background: transparent;
                color: #9ca3af;
                font-size: 1.75rem;
                cursor: pointer;
                transition: transform 0.2s ease, color 0.2s ease;
            }

            .welcome-close:hover {
                transform: scale(1.3);
                color: #fff;
            }

            .welcome-icon {
                width: 80px;
                height: 80px;
                border-radius: 999px;
                background: #111827;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.5rem;
                font-size: 2.2rem;
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
                padding: 1rem 1.5rem;
                background: #f97316;
                color: #020617;
                font-size: 1.35rem;
                font-weight: 700;
                cursor: pointer;
                margin-bottom: 0.9rem;
            }

            .welcome-cta:hover {
                background: #fdba74;
            }

            .welcome-coupons {
                display: flex;
                flex-direction: column;
                gap: 1.25rem;
                margin-bottom: 1.5rem;
            }

            .welcome-coupons .welcome-cta {
                margin-bottom: 0;
                background: #000;
                color: #fff;
                transition: background 0.2s ease, transform 0.2s ease, color 0.2s ease;
                text-shadow:
                    0 0 10px rgba(255, 255, 255, 0.9),
                    0 0 20px rgba(255, 255, 255, 0.5),
                    0 0 30px rgba(255, 255, 255, 0.3);
            }

            .welcome-coupons .welcome-cta:hover {
                background: #1f2937;
                transform: scale(1.03) translateY(-2px);
                color: #22c55e;
                text-shadow:
                    0 0 10px rgba(34, 197, 94, 0.9),
                    0 0 20px rgba(34, 197, 94, 0.5),
                    0 0 30px rgba(34, 197, 94, 0.3);
            }

            .welcome-subtitle {
                font-size: 1.5rem;
                font-weight: 800;
                margin-bottom: 1.5rem;
                color: #e5e7eb;
                text-shadow:
                    0 0 10px rgba(255, 255, 255, 0.9),
                    0 0 20px rgba(255, 255, 255, 0.5),
                    0 0 30px rgba(255, 255, 255, 0.3);
            }

            .welcome-footnote {
                font-size: 1rem;
                opacity: 0.7;
                text-shadow:
                    0 0 8px rgba(255, 255, 255, 0.6),
                    0 0 16px rgba(255, 255, 255, 0.3);
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

            <div class="hero-center">
                <div class="discord-cta-wrap">
                    <div class="discord-cta">
                        <a href="https://discord.gg/zjHfxED6" target="_blank" rel="noopener noreferrer">
                            Join my Discord server
                            <span class="discord-cta-arrow" aria-hidden="true">→</span>
                        </a>
                        <span class="discord-cta-sub">Free entry — exclusive finds inside</span>
                    </div>
                    <div class="tiktok-cta">
                        <a href="https://www.tiktok.com/@mxtsufindss?is_from_webapp=1&sender_device=pc" target="_blank" rel="noopener noreferrer">
                            Follow my TikTok
                            <span class="tiktok-cta-arrow" aria-hidden="true">→</span>
                        </a>
                        <span class="tiktok-cta-sub">Latest finds & drops</span>
                    </div>
                </div>

                <nav class="category-strip" aria-label="Product categories">
                    <a href="{{ route('products.index') }}#shoes" class="category-card">
                        <div class="category-card-image">
                            <img src="{{ asset('images/shoes-icon.png') }}" alt="">
                        </div>
                        <span class="category-card-label">Shoes</span>
                    </a>
                    <a href="{{ route('products.index') }}#tees" class="category-card">
                        <div class="category-card-image"></div>
                        <span class="category-card-label">Tops</span>
                    </a>
                    <a href="{{ route('products.index') }}#jeans" class="category-card">
                        <div class="category-card-image"></div>
                        <span class="category-card-label">Bottoms</span>
                    </a>
                    <a href="{{ route('products.index') }}#sweats" class="category-card">
                        <div class="category-card-image"></div>
                        <span class="category-card-label">Winter</span>
                    </a>
                    <a href="{{ route('products.index') }}#jewelry" class="category-card">
                        <div class="category-card-image"></div>
                        <span class="category-card-label">Jewelry</span>
                    </a>
                </nav>
            </div>

            @if (! $products->isEmpty())
                @php
                    $sections = [
                        'hoodies' => 'Hoodies',
                        'tees' => 'Tees',
                        'jeans' => 'Jeans',
                        'sweats' => 'Sweats',
                        'boots' => 'boots',
                        'shoes' => 'shoes',
                        'jewelry' => 'Jewelry',
                    ];
                @endphp

                @foreach ($sections as $key => $label)
                    @php
                        $sectionProducts = $key === 'jeans'
                            ? $products->whereIn('category', ['jeans', 'jeans_sweats'])
                            : $products->where('category', $key);
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
                <p class="welcome-subtitle">Choose An ACBuy coupon</p>
                <div class="welcome-coupons">
                    @foreach($coupons ?? [] as $coupon)
                        <a
                            href="https://www.acbuy.com/login?loginStatus=register&code=ZSTSLZ"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="welcome-cta"
                            data-dismiss="welcome-modal"
                            style="text-decoration:none;"
                        >
                            {{ $coupon }}
                        </a>
                    @endforeach
                </div>
                <div class="welcome-footnote">
                    only available for new users
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
