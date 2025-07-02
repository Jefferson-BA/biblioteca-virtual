<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: sans-serif; background: #f2f2f2; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 10px; max-width: 400px; margin: auto; }
        input, button { width: 100%; padding: 10px; margin-top: 10px; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Iniciar Sesión</h2>

    @if(session('success')) <p class="success">{{ session('success') }}</p> @endif
    @if(session('error')) <p class="error">{{ session('error') }}</p> @endif

    <form method="POST" action="/login">
        @csrf
        <input type="email" name="correo" placeholder="Correo" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
