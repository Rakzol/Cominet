DROP DATABASE cominet;

CREATE DATABASE cominet;

USE cominet;

CREATE TABLE restaurantes(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(256) NOT NULL,
    direccion VARCHAR(256) NOT NULL,
    telefono VARCHAR(16) NOT NULL,
    descripcion VARCHAR(1024) NOT NULL,
    correo VARCHAR(256) NOT NULL,
    contrasena VARCHAR(256) NOT NULL,
    apertura_lunes TIME NOT NULL,
    cierre_lunes TIME NOT NULL,
    apertura_martes TIME NOT NULL,
    cierre_martes TIME NOT NULL,
    apertura_miercoles TIME NOT NULL,
    cierre_miercoles TIME NOT NULL,
    apertura_jueves TIME NOT NULL,
    cierre_jueves TIME NOT NULL,
    apertura_viernes TIME NOT NULL,
    cierre_viernes TIME NOT NULL,
    apertura_sabado TIME NOT NULL,
    cierre_sabado TIME NOT NULL,
    apertura_domingo TIME NOT NULL,
    cierre_domingo TIME NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE platillos(
    id INT NOT NULL AUTO_INCREMENT,
    id_restaurante INT,
    nombre VARCHAR(256) NOT NULL,
    categoria VARCHAR(256) NOT NULL,
    descripcion VARCHAR(1024) NOT NULL,
    precio FLOAT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(id_restaurante) REFERENCES restaurantes(id)
);