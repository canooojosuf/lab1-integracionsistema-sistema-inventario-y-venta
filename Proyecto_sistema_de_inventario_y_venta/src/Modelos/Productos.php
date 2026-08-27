<?php

namespace App\Modelos;

use App\Conexion\Conexion;
use App\Interfaces\CRUDinterfaz;





class Productos extends ProductoBase implements CRUDinterfaz
{


    // ===== LISTAR TODOS =====
    public function listar(): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM productos ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ===== LEER POR ID =====
    public function leer(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM productos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    // ===== CREAR =====
    public function crear(array $datos): bool
    {
        $sql = "INSERT INTO productos (nombre, descripcion, marca, medida, precio, stock) 
                VALUES (:nombre, :descripcion, :marca, :medida, :precio, :stock)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':descripcion' => $datos['descripcion'],
            ':marca' => $datos['marca'],
            ':medida' => $datos['medida'],
            ':precio' => $datos['precio'],
            ':stock' => $datos['stock']
        ]);
    }

    // ===== ACTUALIZAR =====
    public function actualizar(int $id, array $datos): bool
    {
        $sql = "UPDATE productos SET nombre = :nombre, 
                descripcion = :descripcion, 
                marca = :marca, 
                medida = :medida, 
                precio = :precio, 
                stock = :stock 
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':descripcion' => $datos['descripcion'],
            ':marca' => $datos['marca'],
            ':medida' => $datos['medida'],
            ':precio' => $datos['precio'],
            ':stock' => $datos['stock'],
            ':id' => $id
        ]);
    }

    // ===== ELIMINAR =====
    public function eliminar(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM productos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
