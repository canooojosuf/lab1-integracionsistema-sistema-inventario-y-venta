<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ProductoApiController;

// Rutas públicas
Route::post('/register', [AuthApiController::class, 'register']);

Route::post('/login', [AuthApiController::class, 'login'])
    ->middleware('throttle:5,1');

// Rutas protegidas por Sanctum
Route::middleware('auth:sanctum')->group(function () {

    // Autenticación
    Route::get('/yo', [AuthApiController::class, 'yo']);

    Route::post('/logout', [AuthApiController::class, 'logout']);

    // Información del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // CRUD de productos
    Route::apiResource('productos', ProductoApiController::class)
        ->names('api.productos');

});