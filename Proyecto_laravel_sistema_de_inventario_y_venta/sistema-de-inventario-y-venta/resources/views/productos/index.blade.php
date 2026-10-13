@extends('layouts.app')

@section('titulo', 'Listado de productos')

@section('contenido')

    <h1>Productos de ferretería</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <p>
        <a href="{{ route('productos.create') }}"
           style="background-color: #198754;
                  color: white;
                  padding: 10px 15px;
                  text-decoration: none;
                  border-radius: 5px;">
            + Registrar nuevo producto
        </a>
    </p>

    <ul style="list-style: none; padding: 0;">

        @forelse ($productos as $producto)

            <li style="margin-bottom: 15px;
                       padding: 15px;
                       border: 1px solid #ddd;
                       border-radius: 8px;">

                <div style="margin-bottom: 12px;">

                    <a href="{{ route('productos.show', $producto->id) }}"
                       style="font-weight: bold; font-size: 18px;">
                        {{ $producto->nombre }}
                    </a>

                    <p>
                        Marca: {{ $producto->marca ?? 'Sin marca' }}
                        <br>
                        Precio: ${{ number_format((float) $producto->precio, 2) }}
                        <br>
                        Stock: {{ $producto->stock }}
                        <br>
                        Transacciones: {{ $producto->transacciones_count ?? 0 }}
                    </p>

                </div>

                <div style="display: flex;
                            align-items: center;
                            gap: 10px;
                            flex-wrap: wrap;">

                    <a href="{{ route('productos.edit', $producto->id) }}"
                       style="background-color: #0d6efd;
                              color: white;
                              padding: 8px 16px;
                              text-decoration: none;
                              border-radius: 5px;">
                        Editar
                    </a>

                    <form action="{{ route('productos.destroy', $producto->id) }}"
                          method="POST"
                          style="margin: 0;"
                          onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                style="background-color: #dc3545;
                                       color: white;
                                       padding: 8px 16px;
                                       border: none;
                                       border-radius: 5px;
                                       cursor: pointer;">
                            Eliminar
                        </button>

                    </form>

                </div>

            </li>

        @empty

            <li>No hay productos registrados.</li>

        @endforelse

    </ul>

@endsection