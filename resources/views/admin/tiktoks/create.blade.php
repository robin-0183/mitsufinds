<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add TikTok · Admin · {{ config('app.name', 'mxtsu') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            * { box-sizing: border-box; }

            body {
                margin: 0;
                font-family: 'Oswald', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: #000000;
                color: #e5e7eb;
            }

            .shell {
                max-width: 800px;
                margin: 0 auto;
                padding: 5rem 1.5rem 3rem;
            }

            .title {
                font-size: 1.75rem;
                font-weight: 800;
                letter-spacing: 0.02em;
                margin: 0 0 1.5rem;
            }

            a.btn,
            button.btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.5rem 0.9rem;
                border-radius: 999px;
                border: 1px solid transparent;
                font-size: 0.85rem;
                font-weight: 500;
                cursor: pointer;
                text-decoration: none;
                transition: transform 0.2s ease, background 0.2s ease, border-color 0.2s ease;
            }

            .btn-primary {
                background: #000000;
                border-color: #ffffff;
                color: #f9fafb;
            }

            .btn-primary:hover {
                background: #111827;
                border-color: #f97316;
                transform: scale(1.08);
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

            form {
                margin-top: 1.5rem;
            }

            .field {
                margin-bottom: 1rem;
            }

            label {
                display: block;
                font-size: 0.85rem;
                text-transform: uppercase;
                letter-spacing: 0.12em;
                margin-bottom: 0.35rem;
                color: #9ca3af;
            }

            input[type="text"],
            textarea {
                width: 100%;
                padding: 0.6rem 0.75rem;
                border-radius: 0.5rem;
                border: 1px solid #374151;
                background: #000000;
                color: #f9fafb;
                font-size: 0.95rem;
            }

            textarea {
                min-height: 140px;
                resize: vertical;
            }

            input[type="checkbox"] {
                width: 1rem;
                height: 1rem;
            }

            .checkbox-row {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .error {
                margin-top: 0.25rem;
                font-size: 0.8rem;
                color: #fecaca;
            }

            .hint {
                margin-top: 0.25rem;
                font-size: 0.8rem;
                color: #9ca3af;
            }
        </style>
    </head>
    <body>
        <div class="shell">
            <h1 class="title">Add TikTok video</h1>

            <a href="{{ route('admin.tiktoks.index') }}" class="btn btn-ghost">← Back to TikToks</a>

            <form method="POST" action="{{ route('admin.tiktoks.store') }}">
                @csrf

                <div class="field">
                    <label for="title">Title</label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="embed_html">TikTok embed code</label>
                    <textarea id="embed_html" name="embed_html">{{ old('embed_html') }}</textarea>
                    <div class="hint">Paste the TikTok embed code here (from the TikTok share/embed option).</div>
                    @error('embed_html')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <div class="checkbox-row">
                        <input id="is_active" type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                        <label for="is_active">Show on TikTok videos page</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save TikTok</button>
            </form>
        </div>
    </body>
</html>

