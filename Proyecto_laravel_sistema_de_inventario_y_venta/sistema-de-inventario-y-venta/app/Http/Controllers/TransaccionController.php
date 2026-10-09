<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransaccionController extends Controller
{
    // Mostrar el historial de ventas.
    public function index()
    {
        $transacciones = Transaccion::whereHas('producto', function ($query) {
            $query->where('user_id', Auth::id());
        })
            ->with('producto')
            ->latest()
            ->get();

        return view('ventas.index', compact('transacciones'));
    }

    // Mostrar el formulario de venta.
    public function create()
    {
        $productos = Producto::where('user_id', Auth::id())
            ->where('stock', '>', 0)
            ->orderBy('nombre')
            ->get();

        return view('ventas.create', compact('productos'));
    }

    // Registrar la venta y descontar el inventario.
    public function store(Request $request)
    {
        $datos = $request->validate([
            'producto_id' => 'required|integer|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'cliente_nombre' => 'required|string|max:255',
            'metodo_pago' => 'required|in:Efectivo,Tarjeta,Transferencia',
        ]);

        DB::transaction(function () use ($datos) {
            $producto = Producto::where('user_id', Auth::id())
                ->whereKey($datos['producto_id'])
                ->lockForUpdate()
                ->first();

            if (!$producto) {
                throw ValidationException::withMessages([
                    'producto_id' => 'El producto no existe o no te pertenece.',
                ]);
            }

            if ($producto->stock < $datos['cantidad']) {
                throw ValidationException::withMessages([
                    'cantidad' => 'Stock insuficiente. Disponibles: '
                        . $producto->stock,
                ]);
            }

            $monto = round(
                (float) $producto->precio * $datos['cantidad'],
                2
            );

            Transaccion::create([
                'producto_id' => $producto->getKey(),
                'cantidad' => $datos['cantidad'],
                'monto' => number_format($monto, 2, '.', ''),
                'moneda' => 'USD',
                'cliente_nombre' => $datos['cliente_nombre'],
                'metodo_pago' => $datos['metodo_pago'],
                'estado' => 'Completada',
            ]);

            $producto->decrement('stock', $datos['cantidad']);
        });

        return redirect()
            ->route('ventas.index')
            ->with('success', 'Venta registrada correctamente.');
    }
}