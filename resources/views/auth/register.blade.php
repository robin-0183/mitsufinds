<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <title>Register · {{ config('app.name', 'mxtsu') }}</title>
        <style>
            html { overflow-x: hidden; -webkit-text-size-adjust: 100%; }
            * { box-sizing: border-box; }
            body {
                margin: 0;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: #000000;
                color: #f9fafb;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
                position: relative;
                overflow-x: hidden;
            }
            .card {
                position: relative;
                z-index: 1;
                width: 100%;
                max-width: 360px;
                background: #111827;
                border: 1px solid #1f2937;
                border-radius: 1rem;
                padding: 2rem;
            }
            .title {
                font-size: 1.35rem;
                font-weight: 600;
                margin-bottom: 1.5rem;
                text-align: center;
            }
            .form-group {
                margin-bottom: 1.25rem;
            }
            .form-group label {
                display: block;
                font-size: 0.9rem;
                margin-bottom: 0.4rem;
                color: #9ca3af;
            }
            .form-group input {
                width: 100%;
                padding: 0.75rem 0.85rem;
                min-height: 48px;
                font-size: 1rem;
                background: #020617;
                border: 1px solid #374151;
                border-radius: 0.5rem;
                color: #f9fafb;
            }
            .form-group input:focus {
                outline: none;
                border-color: #4b5563;
            }
            .form-group input::placeholder {
                color: #6b7280;
            }
            .error {
                font-size: 0.875rem;
                color: #f87171;
                margin-top: 0.35rem;
            }
            .btn {
                width: 100%;
                padding: 0.75rem 1rem;
                min-height: 48px;
                font-size: 1rem;
                font-weight: 500;
                background: #1f2937;
                border: 1px solid #374151;
                border-radius: 0.5rem;
                color: #f9fafb;
                cursor: pointer;
            }
            .btn:hover { background: #374151; }
            .btn:focus { outline: none; }
            .links {
                margin-top: 1.25rem;
                text-align: center;
                font-size: 0.9rem;
            }
            .links a {
                color: #9ca3af;
                text-decoration: none;
            }
            .links a:hover { color: #e5e7eb; }
        </style>
    </head>
    <body>
        @include('partials.stars-bg')
        <div class="card">
            <h1 class="title">Create account</h1>

            @if ($errors->any())
                <p class="error" style="margin-bottom: 1rem;">{{ $errors->first() }}</p>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                    >
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="you@example.com"
                    >
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        minlength="8"
                    >
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        minlength="8"
                    >
                </div>
                <button type="submit" class="btn">Register</button>
            </form>

            <div class="links">
                <a href="{{ route('login') }}">Already have an account? Sign in</a>
            </div>
        </div>
    </body>
</html>
