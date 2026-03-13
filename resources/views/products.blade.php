<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Products · {{ config('app.name', 'mxtsu') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            html { font-size: 90%; }
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: #000000;
                color: #ffffff;
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
                padding: 5.5rem 1.5rem 3rem 3rem;
            }

            header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .search-wrap {
                flex: 1;
                display: flex;
                justify-content: flex-end;
                min-width: 0;
            }

            .search-bar {
                width: 100%;
                max-width: 420px;
                padding: 0.85rem 1.35rem;
                font-family: 'Oswald', system-ui, sans-serif;
                font-size: 1.1rem;
                font-weight: 500;
                letter-spacing: 0.02em;
                background: #000000;
                border: none;
                border-radius: 999px;
                color: #ffffff;
                box-shadow: 0 0 0 0 transparent;
                transition: transform 0.2s ease, font-size 0.2s ease, padding 0.2s ease, box-shadow 0.25s ease;
            }

            .search-bar:hover {
                transform: scale(1.03);
                font-size: 1.15rem;
                padding: 0.9rem 1.4rem;
                box-shadow: 0 0 12px 2px rgba(255, 255, 255, 0.4);
            }

            .search-bar:focus {
                outline: none;
                transform: scale(1.03);
                font-size: 1.15rem;
                padding: 0.9rem 1.4rem;
                box-shadow: 0 0 14px 3px rgba(255, 255, 255, 0.5);
            }

            .search-bar::placeholder {
                color: rgba(255, 255, 255, 0.6);
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
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                font-size: 1.4rem;
                font-weight: 700;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                margin: 0;
            }

            .products-layout {
                display: flex;
                gap: 2.25rem;
                align-items: flex-start;
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
                position: sticky;
                top: 1.5rem;
                align-self: flex-start;
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
                margin-bottom: 0.6rem;
            }

            .filter-categories a,
            .filter-categories button {
                display: block;
                width: 100%;
                padding: 0.9rem 1.1rem;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                font-size: 1.02rem;
                font-weight: 700;
                letter-spacing: 0.08em;
                color: #ffffff;
                background: transparent;
                border: none;
                border-radius: 0.5rem;
                text-align: left;
                cursor: pointer;
                text-decoration: none;
                box-shadow: 0 0 0 transparent;
                transition: transform 0.2s ease, background 0.2s ease, box-shadow 0.25s ease;
            }

            .filter-categories a:hover,
            .filter-categories button:hover {
                color: #ffffff;
                background: #111111;
                transform: scale(1.05);
                box-shadow: 0 0 12px 2px rgba(255, 255, 255, 0.35);
            }

            .filter-categories .active {
                background: #111111;
                color: #ffffff;
            }

            .filter-cat-parent {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
            }

            .filter-cat-chevron {
                font-size: 0.75rem;
                opacity: 0.8;
                transition: transform 0.2s ease;
            }

            .filter-cat-parent-toggle.is-open .filter-cat-chevron {
                transform: rotate(90deg);
            }

            .filter-category-sublist {
                list-style: none;
                padding: 0;
                margin: 0;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.2s ease;
            }

            .filter-category-sublist.is-open {
                max-height: 400px;
            }

            .filter-category-sublist li {
                margin-bottom: 0.4rem;
            }

            .filter-category-sublist .filter-cat {
                padding-left: 1.25rem;
            }

            .filter-cat-parent-toggle,
            .filter-category-sublist .filter-cat {
                font-family: 'Open Sans', system-ui, sans-serif;
                color: #6b7280;
            }

            .filter-cat-parent-toggle:hover,
            .filter-category-sublist .filter-cat:hover {
                color: #9ca3af;
                background: #111111;
                box-shadow: 0 0 12px 2px rgba(255, 255, 255, 0.35);
            }

            .filter-category-sublist .filter-cat.active {
                color: #d1d5db;
                background: #111111;
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

            .sort-wrap {
                margin-top: 1rem;
            }

            .products-main {
                flex: 1;
                min-width: 0;
            }

            .products-topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 1.5rem;
                font-size: 0.85rem;
            }

            .products-count {
                font-family: 'Oswald', system-ui, sans-serif;
                font-weight: 500;
                color: #ffffff;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .products-sort {
                display: flex;
                flex-direction: column;
                gap: 0.4rem;
            }

            .products-sort label {
                font-size: 0.8rem;
                font-family: 'Oswald', system-ui, sans-serif;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                color: #ffffff;
            }

            .products-sort select {
                padding: 0.4rem 1.5rem 0.4rem 0.75rem;
                font-size: 0.9rem;
                font-family: 'Oswald', system-ui, sans-serif;
                font-weight: 500;
                letter-spacing: 0.03em;
                border-radius: 0.375rem;
                border: none;
                background: #000000;
                color: #ffffff;
                cursor: pointer;
            }

            .products-sort select:focus {
                outline: none;
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

            .filter-panel-backdrop {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.6);
                z-index: 999;
                opacity: 0;
                transition: opacity 0.25s ease;
            }
            body.filters-open .filter-panel-backdrop {
                display: block;
                opacity: 1;
            }
            .mobile-filters-btn {
                display: none;
                align-items: center;
                gap: 0.5rem;
                padding: 0.5rem 0.9rem;
                font-size: 0.9rem;
                font-weight: 600;
                color: #fff;
                background: #111;
                border: 1px solid rgba(255, 255, 255, 0.3);
                border-radius: 0.5rem;
                cursor: pointer;
            }
            .mobile-filters-btn:hover { background: #1a1a1a; }
            .filter-panel-close {
                display: none;
                position: absolute;
                top: 1rem;
                right: 1rem;
                width: 2.25rem;
                height: 2.25rem;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                line-height: 1;
                color: #9ca3af;
                background: transparent;
                border: none;
                cursor: pointer;
                padding: 0;
            }
            .filter-panel-close:hover { color: #fff; }

            @media (max-width: 768px) {
                body.filters-open { overflow: hidden; }
                .shell { padding: 1rem 1rem 2rem 1rem; }
                .products-layout {
                    flex-direction: row;
                    align-items: stretch;
                }
                .filter-panel {
                    position: fixed;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    width: 300px;
                    max-width: 85vw;
                    margin: 0;
                    margin-left: 0;
                    margin-top: 0;
                    min-height: 100vh;
                    padding: 3rem 1rem 1.5rem 1rem;
                    z-index: 1000;
                    transform: translateX(-100%);
                    transition: transform 0.25s ease;
                    overflow-y: auto;
                    border-radius: 0;
                }
                body.filters-open .filter-panel { transform: translateX(0); }
                .filter-panel-close { display: flex; }
                .filter-sidebar-title { padding-right: 2.5rem; }
                .products-main { flex: 1; min-width: 0; }
                .mobile-filters-btn { display: inline-flex; }
                .products-topbar {
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                    justify-content: space-between;
                    gap: 0.5rem;
                    margin-bottom: 0.5rem;
                }
                .grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    gap: 1rem;
                    margin-top: 0.5rem;
                }
                .products-count { font-size: 0.9rem; }
                .back-link { left: 0.75rem; top: 0.75rem; font-size: 0.8rem; }
                .filter-section { margin-bottom: 1.25rem; }
                .filter-categories button,
                .filter-categories .filter-cat { padding: 0.75rem 0.9rem; font-size: 0.95rem; }
                .filter-price-inputs { flex-wrap: wrap; }
                .product-card .card-title { font-size: 0.9rem; }
                .product-card .card-price-pill { font-size: 0.85rem; }
                .product-card .btn-primary { padding: 0.5rem 0.75rem; font-size: 0.85rem; }
            }

            @media (max-width: 480px) {
                .shell { padding: 0.75rem 0.75rem 1.5rem; }
                .filter-panel { width: 280px; padding: 2.75rem 0.75rem 1.25rem 0.75rem; }
                .grid {
                    grid-template-columns: 1fr;
                    gap: 1rem;
                    margin-top: 0.5rem;
                }
                .filter-heading { font-size: 0.75rem; margin-bottom: 0.75rem; }
                .filter-categories .filter-cat { padding: 0.65rem 0.8rem; font-size: 0.9rem; }
                .filter-category-sublist .filter-cat { padding-left: 1rem; }
                .product-card .card-body { padding: 0.75rem; }
                .product-card .card-title { font-size: 0.85rem; }
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

            @keyframes product-card-out {
                from {
                    opacity: 1;
                    transform: translateY(0);
                }
                to {
                    opacity: 0;
                    transform: translateY(24px);
                }
            }

            .grid .product-card {
                opacity: 0;
            }

            .grid.is-visible .product-card {
                animation: product-card-in 0.55s ease forwards;
            }

            .grid.is-visible .product-card.card--exiting {
                animation: product-card-out 0.55s ease forwards;
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

            .card-description {
                display: none;
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

            .filter-favorites {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                margin-left: 0.5rem;
            }

            .filter-favorites-count {
                min-width: 16px;
                padding: 0 0.25rem;
                border-radius: 999px;
                background: #ffffff;
                color: #000000;
                font-size: 0.72rem;
                font-weight: 700;
                text-align: center;
            }

            .filter-favorites-icon {
                width: 32px;
                height: 32px;
                border-radius: 999px;
                background: rgba(0, 0, 0, 0.9);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: #ffffff;
                box-shadow: 0 0 12px rgba(255, 255, 255, 0.95);
            }

            .filter-favorites-icon svg {
                width: 20px;
                height: 20px;
            }

            .filter-favorites-link {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                text-decoration: none;
                color: inherit;
            }

            @keyframes filter-fav-pulse {
                0% {
                    transform: scale(1);
                    box-shadow: 0 0 12px rgba(255, 255, 255, 0.95);
                }
                50% {
                    transform: scale(1.18);
                    box-shadow:
                        0 0 18px rgba(255, 255, 255, 1),
                        0 0 26px rgba(255, 255, 255, 0.85);
                }
                100% {
                    transform: scale(1);
                    box-shadow: 0 0 12px rgba(255, 255, 255, 0.95);
                }
            }

            .filter-favorites-icon.is-animating {
                animation: filter-fav-pulse 0.55s ease-out;
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
        <div class="page-load-overlay" id="products-page-load-overlay" aria-hidden="false">
            <div class="page-load-spinner" aria-hidden="true"></div>
        </div>
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
                <div class="filter-panel-backdrop" id="filter-backdrop" aria-hidden="true"></div>
                <aside class="filter-panel" role="navigation" aria-label="Product filters">
                    <button type="button" class="filter-panel-close" id="filter-panel-close" aria-label="Close filters">&times;</button>
                    <h2 class="filter-sidebar-title">
                        Filters
                        <span class="filter-favorites" id="filter-favorites" aria-hidden="true" style="display:none;">
                            <a href="{{ route('favorites') }}" class="filter-favorites-link">
                                <span class="filter-favorites-icon" id="filter-favorites-icon">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.001 20.25C12.001 20.25 5 15.75 5 9.75C5 7.127 7.014 5.25 9.35 5.25C10.77 5.25 12.001 6.036 12.001 6.036C12.001 6.036 13.232 5.25 14.652 5.25C16.988 5.25 19.002 7.127 19.002 9.75C19.002 15.75 12.001 20.25 12.001 20.25Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="filter-favorites-count" id="filter-favorites-count">0</span>
                            </a>
                        </span>
                    </h2>

                        <div class="filter-section">
                            <div class="filter-heading">Category</div>
                            <ul class="filter-categories">
                                <li><button type="button" class="filter-cat active" data-category="" data-brand="">All</button></li>
                                <li>
                                    <button type="button" class="filter-cat filter-cat-parent-toggle filter-cat-hoodies-toggle" id="hoodies-toggle" data-category="hoodies" data-brand="" aria-expanded="false">
                                        <span class="filter-cat-parent">
                                            <span>Hoodies</span>
                                            <span class="filter-cat-chevron" aria-hidden="true">›</span>
                                        </span>
                                    </button>
                                    <ul class="filter-category-sublist" id="hoodies-brands" aria-hidden="true">
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="hoodies" data-brand="">All hoodies</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="hoodies" data-brand="balenciaga">Balenciaga</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="hoodies" data-brand="mm6">mm6</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="hoodies" data-brand="rick_owens">rick owens</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="hoodies" data-brand="supreme">supreme</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="hoodies" data-brand="erd">erd</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="hoodies" data-brand="vetements">Vetements</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="hoodies" data-brand="underground">Underground</button></li>
                                    </ul>
                                </li>
                                <li>
                                    <button type="button" class="filter-cat filter-cat-parent-toggle" id="tees-toggle" data-category="tees" data-brand="" aria-expanded="false">
                                        <span class="filter-cat-parent">
                                            <span>Tees</span>
                                            <span class="filter-cat-chevron" aria-hidden="true">›</span>
                                        </span>
                                    </button>
                                    <ul class="filter-category-sublist" id="tees-brands" aria-hidden="true">
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="tees" data-brand="">All tees</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="tees" data-brand="balenciaga">Balenciaga</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="tees" data-brand="mm6">mm6</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="tees" data-brand="rick_owens">rick owens</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="tees" data-brand="supreme">supreme</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="tees" data-brand="erd">erd</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="tees" data-brand="vetements">Vetements</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="tees" data-brand="underground">Underground</button></li>
                                    </ul>
                                </li>
                                <li>
                                    <button type="button" class="filter-cat filter-cat-parent-toggle" id="jeans-toggle" data-category="jeans" data-brand="" aria-expanded="false">
                                        <span class="filter-cat-parent">
                                            <span>Jeans</span>
                                            <span class="filter-cat-chevron" aria-hidden="true">›</span>
                                        </span>
                                    </button>
                                    <ul class="filter-category-sublist" id="jeans-brands" aria-hidden="true">
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="jeans" data-brand="">All jeans</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="jeans" data-brand="balenciaga">Balenciaga</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="jeans" data-brand="rick_owens">Rick Owens</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="jeans" data-brand="mm6">mm6</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="jeans" data-brand="acne">Acne</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="jeans" data-brand="vetements">Vetements</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="jeans" data-brand="underground">Underground</button></li>
                                    </ul>
                                </li>
                                <li>
                                    <button type="button" class="filter-cat filter-cat-parent-toggle" id="sweats-toggle" data-category="sweats" data-brand="" aria-expanded="false">
                                        <span class="filter-cat-parent">
                                            <span>Sweats</span>
                                            <span class="filter-cat-chevron" aria-hidden="true">›</span>
                                        </span>
                                    </button>
                                    <ul class="filter-category-sublist" id="sweats-brands" aria-hidden="true">
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="sweats" data-brand="">All sweats</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="sweats" data-brand="underground">Underground</button></li>
                                    </ul>
                                </li>
                                <li>
                                    <button type="button" class="filter-cat filter-cat-parent-toggle" id="boots-toggle" data-category="boots" data-brand="" aria-expanded="false">
                                        <span class="filter-cat-parent">
                                            <span>boots</span>
                                            <span class="filter-cat-chevron" aria-hidden="true">›</span>
                                        </span>
                                    </button>
                                    <ul class="filter-category-sublist" id="boots-brands" aria-hidden="true">
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="boots" data-brand="">All boots</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="boots" data-brand="balenciaga">Balenciaga</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="boots" data-brand="rick_owens">Rick Owens</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="boots" data-brand="vetements">Vetements</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="boots" data-brand="underground">Underground</button></li>
                                    </ul>
                                </li>
                                <li>
                                    <button type="button" class="filter-cat filter-cat-parent-toggle" id="shoes-toggle" data-category="shoes" data-brand="" aria-expanded="false">
                                        <span class="filter-cat-parent">
                                            <span>shoes</span>
                                            <span class="filter-cat-chevron" aria-hidden="true">›</span>
                                        </span>
                                    </button>
                                    <ul class="filter-category-sublist" id="shoes-brands" aria-hidden="true">
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="shoes" data-brand="">All shoes</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="shoes" data-brand="nike">Nike</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="shoes" data-brand="balenciaga">Balenciaga</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="shoes" data-brand="rick_owens">Rick Owens</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="shoes" data-brand="mm6">mm6</button></li>
                                        <li><button type="button" class="filter-cat filter-cat-brand" data-category="shoes" data-brand="underground">Underground</button></li>
                                    </ul>
                                </li>
                                <li><button type="button" class="filter-cat" data-category="jerseys" data-brand="">Jerseys</button></li>
                                <li><button type="button" class="filter-cat" data-category="jewelry" data-brand="">jewelry</button></li>
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
                            <div class="sort-wrap">
                                <form method="GET" action="{{ route('products.index') }}" class="products-sort">
                                    <label for="sort">Sort</label>
                                    <select id="sort" name="sort">
                                        <option value="">Default</option>
                                        <option value="price_asc" @selected(request('sort') === 'price_asc')>Price ↑</option>
                                        <option value="price_desc" @selected(request('sort') === 'price_desc')>Price ↓</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="products-main">
                    <div class="products-topbar">
                        <button type="button" class="mobile-filters-btn" id="mobile-filters-btn" aria-label="Open filters">
                            Filters
                        </button>
                        <div class="products-count">
                            Showing {{ $products->count() }} results
                        </div>
                    </div>
                    @if ($products->isEmpty())
                        <div class="empty">
                            No products yet. Visit the admin dashboard to add your first ACBuy item.
                        </div>
                    @else
                        <div class="grid" id="products-grid">
                            @foreach ($products as $product)
                                <article class="card product-card" data-category="{{ $product->category ?? '' }}" data-brand="{{ $product->brand ?? '' }}" data-price="{{ $product->price ?? '' }}" data-product-id="{{ $product->id }}">
                                    <button type="button" class="card-fav-btn" data-product-id="{{ $product->id }}" aria-label="Favorite product">
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
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy" decoding="async">
                                        </div>
                                    @endif

                                    <div class="card-body">
                                        <h2 class="card-title">{{ $product->name }}</h2>

                                        @if ($product->description)
                                            <p class="card-description">
                                                {{ Str::limit($product->description, 120) }}
                                            </p>
                                        @endif
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
                    @endif
                </div>
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
                    var cat = document.querySelector('.filter-cat.active:not(.filter-cat-parent-toggle)');
                    if (!cat) cat = document.querySelector('.filter-cat.active');
                    var category = cat ? (cat.getAttribute('data-category') || '') : '';
                    var brand = cat ? (cat.getAttribute('data-brand') || '') : '';
                    var minP = parsePrice(priceMinInput.value, 1);
                    var maxP = parsePrice(priceMaxInput.value, maxVal);
                    if (minP > maxP) { var t = minP; minP = maxP; maxP = t; }
                    var categoriesWithBrand = ['hoodies', 'tees', 'jeans', 'sweats', 'boots', 'shoes'];
                    cards.forEach(function (card) {
                        var c = (card.getAttribute('data-category') || '');
                        var b = (card.getAttribute('data-brand') || '');
                        var p = card.getAttribute('data-price');
                        var price = p === '' || p === null ? null : parseFloat(p);
                        var matchCat = !category || c === category || (category === 'jeans' && c === 'jeans_sweats');
                        var matchBrand = true;
                        if (categoriesWithBrand.indexOf(category) >= 0 && brand !== '') {
                            matchBrand = b === brand;
                        }
                        var matchPrice = true;
                        if (price !== null && !isNaN(price)) {
                            matchPrice = price >= minP && price <= maxP;
                        } else if (minP > 0 || maxP < maxVal) {
                            matchPrice = false;
                        }
                        if (matchCat && matchBrand && matchPrice) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
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

                function setupCategoryToggle(toggleId, sublistId) {
                    var toggle = document.getElementById(toggleId);
                    var sublist = document.getElementById(sublistId);
                    if (toggle && sublist) {
                        toggle.addEventListener('click', function () {
                            sublist.classList.toggle('is-open');
                            toggle.classList.toggle('is-open');
                            var open = sublist.classList.contains('is-open');
                            toggle.setAttribute('aria-expanded', open);
                            sublist.setAttribute('aria-hidden', !open);
                        });
                    }
                }
                setupCategoryToggle('hoodies-toggle', 'hoodies-brands');
                setupCategoryToggle('tees-toggle', 'tees-brands');
                setupCategoryToggle('jeans-toggle', 'jeans-brands');
                setupCategoryToggle('sweats-toggle', 'sweats-brands');
                setupCategoryToggle('boots-toggle', 'boots-brands');
                setupCategoryToggle('shoes-toggle', 'shoes-brands');

                catButtons.forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        if (btn.classList.contains('filter-cat-parent-toggle')) return;
                        catButtons.forEach(function (b) { b.classList.remove('active'); });
                        btn.classList.add('active');
                        applyFilters();
                    });
                });

                var hash = (window.location.hash || '').slice(1).toLowerCase();
                if (hash) {
                    var selector = '.filter-cat[data-category="' + hash + '"]:not(.filter-cat-parent-toggle)';
                    var catBtn = document.querySelector(selector);
                    if (catBtn) {
                        catButtons.forEach(function (b) { b.classList.remove('active'); });
                        catBtn.classList.add('active');
                        applyFilters();
                    }
                }

                (function () {
                    var mobileFiltersBtn = document.getElementById('mobile-filters-btn');
                    var filterBackdrop = document.getElementById('filter-backdrop');
                    var filterPanelClose = document.getElementById('filter-panel-close');
                    function openFilters() {
                        document.body.classList.add('filters-open');
                        if (filterBackdrop) filterBackdrop.setAttribute('aria-hidden', 'false');
                    }
                    function closeFilters() {
                        document.body.classList.remove('filters-open');
                        if (filterBackdrop) filterBackdrop.setAttribute('aria-hidden', 'true');
                    }
                    if (mobileFiltersBtn) mobileFiltersBtn.addEventListener('click', openFilters);
                    if (filterPanelClose) filterPanelClose.addEventListener('click', closeFilters);
                    if (filterBackdrop) filterBackdrop.addEventListener('click', closeFilters);
                })();

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

                (function () {
                    var gridEl = document.getElementById('products-grid');
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

                    function updateFavUI() {
                        var favIds = loadFavs();
                        var countEl = document.getElementById('filter-favorites-count');
                        var wrapEl = document.getElementById('filter-favorites');
                        var iconEl = document.getElementById('filter-favorites-icon');
                        var prevCount = parseInt(countEl ? countEl.textContent : '0', 10) || 0;
                        if (wrapEl && countEl) {
                            if (favIds.length > 0) {
                                countEl.textContent = String(favIds.length);
                                wrapEl.style.display = 'inline-flex';
                            } else {
                                wrapEl.style.display = 'none';
                            }
                        }

                        if (iconEl && favIds.length > prevCount) {
                            iconEl.classList.remove('is-animating');
                            // force reflow to restart animation
                            void iconEl.offsetWidth;
                            iconEl.classList.add('is-animating');
                        }

                        var buttons = gridEl.querySelectorAll('.card-fav-btn');
                        buttons.forEach(function (btn) {
                            var id = btn.getAttribute('data-product-id');
                            if (!id) return;
                            if (favIds.indexOf(id) !== -1) {
                                btn.classList.add('is-active');
                            } else {
                                btn.classList.remove('is-active');
                            }
                        });
                    }

                    gridEl.addEventListener('click', function (event) {
                        var target = event.target;
                        var btn = target.closest('.card-fav-btn');
                        if (!btn) {
                            return;
                        }
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
                        updateFavUI();
                    });

                    updateFavUI();
                })();
            })();

            (function () {
                var overlay = document.getElementById('products-page-load-overlay');
                var grid = document.getElementById('products-grid');
                function hideOverlay() {
                    if (overlay) {
                        overlay.classList.add('is-hidden');
                        overlay.setAttribute('aria-hidden', 'true');
                    }
                    if (grid) {
                        grid.classList.add('is-visible');
                        var cards = grid.querySelectorAll('.product-card');
                        cards.forEach(function (card, i) {
                            card.style.animationDelay = (i * 0.04) + 's';
                        });
                    }
                }
                if (document.readyState === 'complete') {
                    hideOverlay();
                } else {
                    window.addEventListener('load', hideOverlay);
                    window.setTimeout(hideOverlay, 200);
                }
            })();
        </script>
        @include('partials.footer')
    </body>
</html>
