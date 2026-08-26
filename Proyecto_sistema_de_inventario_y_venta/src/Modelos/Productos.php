<?php

namespace App\Modelos;

use App\Conexion\Conexion;
use App\Interfaces\CRUDinterfaz;





class Productos implements CRUDInterfaz
{
    private $pdo;

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
    }
}
