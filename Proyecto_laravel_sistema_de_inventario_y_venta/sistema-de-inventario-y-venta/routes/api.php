<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ProductoApiController;

// Ruta pública para login (con límite de intentos)
Route::post('/login', [AuthApiController::class, 'login']) 
    ->middleware('throttle:5,1');

// Rutas protegidas por Sanctum
Route::middleware('auth:sanctum')->group(function () { 
    // Autenticación
    Route::get('/yo', [AuthApiController::class, 'yo']); 
    Route::post('/logout', [AuthApiController::class, 'logout']); 
    
    // CRUD de Productos (Esto ya maneja index, store, show, update y destroy)
    Route::apiResource('productos', ProductoApiController::class);
});