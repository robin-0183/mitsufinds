<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Favorites · {{ config('app.name', 'mxtsu') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                font-family: 'Oswald', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                font-size: 1.4rem;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                margin: 0 0 0.75rem;
            }

            .products-topbar {
                margin-top: 1.5rem;
                margin-bottom: 1.5rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .products-count {
                font-family: 'Oswald', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                font-weight: 500;
                color: #ffffff;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 1.4rem;
                margin-top: 80px;
            }

            @media (max-width: 1024px) {
                .grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }
            }

            @media (max-width: 768px) {
                .shell { padding: 1rem 1rem 2rem; }
                .grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    gap: 1rem;
                    margin-top: 1rem;
                }
                .back-link { left: 0.75rem; top: 0.75rem; font-size: 0.8rem; }
            }

            @media (max-width: 480px) {
                .shell { padding: 0.75rem 0.75rem 1.5rem; }
                .grid { grid-template-columns: 1fr; gap: 1rem; }
            }

            @keyframes product-card-in {
                from {
                    opacity: 0;
                    transform: translateY(24px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .grid .product-card {
                opacity: 0;
            }

            .grid.is-visible .product-card {
                animation: product-card-in 0.55s ease forwards;
            }

            .card {
                position: relative;
                border-radius: 1.1rem;
                overflow: hidden;
                background: #000000;
                border: 1px solid #000000;
                display: flex;
                flex-direction: column;
                min-height: 300px;
                box-shadow: 0 14px 32px rgba(0, 0, 0, 0.95);
                transition: transform 0.2s ease-out, box-shadow 0.2s ease-out, border-color 0.2s ease-out;
            }

            .card:hover {
                transform: scale(1.08) translateY(-4px);
                border-color: #ffffff;
                box-shadow:
                    0 0 10px rgba(255, 255, 255, 0.7),
                    0 0 22px rgba(255, 255, 255, 0.4),
                    0 16px 40px rgba(0, 0, 0, 0.95);
            }

            .card-image {
                position: relative;
                padding-top: 90%;
                background: #000000;
                overflow: hidden;
            }

            .card-image img {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                object-fit: contain;
                background: #000000;
                transition: transform 0.26s ease-out;
            }

            .card:hover .card-image img {
                transform: scale(1.12);
            }

            .card-body {
                padding: 0.75rem 0.85rem 0.6rem;
                display: flex;
                flex-direction: column;
                gap: 0.3rem;
                flex: 1;
            }

            .card-title {
                font-size: 1.05rem;
                font-weight: 700;
                color: #ffffff;
            }

            .card-footer {
                margin-top: auto;
                padding: 0 0.6rem 0.55rem;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .card-price-pill {
                position: absolute;
                top: 2.1rem;
                right: 0.55rem;
                min-width: 28px;
                padding: 0.12rem 0.4rem;
                border-radius: 999px;
                background: #000000;
                border: 1px solid #ffffff;
                font-size: 0.65rem;
                font-weight: 600;
                text-align: center;
            }

            .card-price-pill .currency-symbol {
                margin-right: 0.1rem;
            }

            .card-fav-btn {
                position: absolute;
                top: 0.55rem;
                right: 0.55rem;
                width: 32px;
                height: 32px;
                border-radius: 999px;
                background: rgba(0, 0, 0, 0.9);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: #ffffff;
                box-shadow: 0 0 12px rgba(255, 255, 255, 0.95);
                border: none;
                padding: 0;
                cursor: pointer;
                z-index: 2;
                transition: transform 0.2s ease-out, box-shadow 0.2s ease-out, background 0.2s ease-out;
            }

            .card-fav-btn:hover {
                transform: scale(1.22);
                box-shadow:
                    0 0 16px rgba(255, 255, 255, 1),
                    0 0 26px rgba(255, 255, 255, 0.8);
                background: #000000;
            }

            .card-fav-btn svg {
                width: 20px;
                height: 20px;
            }

            .card-fav-btn.is-active {
                background: #ffffff;
                color: #000000;
                box-shadow:
                    0 0 14px rgba(255, 255, 255, 1),
                    0 0 24px rgba(255, 255, 255, 0.7);
            }

            .card-fav-btn.is-active svg path {
                fill: currentColor;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.35rem 0.7rem;
                border-radius: 999px;
                border: none;
                font-size: 0.7rem;
                font-weight: 700;
                cursor: pointer;
                text-decoration: none;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .product-card .btn-primary {
                width: 100%;
                justify-content: center;
                gap: 0.3rem;
                background: #ffffff;
                color: #000000;
                border-radius: 999px;
                border: 1px solid #ffffff;
                box-shadow: 0 6px 14px rgba(0, 0, 0, 0.6);
                transition: transform 0.16s ease-out, box-shadow 0.16s ease-out, border-color 0.16s ease-out, background 0.16s ease-out, color 0.16s ease-out;
            }

            .product-card .btn-primary:hover {
                background: #f9fafb;
                color: #000000;
                border-color: #22c55e;
                box-shadow:
                    0 0 8px rgba(255, 255, 255, 0.85),
                    0 0 14px rgba(34, 197, 94, 0.45);
                transform: scale(1.03) translateY(-1px);
            }

            .empty {
                margin-top: 3rem;
                text-align: center;
                opacity: 0.75;
                font-size: 0.95rem;
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
            <a href="{{ route('products.index') }}" class="back-link">&larr; Back to products</a>

            <header>
                <h1 class="title">Favorites</h1>
            </header>

            <div class="products-topbar">
                <div class="products-count" id="favorites-count-label">
                    Showing 0 favorites
                </div>
            </div>

            @if($products->isEmpty())
                <div class="empty">
                    No products available yet.
                </div>
            @else
                <div class="grid" id="favorites-grid">
                    @foreach ($products as $product)
                        <article class="card product-card" data-product-id="{{ $product->id }}">
                            <button type="button" class="card-fav-btn" data-product-id="{{ $product->id }}" aria-label="Toggle favorite">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.001 20.25C12.001 20.25 5 15.75 5 9.75C5 7.127 7.014 5.25 9.35 5.25C10.77 5.25 12.001 6.036 12.001 6.036C12.001 6.036 13.232 5.25 14.652 5.25C16.988 5.25 19.002 7.127 19.002 9.75C19.002 15.75 12.001 20.25 12.001 20.25Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>

                            @if ($product->price)
                                <div class="card-price-pill">
                                    <span class="currency-symbol">€</span>{{ number_format($product->price, 0, ',', '') }}
                                </div>
                            @endif

                            @if ($product->image_url)
                                <div class="card-image">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                </div>
                            @endif

                            <div class="card-body">
                                <h2 class="card-title">{{ $product->name }}</h2>
                            </div>

                            <div class="card-footer">
                                <a href="{{ $product->affiliate_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                                    <span aria-hidden="true">
                                        🛒
                                    </span>
                                    <span>Buy now</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="empty" id="favorites-empty" style="display:none;">
                    You have no favorites yet. Go back to Products and tap the heart icon to favorite items.
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

            (function () {
                var gridEl = document.getElementById('favorites-grid');
                if (!gridEl) return;

                var favKey = 'mitsufinds:favorites';

                function loadFavs() {
                    try {
                        var raw = window.localStorage.getItem(favKey);
                        if (!raw) return [];
                        var parsed = JSON.parse(raw);
                        return Array.isArray(parsed) ? parsed : [];
                    } catch (e) {
                        return [];
                    }
                }

                function saveFavs(list) {
                    try {
                        window.localStorage.setItem(favKey, JSON.stringify(list));
                    } catch (e) {}
                }

                function updateFavoritesView() {
                    var favIds = loadFavs();
                    var cards = gridEl.querySelectorAll('.product-card');
                    var visibleCount = 0;

                    cards.forEach(function (card) {
                        var id = card.getAttribute('data-product-id');
                        var btn = card.querySelector('.card-fav-btn');
                        if (!id || !btn) return;

                        if (favIds.indexOf(id) !== -1) {
                            card.style.display = '';
                            btn.classList.add('is-active');
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                            btn.classList.remove('is-active');
                        }
                    });

                    var countLabel = document.getElementById('favorites-count-label');
                    if (countLabel) {
                        countLabel.textContent = 'Showing ' + visibleCount + ' favorite' + (visibleCount === 1 ? '' : 's');
                    }

                    var emptyEl = document.getElementById('favorites-empty');
                    if (emptyEl) {
                        emptyEl.style.display = visibleCount === 0 ? 'block' : 'none';
                    }

                    if (!gridEl.classList.contains('is-visible')) {
                        gridEl.classList.add('is-visible');
                        var cardsArr = gridEl.querySelectorAll('.product-card');
                        cardsArr.forEach(function (card, i) {
                            card.style.animationDelay = (i * 0.06) + 's';
                        });
                    }
                }

                gridEl.addEventListener('click', function (event) {
                    var target = event.target;
                    var btn = target.closest('.card-fav-btn');
                    if (!btn) return;
                    var id = btn.getAttribute('data-product-id');
                    if (!id) return;

                    var favIds = loadFavs();
                    var idx = favIds.indexOf(id);
                    if (idx === -1) {
                        favIds.push(id);
                    } else {
                        favIds.splice(idx, 1);
                    }
                    saveFavs(favIds);
                    updateFavoritesView();
                });

                updateFavoritesView();
            })();
        </script>
    </body>
</html>
