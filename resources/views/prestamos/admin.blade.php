@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📋 Gestión de Préstamos</h2>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Libro</th>
                <th>Fecha Préstamo</th>
                <th>Fecha Devolución</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prestamos as $p)
                <tr>
                    <td>{{ $p->usuario }}</td>
                    <td>{{ $p->titulo }}</td>
                    <td>{{ $p->fecha_prestamo }}</td>
                    <td>{{ $p->fecha_devolucion ?? '—' }}</td>
                    <td>{{ ucfirst($p->estado) }}</td>
                    <td>
                        @if($p->estado == 'pendiente')
                            <form method="POST" action="{{ route('prestamos.estado') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $p->id }}">
                                <button name="estado" value="exitoso">✅ Aceptar</button>
                                <button name="estado" value="rechazado">❌ Rechazar</button>
                            </form>
                        @elseif($p->estado == 'exitoso' && !$p->fecha_devolucion)
                            <form method="POST" action="{{ route('prestamos.devolver') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $p->id }}">
                                <button>📦 Registrar Devolución</button>
                            </form>
                        @else
                            —
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
