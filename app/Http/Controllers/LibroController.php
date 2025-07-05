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
    // Buscar o crear la categoría
    $categoriaNombre = trim($request->categoria_nombre);
    $categoria = DB::select("SELECT id FROM categorias WHERE LOWER(nombre) = ?", [strtolower($categoriaNombre)]);
    if ($categoria) {
        $categoria_id = $categoria[0]->id;
    } else {
        DB::insert("INSERT INTO categorias (nombre) VALUES (?)", [$categoriaNombre]);
        $categoria_id = DB::getPdo()->lastInsertId();
        if (!$categoria_id) {
            $cat = DB::select("SELECT id FROM categorias WHERE LOWER(nombre) = ? ORDER BY id DESC FETCH FIRST 1 ROWS ONLY", [strtolower($categoriaNombre)]);
            $categoria_id = $cat[0]->id;
        }
    }

    // Buscar o crear el autor
    $autorNombre = trim($request->autor_nombre);
    $autor = DB::select("SELECT id FROM autores WHERE LOWER(nombre) = ?", [strtolower($autorNombre)]);
    if ($autor) {
        $autor_id = $autor[0]->id;
    } else {
        DB::insert("INSERT INTO autores (nombre) VALUES (?)", [$autorNombre]);
        $autor_id = DB::getPdo()->lastInsertId();
        if (!$autor_id) {
            $aut = DB::select("SELECT id FROM autores WHERE LOWER(nombre) = ? ORDER BY id DESC FETCH FIRST 1 ROWS ONLY", [strtolower($autorNombre)]);
            $autor_id = $aut[0]->id;
        }
    }

    // Registrar el libro usando el procedimiento almacenado
    DB::unprepared("
        BEGIN
            registrar_libro(
                '{$request->titulo}',
                {$categoria_id},
                {$autor_id},
                {$request->cantidad_disponible}
            );
        END;
    ");

    return redirect()->route('libros.index')->with('success', 'Libro registrado correctamente.');
}

    public function update(Request $request)
{
    // Buscar o crear la categoría
    $categoriaNombre = trim($request->categoria_nombre);
    $categoria = DB::select("SELECT id FROM categorias WHERE LOWER(nombre) = ?", [strtolower($categoriaNombre)]);
    if ($categoria) {
        $categoria_id = $categoria[0]->id;
    } else {
        DB::insert("INSERT INTO categorias (nombre) VALUES (?)", [$categoriaNombre]);
        $categoria_id = DB::getPdo()->lastInsertId();
        if (!$categoria_id) {
            $cat = DB::select("SELECT id FROM categorias WHERE LOWER(nombre) = ? ORDER BY id DESC FETCH FIRST 1 ROWS ONLY", [strtolower($categoriaNombre)]);
            $categoria_id = $cat[0]->id;
        }
    }

    // Buscar o crear el autor
    $autorNombre = trim($request->autor_nombre);
    $autor = DB::select("SELECT id FROM autores WHERE LOWER(nombre) = ?", [strtolower($autorNombre)]);
    if ($autor) {
        $autor_id = $autor[0]->id;
    } else {
        DB::insert("INSERT INTO autores (nombre) VALUES (?)", [$autorNombre]);
        $autor_id = DB::getPdo()->lastInsertId();
        if (!$autor_id) {
            $aut = DB::select("SELECT id FROM autores WHERE LOWER(nombre) = ? ORDER BY id DESC FETCH FIRST 1 ROWS ONLY", [strtolower($autorNombre)]);
            $autor_id = $aut[0]->id;
        }
    }

    // Llamar al procedimiento para actualizar el libro
    DB::unprepared("
        BEGIN
            actualizar_libro(
                {$request->id},
                '{$request->titulo}',
                {$categoria_id},
                {$autor_id},
                {$request->cantidad_disponible}
            );
        END;
    ");

    return redirect()->route('libros.index')->with('success', 'Libro actualizado correctamente.');
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
