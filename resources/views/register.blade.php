<!DOCTYPE html>
<html>
<head>
    <title>Register | SISTEC</title>
</head>
<body style="font-family: Arial; background: #f5f5f5; padding: 2rem;">
    <h2>Registrar nuevo administrador / técnico</h2>
    <form method="POST" action="{{ route('register.process') }}" style="background: white; padding: 1.5rem; max-width: 400px;">
        @csrf
        <label>Nombre:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Especialidad:</label><br>
        <input type="text" name="especialidad" required><br><br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>
