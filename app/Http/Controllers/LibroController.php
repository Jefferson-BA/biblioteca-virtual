<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LibroController extends Controller
{
    public function index()
    {
        $libros = DB::select("SELECT * FROM vista_libros");


        $categorias = DB::select("SELECT * FROM categorias");
        $autores = DB::select("SELECT * FROM autores");

        return view('libros.index', compact('libros', 'categorias', 'autores'));
    }

    public function store(Request $request)
    {
        DB::unprepared("
            BEGIN
                registrar_libro(
                    '{$request->titulo}',
                    {$request->categoria_id},
                    {$request->autor_id},
                    {$request->cantidad_disponible}
                );
            END;
        ");

        return redirect()->route('libros.index')->with('success', 'Libro registrado.');
    }

    public function update(Request $request)
    {
        DB::unprepared("
            BEGIN
                actualizar_libro(
                    {$request->id},
                    '{$request->titulo}',
                    {$request->categoria_id},
                    {$request->autor_id},
                    {$request->cantidad_disponible}
                );
            END;
        ");

        return redirect()->route('libros.index')->with('success', 'Libro actualizado.');
    }

    public function delete(Request $request)
    {
        DB::unprepared("
            BEGIN
                eliminar_libro({$request->id});
            END;
        ");

        return redirect()->route('libros.index')->with('success', 'Libro eliminado.');
    }
    public function vistaUsuario()
{
    $libros = DB::select("SELECT * FROM vista_libros");


    return view('libros.usuario', compact('libros'));
}

}
