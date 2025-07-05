<!-- filepath: c:\pc5.1\biblioteca_virtual\resources\views\prestamos\usuario.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel de Usuario - Préstamos</title>
    <link rel="stylesheet" href="{{ asset('css/prestamouser.blade.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="decorative-elements"></div>
    <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
        <i class="fas fa-bars"></i>
    </button>
    <div class="mobile-overlay" onclick="toggleMobileMenu()"></div>
    <div class="main-layout">
        <div class="dashboard" id="dashboard">
            <div class="logo">
                <i class="fas fa-book-open"></i>
            </div>
            <h2>Panel de Usuario</h2>
            <div class="opciones">
                <a href="{{ route('libros.vista_usuario') }}">
                    <i class="fas fa-book"></i>
                    Libros Disponibles
                </a>
                <a href="{{ route('prestamos.usuario') }}" class="active">
                    <i class="fas fa-handshake"></i>
                    Préstamos
                </a>
            </div>
        </div>
        <div class="main-content">
            <!-- Formulario de Solicitud de Préstamo -->
            <div class="form-container">
                <h3>
                    <i class="fas fa-plus-circle"></i>
                    Solicitar Préstamo
                </h3>
                <form id="prestamoForm" method="POST" action="{{ route('prestamos.solicitar') }}">
                    @csrf
                    <div class="form-grid">
                        <div class="input-group">
                            <i class="fas fa-book"></i>
                            <select name="libro_id" required class="form-select">
                                <option value="">Seleccionar libro...</option>
                                @foreach($libros as $libro)
                                    <option value="{{ $libro->id }}">{{ $libro->titulo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            Solicitar Préstamo
                        </button>
                    </div>
                </form>
            </div>
            <!-- Tabla de Préstamos -->
            <div class="table-container">
                <h3>
                    <i class="fas fa-list"></i>
                    Mis Préstamos
                </h3>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th><i class="fas fa-book"></i> Título</th>
                                <th><i class="fas fa-calendar-alt"></i> Fecha Préstamo</th>
                                <th><i class="fas fa-calendar-check"></i> Fecha Devolución</th>
                                <th><i class="fas fa-info-circle"></i> Estado</th>
                            </tr>
                        </thead>
                        <tbody id="prestamosTable">
                            @forelse($prestamos as $prestamo)
                                <tr>
                                    <td>{{ $prestamo->titulo }}</td>
                                    <td>{{ $prestamo->fecha_prestamo }}</td>
                                    <td>{{ $prestamo->fecha_devolucion ?? '—' }}</td>
                                    <td>
                                        <span class="badge badge-{{ strtolower($prestamo->estado) }}">
                                            {{ ucfirst($prestamo->estado) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align:center;">No tienes préstamos registrados.</td>
                                </tr>
                            @endforelse
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
        // Cerrar menú móvil al hacer clic en un enlace
        document.querySelectorAll('.opciones a').forEach(link => {
            link.addEventListener('click', function(e) {
                // Remover clase active de todos los enlaces
                document.querySelectorAll('.opciones a').forEach(a => a.classList.remove('active'));
                // Agregar clase active al enlace clickeado
                this.classList.add('active');
                // Cerrar menú móvil
                if (window.innerWidth <= 768) {
                    toggleMobileMenu();
                }
            });
        });
    </script>
</body>
</html>