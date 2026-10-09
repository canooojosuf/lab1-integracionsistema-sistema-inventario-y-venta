<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

class ProductoController extends Controller
{
    // Mostrar los productos del usuario autenticado.
    public function index(Request $request)
    {
        $productos = $request->user()
            ->productos()
            ->withCount('transacciones')
            ->latest()
            ->get();

        return view('productos.index', compact('productos'));
    }

    // Mostrar el formulario de creación.
    public function create()
    {
        return view('productos.create');
    }

    // Guardar un producto.
    public function store(StoreProductoRequest $request)
    {
        $request->user()
            ->productos()
            ->create($request->validated());

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto registrado correctamente.');
    }

    // Mostrar los detalles de un producto.
    public function show(Request $request, Producto $producto)
    {
        $producto = $request->user()
            ->productos()
            ->findOrFail($producto->id);

        $producto->load('transacciones');

        return view('productos.show', compact('producto'));
    }

    // Mostrar el formulario de edición.
   public function edit(Request $request, Producto $producto)
{
    $producto = $request->user()
        ->productos()
        ->findOrFail($producto->id);

    return view('productos.edit', compact('producto'));
}

    // Actualizar un producto.
    public function update(
        UpdateProductoRequest $request,
        Producto $producto
    ) {
        $producto = $request->user()
            ->productos()
            ->findOrFail($producto->id);

        $producto->update($request->validated());

        return redirect()
            ->route('productos.show', $producto)
            ->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar un producto.
    public function destroy(Request $request, Producto $producto)
    {
        $producto = $request->user()
            ->productos()
            ->findOrFail($producto->id);

        $producto->delete();

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}