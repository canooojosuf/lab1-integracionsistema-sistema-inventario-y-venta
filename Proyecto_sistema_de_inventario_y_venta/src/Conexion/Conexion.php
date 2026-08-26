<?php

namespace App\Conexion;

use PDO;
use PDOException;

class Conexion
{

    public static function conectar(): PDO
    {

        $dsn = "mysql:host=127.0.0.1;dbname=inventario;charset=utf8mb4";

        try {
            return new PDO($dsn, "root", "", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
