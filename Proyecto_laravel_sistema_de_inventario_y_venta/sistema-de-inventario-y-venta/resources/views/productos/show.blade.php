@extends('layouts.app')

@section('titulo', $producto->nombre)

@section('contenido')
    <div style="max-width: 800px; margin: 0 auto;">
        
        <!-- Mensaje de confirmación -->
        @if (session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; font-weight: bold;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tarjeta Principal del Producto -->
        <div style="background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 30px; margin-bottom: 20px;">
            
            <!-- Encabezado: Título y Botón Editar -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px;">
                <h1 style="color: #1a202c; margin: 0; font-size: 28px;">{{ $producto->nombre }}</h1>
                <a href="{{ route('productos.edit', $producto->id) }}" style="background-color: #0d6efd; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px;">
                    Editar producto
                </a>
            </div>

            <!-- Datos en dos columnas -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div>
                    <p style="margin: 0 0 12px 0; color: #4a5568;"><strong>Marca:</strong> {{ $producto->marca ?? 'Sin marca' }}</p>
                    <p style="margin: 0 0 12px 0; color: #4a5568;"><strong>Medida:</strong> {{ $producto->medida ?? 'Sin medida' }}</p>
                </div>
                <div>
                    <p style="margin: 0 0 12px 0; color: #4a5568;"><strong>Precio:</strong> <span style="color: #198754; font-weight: bold; font-size: 18px;">${{ number_format((float) $producto->precio, 2) }}</span></p>
                    <p style="margin: 0 0 12px 0; color: #4a5568;"><strong>Stock disponible:</strong> {{ $producto->stock }}</p>
                </div>
            </div>

            <!-- Descripción -->
            <div style="background-color: #f8fafc; border-left: 4px solid #cbd5e0; padding: 15px; border-radius: 5px; margin-bottom: 30px;">
                <p style="margin: 0; color: #4a5568;"><strong>Descripción:</strong><br> {{ $producto->descripcion ?? 'Sin descripción' }}</p>
            </div>

            <!-- Sección de Transacciones -->
            <h2 style="color: #1a202c; font-size: 20px; margin-bottom: 15px;">Transacciones del producto</h2>

            @forelse ($producto->transacciones as $t)
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="margin: 0 0 5px 0; font-weight: bold; color: #1a202c; font-size: 16px;">
                            ${{ $t->monto }} {{ $t->moneda }}
                        </p>
                        <p style="margin: 0; font-size: 14px; color: #4a5568;">
                            Cliente: {{ $t->cliente_nombre }} &nbsp;|&nbsp; Cantidad: {{ $t->cantidad }}
                        </p>
                    </div>
                    <div>
                        <x-badge-estado :estado="$t->estado" />
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 20px; border: 1px dashed #cbd5e0; border-radius: 8px;">
                    <p style="color: #718096; font-style: italic; margin: 0;">Este producto aún no registra transacciones.</p>
                </div>
            @endforelse

        </div>

        <!-- Botón Volver -->
        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{ route('productos.index') }}" style="color: #4a5568; text-decoration: none; font-weight: bold;">
                &larr; Volver al listado de productos
            </a>
        </div>

    </div>
@endsection