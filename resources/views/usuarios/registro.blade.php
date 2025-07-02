<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <style>
        body { font-family: sans-serif; background: #f2f2f2; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 10px; max-width: 400px; margin: auto; }
        input, button { width: 100%; padding: 10px; margin-top: 10px; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Registro de Usuario</h2>

    @if(session('success')) <p class="success">{{ session('success') }}</p> @endif
    @if(session('error')) <p class="error">{{ session('error') }}</p> @endif

    <form method="POST" action="/registrar">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="correo" placeholder="Correo" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <input type="number" name="rol_id" placeholder="Rol ID (ej. 1)" required>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
