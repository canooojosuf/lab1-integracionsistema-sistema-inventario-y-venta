# Sistema de inventario y venta

## Resumen del proyecto

Este proyecto es un sistema web local para gestionar el inventario y la venta de productos. Permite registrar productos con su nombre, descripción, marca, unidad de medida, precio y cantidad disponible. También permite consultar, editar y eliminar los productos registrados.

## Integrantes

- Lara Alvarenga, Rafael Ernesto — LA-73492-26
- Benitez Jacinto, Rosa Evelyn — BJ-57615-19
- Cerón Ramos, José Ulises — CR-67257-24

## Requisitos

- PHP 8.0 o una versión superior.
- Composer.
- MySQL o MariaDB.
- Un navegador web.

## Instalación

1. Clona o descarga este repositorio en tu equipo.

2. Abre PowerShell o una terminal dentro de la carpeta del repositorio:

```powershell
cd ruta\al\lab1-integracionsistema-sistema-inventario-y-venta
```

3. Entra a la carpeta del proyecto PHP:

```powershell
cd Proyecto_sistema_de_inventario_y_venta
```

4. Instala las dependencias definidas en `composer.json`:

```powershell
composer install
```

Este comando instala las dependencias y genera el cargador automático de clases en la carpeta `vendor`.

## Configuración de la base de datos

La aplicación se conecta a MySQL con los siguientes datos, definidos en `src/Conexion/Conexion.php`:

```text
Servidor: 127.0.0.1
Base de datos: inventario
Usuario: root
Contraseña: root
```

Crea la base de datos y la tabla `productos` ejecutando este script en MySQL:

```sql
CREATE DATABASE inventario;

USE inventario;

CREATE TABLE productos (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(100) NOT NULL,
	descripcion TEXT NOT NULL,
	marca VARCHAR(100) NOT NULL,
	medida VARCHAR(50) NOT NULL,
	precio DECIMAL(10, 2) NOT NULL,
	stock INT NOT NULL
);
```

Si tu usuario `root` tiene una contraseña diferente, actualiza la contraseña en `src/Conexion/Conexion.php` antes de ejecutar la aplicación.

## Ejecución local

Desde la carpeta `Proyecto_sistema_de_inventario_y_venta`, ejecuta:

```powershell
php -S localhost:8000 -t .
```

Mantén abierta la terminal mientras utilices el sistema. Después abre en el navegador:

```text
http://localhost:8000/index.php
```

Para registrar un producto directamente, utiliza:

```text
http://localhost:8000/index.php?action=crear
```

Desde la pantalla principal puedes crear, editar y eliminar productos.

Para detener el servidor, presiona `Ctrl + C` en la terminal.

## Solución de problemas

- Si aparece `composer no se reconoce`, instala Composer y reinicia la terminal.
- Si aparece `ERR_CONNECTION_REFUSED`, inicia el servidor con `php -S localhost:8000 -t .` y verifica que estés usando el puerto `8000`.
- Si aparece un error de conexión a MySQL, comprueba que MySQL esté iniciado y que los datos de conexión coincidan con `src/Conexion/Conexion.php`.