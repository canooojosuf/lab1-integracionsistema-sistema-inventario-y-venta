@extends('layouts.app')

@section('titulo', 'Historial de ventas')

@section('contenido')

    <h1>Historial de ventas de ferretería</h1>

    <p>
        <a href="{{ route('ventas.create') }}">+ Registrar nueva venta</a>
        |
        <a href="{{ route('productos.index') }}">Ver inventario</a>
    </p>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cliente</th>
                <th>Cantidad</th>
                <th>Monto</th>
                <th>Moneda</th>
                <th>Método de pago</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($transacciones as $transaccion)
                <tr>
                    <td>{{ $transaccion->id }}</td>

                    <td>
                        {{ $transaccion->producto?->nombre ?? 'Producto no disponible' }}
                    </td>

                    <td>{{ $transaccion->cliente_nombre }}</td>

                    <td>{{ $transaccion->cantidad }}</td>

                    <td>
                        ${{ number_format((float) $transaccion->monto, 2) }}
                    </td>

                    <td>{{ $transaccion->moneda }}</td>

                    <td>{{ $transaccion->metodo_pago }}</td>

                    <td>{{ $transaccion->estado }}</td>

                    <td>
                        {{ $transaccion->created_at->format('d/m/Y H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Todavía no hay ventas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection