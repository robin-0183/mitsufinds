<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'mxtsu') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Bebas+Neue&display=swap" rel="stylesheet">
        <style>
            html {
                font-size: 85%;
                scroll-behavior: smooth;
            }
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: #000000;
                color: #f9fafb;
                position: relative;
            }
            .shell {
                position: relative;
                z-index: 1;
                max-width: 1200px;
                margin: 0 auto;
                padding: 1.25rem 1.5rem 40rem;
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
                display: flex;
                align-items: center;
                gap: 0.75rem;
                min-width: 120px;
            }

            .top-bar-center {
                flex: 1;
                display: flex;
                justify-content: flex-start;
                padding-left: 8.5rem;
            }

            .top-nav {
                display: inline-flex;
                align-items: center;
                justify-content: flex-start;
                gap: 2rem;
                padding: 0.9rem 1.5rem 0.9rem 1.25rem;
                min-width: 460px;
                max-width: 52%;
                border-radius: 999px;
                background: #000000;
                border: 1px solid rgba(255, 255, 255, 0.35);
                box-shadow:
                    0 0 0 1px rgba(0, 0, 0, 0.7),
                    0 18px 40px rgba(0, 0, 0, 0.9);
                position: relative;
                transition: transform 0.3s ease, padding 0.3s ease, box-shadow 0.3s ease;
            }

            .top-nav:hover {
                transform: scale(1.04);
                box-shadow:
                    0 0 0 1px rgba(0, 0, 0, 0.7),
                    0 0 16px rgba(255, 255, 255, 0.12),
                    0 20px 44px rgba(0, 0, 0, 0.9);
            }

            .top-nav-inner {
                display: inline-flex;
                align-items: center;
                gap: 2rem;
            }
            .top-nav-icons {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }

            .top-nav-brand-img {
                width: 32px;
                height: 32px;
                object-fit: cover;
                border-radius: 50%;
                flex-shrink: 0;
            }

            .top-nav-item {
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                font-size: 0.9rem;
                font-weight: 600;
                opacity: 0.96;
                cursor: pointer;
                display: inline-block;
                transition: transform 0.2s ease;
            }

            .top-nav-item:hover {
                transform: scale(1.08);
            }

            .header-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 1.75rem;
                height: 1.75rem;
                border-radius: 999px;
                background: #000000;
                border: 1px solid #ffffff;
                cursor: pointer;
                transition: transform 0.15s ease, background 0.15s ease, border-color 0.15s ease;
            }

            .header-icon svg {
                width: 1.05rem;
                height: 1.05rem;
                color: #ffffff;
            }

            .header-icon:hover {
                transform: scale(1.08) translateY(-1px);
                background: #111827;
                border-color: #ffffff;
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
                min-height: 28vh;
                width: 100%;
                padding: 5rem 0 1.25rem;
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

            .search-bar-wrap {
                width: 100%;
                display: flex;
                justify-content: center;
                margin: 2.25rem 0 0.75rem;
            }

            .its-out-heading {
                margin-top: -0.5rem;
                margin-right: 2.5rem;
                font-family: 'Oswald', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                font-size: min(1.7rem, 3.2vw);
                font-weight: 700;
                letter-spacing: 0.28em;
                text-transform: uppercase;
                text-align: center;
                background: none;
                border: none;
                color: inherit;
                padding: 0;
                cursor: pointer;
                transition: transform 0.2s ease, opacity 0.2s ease;
            }

            .its-out-heading:hover {
                transform: scale(1.1);
                opacity: 1;
            }

            .its-out-heading:active {
                transform: scale(0.98);
            }

            .search-bar {
                width: 92%;
                max-width: 1200px;
            }

            .search-bar-inner {
                position: relative;
                width: 100%;
            }

            .search-bar-input {
                width: 100%;
                padding: 0.9rem 1rem 0.9rem 2.75rem;
                border-radius: 999px;
                border: none;
                background: #000000;
                color: #f9fafb;
                font-size: 1.1rem;
                font-family: inherit;
                outline: none;
                box-shadow:
                    0 18px 40px rgba(0, 0, 0, 0.8);
                transition: box-shadow 0.25s ease, background 0.25s ease, color 0.25s ease, transform 0.3s ease, padding 0.3s ease;
            }

            .search-bar-input::placeholder {
                color: #9ca3af;
            }

            .search-bar-input:hover,
            .search-bar-input:focus {
                background: #000000;
                color: #ffffff;
                transform: scale(1.04);
                padding: 1rem 1.15rem 1rem 2.85rem;
                box-shadow:
                    0 0 0 1px rgba(255, 255, 255, 0.25),
                    0 0 20px rgba(255, 255, 255, 0.35),
                    0 18px 40px rgba(0, 0, 0, 0.9);
                text-shadow:
                    0 0 12px rgba(255, 255, 255, 0.9),
                    0 0 24px rgba(255, 255, 255, 0.5),
                    0 0 36px rgba(255, 255, 255, 0.3);
            }

            .search-bar-icon {
                position: absolute;
                left: 1rem;
                top: 50%;
                transform: translateY(-50%);
                width: 0.95rem;
                height: 0.95rem;
                pointer-events: none;
                color: #9ca3af;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .discord-cta,
            .tiktok-cta {
                width: 380px;
                min-width: 380px;
                min-height: 140px;
                box-sizing: border-box;
            }

            .discord-cta {
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

            .discord-floating {
                position: fixed;
                right: 1.75rem;
                bottom: 4.5rem;
                z-index: 30;
                display: flex;
                align-items: center;
                gap: 0.85rem;
                padding: 0.65rem 0.95rem;
                background: rgba(0, 0, 0, 0.84);
                border-radius: 999px;
                box-shadow:
                    0 12px 30px rgba(0, 0, 0, 0.7),
                    0 0 0 1px rgba(255, 255, 255, 0.14);
                backdrop-filter: blur(10px);
                transform: translateY(120%);
                opacity: 0;
                pointer-events: none;
                transition: transform 0.3s ease-out, opacity 0.3s ease-out, box-shadow 0.3s ease-out;
            }

            .discord-floating.is-visible {
                transform: translateY(0);
                opacity: 1;
                pointer-events: auto;
            }

            .discord-floating-logo {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: #ffffff;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 0 14px rgba(255, 255, 255, 0.6);
            }

            .discord-floating-logo svg {
                width: 22px;
                height: 22px;
                fill: #000000;
            }

            .discord-floating-text {
                font-size: 0.78rem;
                font-weight: 600;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                color: #e5e7eb;
                white-space: nowrap;
                max-width: 220px;
                overflow: hidden;
                opacity: 1;
                transform-origin: left center;
                text-decoration: none;
                transition: opacity 0.35s ease, max-width 0.4s ease, margin-right 0.35s ease, transform 0.35s ease;
            }

            .discord-floating--compact .discord-floating-text {
                opacity: 0;
                max-width: 0;
                margin-right: 0;
                transform: scaleX(0.8);
            }

            .discord-floating:hover {
                transform: translateY(0) scale(1.12);
                box-shadow:
                    0 18px 40px rgba(0, 0, 0, 0.8),
                    0 0 0 1px rgba(255, 255, 255, 0.2);
            }

            .discord-floating-close {
                border: none;
                background: none;
                color: #9ca3af;
                cursor: pointer;
                font-size: 0.95rem;
                padding: 0;
                line-height: 1;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                transition: color 0.2s ease, transform 0.2s ease;
            }

            .discord-floating-close:hover {
                color: #ffffff;
                transform: scale(1.1);
            }

            .tiktok-floating {
                position: fixed;
                right: 1.75rem;
                bottom: 9.5rem; /* slightly higher above Discord */
                z-index: 30;
                display: flex;
                align-items: center;
                gap: 0.85rem;
                padding: 0.65rem 0.95rem;
                background: rgba(0, 0, 0, 0.84);
                border-radius: 999px;
                box-shadow:
                    0 12px 30px rgba(0, 0, 0, 0.7),
                    0 0 0 1px rgba(255, 255, 255, 0.14);
                backdrop-filter: blur(10px);
                transform: translateY(120%);
                opacity: 0;
                pointer-events: none;
                transition: transform 0.3s ease-out, opacity 0.3s ease-out, box-shadow 0.3s ease-out;
            }

            .tiktok-floating.is-visible {
                transform: translateY(0);
                opacity: 1;
                pointer-events: auto;
            }

            .tiktok-floating-logo {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background: #ffffff;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 0 14px rgba(255, 255, 255, 0.6);
            }

            .tiktok-floating-logo svg {
                width: 22px;
                height: 22px;
                fill: #000000;
            }

            .tiktok-floating-text {
                font-size: 0.78rem;
                font-weight: 600;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                color: #e5e7eb;
                white-space: nowrap;
                max-width: 220px;
                overflow: hidden;
                opacity: 1;
                transform-origin: left center;
                text-decoration: none;
                transition: opacity 0.35s ease, max-width 0.4s ease, margin-right 0.35s ease, transform 0.35s ease;
            }

            .tiktok-floating:hover {
                transform: translateY(0) scale(1.12);
                box-shadow:
                    0 18px 40px rgba(0, 0, 0, 0.8),
                    0 0 0 1px rgba(255, 255, 255, 0.2);
            }

            .tiktok-floating--compact .tiktok-floating-text {
                opacity: 0;
                max-width: 0;
                margin-right: 0;
                transform: scaleX(0.8);
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
                margin-top: 7vh;
                margin-bottom: 2rem;
                width: 100%;
                padding-left: 0;
                margin-left: 0;
            }

            .category-card {
                display: flex;
                flex-direction: column;
                flex: 1 1 260px;
                min-width: 260px;
                max-width: 460px;
                background: #000000;
                border: 1px solid #2a2a2a;
                border-radius: 1.25rem;
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
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
                background: #000000;
            }

            .category-card-image img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            .category-card-image-img--hoodies {
                width: 30%;
                height: 30%;
                margin: 0 auto;
            }

            .category-card-label {
                padding: 0.75rem 1.25rem;
                font-size: 1.35rem;
                font-weight: 400;
                text-align: center;
                background: #000000;
                color: #ffffff;
                letter-spacing: 0;
                margin-top: auto;
                font-family: 'Bebas Neue', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            }

            .category-card-label--left {
                text-align: center;
            }

            .category-strip-subtitle {
                margin: 14rem 0 2.25rem;
                text-align: center;
                font-size: clamp(1.5rem, 4vw, 2.5rem);
                font-weight: 700;
                letter-spacing: 0.15em;
                text-transform: uppercase;
                color: #ffffff;
                text-shadow:
                    0 0 10px rgba(255, 255, 255, 0.9),
                    0 0 20px rgba(255, 255, 255, 0.7),
                    0 0 30px rgba(255, 255, 255, 0.5),
                    0 0 40px rgba(255, 255, 255, 0.3);
            }

            .trusted-sellers-cards {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 2rem;
                margin-top: 3.5rem;
                padding: 0 1rem;
            }
            .trusted-seller-card {
                flex: 1;
                min-width: 280px;
                max-width: 360px;
                background: #000000;
                border: 1px solid rgba(255, 255, 255, 0.35);
                border-radius: 1rem;
                padding: 2rem 1.5rem;
                box-shadow:
                    0 0 15px rgba(255, 255, 255, 0.15),
                    0 0 30px rgba(255, 255, 255, 0.08);
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }
            .trusted-seller-card:hover {
                transform: scale(1.05);
                box-shadow:
                    0 0 20px rgba(255, 255, 255, 0.25),
                    0 0 40px rgba(255, 255, 255, 0.12);
            }
            .trusted-seller-card-logo {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                background: #000000;
                border: 1px solid rgba(255, 255, 255, 0.35);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.65rem;
                font-weight: 700;
                color: #fff;
                letter-spacing: 0.05em;
                margin-bottom: 1rem;
                overflow: hidden;
            }
            .trusted-seller-card-logo img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .trusted-seller-card-name {
                font-size: 1.25rem;
                font-weight: 700;
                color: #ffffff;
                margin-bottom: 0.75rem;
            }
            .trusted-seller-card-desc {
                font-size: 0.85rem;
                color: rgba(255, 255, 255, 0.85);
                line-height: 1.4;
                margin-bottom: 1.5rem;
                max-width: 100%;
            }
            .trusted-seller-card-promo {
                margin-top: 1rem;
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 0.9);
                line-height: 1.4;
                text-align: center;
                font-weight: 600;
                letter-spacing: 0.02em;
            }

            .trusted-seller-card-buttons {
                display: flex;
                flex-direction: column;
                gap: 0.6rem;
                width: 100%;
                align-items: center;
            }
            .trusted-seller-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                padding: 0.6rem 1.25rem;
                background: #000000;
                color: #ffffff;
                font-size: 0.8rem;
                font-weight: 600;
                letter-spacing: 0.05em;
                text-decoration: none;
                border-radius: 999px;
                border: 1px solid rgba(255, 255, 255, 0.4);
                cursor: pointer;
                width: 100%;
                max-width: 220px;
                transition: box-shadow 0.2s, transform 0.2s, border-color 0.2s;
                box-shadow:
                    0 0 10px rgba(255, 255, 255, 0.2),
                    0 0 20px rgba(255, 255, 255, 0.1);
            }
            .trusted-seller-btn:hover {
                border-color: rgba(255, 255, 255, 0.7);
                box-shadow:
                    0 0 15px rgba(255, 255, 255, 0.4),
                    0 0 30px rgba(255, 255, 255, 0.2);
                transform: scale(1.02);
            }
            .trusted-seller-btn svg {
                flex-shrink: 0;
                width: 14px;
                height: 14px;
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
                top: 1.5rem;
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

            .logout-form {
                display: inline;
                margin: 0;
            }

            .logout-form .admin-link,
            .logout-form button[type="submit"] {
                cursor: pointer;
                font-family: inherit;
            }

            .admin-panel-btn {
                position: fixed;
                right: 1.5rem;
                top: 1.5rem;
                z-index: 9999;
                padding: 0.55rem 1.1rem;
                border-radius: 999px;
                border: 1px solid rgba(255, 255, 255, 0.35);
                font-size: 0.85rem;
                font-weight: 600;
                text-decoration: none;
                color: #e5e7eb;
                background: #000000;
                box-shadow: 0 4px 14px rgba(0, 0, 0, 0.5);
                outline: none;
                transition: transform 0.15s ease, border-color 0.15s ease;
            }

            .admin-panel-btn:hover {
                border-color: #fff;
                transform: scale(1.05);
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
                animation: welcome-gift-pulse 1.2s ease-in-out infinite;
                text-decoration: none;
                color: inherit;
                cursor: pointer;
            }

            @keyframes welcome-gift-pulse {
                0%, 100% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(252, 211, 77, 0.0);
                }
                50% {
                    transform: scale(1.08);
                    box-shadow: 0 0 30px 0 rgba(252, 211, 77, 0.45);
                }
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
                border: 1px solid rgba(249, 250, 251, 0.4);
                box-shadow:
                    0 0 0 1px rgba(15, 23, 42, 0.6),
                    0 12px 30px rgba(0, 0, 0, 0.85);
                transition: background 0.2s ease, transform 0.2s ease, color 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
                text-shadow:
                    0 0 10px rgba(255, 255, 255, 0.9),
                    0 0 20px rgba(255, 255, 255, 0.5),
                    0 0 30px rgba(255, 255, 255, 0.3);
            }

            .welcome-coupons .welcome-cta:hover {
                background: #1f2937;
                transform: scale(1.03) translateY(-2px);
                color: #22c55e;
                border-color: rgba(249, 250, 251, 0.9);
                box-shadow:
                    0 0 0 1px rgba(249, 250, 251, 0.7),
                    0 16px 40px rgba(0, 0, 0, 0.95);
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
    <body class="has-footer">
        <div class="page-main">
        @include('partials.stars-bg')
        <div class="shell">
            <header>
                <div class="top-bar-left" aria-hidden="true"></div>
                <div class="brand" aria-hidden="true"></div>

                <div class="top-bar-center">
                    <nav class="top-nav">
                        <div class="top-nav-inner">
                            <span class="top-nav-icons">
                                <a href="{{ route('favorites') }}" class="header-icon top-nav-icon" aria-label="Favorites">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.001 20.25C12.001 20.25 5 15.75 5 9.75C5 7.127 7.014 5.25 9.35 5.25C10.77 5.25 12.001 6.036 12.001 6.036C12.001 6.036 13.232 5.25 14.652 5.25C16.988 5.25 19.002 7.127 19.002 9.75C19.002 15.75 12.001 20.25 12.001 20.25Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </span>
                            <img src="{{ asset('images/nav-brand.png') }}" alt="" class="top-nav-brand-img" width="32" height="32">
                            <a href="{{ route('products.index') }}" class="top-nav-item" style="text-decoration:none; color:inherit;">
                                Products
                            </a>
                            <a href="{{ route('home') }}#trusted-sellers" class="top-nav-item" style="text-decoration:none; color:inherit;">
                                Trusted sellers
                            </a>
                            <a href="{{ route('faq') }}" class="top-nav-item" style="text-decoration:none; color:inherit;">
                                FAQ
                            </a>
                        </div>
                    </nav>
                </div>

                <div style="display:flex; align-items:center; gap:0.75rem;">
                    @php
                        $isAdmin = auth()->check() && config('admin.email') && strtolower(trim(auth()->user()->email ?? '')) === strtolower(trim(config('admin.email')));
                    @endphp
                    @auth
                        @if($isAdmin)
                            <a href="{{ route('admin.products.index') }}" class="admin-link" id="login-link">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf
                            <button type="submit" class="admin-link">Logout</button>
                        </form>
                    @else
                        <a href="{{ url('/login') }}" class="admin-link" id="login-link" data-login-url="{{ url('/login') }}">
                            Login
                        </a>
                    @endauth
                </div>
            </header>

            @if($isAdmin)
                <a href="{{ route('admin.products.index') }}" class="admin-panel-btn">Admin panel</a>
            @endif

            <div class="hero-center">
                <button type="button" class="its-out-heading" id="its-out-btn" aria-label="Celebrate">
                    ITS OUT !
                </button>

                <div class="search-bar-wrap">
                    <form action="{{ route('products.index') }}" method="GET" class="search-bar">
                        <div class="search-bar-inner">
                            <div class="search-bar-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11" cy="11" r="6" stroke="currentColor" stroke-width="2"/>
                                    <line x1="15.5" y1="15.5" x2="20" y2="20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <input
                                type="text"
                                name="q"
                                value="{{ request('q') }}"
                                class="search-bar-input"
                                placeholder="Search for products..."
                                autocomplete="off"
                            >
                        </div>
                    </form>
                </div>

                <nav class="category-strip" aria-label="Product categories">
                    <a href="{{ route('products.index') }}#shoes" class="category-card">
                        <div class="category-card-image">
                            <img src="{{ asset('images/shoes-icon.png') }}" alt="Shoes">
                        </div>
                        <span class="category-card-label">Shoes</span>
                    </a>
                    <a href="{{ route('products.index') }}#tees" class="category-card">
                        <div class="category-card-image">
                            <img src="{{ asset('images/hoodies-icon.png') }}" alt="Hoodies" class="category-card-image-img--hoodies">
                        </div>
                        <span class="category-card-label">Hoodies</span>
                    </a>
                    <a href="{{ route('products.index') }}#jeans" class="category-card">
                        <div class="category-card-image">
                            <img src="{{ asset('images/jeans-icon.png') }}" alt="Jeans">
                        </div>
                        <span class="category-card-label">Jeans</span>
                    </a>
                    <a href="{{ route('products.index') }}#sweats" class="category-card">
                        <div class="category-card-image">
                            <img src="{{ asset('images/sweats-icon.png') }}" alt="Sweats">
                        </div>
                        <span class="category-card-label">Sweats</span>
                    </a>
                    <a href="{{ route('products.index') }}#jewelry" class="category-card">
                        <div class="category-card-image">
                            <img src="{{ asset('images/jewelry-icon.png') }}" alt="Jewelry">
                        </div>
                        <span class="category-card-label">Jewelry</span>
                    </a>
                </nav>
                <p class="category-strip-subtitle" id="trusted-sellers">Trusted Sellers</p>
                <div class="trusted-sellers-cards">
                    <div class="trusted-seller-card">
                        <div class="trusted-seller-card-logo"><img src="{{ asset('images/gtal-logo.png') }}" alt="GTAL" width="80" height="80"></div>
                        <h3 class="trusted-seller-card-name">Gtal</h3>
                        <p class="trusted-seller-card-desc">Best shoe seller for most shoes that he has. Pick a good batch and you will receive good quality.</p>
                        <div class="trusted-seller-card-buttons">
                            <a href="https://weidian.com/?userid=1731179625&spider_token=7d01&tabType=all" class="trusted-seller-btn" target="_blank" rel="noopener noreferrer">
                                Weidian Shop
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                            <a href="https://www.acbuy.com/shop-detail?source=WD&sellerId=1731179625&shopName=GTAL" class="trusted-seller-btn" target="_blank" rel="noopener noreferrer">
                                ACBuy Shop
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                            <a href="https://lulux.x.yupoo.com/categories" class="trusted-seller-btn" target="_blank" rel="noopener noreferrer">
                                Yupoo
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        </div>
                    </div>
                    <div class="trusted-seller-card">
                        <div class="trusted-seller-card-logo"><img src="{{ asset('images/mvt-logo.png') }}" alt="MVT" width="80" height="80"></div>
                        <h3 class="trusted-seller-card-name">MVT</h3>
                        <p class="trusted-seller-card-desc">Truly amazing quality and accuracy on everything he releases, Not budget friendly but its 100% worth to buy from him</p>
                        <div class="trusted-seller-card-buttons">
                            <a href="https://mvt-shop01.x.yupoo.com/albums" class="trusted-seller-btn" target="_blank" rel="noopener noreferrer">
                                Yupoo
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                            <a href="https://www.acbuy.com/shop-detail?source=TB&sellerId=274581866&shopName=Mmmmvvvt" class="trusted-seller-btn" target="_blank" rel="noopener noreferrer">
                                ACBuy Shop
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        </div>
                    </div>
                    <div class="trusted-seller-card">
                        <div class="trusted-seller-card-logo"><img src="{{ asset('images/jerseybrothers-logo.png') }}" alt="JerseyBrothers" width="80" height="80"></div>
                        <h3 class="trusted-seller-card-name">JerseyBrothers</h3>
                        <p class="trusted-seller-card-desc">Toptier quality jerseys with low price, Really budget friendly and has almost 1000 jerseys ! ALSO CUSTOM NAME AND NUMBER</p>
                        <div class="trusted-seller-card-buttons">
                            <a href="https://weidian.com/?userid=1679255613&spider_token=5b4b" class="trusted-seller-btn" target="_blank" rel="noopener noreferrer">
                                Weidian Shop
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                            <a href="https://www.acbuy.com/shop-detail?source=WD&sellerId=1679255613&shopName=Jersey+Brothers" class="trusted-seller-btn" target="_blank" rel="noopener noreferrer">
                                ACBuy Shop
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        </div>
                        <p class="trusted-seller-card-promo">BUY JERSEY, WRITE IN REMARK mitsu, CREATE A TIKTOK, GET 200 LIKES AND CHOOSE YOUR JERSEY FOR FREE !</p>
                    </div>
                </div>
            </div>

                <div class="discord-floating" id="discord-floating">
                    <div class="discord-floating-logo" aria-hidden="true">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.317 4.369A19.91 19.91 0 0 0 16.558 3c-.197.351-.42.825-.576 1.196a18.27 18.27 0 0 0-3.964 0A12.64 12.64 0 0 0 11.442 3 19.9 19.9 0 0 0 7.68 4.371C4.943 8.285 4.26 12.091 4.57 15.853A19.9 19.9 0 0 0 9.07 17.5c.328-.45.62-.928.873-1.434a11.8 11.8 0 0 1-1.377-.66c.116-.083.23-.17.34-.26 2.652 1.243 5.53 1.243 8.16 0 .113.09.227.178.34.26-.44.264-.9.486-1.378.66.253.506.545.984.873 1.434a19.86 19.86 0 0 0 4.5-1.647c.37-4.274-.63-8.044-2.954-11.484ZM10.02 13.91c-.8 0-1.45-.73-1.45-1.625 0-.896.64-1.63 1.45-1.63.819 0 1.46.742 1.45 1.63 0 .895-.64 1.625-1.45 1.625Zm3.98 0c-.8 0-1.45-.73-1.45-1.625 0-.896.64-1.63 1.45-1.63.819 0 1.47.742 1.46 1.63 0 .895-.64 1.625-1.46 1.625Z"/>
                        </svg>
                    </div>
                    <a href="https://discord.gg/P9XtWcmsau" target="_blank" rel="noopener noreferrer" class="discord-floating-text">
                        join my discord for more finds
                    </a>
                    <button type="button" class="discord-floating-close" id="discord-floating-close" aria-label="Close Discord popup">
                        ×
                    </button>
                </div>

                <div class="tiktok-floating" id="tiktok-floating">
                    <div class="tiktok-floating-logo" aria-hidden="true">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.5 5.5c.6.8 1.4 1.4 2.3 1.8V9c-1.1-.1-2.2-.5-3.2-1.2v5.7c0 2.9-2.2 4.9-4.9 4.9-1 0-1.9-.3-2.7-.7-.3-.2-.4-.5-.2-.9l.6-1.2c.2-.4.5-.5.9-.3.4.2.9.4 1.4.4 1.3 0 2.2-.9 2.2-2.2v-6h.2c.8 0 1.6-.1 2.4-.5zM10.2 9.7v2.1c-.2-.1-.4-.1-.6-.1-1.1 0-2 1-2 2.1 0 .7.3 1.3.8 1.7l-.7 1.4C7 16.3 6.5 15.3 6.5 14.2 6.5 11.7 8.2 9.7 10.2 9.7z"/>
                        </svg>
                    </div>
                    <a href="https://www.tiktok.com/@mxtsufindss?is_from_webapp=1&sender_device=pc" target="_blank" rel="noopener noreferrer" class="tiktok-floating-text">
                        Follow for better content
                    </a>
                    <button type="button" class="discord-floating-close" id="tiktok-floating-close" aria-label="Close TikTok popup">
                        ×
                    </button>
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
        </div>

        @include('partials.footer')

        <div id="welcome-overlay" class="welcome-overlay welcome-overlay--hidden">
            <div class="welcome-modal">
                <button type="button" class="welcome-close" data-dismiss="welcome-modal">&times;</button>
                <a
                    href="https://www.acbuy.com/login?loginStatus=register&code=ZSTSLZ"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="welcome-icon"
                    data-dismiss="welcome-modal"
                >
                    🎁
                </a>
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
                var nav = performance.getEntriesByType && performance.getEntriesByType('navigation')[0];
                var isReload = nav && nav.type === 'reload';
                if (window.location.hash === '#trusted-sellers') {
                    if (isReload) {
                        window.scrollTo(0, 0);
                        history.replaceState(null, '', window.location.pathname);
                    } else {
                        var el = document.getElementById('trusted-sellers');
                        if (el) {
                            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }
                }

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

            (function () {
                var btn = document.getElementById('its-out-btn');
                if (!btn) return;
                btn.addEventListener('click', function () {
                    if (typeof confetti !== 'function') return;
                    var opts = { particleCount: 80, spread: 60, startVelocity: 40, ticks: 120, gravity: 0.8, scalar: 1.1, colors: ['#ffffff', '#f97316', '#eab308', '#22c55e', '#3b82f6', '#a855f7'] };
                    confetti(Object.assign({ origin: { x: 0.2, y: 0.55 }, angle: 120 }, opts));
                    confetti(Object.assign({ origin: { x: 0.8, y: 0.55 }, angle: 60 }, opts));
                });
            })();

            (function () {
                var popup = document.getElementById('discord-floating');
                if (!popup) return;
                var closeBtn = document.getElementById('discord-floating-close');

                // Show almost immediately so CSS handles the smooth pop-in
                window.setTimeout(function () {
                    popup.classList.add('is-visible');
                    window.setTimeout(function () {
                        popup.classList.add('discord-floating--compact');
                    }, 2000);
                }, 100);

                if (closeBtn) {
                    closeBtn.addEventListener('click', function () {
                        popup.classList.remove('is-visible');
                    });
                }
            })();

            (function () {
                var popup = document.getElementById('tiktok-floating');
                if (!popup) return;
                var closeBtn = document.getElementById('tiktok-floating-close');

                window.setTimeout(function () {
                    popup.classList.add('is-visible');
                    window.setTimeout(function () {
                        popup.classList.add('tiktok-floating--compact');
                    }, 2000);
                }, 150);

                if (closeBtn) {
                    closeBtn.addEventListener('click', function () {
                        popup.classList.remove('is-visible');
                    });
                }
            })();
        </script>
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>
    </body>
</html>
