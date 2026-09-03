CREATE DATABASE IF NOT EXISTS patrimonio_db;
USE patrimonio_db;

CREATE TABLE IF NOT EXISTS piezas_arqueologicas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    sitio VARCHAR(150) NOT NULL,
    coordenadas VARCHAR(100) NOT NULL,
    fecha_hallazgo DATE NOT NULL,
    descripcion TEXT,
    estado_conservacion ENUM('Excelente', 'Regular', 'Fragmentado') NOT NULL
);

INSERT INTO piezas_arqueologicas (nombre, sitio, coordenadas, fecha_hallazgo, descripcion, estado_conservacion) VALUES
('Vasija ceremonial', 'Sitio Arqueológico Toisán', '0.3512, -78.6543', '2026-05-12', 'Vasija de barro con grabados precolombinos.', 'Regular'),
('Hacha de obsidiana', 'Valle Intag', '0.3421, -78.6891', '2026-06-01', 'Herramienta cortante de origen volcánico.', 'Excelente');