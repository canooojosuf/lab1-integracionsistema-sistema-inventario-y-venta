@extends('layouts.app')

@section('titulo', $producto->nombre)

@section('contenido')

    <h1>{{ $producto->nombre }}</h1>

    <p>
        <strong>Descripción:</strong>
        {{ $producto->descripcion ?? 'Sin descripción' }}
    </p>

    <p>
        <strong>Marca:</strong>
        {{ $producto->marca ?? 'Sin marca' }}
    </p>

    <p>
        <strong>Medida:</strong>
        {{ $producto->medida ?? 'Sin medida' }}
    </p>

    <p>
        <strong>Precio:</strong>
        ${{ number_format((float) $producto->precio, 2) }}
    </p>

    <p>
        <strong>Stock disponible:</strong>
        {{ $producto->stock }}
    </p>

    {{-- Mensaje de confirmación --}}
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    {{-- Enlace para editar el producto --}}
    <p>
        <a href="{{ route('productos.edit', $producto) }}">
            Editar producto
        </a>
    </p>

    <hr>

    <h2>Transacciones del producto</h2>

    @forelse ($producto->transacciones as $t)
        <div class="transaccion">
            <strong>
                ${{ $t->monto }} {{ $t->moneda }}
            </strong>

            — Cliente: {{ $t->cliente_nombre }}
            — Cantidad: {{ $t->cantidad }}

            <x-badge-estado :estado="$t->estado" />
        </div>
    @empty
        <p>Este producto aún no registra transacciones.</p>
    @endforelse

    <p>
        <a href="{{ route('productos.index') }}">
            Volver al listado de productos
        </a>
    </p>

@endsection