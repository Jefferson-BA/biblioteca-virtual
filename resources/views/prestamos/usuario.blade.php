@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📚 Solicitar Préstamo</h2>

    <form method="POST" action="{{ route('prestamos.solicitar') }}">
        @csrf
        <label for="libro_id">Seleccionar libro:</label>
        <select name="libro_id" required>
            @foreach ($libros as $libro)
                <option value="{{ $libro->id }}">{{ $libro->titulo }}</option>
            @endforeach
        </select>
        <button type="submit">Solicitar</button>
    </form>

    <h3 class="mt-4">🗂️ Mis Préstamos</h3>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Título</th>
                <th>Fecha Préstamo</th>
                <th>Fecha Devolución</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prestamos as $p)
                <tr>
                    <td>{{ $p->titulo }}</td>
                    <td>{{ $p->fecha_prestamo }}</td>
                    <td>{{ $p->fecha_devolucion ?? '—' }}</td>
                    <td>{{ ucfirst($p->estado) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
