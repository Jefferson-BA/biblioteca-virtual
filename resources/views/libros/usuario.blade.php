<!DOCTYPE html>
<html>
<head>
    <title>Catálogo de Libros</title>
    <style>
        body { font-family: sans-serif; background: #f9f9f9; padding: 20px; }
        table { width: 100%; background: white; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; }
        th { background: #007bff; color: white; }
    </style>
</head>
<body>
    <h2>📚 Libros Disponibles</h2>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Categoría</th>
                <th>Autor</th>
                <th>Disponibilidad</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($libros as $libro)
            <tr>
                <td>{{ $libro->titulo }}</td>
                <td>{{ $libro->categoria }}</td>
                <td>{{ $libro->autor }}</td>
                <td>{{ $libro->cantidad_disponible }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
