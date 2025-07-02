<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function mostrarFormularioRegistro()
    {
        return view('usuarios.registro');
    }

    public function mostrarFormularioLogin()
    {
        return view('usuarios.login');
    }

    public function registrar(Request $request)
    {
        try {
            DB::unprepared("
                BEGIN 
                    registrar_usuario(
                        '{$request->nombre}', 
                        '{$request->correo}', 
                        '{$request->contrasena}', 
                        {$request->rol_id}
                    ); 
                END;
            ");
            return back()->with('success', 'Usuario registrado correctamente');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
    protected function authenticated(Request $request, $user)
{
    $rol = DB::table('usuarios')
             ->join('roles', 'usuarios.rol_id', '=', 'roles.id')
             ->where('usuarios.id', $user->id)
             ->select('roles.nombre')
             ->first();

    if ($rol && $rol->nombre === 'admin') {
        return redirect()->route('libros.index'); // Vista de administración
    }

    return redirect()->route('libros.vista_usuario'); // Solo para visualizar libros
}


    public function login(Request $request)
    {
        try {
            $usuario = DB::select("
                SELECT COUNT(*) AS total 
                FROM usuarios 
                WHERE correo = ? AND contrasena = ?
            ", [$request->correo, $request->contrasena]);

            if ($usuario[0]->total > 0) {
                return back()->with('success', 'Inicio de sesión exitoso');
            } else {
                return back()->with('error', 'Credenciales incorrectas');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
