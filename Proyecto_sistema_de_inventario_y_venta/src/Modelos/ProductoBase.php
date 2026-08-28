<?php

namespace App\Modelos;

use App\Conexion\Conexion;

class ProductoBase
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::conectar();
    }
}
