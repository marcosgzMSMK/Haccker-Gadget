-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS hacckergadget;

-- Seleccionar la base de datos
USE hacckergadget;

-- Crear la tabla de usuarios
CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    UNIQUE (nombre_usuario)
);

-- Crear la tabla de historial de compras
CREATE TABLE HistorialCompras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    producto1 INT DEFAULT 0,
    producto2 INT DEFAULT 0,
    producto3 INT DEFAULT 0,
    fecha_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id)
);

-- Crear la tabla de contactos
CREATE TABLE Contactos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
