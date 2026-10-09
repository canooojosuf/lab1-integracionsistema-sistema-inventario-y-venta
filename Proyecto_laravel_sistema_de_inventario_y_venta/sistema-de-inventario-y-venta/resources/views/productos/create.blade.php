<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar producto</title>
</head>
<body>
    <h1>Inventario de ferretería</h1>
    <h2>Registrar producto</h2>

    <p>
        <a href="{{ route('productos.index') }}">Volver al inventario</a>
    </p>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('productos.store') }}" method="POST">
        @csrf

        <label for="nombre">Nombre:</label>
        <input id="nombre" name="nombre" type="text"
               maxlength="150" value="{{ old('nombre') }}" required>
        <br><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
        <br><br>

        <label for="marca">Marca:</label>
        <input id="marca" name="marca" type="text"
               maxlength="50" value="{{ old('marca') }}">
        <br><br>

        <label for="medida">Medida:</label>
        <input id="medida" name="medida" type="text"
               maxlength="150" placeholder="Unidad, metro, libra..."
               value="{{ old('medida') }}" required>
        <br><br>

        <label for="precio">Precio unitario ($):</label>
        <input id="precio" name="precio" type="number"
               min="0" max="99999999.99" step="0.01"
               value="{{ old('precio') }}" required>
        <br><br>

        <label for="stock">Existencias iniciales:</label>
        <input id="stock" name="stock" type="number"
               min="0" step="1" value="{{ old('stock', 0) }}" required>
        <br><br>

        <button type="submit">Guardar producto</button>
    </form>
</body>
</html>