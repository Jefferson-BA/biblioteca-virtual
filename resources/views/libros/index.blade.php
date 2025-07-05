<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Libros</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/libros.blade.css') }}">
</head>
<body>
    <div class="decorative-elements"></div>
    
    <!-- Dashboard Principal -->
    <div class="dashboard">
        <div class="logo">
            <i class="fas fa-book"></i>
        </div>
        <h2>Biblioteca Virtual</h2>
        <div class="opciones">
            <a href="{{ route('libros.index') }}">
                <i class="fas fa-book"></i>
                Gestionar Libros
            </a>
            <a href="{{ route('prestamos.admin') }}">
                <i class="fas fa-handshake"></i>
                Préstamos
            </a>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="main-content">
        <!-- Mensaje de Éxito -->
        @if(session('success')) 
            <div class="alert success">
                <i class="fas fa-check-circle"></i>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Formulario de Registro -->
        <div class="form-container">
            <form method="POST" action="{{ route('libros.store') }}">
                @csrf
                <h3>Registrar Libro</h3>
                
                <div class="form-grid">
                    <div class="input-group">
                        <i class="fas fa-book"></i>
                        <input type="text" name="titulo" placeholder="Título del libro" required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-tags"></i>
                        <input type="text" name="categoria_nombre" placeholder="Categoría" required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-user-edit"></i>
                        <input type="text" name="autor_nombre" placeholder="Autor" required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-hashtag"></i>
                        <input type="number" name="cantidad_disponible" placeholder="Cantidad disponible" required>
                    </div>
                </div>
                
                <button type="submit" class="btn-primary">
                    <i class="fas fa-plus"></i>
                    Registrar Libro
                </button>
            </form>
        </div>

        <!-- Tabla de Libros -->
        <div class="table-container">
            <h3>Libros Registrados</h3>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Autor</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($libros as $libro)
                        <tr>
                            <td>{{ $libro->titulo }}</td>
                            <td>{{ $libro->categoria }}</td>
                            <td>{{ $libro->autor }}</td>
                            <td>
                                <span class="badge">{{ $libro->cantidad_disponible }}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button type="button" class="btn-edit" onclick="editarLibro({{ json_encode($libro) }})">
                                        <i class="fas fa-edit"></i>
                                        Editar
                                    </button>
                                    <form method="POST" action="{{ route('libros.delete') }}" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $libro->id }}">
                                        <button type="submit" class="btn-delete" onclick="return confirm('¿Eliminar este libro?')">
                                            <i class="fas fa-trash"></i>
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Formulario de Edición -->
        <div id="editForm" class="form-container edit-form" style="display:none;">
            <h3>Editar Libro</h3>
            <form method="POST" action="{{ route('libros.update') }}">
                @csrf
                <input type="hidden" name="id" id="edit_id">
                
                <div class="form-grid">
                    <div class="input-group">
                        <i class="fas fa-book"></i>
                        <input type="text" name="titulo" id="edit_titulo" placeholder="Título del libro" required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-tags"></i>
                        <input type="text" name="categoria_nombre" id="edit_categoria_nombre" placeholder="Categoría" required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-user-edit"></i>
                        <input type="text" name="autor_nombre" id="edit_autor_nombre" placeholder="Autor" required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-hashtag"></i>
                        <input type="number" name="cantidad_disponible" id="edit_cantidad" placeholder="Cantidad disponible" required>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i>
                        Actualizar
                    </button>
                    <button type="button" class="btn-secondary" onclick="cancelarEdicion()">
                        <i class="fas fa-times"></i>
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Animaciones de entrada
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.dashboard, .main-content > *');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    el.style.transition = 'all 0.6s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Función para editar libro
        function editarLibro(libro) {
            document.getElementById('edit_id').value = libro.id;
            document.getElementById('edit_titulo').value = libro.titulo;
            document.getElementById('edit_categoria_nombre').value = libro.categoria;
            document.getElementById('edit_autor_nombre').value = libro.autor;
            document.getElementById('edit_cantidad').value = libro.cantidad_disponible;
            
            const editForm = document.getElementById('editForm');
            editForm.style.display = 'block';
            editForm.scrollIntoView({ behavior: 'smooth' });
            
            // Animación de aparición
            setTimeout(() => {
                editForm.style.opacity = '1';
                editForm.style.transform = 'translateY(0)';
            }, 100);
        }

        // Función para cancelar edición
        function cancelarEdicion() {
            const editForm = document.getElementById('editForm');
            editForm.style.opacity = '0';
            editForm.style.transform = 'translateY(20px)';
            setTimeout(() => {
                editForm.style.display = 'none';
            }, 300);
        }

        // Efectos de interacción en inputs
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                const icon = this.parentElement.querySelector('i');
                if (icon) {
                    icon.style.color = '#1f1c2c';
                    icon.style.transform = 'translateY(-50%) scale(1.1)';
                }
            });
            
            input.addEventListener('blur', function() {
                const icon = this.parentElement.querySelector('i');
                if (icon) {
                    icon.style.color = '#928dab';
                    icon.style.transform = 'translateY(-50%) scale(1)';
                }
            });
        });
    </script>
</body>
</html>