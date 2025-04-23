<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['auth', 'can:Ver menu'])->group(function () {
        Route::get('/vista-categorias', [MenuController::class, 'listaCategorias']);
    });
    Route::middleware(['auth', 'can:Crear menu'])->group(function () {
        Route::get('/crear-c', [MenuController::class, 'vistaCrearCategorias']);
        Route::post('/crearCategoria', [MenuController::class, 'crearCategorias']);
    });
    Route::middleware(['auth', 'can:Editar menu'])->group(function () {
        Route::get('editar-c/{id}', [MenuController::class, 'editarCategoria']);
        Route::put('actualizar-c/{id}', [MenuController::class, 'actualizarCategoria']);
        Route::delete('eliminar-c/{id}', [MenuController::class, 'eliminarCategoria']);
    });

    Route::middleware(['auth', 'can:Eliminar menu'])->group(function () {
        Route::delete('eliminar-c/{id}', [MenuController::class, 'eliminarCategoria']);
    });

    Route::middleware(['auth', 'can:Productos'])->group(function () {
        Route::get('/vista-productos', [ProductosController::class, 'listaProductos']);
        Route::get('/crear-p', [ProductosController::class, 'vistaCrearProductos']);
        Route::post('/crearProducto', [ProductosController::class, 'craerProductos']);
        Route::get('editar-producto/{id}', [ProductosController::class, 'editarProducto']);
        Route::put('actualizar-producto/{id}', [ProductosController::class, 'actualizarProducto']);
        Route::delete('eliminar-producto/{id}', [ProductosController::class, 'eliminarProductos']);
    });
    // usuarios 
    Route::middleware(['auth', 'can:Usuarios'])->group(function () {
        Route::get('/usuarios', [UsuarioController::class, 'index']);
        Route::get('/crear-usuario', [UsuarioController::class, 'create']);
        Route::post('/usuarios-crear', [UsuarioController::class, 'store']);
        Route::get('/editar-usuario/{id}', [UsuarioController::class, 'edit']);
        Route::put('/usuarios-editarc/{id}', [UsuarioController::class, 'update']);
        Route::delete('/eliminar-usuario/{id}', [UsuarioController::class, 'destroy']);
    });

    // roles y permisos 
    Route::middleware(['auth', 'can:Roles'])->group(function () {
        Route::get('/roles', [RoleController::class, 'index']);
        Route::get('/roles/crear', [RoleController::class, 'create']);
        Route::post('/roles/guardar', [RoleController::class, 'store']);
        Route::get('/roles/editar/{id}', [RoleController::class, 'edit']);
        Route::put('/roles/actualizar/{id}', [RoleController::class, 'update']);
        Route::delete('/roles/eliminar/{id}', [RoleController::class, 'destroy']);
    });
});

require __DIR__.'/auth.php';
