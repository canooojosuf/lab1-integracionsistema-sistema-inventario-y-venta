<?php

namespace App\Modelos;

use App\Conexion\Conexion;
use App\Interfaces\CRUDinterfaz;





class Productos implements CRUDInterfaz
{
    private  $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::conectar();
    }

    // ===== LISTAR TODOS =====
    public function listar(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM productos ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    // ===== CREAR =====
    public function crear(array $datos): bool
    {
        $sql = "INSERT INTO productos (nombre, descripcion, marca, medida, precio, stock) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $datos['nombre'],
            $datos['descripcion'],
            $datos['marca'],
            $datos['medida'],
            $datos['precio'],
            $datos['stock']
        ]);
        //aqui
    }
    public function leer(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }   
    public function actualizar(int $id, array $datos): bool
    {
        $sql = "UPDATE productos SET nombre = ?, descripcion = ?, marca = ?, medida = ?, precio = ?, stock = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $datos['nombre'],
            $datos['descripcion'],
            $datos['marca'],
            $datos['medida'],
            $datos['precio'],
            $datos['stock'],
            $id
        ]);
    }
        public function eliminar(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM productos WHERE id = ?");
        return $stmt->execute([$id]);
    }   
}
