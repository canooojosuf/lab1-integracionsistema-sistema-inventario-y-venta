@extends('layouts.app')

@section('titulo', 'Registrar venta')

@section('contenido')

    <h1>Ferretería - Registrar venta</h1>

    <p>
        <a href="{{ route('productos.index') }}">Volver al inventario</a>
        |
        <a href="{{ route('ventas.index') }}">Ver historial de ventas</a>
    </p>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($productos->isEmpty())
        <p>No hay productos con existencias disponibles.</p>

        <a href="{{ route('productos.create') }}">
            Registrar un producto
        </a>
    @else
        <form action="{{ route('ventas.store') }}" method="POST">
            @csrf

            <div>
                <label for="producto_id">Producto:</label>

                <select id="producto_id" name="producto_id" required>
                    <option value="">Seleccione un producto</option>

                    @foreach ($productos as $producto)
                        <option
                            value="{{ $producto->id }}"
                            @selected(old('producto_id') == $producto->id)
                        >
                            {{ $producto->nombre }}
                            — Marca: {{ $producto->marca ?? 'Sin marca' }}
                            — Precio: ${{ number_format((float) $producto->precio, 2) }}
                            — Stock: {{ $producto->stock }}
                        </option>
                    @endforeach
                </select>
            </div>

            <br>

            <div>
                <label for="cantidad">Cantidad vendida:</label>

                <input
                    type="number"
                    id="cantidad"
                    name="cantidad"
                    min="1"
                    step="1"
                    value="{{ old('cantidad', 1) }}"
                    required
                >
            </div>

            <br>

            <div>
                <label for="cliente_nombre">Nombre del cliente:</label>

                <input
                    type="text"
                    id="cliente_nombre"
                    name="cliente_nombre"
                    maxlength="255"
                    value="{{ old('cliente_nombre') }}"
                    required
                >
            </div>

            <br>

            <div>
                <label for="metodo_pago">Método de pago:</label>

                <select id="metodo_pago" name="metodo_pago" required>
                    <option value="Efectivo"
                        @selected(old('metodo_pago', 'Efectivo') === 'Efectivo')>
                        Efectivo
                    </option>

                    <option value="Tarjeta"
                        @selected(old('metodo_pago') === 'Tarjeta')>
                        Tarjeta
                    </option>

                    <option value="Transferencia"
                        @selected(old('metodo_pago') === 'Transferencia')>
                        Transferencia
                    </option>
                </select>
            </div>

            <br>

            <p>
                El monto total se calculará automáticamente según
                el precio del producto y la cantidad vendida.
            </p>

            <button type="submit">Registrar venta</button>
        </form>
    @endif

@endsection