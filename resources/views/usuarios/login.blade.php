<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.blade.css') }}">
</head>
<body>
    <div class="decorative-elements"></div>
    
    <div class="contenedor">
        <div class="logo">
            <i class="fas fa-book-open"></i>
        </div>
        
        <h2>Iniciar Sesión</h2>

        @if(session('success')) 
            <p class="success">{{ session('success') }}</p> 
        @endif
        
        @if(session('error')) 
            <p class="error">{{ session('error') }}</p> 
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="correo" placeholder="Correo electrónico" required>
            </div>
            
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
            </div>
            
            <button type="submit">
                <i class="fas fa-sign-in-alt"></i> Ingresar
            </button>
            
            <a class="register-link" href="{{ route('registro') }}">
                ¿No tienes cuenta? Regístrate aquí
            </a>
        </form>
    </div>

    <script>
        // Animación de entrada
        document.addEventListener('DOMContentLoaded', function() {
            const contenedor = document.querySelector('.contenedor');
            contenedor.style.opacity = '0';
            contenedor.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                contenedor.style.transition = 'all 0.6s ease';
                contenedor.style.opacity = '1';
                contenedor.style.transform = 'translateY(0)';
            }, 100);
        });

        // Efectos de interacción
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('i').style.color = '#1f1c2c';
                this.parentElement.querySelector('i').style.transform = 'translateY(-50%) scale(1.1)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('i').style.color = '#928dab';
                this.parentElement.querySelector('i').style.transform = 'translateY(-50%) scale(1)';
            });
        });
    </script>
</body>
</html>