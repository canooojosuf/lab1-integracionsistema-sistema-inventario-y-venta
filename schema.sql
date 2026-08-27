CREATE DATABASE IF NOT EXISTS Inventario; 
USE Inventario; 
  
CREATE TABLE productos ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR(150) NOT NULL, 
    descripcion TEXT,
    marca VARCHAR(50), 
    medida VARCHAR(150) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
     
);