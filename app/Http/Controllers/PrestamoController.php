<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    public function solicitar(Request $request)
    {
        $usuarioId = Auth::id();
        $libroId = $request->input('libro_id');

        DB::unprepared("BEGIN registrar_prestamo($usuarioId, $libroId); END;");

        return redirect()->route('prestamos.usuario')->with('success', 'Solicitud enviada.');
    }

    public function usuarioPrestamos()
    {
        $usuarioId = Auth::id();
        $prestamos = DB::select("
            SELECT p.id, l.titulo, p.fecha_prestamo, p.fecha_devolucion, p.estado
            FROM prestamos p
            JOIN libros l ON p.libro_id = l.id
            WHERE p.usuario_id = $usuarioId
            ORDER BY p.fecha_prestamo DESC
        ");

        $libros = DB::select("SELECT * FROM vista_libros");

        return view('prestamos.usuario', compact('prestamos', 'libros'));
    }

    public function adminPrestamos()
    {
        $prestamos = DB::select("
            SELECT p.id, u.nombre AS usuario, l.titulo, p.fecha_prestamo, p.fecha_devolucion, p.estado
            FROM prestamos p
            JOIN usuarios u ON p.usuario_id = u.id
            JOIN libros l ON p.libro_id = l.id
            ORDER BY p.fecha_prestamo DESC
        ");

        return view('prestamos.admin', compact('prestamos'));
    }

    public function actualizarEstado(Request $request)
    {
        $id = $request->input('id');
        $estado = $request->input('estado');

        DB::unprepared("BEGIN actualizar_estado_prestamo($id, '$estado'); END;");

        return back()->with('success', 'Estado actualizado.');
    }

    public function registrarDevolucion(Request $request)
    {
        $id = $request->input('id');

        DB::unprepared("BEGIN registrar_devolucion($id); END;");

        return back()->with('success', 'Devolución registrada.');
    }
}
