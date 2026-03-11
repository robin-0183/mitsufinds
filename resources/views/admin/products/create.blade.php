<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add Product · Admin · {{ config('app.name', 'mxtsu') }}</title>
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: #000000;
                color: #e5e7eb;
                font-weight: 600;
            }

            .shell {
                max-width: 760px;
                margin: 0 auto;
                padding: 2rem 1.5rem 3rem;
            }

            header {
                margin-bottom: 1.5rem;
            }

            .title {
                font-size: 1.85rem;
                font-weight: 800;
            }

            .subtitle {
                font-size: 1.05rem;
                font-weight: 700;
                opacity: 0.75;
            }

            form {
                margin-top: 1.5rem;
                padding: 2rem 1.75rem 2rem;
                border-radius: 1rem;
                background: #000000;
                border: 1px solid #1a1a1a;
            }

            .field {
                margin-bottom: 1.25rem;
            }

            label {
                display: block;
                font-size: 1rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                margin-bottom: 0.4rem;
                color: #9ca3af;
            }

            input[type="text"],
            input[type="number"],
            input[type="file"],
            textarea,
            select {
                width: 100%;
                border-radius: 0.5rem;
                border: 1px solid #333;
                background: #0a0a0a;
                padding: 0.75rem 0.85rem;
                color: #e5e7eb;
                font-size: 1.05rem;
                font-weight: 600;
                transition: transform 0.2s ease, font-size 0.2s ease, padding 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
            }

            input[type="text"]:hover,
            input[type="number"]:hover,
            textarea:hover,
            select:hover {
                transform: scale(1.01);
                font-size: 1.08rem;
            }

            input[type="text"]:focus,
            input[type="number"]:focus,
            textarea:focus,
            select:focus {
                outline: none;
                border-color: #f97316;
                box-shadow: 0 0 0 1px #f97316;
                transform: scale(1.01);
                font-size: 1.08rem;
            }

            input[type="file"] {
                background: #000000;
                cursor: pointer;
            }

            input[type="file"]::file-selector-button {
                background: #000000;
                border: 1px solid #333;
                color: #e5e7eb;
                padding: 0.5rem 0.75rem;
                margin-right: 0.75rem;
                border-radius: 0.375rem;
                font-weight: 600;
                cursor: pointer;
            }

            input[type="file"]:hover,
            input[type="file"]:focus {
                transform: scale(1.01);
                font-size: 1.08rem;
            }

            textarea {
                min-height: 110px;
                resize: vertical;
            }

            .hint {
                font-size: 0.95rem;
                font-weight: 600;
                opacity: 0.7;
                margin-top: 0.3rem;
            }

            .checkbox-row {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-size: 1.05rem;
                font-weight: 700;
            }

            input[type="checkbox"] {
                width: 20px;
                height: 20px;
            }

            .actions {
                display: flex;
                justify-content: flex-end;
                gap: 1rem;
                margin-top: 1.5rem;
            }

            a.btn,
            button.btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.7rem 1.25rem;
                border-radius: 999px;
                border: 1px solid transparent;
                font-size: 1rem;
                font-weight: 700;
                cursor: pointer;
                text-decoration: none;
            }

            .btn-primary {
                background: #000000;
                border: 1px solid #333;
                color: #e5e7eb;
                padding: 0.85rem 1.75rem;
                font-size: 1.15rem;
                font-weight: 800;
            }

            .btn-primary:hover {
                background: #1a1a1a;
                border-color: #444;
                color: #f9fafb;
            }

            .btn-primary:focus {
                outline: none;
            }

            .btn-ghost {
                background: transparent;
                border-color: #374151;
                color: #e5e7eb;
                font-weight: 700;
            }

            .btn-ghost:hover {
                background: #111;
                border-color: #4b5563;
            }

            .error {
                margin-top: 0.25rem;
                font-size: 0.95rem;
                font-weight: 600;
                color: #fecaca;
            }
        </style>
    </head>
    <body>
        <div class="shell">
            <header>
                <div class="title">Add product</div>
                <div class="subtitle">Create an ACBuy affiliate item that appears on the mxtsu home page.</div>
            </header>

            <form method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="field">
                    <label for="name">Name</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="category">Section</label>
                    <select
                        id="category"
                        name="category"
                        style="width:100%;border-radius:0.5rem;border:1px solid #333;background:#0a0a0a;padding:0.75rem 0.85rem;color:#e5e7eb;font-size:1.05rem;font-weight:600;"
                    >
                        @php
                            $currentCategory = old('category', 'hoodies');
                        @endphp
                        <option value="hoodies" {{ $currentCategory === 'hoodies' ? 'selected' : '' }}>Hoodies</option>
                        <option value="tees" {{ $currentCategory === 'tees' ? 'selected' : '' }}>Tees</option>
                        <option value="jeans" {{ $currentCategory === 'jeans' ? 'selected' : '' }}>Jeans</option>
                        <option value="sweats" {{ $currentCategory === 'sweats' ? 'selected' : '' }}>Sweats</option>
                        <option value="boots" {{ $currentCategory === 'boots' ? 'selected' : '' }}>boots</option>
                        <option value="shoes" {{ $currentCategory === 'shoes' ? 'selected' : '' }}>shoes</option>
                        <option value="jewelry" {{ $currentCategory === 'jewelry' ? 'selected' : '' }}>Jewelry</option>
                    </select>
                    <div class="hint">Product will appear in this section on the home page and on the Products page.</div>
                    @error('category')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field" id="brand-field">
                    <label for="brand">Brand (hoodies only)</label>
                    <select
                        id="brand"
                        name="brand"
                        style="width:100%;border-radius:0.5rem;border:1px solid #333;background:#0a0a0a;padding:0.75rem 0.85rem;color:#e5e7eb;font-size:1.05rem;font-weight:600;"
                    >
                        @php
                            $currentBrand = old('brand', '');
                        @endphp
                        <option value="" {{ $currentBrand === '' ? 'selected' : '' }}>—</option>
                        <option value="balenciaga" {{ $currentBrand === 'balenciaga' ? 'selected' : '' }}>Balenciaga</option>
                        <option value="mm6" {{ $currentBrand === 'mm6' ? 'selected' : '' }}>mm6</option>
                        <option value="rick_owens" {{ $currentBrand === 'rick_owens' ? 'selected' : '' }}>rick owens</option>
                        <option value="supreme" {{ $currentBrand === 'supreme' ? 'selected' : '' }}>supreme</option>
                        <option value="erd" {{ $currentBrand === 'erd' ? 'selected' : '' }}>erd</option>
                    </select>
                    @error('brand')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="affiliate_url">Affiliate URL</label>
                    <input
                        id="affiliate_url"
                        type="text"
                        name="affiliate_url"
                        value="{{ old('affiliate_url') }}"
                        required
                    >
                    <div class="hint">Paste the ACBuy tracking link for this product.</div>
                    @error('affiliate_url')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="image">Product image (optional)</label>
                    <input
                        id="image"
                        type="file"
                        name="image"
                        accept="image/*"
                    >
                    <div class="hint">Choose a picture from your device. Max 2 MB. JPG, PNG, GIF or WebP.</div>
                    @error('image')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="image_url">Image URL (optional)</label>
                    <input
                        id="image_url"
                        type="text"
                        name="image_url"
                        value="{{ old('image_url') }}"
                    >
                    <div class="hint">Or paste a direct link to a product image hosted on ACBuy or elsewhere. Ignored if you upload a file above.</div>
                    @error('image_url')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="price">Price (optional)</label>
                    <input
                        id="price"
                        type="number"
                        name="price"
                        step="0.01"
                        min="0"
                        value="{{ old('price') }}"
                    >
                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="description">Description (optional)</label>
                    <textarea id="description" name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="actions">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save product</button>
                </div>
            </form>
        </div>
    </body>
</html>
