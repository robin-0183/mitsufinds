<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Developer login — {{ config('app.name', 'mxtsu') }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #000000;
            color: #f9fafb;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        .dev-login-box {
            width: 100%;
            max-width: 340px;
            background: #111;
            border: 1px solid #333;
            border-radius: 0.5rem;
            padding: 1.5rem 2rem;
        }
        .dev-login-box h1 {
            margin: 0 0 1rem;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .dev-login-box form { display: flex; flex-direction: column; gap: 1rem; }
        .dev-login-box input[type="password"] {
            width: 100%;
            padding: 0.6rem 0.75rem;
            font-size: 1rem;
            color: #fff;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 0.25rem;
        }
        .dev-login-box input:focus { outline: none; border-color: #555; }
        .dev-login-box .error { font-size: 0.875rem; color: #e57373; }
        .dev-login-box button[type="submit"] {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #000;
            background: #fff;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }
        .dev-login-box a.back {
            display: inline-block;
            margin-top: 1rem;
            font-size: 0.875rem;
            color: #9ca3af;
            text-decoration: none;
        }
        .dev-login-box a.back:hover { color: #fff; }
    </style>
</head>
<body>
    <div class="dev-login-box">
        <h1>Developer access</h1>
        <form method="post" action="{{ route('dev-auth') }}">
            @csrf
            @if ($errors->has('dev_password'))
                <p class="error" role="alert">{{ $errors->first('dev_password') }}</p>
            @endif
            <input type="password" name="dev_password" placeholder="Developer password" required autofocus>
            <button type="submit">Enter</button>
        </form>
        <a href="{{ route('home') }}" class="back">← Back to site</a>
    </div>
</body>
</html>
