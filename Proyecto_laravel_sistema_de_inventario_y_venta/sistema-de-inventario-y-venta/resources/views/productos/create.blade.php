@extends('layouts.app')

@section('titulo', 'Registrar producto')

@section('contenido')
    <div style="max-width: 700px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        
        <h1 style="margin-bottom: 25px; color: #1a202c;">Registrar nuevo producto</h1>

        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/productos" method="POST">
            @csrf

            <!-- Fila 1: Nombre y Marca -->
            <div style="display: flex; gap: 20px; margin-bottom: 15px;">
                <div style="flex: 2;">
                    <label for="nombre" style="font-weight: bold; display: block; margin-bottom: 5px; color: #4a5568;">Nombre del producto:</label>
                    <input id="nombre" name="nombre" type="text" maxlength="150" value="{{ old('nombre') }}" required
                           style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 5px; box-sizing: border-box;">
                </div>
                <div style="flex: 1;">
                    <label for="marca" style="font-weight: bold; display: block; margin-bottom: 5px; color: #4a5568;">Marca:</label>
                    <input id="marca" name="marca" type="text" maxlength="50" value="{{ old('marca') }}"
                           style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 5px; box-sizing: border-box;">
                </div>
            </div>

            <!-- Fila 2: Descripción -->
            <div style="margin-bottom: 15px;">
                <label for="descripcion" style="font-weight: bold; display: block; margin-bottom: 5px; color: #4a5568;">Descripción:</label>
                <textarea id="descripcion" name="descripcion" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 5px; box-sizing: border-box; min-height: 80px;">{{ old('descripcion') }}</textarea>
            </div>

            <!-- Fila 3: Medida -->
            <div style="margin-bottom: 15px;">
                <label for="medida" style="font-weight: bold; display: block; margin-bottom: 5px; color: #4a5568;">Medida:</label>
                <input id="medida" name="medida" type="text" maxlength="150" placeholder="Ej: Unidad, metro, libra..." value="{{ old('medida') }}" required
                       style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 5px; box-sizing: border-box;">
            </div>

            <!-- Fila 4: Precio y Stock -->
            <div style="display: flex; gap: 20px; margin-bottom: 25px;">
                <div style="flex: 1;">
                    <label for="precio" style="font-weight: bold; display: block; margin-bottom: 5px; color: #4a5568;">Precio unitario ($):</label>
                    <input id="precio" name="precio" type="number" min="0" max="99999999.99" step="0.01" value="{{ old('precio') }}" required
                           style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 5px; box-sizing: border-box;">
                </div>
                <div style="flex: 1;">
                    <label for="stock" style="font-weight: bold; display: block; margin-bottom: 5px; color: #4a5568;">Existencias iniciales:</label>
                    <input id="stock" name="stock" type="number" min="0" step="1" value="{{ old('stock', 0) }}" required
                           style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 5px; box-sizing: border-box;">
                </div>
            </div>

            <!-- Botones -->
            <div style="display: flex; gap: 15px;">
                <button type="submit" style="background-color: #198754; color: white; padding: 12px 25px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
                    Guardar producto
                </button>
                <a href="{{ route('productos.index') }}" style="background-color: #e2e8f0; color: #4a5568; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-weight: bold; text-align: center;">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection