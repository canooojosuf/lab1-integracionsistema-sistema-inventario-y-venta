<?php

namespace App\Controladores;

use App\Modelos\Productos;


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
}
