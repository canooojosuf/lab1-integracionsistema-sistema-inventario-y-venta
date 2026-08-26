<?php

namespace App\interfaces;


interface CRUDinterfaz
{
    public function listar(): array;

    public function crear(array $data): bool;

    //public function leer(int $id): ?array;

    //public function actualizar(int $id, array $data): bool;

    //public function eliminar(int $id): bool;
}
