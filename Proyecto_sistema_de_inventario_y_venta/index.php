<?php

require __DIR__ . '/vendor/autoload.php';

use App\Controladores\ProductoController;

$controller = new ProductoController();

// ===== OBTENER ACCIÓN =====
$action = $_GET['action'] ?? 'listar';
$id = $_GET['id'] ?? null;
$mensaje = $_GET['mensaje'] ?? null;
$error = $_GET['error'] ?? null;

// ===== PROCESAR ACCIONES POST =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'crear' || ($action === 'editar' && $id)) {
        $datos = [
            'nombre' => $_POST['nombre'] ?? '',
            'descripcion' => $_POST['descripcion'] ?? '',
            'marca' => $_POST['marca'] ?? '',
            'medida' => $_POST['medida'] ?? '',
            'precio' => $_POST['precio'] ?? 0,
            'stock' => $_POST['stock'] ?? 0
        ];

        $guardado = $action === 'crear'
            ? $controller->guardar($datos)
            : $controller->actualizar((int) $id, $datos);

        if ($guardado) {
            $mensaje = $action === 'crear'
                ? 'Producto creado exitosamente'
                : 'Producto actualizado exitosamente';
            header('Location: index.php?mensaje=' . urlencode($mensaje));
        } else {
            $error = $action === 'crear'
                ? 'Error al crear el producto'
                : 'Error al actualizar el producto';
            $url = 'index.php?action=' . $action;
            if ($action === 'editar') {
                $url .= '&id=' . (int) $id;
            }
            header('Location: ' . $url . '&error=' . urlencode($error));
        }
        exit;
    }
 }

// ===== ELIMINAR =====
if ($action === 'eliminar' && $id) {
    if ($controller->eliminar((int) $id)) {
        header('Location: index.php?mensaje=Producto eliminado exitosamente');
    } else {
        header('Location: index.php?error=' . urlencode('Error al eliminar el producto'));
    }
    exit;
}

// ===== OBTENER DATOS PARA LISTAR =====
// ✅ ESTO DEBE ESTAR FUERA DEL IF POST
$productos = $controller->listar();

//===== OBTENER DATOS PARA EDITAR =====
$producto = null;
if ($action === 'editar' && $id) {
    $producto = $controller->leer((int) $id);
    if (!$producto) {
        header('Location: index.php?error=Producto no encontrado');
        exit;
    }
}







?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario y Venta</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <h1>Registrar Productos</h1>

    <!-- ===== MENSAJES ===== -->
    <?php if ($mensaje): ?>
        <div class="mensaje-exito">✅ <?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="mensaje-error">❌ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- ===== FORMULARIO DE CREACIÓN ===== -->
    <?php if ($action === 'crear' || ($action === 'editar' && $producto)): ?>
        <div class="users-form">
            <form action="index.php?action=<?= $action ?><?= $action === 'editar' ? '&id=' . (int) $id : '' ?>" method="POST">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($producto['nombre'] ?? '') ?>" required>

                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" id="descripcion" value="<?= htmlspecialchars($producto['descripcion'] ?? '') ?>" required>

                <label for="marca">Marca:</label>
                <input type="text" name="marca" id="marca" value="<?= htmlspecialchars($producto['marca'] ?? '') ?>" required>

                <label for="medida">Unidad de Medida:</label>
                <input type="text" name="medida" id="medida" value="<?= htmlspecialchars($producto['medida'] ?? '') ?>" required>

                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" step="0.01" min="0" value="<?= htmlspecialchars($producto['precio'] ?? '') ?>" required>

                <label for="stock">Cantidad:</label>
                <input type="number" name="stock" id="stock" min="0" value="<?= htmlspecialchars($producto['stock'] ?? '') ?>" required>

                <button type="submit"><?= $action === 'editar' ? 'Actualizar Producto' : 'Registrar Producto' ?></button>
                <a href="index.php" class="btn-cancelar">Cancelar</a>
            </form>
        </div>


    <?php else: ?>
        <div class="users-table">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="margin: 0;">Productos Registrados</h2>
                <a href="index.php?action=crear" class="btn-agregar">➕ Agregar Nuevo Producto</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Marca</th>
                        <th>Unidad de Medida</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($productos)): ?>
                        <tr>
                            <td colspan="9" class="sin-productos">No hay productos registrados</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?= htmlspecialchars($producto['id']) ?></td>
                                <td><?= htmlspecialchars($producto['nombre']) ?></td>
                                <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                                <td><?= htmlspecialchars($producto['marca']) ?></td>
                                <td><?= htmlspecialchars($producto['medida']) ?></td>
                                <td>$<?= number_format($producto['precio'], 2) ?></td>
                                <td><?= htmlspecialchars($producto['stock']) ?></td>
                                <td>
                                    <a href="index.php?action=editar&id=<?= $producto['id'] ?>" class="users-table--edit">Editar</a>
                                </td>
                                <td>
                                    <a href="index.php?action=eliminar&id=<?= $producto['id'] ?>" class="users-table--delete" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</body>

</html>