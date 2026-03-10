<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login · {{ config('app.name', 'mxtsu') }}</title>
        <style>
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
                padding: 1.5rem;
            }
            .page {
                width: 100%;
                max-width: 320px;
            }
            .title {
                font-size: 1.5rem;
                font-weight: 600;
                margin-bottom: 1.75rem;
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
                padding: 0.65rem 0.75rem;
                font-size: 1rem;
                background: #0a0a0a;
                border: 1px solid #333;
                border-radius: 0.375rem;
                color: #f9fafb;
            }
            .form-group input:focus {
                outline: none;
                border-color: #555;
            }
            .form-group input::placeholder {
                color: #6b7280;
            }
            .error {
                font-size: 0.875rem;
                color: #f87171;
                margin-bottom: 1rem;
            }
            .btn {
                width: 100%;
                padding: 0.65rem 1rem;
                font-size: 1rem;
                font-weight: 500;
                background: #1a1a1a;
                border: 1px solid #333;
                border-radius: 0.375rem;
                color: #f9fafb;
                cursor: pointer;
                margin-top: 0.25rem;
            }
            .btn:hover { background: #262626; }
            .btn:focus { outline: none; }
            .create-account {
                margin-top: 1.5rem;
                text-align: center;
                font-size: 0.9rem;
            }
            .create-account a {
                color: #60a5fa;
                text-decoration: none;
            }
            .create-account a:hover { text-decoration: underline; }
            .create-account .note {
                display: block;
                margin-top: 0.5rem;
                color: #6b7280;
                font-size: 0.8rem;
            }
            .back {
                display: block;
                margin-top: 1.5rem;
                font-size: 0.85rem;
                color: #6b7280;
                text-decoration: none;
                text-align: center;
            }
            .back:hover { color: #9ca3af; }
        </style>
    </head>
    <body>
        <div class="page">
            <h1 class="title">Login</h1>

            @if ($errors->any())
                <p class="error">{{ $errors->first() }}</p>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Username or email"
                    >
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Password"
                    >
                </div>
                <button type="submit" class="btn">Sign in</button>
            </form>

            <div class="create-account">
                <a href="{{ url('/register') }}">Create a new account</a>
                <span class="note">You can only create one new account per 24 hours.</span>
            </div>

            <a href="{{ url('/') }}" class="back">← Back to home</a>
        </div>
    </body>
</html>
