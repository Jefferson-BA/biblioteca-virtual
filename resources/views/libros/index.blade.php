<!DOCTYPE html>
<html>

<head>
    <title>Gestión de Libros</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f0f0f0;
            padding: 20px;
        }

        form,
        table {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        input,
        select,
        button {
            margin-top: 10px;
            padding: 8px;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>
    <h2>📘 Gestión de Libros</h2>

    @if(session('success')) <p class="success">{{ session('success') }}</p> @endif

    <form method="POST" action="{{ route('libros.store') }}">
        @csrf
        <h3>➕ Registrar Libro</h3>
        <input type="text" name="titulo" placeholder="Título" required>
        <select name="categoria_id" required>
            <option value="">Seleccionar Categoría</option>
            @foreach ($categorias as $cat)
            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
            @endforeach
        </select>
        <select name="autor_id" required>
            <option value="">Seleccionar Autor</option>
            @foreach ($autores as $aut)
            <option value="{{ $aut->id }}">{{ $aut->nombre }}</option>
            @endforeach
        </select>
        <input type="number" name="cantidad_disponible" placeholder="Cantidad" required>
        <button type="submit">Registrar</button>
    </form>

    <h3>📋 Libros Registrados</h3>
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
                <td>{{ $libro->cantidad_disponible }}</td>
                <td>
                    <form method="POST" action="{{ route('libros.delete') }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="id" value="{{ $libro->id }}">
                        <button type="submit" onclick="return confirm('¿Eliminar este libro?')">Eliminar</button>
                    </form>
                    <button onclick="editarLibro({{ json_encode($libro) }})">Editar</button>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- 🛠️ Formulario de Edición (oculto hasta presionar "Editar") -->
    <div id="editForm" style="display:none; background:#fff; padding:20px; border-radius:10px; margin-top:30px;">
        <h3>✏️ Editar Libro</h3>
        <form method="POST" action="{{ route('libros.update') }}">
            @csrf
            <input type="hidden" name="id" id="edit_id">
            <input type="text" name="titulo" id="edit_titulo" placeholder="Título" required>
            <select name="categoria_id" id="edit_categoria_id" required>
                <option value="">Seleccionar Categoría</option>
                @foreach ($categorias as $cat)
                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                @endforeach
            </select>
            <select name="autor_id" id="edit_autor_id" required>
                <option value="">Seleccionar Autor</option>
                @foreach ($autores as $aut)
                <option value="{{ $aut->id }}">{{ $aut->nombre }}</option>
                @endforeach
            </select>
            <input type="number" name="cantidad_disponible" id="edit_cantidad" placeholder="Cantidad" required>
            <button type="submit">Actualizar</button>
            <button type="button" onclick="document.getElementById('editForm').style.display='none'">Cancelar</button>
        </form>
    </div>

</body>
<script>
    function editarLibro(libro) {
        document.getElementById('edit_id').value = libro.id;
        document.getElementById('edit_titulo').value = libro.titulo;
        document.getElementById('edit_categoria_id').value = libro.categoria_id;
        document.getElementById('edit_autor_id').value = libro.autor_id;
        document.getElementById('edit_cantidad').value = libro.cantidad_disponible;
        document.getElementById('editForm').style.display = 'block';
        window.scrollTo(0, document.body.scrollHeight);
    }
</script>


</html>