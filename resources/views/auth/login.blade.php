<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - MediTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at top, #2e7d8c, #1e2a3a);
            padding: 20px;
        }
        .auth-card {
            width: 100%;
            max-width: 380px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .auth-logo {
            background: #f8fafc;
            padding: 18px;
            display: flex;
            justify-content: center;
        }
        .auth-logo img {
            height: 60px;
            width: auto;
        }
        .auth-body {
            padding: 28px 32px;
        }
        .auth-subtitle {
            text-align: center;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 5px;
        }
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            box-sizing: border-box;
            padding: 9px 12px;
            font-size: 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
        }
        .form-group input:focus {
            border-color: #2e7d8c;
            box-shadow: 0 0 0 3px rgba(46,125,140,0.15);
        }
        .error-text {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
        }
        .remember-row {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #475569;
            margin-bottom: 18px;
        }
        .links-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 18px;
        }
        .links-row a {
            color: #2e7d8c;
            text-decoration: underline;
        }
        .links-row a.secondary {
            color: #64748b;
        }
        .btn-submit {
            width: 100%;
            padding: 11px;
            background: #2e7d8c;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .btn-submit:hover {
            opacity: 0.9;
        }
        .status-msg {
            text-align: center;
            color: #16a34a;
            font-size: 13px;
            margin-bottom: 14px;
        }
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="auth-logo">
            <img src="{{ asset('images/medi.png') }}" alt="MediTrack">
        </div>

        <div class="auth-body">
            <p class="auth-subtitle">Sign in as Pharmacist</p>

            @if (session('status'))
                <div class="status-msg">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                    @error('password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="remember-row">
                    <input type="checkbox" id="remember_me" name="remember">
                    <label for="remember_me" style="margin:0;">Remember me</label>
                </div>

                <div class="links-row">
                    <a href="{{ route('register') }}">Create an account</a>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="secondary">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">Log in</button>
            </form>
        </div>
    </div>

</body>
</html>