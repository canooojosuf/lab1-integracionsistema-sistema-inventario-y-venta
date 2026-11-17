<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Http\Resources\ProductoResource;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Illuminate\Http\Request;

class ProductoApiController extends Controller
{
    // 1. Listar todos los productos (GET /api/productos)
    public function index()
    {
        
        $productos = Producto::latest()->get();
        return ProductoResource::collection($productos);
    }

    // 2. Guardar un producto (POST /api/productos)
    public function store(StoreProductoRequest $request)
    {
        
        $producto = Producto::create($request->validated());
        
        // Código 201: Created
        return (new ProductoResource($producto))
            ->response()
            ->setStatusCode(201);
    }

    // 3. Mostrar un producto específico (GET /api/productos/{id})
    public function show(string $id)
    {
        $producto = Producto::findOrFail($id);
        return new ProductoResource($producto);
    }

    // 4. Actualizar un producto (PUT/PATCH /api/productos/{id})
    public function update(UpdateProductoRequest $request, string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->validated());
        
        return new ProductoResource($producto);
    }

    // 5. Eliminar un producto (DELETE /api/productos/{id})
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        
        // Código 204: No Content (Eliminado exitosamente)
        return response()->noContent();
    }
}