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
                background: #020617;
                color: #e5e7eb;
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
                font-size: 1.4rem;
                font-weight: 600;
            }

            .subtitle {
                font-size: 0.9rem;
                opacity: 0.75;
            }

            form {
                margin-top: 1.25rem;
                padding: 1.5rem 1.5rem 1.75rem;
                border-radius: 1rem;
                background: #020617;
                border: 1px solid #111827;
            }

            .field {
                margin-bottom: 1rem;
            }

            label {
                display: block;
                font-size: 0.85rem;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                margin-bottom: 0.3rem;
                color: #9ca3af;
            }

            input[type="text"],
            input[type="number"],
            textarea {
                width: 100%;
                border-radius: 0.5rem;
                border: 1px solid #1f2937;
                background: #020617;
                padding: 0.6rem 0.7rem;
                color: #e5e7eb;
                font-size: 0.9rem;
            }

            input[type="text"]:focus,
            input[type="number"]:focus,
            textarea:focus {
                outline: none;
                border-color: #f97316;
                box-shadow: 0 0 0 1px #f97316;
            }

            textarea {
                min-height: 90px;
                resize: vertical;
            }

            .hint {
                font-size: 0.8rem;
                opacity: 0.7;
                margin-top: 0.2rem;
            }

            .checkbox-row {
                display: flex;
                align-items: center;
                gap: 0.45rem;
                font-size: 0.9rem;
            }

            input[type="checkbox"] {
                width: 16px;
                height: 16px;
            }

            .actions {
                display: flex;
                justify-content: flex-end;
                gap: 0.75rem;
                margin-top: 1.25rem;
            }

            a.btn,
            button.btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.55rem 1.1rem;
                border-radius: 999px;
                border: 1px solid transparent;
                font-size: 0.85rem;
                font-weight: 500;
                cursor: pointer;
                text-decoration: none;
            }

            .btn-primary {
                background: #f97316;
                border-color: #ea580c;
                color: #0b1120;
            }

            .btn-primary:hover {
                background: #fdba74;
                border-color: #fb923c;
            }

            .btn-ghost {
                background: transparent;
                border-color: #374151;
                color: #e5e7eb;
            }

            .btn-ghost:hover {
                background: #020617;
                border-color: #4b5563;
            }

            .error {
                margin-top: 0.2rem;
                font-size: 0.8rem;
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

            <form method="post" action="{{ route('admin.products.store') }}">
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
                    <label for="category">Category</label>
                    <select
                        id="category"
                        name="category"
                        style="width:100%;border-radius:0.5rem;border:1px solid #1f2937;background:#020617;padding:0.6rem 0.7rem;color:#e5e7eb;font-size:0.9rem;"
                    >
                        @php
                            $currentCategory = old('category', 'hoodies');
                        @endphp
                        <option value="hoodies" {{ $currentCategory === 'hoodies' ? 'selected' : '' }}>Hoodies</option>
                        <option value="tees" {{ $currentCategory === 'tees' ? 'selected' : '' }}>Tees</option>
                        <option value="jeans_sweats" {{ $currentCategory === 'jeans_sweats' ? 'selected' : '' }}>Jeans / Sweats</option>
                        <option value="jewelry" {{ $currentCategory === 'jewelry' ? 'selected' : '' }}>Jewelry</option>
                    </select>
                    @error('category')
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
                    <label for="image_url">Image URL (optional)</label>
                    <input
                        id="image_url"
                        type="text"
                        name="image_url"
                        value="{{ old('image_url') }}"
                    >
                    <div class="hint">Direct link to a product image hosted on ACBuy or elsewhere.</div>
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

                <div class="field">
                    <div class="checkbox-row">
                        <input
                            id="is_active"
                            type="checkbox"
                            name="is_active"
                            value="1"
                            {{ old('is_active', '1') ? 'checked' : '' }}
                        >
                        <label for="is_active" style="margin:0; text-transform:none; letter-spacing:0;">Show on home page</label>
                    </div>
                </div>

                <div class="actions">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save product</button>
                </div>
            </form>
        </div>
    </body>
</html>
