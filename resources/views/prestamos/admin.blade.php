<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/prestamo.blade.css') }}">
</head>
<body>
    <div class="decorative-elements"></div>
    
    <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
        <i class="fas fa-bars"></i>
    </button>
    
    <div class="mobile-overlay" onclick="toggleMobileMenu()"></div>
    
    <div class="main-layout">
        <div class="dashboard" id="sidebar">
            <div class="logo">
                <i class="fas fa-book"></i>
            </div>
            <h2>Biblioteca Virtual</h2>
            <div class="opciones">
                <a href="{{ route('libros.index') }}">
                    <i class="fas fa-book-open"></i>
                    Gestionar Libros
                </a>
                <a href="{{ route('prestamos.admin') }}">
                    <i class="fas fa-handshake"></i>
                    Préstamos
                </a>
            </div>
        </div>

        <div class="main-content">
            <div class="container">
                <h2>Gestión de Préstamos</h2>

                <div class="table-container">
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th><i class="fas fa-user"></i> Usuario</th>
                                    <th><i class="fas fa-book"></i> Libro</th>
                                    <th><i class="fas fa-calendar-alt"></i> Fecha Préstamo</th>
                                    <th><i class="fas fa-calendar-check"></i> Fecha Devolución</th>
                                    <th><i class="fas fa-info-circle"></i> Estado</th>
                                    <th><i class="fas fa-cogs"></i> Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestamos as $p)
                                    <tr>
                                        <td>{{ $p->usuario }}</td>
                                        <td>{{ $p->titulo }}</td>
                                        <td>{{ $p->fecha_prestamo }}</td>
                                        <td>{{ $p->fecha_devolucion ?? '—' }}</td>
                                        <td>
                                            <span class="badge {{ $p->estado }}">
                                                {{ ucfirst($p->estado) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                @if($p->estado == 'pendiente')
                                                    <form method="POST" action="{{ route('prestamos.estado') }}" style="display: inline;">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $p->id }}">
                                                        <button name="estado" value="exitoso">
                                                            <i class="fas fa-check"></i> Aceptar
                                                        </button>
                                                        <button name="estado" value="rechazado">
                                                            <i class="fas fa-times"></i> Rechazar
                                                        </button>
                                                    </form>
                                                @elseif($p->estado == 'exitoso' && !$p->fecha_devolucion)
                                                    <form method="POST" action="{{ route('prestamos.devolver') }}" style="display: inline;">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $p->id }}">
                                                        <button>
                                                            <i class="fas fa-undo"></i> Registrar Devolución
                                                        </button>
                                                    </form>
                                                @else
                                                    <span style="color: #6c757d;">—</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>