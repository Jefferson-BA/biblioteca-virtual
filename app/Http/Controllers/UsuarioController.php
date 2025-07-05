<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function mostrarFormularioRegistro()
{
    $roles = DB::select("SELECT id, nombre FROM roles WHERE LOWER(nombre) IN ('admin', 'usuario')");
    return view('usuarios.registro', compact('roles'));
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
        return redirect()->route('login')->with('success', 'Usuario registrado correctamente. Ahora puedes iniciar sesión.');
    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }
}

    public function login(Request $request)
    {
        try {
            $usuario = DB::select("
                SELECT u.*, r.nombre AS rol_nombre
                FROM usuarios u
                JOIN roles r ON u.rol_id = r.id
                WHERE u.correo = ? AND u.contrasena = ? AND ROWNUM = 1
            ", [$request->correo, $request->contrasena]);

            if ($usuario && count($usuario) > 0) {
                $usuario = (array)$usuario[0];
                session(['usuario' => $usuario]);

                // Redirigir según el rol
                if (strtolower($usuario['rol_nombre']) === 'admin') {
    return redirect()->route('libros.index');
} else {
    return redirect()->route('libros.vista_usuario');
}
            } else {
                return back()->with('error', 'Credenciales incorrectas');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}