<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - MediTrack</title>
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
        .form-group input,
        .form-group select {
            width: 100%;
            box-sizing: border-box;
            padding: 9px 12px;
            font-size: 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
        }
        .form-group input:focus,
        .form-group select:focus {
            border-color: #2e7d8c;
            box-shadow: 0 0 0 3px rgba(46,125,140,0.15);
        }
        .error-text {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
        }
        .links-row {
            text-align: center;
            font-size: 13px;
            margin-bottom: 18px;
        }
        .links-row a {
            color: #2e7d8c;
            text-decoration: underline;
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
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="auth-logo">
            <img src="{{ asset('images/medi.png') }}" alt="MediTrack">
        </div>

        <div class="auth-body">
            <p class="auth-subtitle">Register as Pharmacist</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    @error('name')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                    @error('email')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password">
                    @error('password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="Pharmacist" selected>Pharmacist</option>
                    </select>
                    @error('role')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="links-row">
                    <a href="{{ route('login') }}">Already have an account? Sign in</a>
                </div>

                <button type="submit" class="btn-submit">Register</button>
            </form>
        </div>
    </div>

</body>
</html>