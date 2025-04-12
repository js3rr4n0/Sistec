{{-- resources/views/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | SISTEC</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: white;
            width: 100%;
            max-width: 520px;
            padding: 3rem 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: block;
            margin: 0 auto 2rem;
            max-height: 65px;
        }

        h2 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        p {
            text-align: center;
            font-size: 1rem;
            color: #555;
            margin-bottom: 2rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 1rem;
            font-size: 1rem;
            margin-bottom: 1.2rem;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            color: #444;
        }

        .checkbox-label input {
            margin-right: 8px;
        }

        .btn {
            width: 100%;
            background-color: #2a5bff;
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            margin-bottom: 1.5rem;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background-color: #1e47cc;
        }

        .forgot {
            text-align: right;
            font-size: 0.9rem;
            margin-top: -0.8rem;
            margin-bottom: 1.8rem;
        }

        .forgot a {
            color: #2a5bff;
            text-decoration: none;
        }

        .error-message {
            color: red;
            font-size: 0.95rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .register-btn {
            width: 100%;
            background: transparent;
            border: 2px solid #2a5bff;
            color: #2a5bff;
            padding: 1rem;
            border-radius: 8px;
            font-weight: bold;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }

        .register-btn:hover {
            background-color: #2a5bff;
            color: white;
        }

        .footer {
            font-size: 0.8rem;
            text-align: center;
            margin-top: 2.5rem;
            color: #777;
        }

        .footer a {
            color: #555;
            margin: 0 0.4rem;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="card">
    <img src="{{ asset('images/CAP.png') }}" class="logo" alt="SISTEC Logo">
    <h2>Welcome Back!</h2>
    <p>Sign in with your email address</p>

    @if ($errors->any())
        <div class="error-message">
            {{ $errors->first('email') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.process') }}">
        @csrf
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>

        <div class="checkbox-label">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Stay Logged In</label>
        </div>

        <div class="forgot">
            <a href="#">Forgot your password?</a>
        </div>

        <button class="btn" type="submit">Continue</button>
    </form>

    <a href="{{ route('register') }}" class="register-btn">Crear cuenta de administrador</a>

    <div class="footer">
        <p><strong>SISTEC</strong> © 2025 Sistec Solutions. All rights reserved.</p>
        <div>
            <a href="#">Privacy</a> |
            <a href="#">Terms</a> |
            <a href="#">Help</a>
        </div>
    </div>
</div>
</body>
</html>
