<?php

namespace App\Controladores;

use App\Modelos\Productos;
use PDO;

class ProductoController
{
    private $producto;

    public function __construct()
    {
        $this->producto = new Productos();
    }

    public function listar()
    {
        return $this->producto->listar();
    }

    public function guardar(array $datos): bool
    {
        return $this->producto->crear($datos);
    }
    //aqui
    public function leer(int $id): ?array
    {
        return $this->producto->leer($id);
    }   
    public function actualizar(int $id, array $datos): bool
    {
        return $this->producto->actualizar($id, $datos);
    }

    public function eliminar(int $id): bool
    {
        return $this->producto->eliminar($id);
    }

}
