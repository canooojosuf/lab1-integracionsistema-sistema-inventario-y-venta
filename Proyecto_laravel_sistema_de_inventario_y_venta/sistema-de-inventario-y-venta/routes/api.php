<?php

use App\Http\Resources\ProductoResource;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ProductoApiController;

Route::post('/login', [AuthApiController::class, 'login']) 
    ->middleware('throttle:5,1');

Route::middleware('auth:sanctum')->group(function () { 
    Route::get('/yo', [AuthApiController::class, 'yo']); 
    Route::post('/logout', [AuthApiController::class, 'logout']); 
    Route::apiResource('productos', ProductoApiController::class);
    
    Route::get('/productos', function (Request $request) { 
        return ProductoResource::collection(
            $request->user()->productos()->orderBy('name')->get()
        );
    });

    Route::get('/productos/{producto}', function (Request $request,Producto $producto) { 
        abort_unless($producto->user()->id === $request->user_id, 403);
        return new ProductoResource($producto->load('transacciones'));
    });
}); 