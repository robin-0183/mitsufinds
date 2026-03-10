<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Products · {{ config('app.name', 'mxtsu') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: #000000;
                color: #ffffff;
            }

            .shell {
                max-width: 1200px;
                margin: 0 auto;
                padding: 5.5rem 1.5rem 3rem 3rem;
            }

            header {
                display: flex;
                align-items: center;
                gap: 1.5rem;
                margin-bottom: 2rem;
            }

            .search-wrap {
                flex: 1;
                display: flex;
                justify-content: center;
            }

            .search-bar {
                width: 100%;
                max-width: 85%;
                padding: 0.75rem 1.25rem;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                font-size: 1rem;
                background: #0a0a0a;
                border: 1px solid #333;
                border-radius: 999px;
                color: #ffffff;
            }

            .search-bar::placeholder {
                color: rgba(255, 255, 255, 0.6);
            }

            .search-bar:focus {
                outline: none;
                border-color: #555;
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
            }

            .back-link:hover {
                color: #e5e7eb;
            }

            .title {
                position: fixed;
                top: 2.75rem;
                left: 1.5rem;
                z-index: 10;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                font-size: 1.6rem;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                margin: 0;
            }

            .products-layout {
                display: flex;
                gap: 2rem;
                align-items: flex-start;
            }

            @media (max-width: 768px) {
                .products-layout { flex-direction: column; }
                .filter-panel { width: 100%; }
            }

            .filter-panel {
                flex-shrink: 0;
                width: 380px;
                min-height: calc(100vh - 6rem);
                background: #000000;
                border-radius: 1rem;
                padding: 1.75rem 1.5rem;
                margin-top: 7.5rem;
                margin-left: -25rem;
            }

            .filter-sidebar-title {
                font-size: 0.8rem;
                font-weight: 700;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: #ffffff;
                margin-bottom: 1.25rem;
                padding-bottom: 0.75rem;
                border-bottom: 1px solid #1a1a1a;
            }

            .filter-section {
                margin-bottom: 1.5rem;
            }

            .filter-section:last-child {
                margin-bottom: 0;
            }

            .filter-heading {
                font-size: 0.8rem;
                font-weight: 700;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                color: #ffffff;
                margin-bottom: 1rem;
            }

            .filter-categories {
                list-style: none;
                padding: 0;
                margin: 0 0 1.75rem 0;
            }

            .filter-categories li {
                margin-bottom: 0.4rem;
            }

            .filter-categories a,
            .filter-categories button {
                display: block;
                width: 100%;
                padding: 0.6rem 0.9rem;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                font-size: 0.95rem;
                font-weight: 700;
                letter-spacing: 0.08em;
                color: #ffffff;
                background: transparent;
                border: none;
                border-radius: 0.5rem;
                text-align: left;
                cursor: pointer;
                text-decoration: none;
                transition: transform 0.2s ease, background 0.2s ease;
            }

            .filter-categories a:hover,
            .filter-categories button:hover {
                color: #ffffff;
                background: #111111;
                transform: scale(1.05);
            }

            .filter-categories .active {
                background: #111111;
                color: #ffffff;
            }

            .filter-price-wrap {
                margin-bottom: 0;
            }

            .filter-section-price-range {
                transition: transform 0.2s ease;
                transform-origin: left center;
            }

            .filter-section-price-range:hover {
                transform: scale(1.05);
            }

            .filter-price-slider-wrap {
                margin: 1.8rem 0 1rem 0;
                width: 100%;
            }

            .filter-price-slider {
                width: 100%;
                height: 6px;
                -webkit-appearance: none;
                appearance: none;
                background: #1a1a1a;
                border-radius: 999px;
            }

            .filter-price-slider::-webkit-slider-thumb {
                -webkit-appearance: none;
                appearance: none;
                width: 18px;
                height: 18px;
                background: #333;
                border: none;
                border-radius: 50%;
                cursor: pointer;
                box-shadow: 0 0 0 2px #0a0a0a;
            }

            .filter-price-slider::-moz-range-thumb {
                width: 18px;
                height: 18px;
                background: #333;
                border: none;
                border-radius: 50%;
                cursor: pointer;
                box-shadow: 0 0 0 2px #0a0a0a;
            }

            .filter-price-slider-row {
                display: flex;
                gap: 0.5rem;
                align-items: center;
                margin-top: 0.5rem;
            }

            .filter-price-slider-row .filter-price-slider {
                flex: 1;
            }

            .filter-price-inputs {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-top: 1rem;
            }

            .filter-price-inputs input {
                flex: 1;
                padding: 0.55rem 0.7rem;
                font-family: inherit;
                font-size: 0.95rem;
                font-weight: 700;
                background: #0a0a0a;
                border: none;
                border-radius: 0.375rem;
                color: #ffffff;
            }

            .filter-price-inputs input:focus {
                outline: none;
            }

            .filter-price-inputs .to {
                font-size: 0.85rem;
                font-weight: 700;
                color: #ffffff;
                text-transform: uppercase;
            }

            .filter-price-group {
                display: inline-flex;
                align-items: center;
                gap: 0.25rem;
            }

            .filter-price-inputs .currency-prefix {
                font-size: 0.95rem;
                font-weight: 700;
                color: #ffffff;
            }

            .currency-toggle-wrap {
                margin-top: 1rem;
            }

            .currency-toggle {
                padding: 0.4rem 0.75rem;
                font-size: 0.85rem;
                font-weight: 700;
                color: #ffffff;
                background: #1a1a1a;
                border: none;
                border-radius: 0.375rem;
                cursor: pointer;
            }

            .currency-toggle:hover {
                background: #262626;
            }

            .products-main {
                flex: 1;
                min-width: 0;
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
        </style>
    </head>
    <body>
        <div class="shell">
            <a href="{{ route('home') }}" class="back-link">
                &larr; Back to home
            </a>

            <header>
                <div class="title">Products</div>
                <div class="search-wrap">
                    <input
                        type="search"
                        class="search-bar"
                        name="q"
                        placeholder="Search products…"
                        aria-label="Search products"
                        autocomplete="off"
                    >
                </div>
            </header>

            @php
                $maxPrice = $products->isNotEmpty() && $products->max('price') ? (float) $products->max('price') : 500;
                $priceMaxRounded = 1000;
                $initialMaxPrice = min($maxPrice, $priceMaxRounded);
            @endphp
            <div class="products-layout">
                <aside class="filter-panel" role="navigation" aria-label="Product filters">
                    <h2 class="filter-sidebar-title">Filters</h2>

                        <div class="filter-section">
                            <div class="filter-heading">Category</div>
                            <ul class="filter-categories">
                                <li><button type="button" class="filter-cat active" data-category="">All</button></li>
                                <li><button type="button" class="filter-cat" data-category="hoodies">Hoodies</button></li>
                                <li><button type="button" class="filter-cat" data-category="tees">Tees</button></li>
                                <li><button type="button" class="filter-cat" data-category="jeans">Jeans</button></li>
                                <li><button type="button" class="filter-cat" data-category="sweats">Sweats</button></li>
                                <li><button type="button" class="filter-cat" data-category="boots">boots</button></li>
                                <li><button type="button" class="filter-cat" data-category="shoes">shoes</button></li>
                                <li><button type="button" class="filter-cat" data-category="jewelry">jewelry</button></li>
                            </ul>
                        </div>

                    <div class="filter-section filter-section-price-range">
                        <div class="filter-heading">Price range</div>
                        <div class="filter-price-wrap">
                            <div class="filter-price-slider-wrap">
                                <div class="filter-price-slider-row">
                                    <input type="range" class="filter-price-slider" id="price-min-slider" min="1" max="{{ $priceMaxRounded }}" value="1" step="0.01" aria-label="Minimum price">
                                    <input type="range" class="filter-price-slider" id="price-max-slider" min="0" max="{{ $priceMaxRounded }}" value="{{ $initialMaxPrice }}" step="0.01" aria-label="Maximum price">
                                </div>
                            </div>
                            <div class="filter-price-inputs">
                                <span class="filter-price-group">
                                    <span class="currency-prefix" id="filter-currency-min">€</span>
                                    <input
                                        type="text"
                                        id="price-min-input"
                                        value="1,00"
                                        placeholder="1,00"
                                        aria-label="Min price"
                                    >
                                </span>
                                <span class="to">to</span>
                                <span class="filter-price-group">
                                    <span class="currency-prefix" id="filter-currency-max">€</span>
                                    <input
                                        type="text"
                                        id="price-max-input"
                                        value="{{ number_format($initialMaxPrice, 2, ',', '') }}"
                                        placeholder="{{ number_format($priceMaxRounded, 2, ',', '') }}"
                                        aria-label="Max price"
                                    >
                                </span>
                            </div>
                            <div class="currency-toggle-wrap">
                                <button type="button" class="currency-toggle" id="currency-toggle" aria-label="Switch currency">€ / $</button>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="products-main">
                    @if ($products->isEmpty())
                        <div class="empty">
                            No products yet. Visit the admin dashboard to add your first ACBuy item.
                        </div>
                    @else
                        <div class="grid" id="products-grid">
                            @foreach ($products as $product)
                                <article class="card product-card" data-category="{{ $product->category ?? '' }}" data-price="{{ $product->price ?? '' }}">
                                    @if ($product->image_url)
                                        <div class="card-image">
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                        </div>
                                    @endif

                                    <div class="card-body">
                                        <h2 class="card-title">{{ $product->name }}</h2>

                                        @if ($product->description)
                                            <p class="card-description">
                                                {{ Str::limit($product->description, 120) }}
                                            </p>
                                        @endif

                                        <div class="card-footer">
                                            @if ($product->price)
                                                <span class="price"><span class="currency-symbol">€ </span>{{ number_format($product->price, 2, ',', '') }}</span>
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
                    @endif
                </div>
            </div>
        </div>
        <script>
            (function () {
                var grid = document.getElementById('products-grid');
                var cards = grid ? grid.querySelectorAll('.product-card') : [];
                var catButtons = document.querySelectorAll('.filter-cat');
                var priceMinInput = document.getElementById('price-min-input');
                var priceMaxInput = document.getElementById('price-max-input');
                var priceMinSlider = document.getElementById('price-min-slider');
                var priceMaxSlider = document.getElementById('price-max-slider');
                var maxVal = {{ $priceMaxRounded }};

                function parsePrice(raw, fallback) {
                    if (typeof raw !== 'string') {
                        return fallback;
                    }
                    var normalized = raw.replace(',', '.');
                    var n = parseFloat(normalized);
                    return isNaN(n) ? fallback : n;
                }

                function formatPrice(num) {
                    var rounded = Math.round((num + Number.EPSILON) * 100) / 100;
                    var parts = rounded.toFixed(2).split('.');
                    return parts[0] + ',' + parts[1];
                }

                function applyFilters() {
                    if (!grid || !cards.length) return;
                    var cat = document.querySelector('.filter-cat.active');
                    var category = cat ? cat.getAttribute('data-category') : '';
                    var minP = parsePrice(priceMinInput.value, 1);
                    var maxP = parsePrice(priceMaxInput.value, maxVal);
                    if (minP > maxP) { var t = minP; minP = maxP; maxP = t; }
                    cards.forEach(function (card) {
                        var c = (card.getAttribute('data-category') || '');
                        var p = card.getAttribute('data-price');
                        var price = p === '' || p === null ? null : parseFloat(p);
                        var matchCat = !category || c === category;
                        var matchPrice = true;
                        if (price !== null && !isNaN(price)) {
                            matchPrice = price >= minP && price <= maxP;
                        } else if (minP > 0 || maxP < maxVal) {
                            matchPrice = false;
                        }
                        card.style.display = (matchCat && matchPrice) ? '' : 'none';
                    });
                }

                function syncMinFromSlider() {
                    if (!priceMinSlider || !priceMinInput) return;
                    var v = parseFloat(priceMinSlider.value) || 1;
                    priceMinInput.value = formatPrice(v);
                    applyFilters();
                }
                function syncMaxFromSlider() {
                    if (!priceMaxSlider || !priceMaxInput) return;
                    var v = parseFloat(priceMaxSlider.value) || maxVal;
                    priceMaxInput.value = formatPrice(v);
                    applyFilters();
                }
                function syncMinFromInput() {
                    if (!priceMinInput) return;
                    var v = parsePrice(priceMinInput.value, 1);
                    var clamped = Math.min(maxVal, Math.max(1, v));
                    if (priceMinSlider) priceMinSlider.value = clamped;
                    applyFilters();
                }
                function syncMaxFromInput() {
                    if (!priceMaxInput) return;
                    var v = parsePrice(priceMaxInput.value, maxVal);
                    var clamped = Math.min(maxVal, Math.max(0, v));
                    if (priceMaxSlider) priceMaxSlider.value = clamped;
                    applyFilters();
                }
                function formatMinInputOnBlur() {
                    if (!priceMinInput) return;
                    var v = parsePrice(priceMinInput.value, 1);
                    var clamped = Math.min(maxVal, Math.max(1, v));
                    priceMinInput.value = formatPrice(clamped);
                    if (priceMinSlider) priceMinSlider.value = clamped;
                    applyFilters();
                }
                function formatMaxInputOnBlur() {
                    if (!priceMaxInput) return;
                    var v = parsePrice(priceMaxInput.value, maxVal);
                    var clamped = Math.min(maxVal, Math.max(0, v));
                    priceMaxInput.value = formatPrice(clamped);
                    if (priceMaxSlider) priceMaxSlider.value = clamped;
                    applyFilters();
                }

                catButtons.forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        catButtons.forEach(function (b) { b.classList.remove('active'); });
                        btn.classList.add('active');
                        applyFilters();
                    });
                });
                if (priceMinInput) {
                    priceMinInput.addEventListener('input', syncMinFromInput);
                    priceMinInput.addEventListener('blur', formatMinInputOnBlur);
                }
                if (priceMaxInput) {
                    priceMaxInput.addEventListener('input', syncMaxFromInput);
                    priceMaxInput.addEventListener('blur', formatMaxInputOnBlur);
                }
                if (priceMinSlider) priceMinSlider.addEventListener('input', syncMinFromSlider);
                if (priceMaxSlider) priceMaxSlider.addEventListener('input', syncMaxFromSlider);

                var currentCurrency = '€';
                var toggleBtn = document.getElementById('currency-toggle');
                var prefixMin = document.getElementById('filter-currency-min');
                var prefixMax = document.getElementById('filter-currency-max');
                function updateCurrency() {
                    currentCurrency = currentCurrency === '€' ? '$' : '€';
                    if (prefixMin) prefixMin.textContent = currentCurrency;
                    if (prefixMax) prefixMax.textContent = currentCurrency;
                    document.querySelectorAll('.currency-symbol').forEach(function (el) { el.textContent = currentCurrency + ' '; });
                }
                if (toggleBtn) toggleBtn.addEventListener('click', updateCurrency);
            })();
        </script>
    </body>
</html>
