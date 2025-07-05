<!DOCTYPE html>
<html>
<head>
    <title>Catálogo de Libros</title>
    <link rel="stylesheet" href="{{ asset('css/librosuser.blade.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Elementos decorativos -->
    <div class="decorative-elements"></div>
    
    <!-- Botón menú móvil -->
    <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Overlay para móvil -->
    <div class="mobile-overlay" onclick="toggleMobileMenu()"></div>
    
    <!-- Layout principal -->
    <div class="main-layout">
        <!-- Dashboard Sidebar -->
        <div class="dashboard" id="dashboard">
            <div class="logo">
                <i class="fas fa-book"></i>
            </div>
            <h2>Panel de Usuario</h2>
            <div class="opciones">
                <a href="{{ route('libros.vista_usuario') }}" class="active">
                    <i class="fas fa-book-open"></i>
                    Libros Disponibles
                </a>
                <a href="{{ route('prestamos.usuario') }}">
                    <i class="fas fa-hand-holding"></i>
                    Préstamos
                </a>
            </div>
        </div>
        
        <!-- Contenido Principal -->
        <div class="main-content">
            <div class="table-container">
                <h2>
                    <i class="fas fa-book-open"></i>
                    Libros Disponibles
                </h2>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th><i class="fas fa-book"></i> Título</th>
                                <th><i class="fas fa-tags"></i> Categoría</th>
                                <th><i class="fas fa-user"></i> Autor</th>
                                <th><i class="fas fa-check-circle"></i> Disponibilidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($libros as $libro)
                            <tr>
                                <td>{{ $libro->titulo }}</td>
                                <td>{{ $libro->categoria }}</td>
                                <td>{{ $libro->autor }}</td>
                                <td>
                                    @if($libro->cantidad_disponible > 0)
                                        <span class="badge badge-disponible">{{ $libro->cantidad_disponible }} disponibles</span>
                                    @else
                                        <span class="badge badge-agotado">Agotado</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const dashboard = document.getElementById('dashboard');
            const overlay = document.querySelector('.mobile-overlay');
            
            dashboard.classList.toggle('mobile-visible');
            overlay.classList.toggle('active');
        }
    </script>
</body>
</html>