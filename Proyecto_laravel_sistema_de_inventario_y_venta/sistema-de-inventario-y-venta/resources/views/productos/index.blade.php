@extends('layouts.app')

@section('titulo', 'Listado de productos')

@section('contenido')

    <h1>Productos de ferretería</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>
        <a href="{{ route('productos.create') }}">
            + Registrar nuevo producto
        </a>
    </p>

    <ul>
        @forelse ($productos as $producto)
            <li>
                <a href="{{ route('productos.show', $producto->id) }}">
                    {{ $producto->nombre }}
                </a>

                — Marca: {{ $producto->marca ?? 'Sin marca' }}
                — Precio: ${{ number_format((float) $producto->precio, 2) }}
                — Stock: {{ $producto->stock }}
                — Transacciones: {{ $producto->transacciones_count }}
            </li>
        @empty
            <li>No hay productos registrados.</li>
        @endforelse
    </ul>

@endsection