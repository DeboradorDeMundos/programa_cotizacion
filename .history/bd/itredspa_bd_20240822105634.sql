-- Configuraciones iniciales
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Creación de la base de datos con codificación y collation adecuados
CREATE DATABASE IF NOT EXISTS `ITredSpa_bd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
USE `cotizaciones_db`;

-- Tabla Clientes
DROP TABLE IF EXISTS `Clientes`;
CREATE TABLE `Clientes` (
    `id_cliente` int NOT NULL AUTO_INCREMENT,
    `nombre_cliente` varchar(255) NOT NULL,
    `empresa` varchar(255),
    `rut` varchar(20) UNIQUE NOT NULL,
    `direccion` varchar(255),
    `telefono` varchar(20),
    `email` varchar(100),
    PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Tabla Proyectos
DROP TABLE IF EXISTS `Proyectos`;
CREATE TABLE `Proyectos` (
    `id_proyecto` int NOT NULL AUTO_INCREMENT,
    `codigo_proyecto` varchar(50) NOT NULL,
    `tipo_trabajo` varchar(255) NOT NULL,
    `area_trabajo` varchar(255) NOT NULL,
    `riesgo_trabajo` varchar(255),
    PRIMARY KEY (`id_proyecto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Tabla Empresa
DROP TABLE IF EXISTS `Empresa`;
CREATE TABLE `Empresa` (
    `id_empresa` int NOT NULL AUTO_INCREMENT,
    `nombre_empresa` varchar(255) NOT NULL,
    `direccion` varchar(255),
    `telefono` varchar(20),
    `email` varchar(100),
    `whatsapp` varchar(20),
    PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Tabla Cotizaciones
DROP TABLE IF EXISTS `Cotizaciones`;
CREATE TABLE `Cotizaciones` (
    `id_cotizacion` int NOT NULL AUTO_INCREMENT,
    `numero_cotizacion` varchar(50) UNIQUE NOT NULL,
    `fecha_emision` date NOT NULL,
    `fecha_validez` date NOT NULL,
    `dias_compra` varchar(50),
    `dias_trabajo` varchar(50),
    `trabajadores` int,
    `horario` varchar(50),
    `colacion` varchar(50),
    `entrega` varchar(50),
    `id_cliente` int NOT NULL,
    `id_proyecto` int NOT NULL,
    `id_empresa` int NOT NULL,
    `total_neto` decimal(10,2),
    `iva` decimal(10,2),
    `total_con_iva` decimal(10,2),
    `descuento` decimal(10,2),
    `total_final` decimal(10,2),
    FOREIGN KEY (`id_cliente`) REFERENCES `Clientes`(`id_cliente`) ON DELETE CASCADE,
    FOREIGN KEY (`id_proyecto`) REFERENCES `Proyectos`(`id_proyecto`) ON DELETE CASCADE,
    FOREIGN KEY (`id_empresa`) REFERENCES `Empresa`(`id_empresa`) ON DELETE CASCADE,
    PRIMARY KEY (`id_cotizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Tabla Items_Cotizacion
DROP TABLE IF EXISTS `Items_Cotizacion`;
CREATE TABLE `Items_Cotizacion` (
    `id_item` int NOT NULL AUTO_INCREMENT,
    `id_cotizacion` int NOT NULL,
    `descripcion` text NOT NULL,
    `cantidad` int NOT NULL,
    `precio_unitario` decimal(10,2) NOT NULL,
    `total` decimal(10,2) AS (cantidad * precio_unitario) STORED,
    PRIMARY KEY (`id_item`),
    FOREIGN KEY (`id_cotizacion`) REFERENCES `Cotizaciones`(`id_cotizacion`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Tabla Tipo Proyecto
DROP TABLE IF EXISTS `tipo_proyecto`;
CREATE TABLE `tipo_proyecto` (
    `id_tipo` int NOT NULL AUTO_INCREMENT,
    `codigo_tipo` varchar(50) NOT NULL,
    `nombre_tipo` varchar(50) NOT NULL,
    PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Insertar valores en tipo_proyecto
INSERT INTO `tipo_proyecto` (`id_tipo`, `codigo_tipo`, `nombre_tipo`) VALUES
(1, 'AP_', 'APP'),
(2, 'SW_', 'Sitio Web'),
(3, 'CC_', 'Carrito de compra'),
(4, 'BL_', 'Blog'),
(5, 'LP_', 'Landing Page'),
(6, 'PW_', 'Portal web'),
(7, 'PS_', 'Presentaciones'),
(8, 'FL_', 'Flyers'),
(9, 'PRD_', 'Publicidad Redes Sociales');

COMMIT;
