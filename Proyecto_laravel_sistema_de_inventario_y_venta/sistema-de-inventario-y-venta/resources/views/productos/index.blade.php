@extends('layouts.app')

@section('titulo', 'Listado de productos')

@section('contenido')
    <div style="max-width: 1000px; margin: 0 auto;">
        
        <!-- Encabezado y Botón de Crear -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h1 style="color: #1a202c; margin: 0;">Productos de ferretería</h1>
            
            <a href="{{ route('productos.create') }}"
               style="background-color: #198754; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                + Registrar nuevo producto
            </a>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Cuadrícula de Productos -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            
            @forelse ($productos as $producto)
                <div style="background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; flex-direction: column; justify-content: space-between;">
                    
                    <div>
                        <h2 style="margin-top: 0; margin-bottom: 15px; font-size: 20px;">
                            <a href="{{ route('productos.show', $producto->id) }}" style="color: #0d6efd; text-decoration: none;">
                                {{ $producto->nombre }}
                            </a>
                        </h2>

                        <p style="color: #4a5568; margin: 5px 0;">
                            <strong>Marca:</strong> {{ $producto->marca ?? 'Sin marca' }}
                        </p>
                        <p style="color: #4a5568; margin: 5px 0;">
                            <strong>Precio:</strong> <span style="color: #198754; font-weight: bold;">${{ number_format((float) $producto->precio, 2) }}</span>
                        </p>
                        <p style="color: #4a5568; margin: 5px 0;">
                            <strong>Stock:</strong> {{ $producto->stock }}
                        </p>
                        <p style="color: #4a5568; margin: 5px 0 20px 0;">
                            <strong>Transacciones:</strong> {{ $producto->transacciones_count ?? 0 }}
                        </p>
                    </div>

                    <!-- Botones de Acción -->
                    <div style="display: flex; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 15px;">
                        <a href="{{ route('productos.edit', $producto->id) }}"
                           style="flex: 1; text-align: center; background-color: #0d6efd; color: white; padding: 8px 0; text-decoration: none; border-radius: 5px; font-size: 14px;">
                            Editar
                        </a>

                        <form action="{{ route('productos.destroy', $producto->id) }}"
                              method="POST"
                              style="flex: 1; margin: 0;"
                              onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="width: 100%; background-color: #dc3545; color: white; padding: 8px 0; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">
                                Eliminar
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: white; border-radius: 8px; border: 1px dashed #cbd5e0;">
                    <p style="color: #718096; font-size: 18px;">No hay productos registrados aún.</p>
                </div>
            @endforelse

        </div>
    </div>
@endsection