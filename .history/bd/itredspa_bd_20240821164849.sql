SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Crear base de datos
CREATE DATABASE IF NOT EXISTS `itredspa_bd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
USE `itredspa_bd`;

-- Tabla Clientes
DROP TABLE IF EXISTS `Clientes`;
CREATE TABLE `Clientes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `RUT` varchar(20) NOT NULL,
  `Empresa` varchar(100),
  `Direccion` varchar(150),
  `Telefono` varchar(15),
  `Email` varchar(100),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Tabla Proyectos
DROP TABLE IF EXISTS `Proyectos`;
CREATE TABLE `Proyectos` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(50) NOT NULL,
  `Descripcion` text,
  `AreaTrabajo` varchar(100),
  `Riesgo` varchar(50),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Tabla Vendedores
DROP TABLE IF EXISTS `Vendedores`;
CREATE TABLE `Vendedores` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Email` varchar(100),
  `Telefono` varchar(15),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Tabla Cotizaciones
DROP TABLE IF EXISTS `Cotizaciones`;
CREATE TABLE `Cotizaciones` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `Validez` int NOT NULL,  -- Días de validez de la cotización
  `ID_Cliente` int NOT NULL,
  `ID_Proyecto` int NOT NULL,
  `ID_Vendedor` int NOT NULL,
  `TotalGeneral` decimal(10) NOT NULL,
  `TipoCliente` varchar(50),
  `DiasCompra` int,
  `DiasTrabajo` int,
  `Trabajadores` int,
  `Horario` varchar(100),
  `Colacion` varchar(100),
  `Entrega` varchar(100),
  `Cargo` varchar(50),
  `Giro` varchar(100),
  `Comuna` varchar(100),
  `Ciudad` varchar(100),
  PRIMARY KEY (`ID`),
  FOREIGN KEY (`ID_Cliente`) REFERENCES `Clientes`(`ID`) ON DELETE CASCADE,
  FOREIGN KEY (`ID_Proyecto`) REFERENCES `Proyectos`(`ID`) ON DELETE CASCADE,
  FOREIGN KEY (`ID_Vendedor`) REFERENCES `Vendedores`(`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Tabla Detalle de Servicios y Precios
DROP TABLE IF EXISTS `DetalleServicios`;
CREATE TABLE `DetalleServicios` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_Cotizacion` int NOT NULL,
  `Cantidad` int NOT NULL DEFAULT 1,
  `Descripcion` text NOT NULL,
  `Precio_Unitario` decimal(10) NOT NULL,
  `Total` decimal(10) AS (Cantidad * Precio_Unitario) STORED,
  PRIMARY KEY (`ID`),
  FOREIGN KEY (`ID_Cotizacion`) REFERENCES `Cotizaciones`(`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Tabla Tipo Proyecto (ya existente, sin cambios)
DROP TABLE IF EXISTS `tipo_proyecto`;
CREATE TABLE `tipo_proyecto` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `codigo_tipo` varchar(50) NOT NULL,
  `nombre_tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Insertar valores en tipo_proyecto
INSERT INTO `tipo_proyecto` (`ID`, `codigo_tipo`, `nombre_tipo`) VALUES
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
