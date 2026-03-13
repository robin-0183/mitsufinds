<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <title>FAQ · {{ config('app.name', 'mxtsu') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            html { font-size: 100%; overflow-x: hidden; -webkit-text-size-adjust: 100%; }
            * { box-sizing: border-box; }
            body { overflow-x: hidden; }
            body {
                margin: 0;
                font-family: 'Oswald', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
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

            .faq-header { text-align: center; margin-bottom: 2.5rem; }
            .faq-main-title {
                font-size: 2.25rem;
                font-weight: 700;
                color: #ffffff;
                margin: 0 0 0.75rem;
                letter-spacing: 0.02em;
            }
            .faq-subtitle {
                font-size: 1.2rem;
                font-weight: 400;
                color: #ffffff;
                margin: 0;
                max-width: 560px;
                margin-left: auto;
                margin-right: auto;
                line-height: 1.5;
            }

            .faq-columns {
                display: flex;
                gap: 3rem;
                align-items: flex-start;
                justify-content: center;
            }
            .faq-toc {
                flex-shrink: 0;
                width: 240px;
            }
            .faq-toc-section-title {
                font-size: 1.35rem;
                font-weight: 700;
                color: #ffffff;
                margin: 0 0 0.5rem;
            }
            .faq-toc-section-desc {
                font-size: 1.1rem;
                color: #ffffff;
                margin: 0 0 1.25rem;
                line-height: 1.45;
            }
            .faq-toc-label {
                font-size: 0.85rem;
                font-weight: 600;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: #ffffff;
                margin-bottom: 0.75rem;
            }
            .faq-toc-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .faq-toc-list li {
                margin-bottom: 0.6rem;
                font-size: 1.1rem;
                color: #ffffff;
            }
            .faq-toc-list li a {
                color: inherit;
                text-decoration: none;
            }
            .faq-toc-list li.is-active,
            .faq-toc-list li.is-active a {
                color: #ffffff;
                font-weight: 700;
                font-size: 1.15rem;
            }

            .faq-content { flex: 1; min-width: 0; max-width: 640px; }
            .faq-accordion {
                background: #0f0f0f;
                border-radius: 0.5rem;
                margin-bottom: 0.75rem;
                border: 1px solid rgba(255, 255, 255, 0.08);
            }
            .faq-accordion-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                padding: 1.2rem 1.5rem;
                background: none;
                border: none;
                cursor: pointer;
                text-align: left;
                font-size: 1.35rem;
                font-weight: 600;
                color: #ffffff;
                font-family: inherit;
                outline: none;
                transition: background 0.25s ease, transform 0.25s ease;
            }
            .faq-accordion-header:hover {
                background: rgba(255, 255, 255, 0.08);
                transform: scale(1.04);
            }
            .faq-accordion-header::after {
                content: '';
                flex-shrink: 0;
                width: 12px;
                height: 12px;
                margin-left: 0.75rem;
                border-right: 2px solid #ffffff;
                border-bottom: 2px solid #ffffff;
                transform: rotate(45deg);
                transition: transform 0.25s ease;
            }
            .faq-accordion.is-open .faq-accordion-header::after {
                transform: rotate(-135deg);
            }
            .faq-accordion-body {
                max-height: 0;
                overflow: hidden;
                opacity: 0;
                padding: 0 1.5rem;
                transition: max-height 0.55s ease-in-out, opacity 0.45s ease-in-out, padding 0.45s ease-in-out;
            }
            .faq-accordion.is-open .faq-accordion-body {
                max-height: 40rem;
                opacity: 1;
                padding: 0 1.5rem 1.1rem;
            }
            .faq-accordion-body-inner {
                font-size: 1.2rem;
                color: #ffffff;
                line-height: 1.7;
                padding-top: 0.35rem;
            }

            @media (max-width: 768px) {
                .shell { padding: 1rem 1rem 2rem; }
                .faq-columns { flex-direction: column; gap: 1.5rem; align-items: stretch; }
                .faq-toc { width: 100%; }
                .faq-main-title { font-size: 1.75rem; }
                .faq-accordion-header { min-height: 48px; padding: 1rem 1.25rem; font-size: 1.1rem; }
                .back-link { left: 0.75rem; top: 0.75rem; min-height: 44px; padding: 0.5rem 0; }
            }
            @media (max-width: 480px) {
                .shell { padding: 0.75rem 0.75rem 1.5rem; }
                .faq-main-title { font-size: 1.5rem; }
                .faq-subtitle { font-size: 1rem; }
                .faq-accordion-header { padding: 0.875rem 1rem; font-size: 1rem; }
                .faq-accordion-body-inner { font-size: 1rem; }
            }
        </style>
    </head>
    <body class="has-footer">
        <div class="page-main">
        <div class="page-load-overlay" id="page-load-overlay" aria-hidden="false">
            <div class="page-load-spinner" aria-hidden="true"></div>
        </div>
        <div class="shell">
            <a href="{{ route('home') }}" class="back-link">&larr; Back to home</a>

            <header class="faq-header">
                <h1 class="faq-main-title">Frequently Asked Information</h1>
                <p class="faq-subtitle">This is the anwser to most known questions</p>
            </header>

            <div class="faq-columns">
                <aside class="faq-toc">
                    <h2 class="faq-toc-section-title">General information</h2>
                    <p class="faq-toc-section-desc">This is the anwser to most known questions</p>
                    <div class="faq-toc-label">Table of contents</div>
                    <ol class="faq-toc-list">
                        <li class="is-active"><a href="#agents" data-faq-tab="general">1. Most Asked questions</a></li>
                        <li><a href="#shipping" data-faq-tab="shipping">2. How to ship items</a></li>
                        <li><a href="#batches" data-faq-tab="batches">3. Whats a batch and why is everybody talking about it ?</a></li>
                    </ol>
                </aside>

                <div class="faq-content" id="faq-section-general">
                    <div class="faq-accordion" id="agents" data-accordion>
                        <button type="button" class="faq-accordion-header" aria-expanded="false">Is acbuy a good agent to buy from ?</button>
                        <div class="faq-accordion-body">
                            <div class="faq-accordion-body-inner">
                                Yes, acbuy is the most known and reliable agent to count on..
                            </div>
                        </div>
                    </div>
                    <div class="faq-accordion" data-accordion>
                        <button type="button" class="faq-accordion-header" aria-expanded="false">How fast is shipping on acbuy?</button>
                        <div class="faq-accordion-body">
                            <div class="faq-accordion-body-inner">
                                Every country has a different shipping speed. But the most known shipping time is 1-2 weeks.
                            </div>
                        </div>
                    </div>
                    <div class="faq-accordion" data-accordion>
                        <button type="button" class="faq-accordion-header" aria-expanded="false">Why should I use acbuy?</button>
                        <div class="faq-accordion-body">
                            <div class="faq-accordion-body-inner">
                                ACBuy simplifies finding products and connecting with trusted agents. You can browse items, compare options, and get reliable service in one place.
                            </div>
                        </div>
                    </div>
                    <div class="faq-accordion" data-accordion>
                        <button type="button" class="faq-accordion-header" aria-expanded="false">Why cant i buy arcteryx on acbuy</button>
                        <div class="faq-accordion-body">
                            <div class="faq-accordion-body-inner">
                                U cant buy arcteryx on acbuy because it makes your parcel seized easily
                            </div>
                        </div>
                    </div>
                    <div class="faq-accordion" data-accordion>
                        <button type="button" class="faq-accordion-header" aria-expanded="false">Do sellers allow returns?</button>
                        <div class="faq-accordion-body">
                            <div class="faq-accordion-body-inner">
                                Yes,but some sellers dont,eitherway acbuy will let you know before you officially purchasing the item !
                            </div>
                        </div>
                    </div>
                    <div class="faq-accordion" data-accordion>
                        <button type="button" class="faq-accordion-header" aria-expanded="false">Why are there two versions of the same item?</button>
                        <div class="faq-accordion-body">
                            <div class="faq-accordion-body-inner">
                                There are some cheaper and some expensive batches. The expensive batches are more likely to be the better quality batches and the cheaper ones are more likely to be the worse batches.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-content" id="faq-section-shipping" style="display:none;">
                    <div class="faq-accordion" data-accordion>
                        <button type="button" class="faq-accordion-header" aria-expanded="false">How do I choose a shipping line?</button>
                        <div class="faq-accordion-body">
                            <div class="faq-accordion-body-inner">
                                Cheaper lines are slower and more risky, while expensive lines are usually faster and safer. Pick the line that matches your budget and risk tolerance or ask acbuy support what they recommend for your country.
                            </div>
                        </div>
                    </div>
                    <div class="faq-accordion" data-accordion>
                        <button type="button" class="faq-accordion-header" aria-expanded="false">Can I ship multiple items together?</button>
                        <div class="faq-accordion-body">
                            <div class="faq-accordion-body-inner">
                                Yes, you can usually consolidate several items into one parcel to save on shipping. acbuy will show you the combined weight and price before you pay.
                            </div>
                        </div>
                    </div>
                    <div class="faq-accordion" data-accordion>
                        <button type="button" class="faq-accordion-header" aria-expanded="false">What should I avoid putting in one parcel?</button>
                        <div class="faq-accordion-body">
                            <div class="faq-accordion-body-inner">
                                Try not to mix very risky items with safe items in the same parcel. If customs stop the risky item, they can seize everything that is packed with it.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-content" id="faq-section-batches" style="display:none;">
                    <div class="faq-accordion" data-accordion>
                        <button type="button" class="faq-accordion-header" aria-expanded="false">whats a batch?</button>
                        <div class="faq-accordion-body">
                            <div class="faq-accordion-body-inner">
                                A batch refers to a specific production run from a factory. Popular items often have multiple batches (e.g., LJR, PK, GX) with varying levels of quality and price.
                            </div>
                        </div>
                    </div>
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

                document.querySelectorAll('[data-accordion]').forEach(function (panel) {
                    var btn = panel.querySelector('.faq-accordion-header');
                    if (!btn) return;
                    btn.addEventListener('click', function () {
                        var isOpen = panel.classList.contains('is-open');
                        document.querySelectorAll('[data-accordion].is-open').forEach(function (p) {
                            p.classList.remove('is-open');
                            var h = p.querySelector('.faq-accordion-header');
                            if (h) h.setAttribute('aria-expanded', 'false');
                        });
                        if (!isOpen) {
                            panel.classList.add('is-open');
                            btn.setAttribute('aria-expanded', 'true');
                        }
                    });
                });

                (function () {
                    var general = document.getElementById('faq-section-general');
                    var shipping = document.getElementById('faq-section-shipping');
                    var batches = document.getElementById('faq-section-batches');
                    var tocLinks = document.querySelectorAll('.faq-toc-list a[data-faq-tab]');
                    if (!general || !shipping || !batches || !tocLinks.length) return;

                    function showTab(name) {
                        // hide all sections first
                        general.style.display = 'none';
                        shipping.style.display = 'none';
                        batches.style.display = 'none';

                        if (name === 'shipping') {
                            shipping.style.display = 'block';
                        } else if (name === 'batches') {
                            batches.style.display = 'block';
                        } else {
                            general.style.display = 'block';
                        }
                        tocLinks.forEach(function (link) {
                            var li = link.closest('li');
                            if (!li) return;
                            if (link.getAttribute('data-faq-tab') === name) {
                                li.classList.add('is-active');
                            } else {
                                li.classList.remove('is-active');
                            }
                        });
                    }

                    tocLinks.forEach(function (link) {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();
                            var tab = link.getAttribute('data-faq-tab') || 'general';
                            showTab(tab);
                        });
                    });

                    showTab('general');
                })();
            })();
        </script>
    </body>
</html>
