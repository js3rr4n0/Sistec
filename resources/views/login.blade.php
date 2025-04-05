{{-- resources/views/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | SISTEC</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .card {
            background: white;
            width: 100%;
            max-width: 450px;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        .logo {
            display: block;
            margin: 0 auto 1rem;
            max-height: 60px;
        }
        h2 {
            text-align: left;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        p {
            font-size: 0.95rem;
            color: #444;
            margin-bottom: 1.5rem;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .checkbox-label {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        .checkbox-label input {
            margin-right: 8px;
        }
        .btn {
            width: 100%;
            background-color: #2a5bff;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 1rem;
        }
        .footer {
            font-size: 0.8rem;
            text-align: center;
            margin-top: 1.5rem;
            color: #777;
        }
        .footer a {
            color: #333;
            margin: 0 0.5rem;
            text-decoration: none;
        }
        .forgot {
            text-align: right;
            font-size: 0.85rem;
            margin-top: -1rem;
            margin-bottom: 1rem;
        }
        .forgot a {
            color: #2a5bff;
            text-decoration: none;
        }
        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        .register-btn {
            width: 100%;
            background: transparent;
            border: 2px solid #2a5bff;
            color: #2a5bff;
            padding: 0.75rem;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="{{ asset('images/CAP.png') }}" class="logo" alt="SISTEC Logo">
        <h2>Welcome Back!</h2>
        <p>Sign in with your email address</p>

        {{-- Mostrar errores --}}
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
                <a href="#">Forgot Your Password?</a>
            </div>

            <button class="btn" type="submit">Continue</button>
        </form>

        {{-- Botón para registro --}}
        <a href="{{ route('register') }}" class="register-btn">Crear cuenta de administrador</a>

        <div class="footer">
            <p><strong>Sistec</strong> © 2023 Sistec Solutions. All rights reserved.</p>
            <div>
                <a href="#">Privacy Policy</a> |
                <a href="#">Terms of Service</a> |
                <a href="#">Help Center</a> |
                <a href="#">Feedback</a> |
                <a href="#">Sitemap</a>
            </div>
        </div>
    </div>
</body>
</html>
