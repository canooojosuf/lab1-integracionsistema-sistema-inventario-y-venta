<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\AuthController;

// Página inicial
Route::get('/', function () {
    return redirect()->route('login');
});

// Registro e inicio de sesión
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

// Rutas que requieren autenticación
Route::middleware('auth')->group(function () {

    // Cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Productos
    Route::get('/productos', [ProductoController::class, 'index'])
        ->name('productos.index');

    Route::get('/productos/crear', [ProductoController::class, 'create'])
        ->name('productos.create');

    Route::post('/productos', [ProductoController::class, 'store'])
        ->name('productos.store');

    Route::get('/productos/{producto}/editar', [ProductoController::class, 'edit'])
        ->name('productos.edit');

    Route::put('/productos/{producto}', [ProductoController::class, 'update'])
        ->name('productos.update');

    Route::get('/productos/{producto}', [ProductoController::class, 'show'])
        ->name('productos.show');

    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])
        ->name('productos.destroy');

    // Ventas
    Route::get('/ventas', [TransaccionController::class, 'index'])
        ->name('ventas.index');

    Route::get('/ventas/crear', [TransaccionController::class, 'create'])
        ->name('ventas.create');

    Route::post('/ventas', [TransaccionController::class, 'store'])
        ->name('ventas.store');
});