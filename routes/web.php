<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController; // Este debe ir arriba
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;



// Ruta principal
Route::get('/', function () {
    return view('welcome');
});


Route::get('/registro', [UsuarioController::class, 'mostrarFormularioRegistro']);
Route::post('/registrar', [UsuarioController::class, 'registrar']);

Route::get('/login', [UsuarioController::class, 'mostrarFormularioLogin']);
Route::post('/login', [UsuarioController::class, 'login']);

Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
Route::post('/libros', [LibroController::class, 'store'])->name('libros.store');
Route::post('/libros/update', [LibroController::class, 'update'])->name('libros.update');
Route::post('/libros/delete', [LibroController::class, 'delete'])->name('libros.delete');
Route::get('/libros-usuario', [LibroController::class, 'vistaUsuario'])->name('libros.vista_usuario');
Route::get('/prestamos', [PrestamoController::class, 'usuarioPrestamos'])->name('prestamos.usuario');
Route::post('/prestamos/solicitar', [PrestamoController::class, 'solicitar'])->name('prestamos.solicitar');
Route::get('/admin/prestamos', [PrestamoController::class, 'adminPrestamos'])->name('prestamos.admin');
Route::post('/admin/prestamos/estado', [PrestamoController::class, 'actualizarEstado'])->name('prestamos.estado');
Route::post('/admin/prestamos/devolver', [PrestamoController::class, 'registrarDevolucion'])->name('prestamos.devolver');