-- Creado por [Tu Nombre o Empresa]
-- Direccion: [Tu Dirección]
-- Contacto: [Tu Correo Electrónico]
-- Creado, Programado y Diseñado por [Tu Nombre o Empresa]
-- [Fecha de Creación]

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- INICIO SCRIPT DE BASE DE DATOS ---------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Configuraciones iniciales
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Selección de la base de datos para usar
USE `itredspa`;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA EMPRESA --------------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Empresa si existe
DROP TABLE IF EXISTS `Empresa`;

-- Crear la tabla Empresa
CREATE TABLE `Empresa` (
    `id_empresa` int NOT NULL AUTO_INCREMENT, -- Identificador único de la empresa
    `rut_empresa` varchar(20) UNIQUE NOT NULL, -- RUT de la empresa
    `nombre_empresa` varchar(255) NOT NULL, -- Nombre de la empresa
    `area_empresa` varchar(255), -- Área de la empresa
    `direccion_empresa` varchar(255), -- Dirección de la empresa
    `telefono_empresa` varchar(20), -- Teléfono de la empresa
    `email_empresa` varchar(100), -- Email de la empresa
    PRIMARY KEY (`id_empresa`) -- Definición de la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA CLIENTES -------------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Clientes si existe
DROP TABLE IF EXISTS `Clientes`;

-- Crear la tabla Clientes
CREATE TABLE `Clientes` (
    `id_cliente` int NOT NULL AUTO_INCREMENT, -- Identificador único del cliente
    `nombre_cliente` varchar(255) NOT NULL, -- Nombre del cliente
    `empresa_cliente` varchar(255), -- Empresa del cliente
    `rut_cliente` varchar(20) UNIQUE NOT NULL, -- RUT del cliente (debe ser único)
    `direccion_cliente` varchar(255), -- Dirección del cliente
    `lugar_cliente` varchar(255), -- Lugar del cliente
    `telefono_cliente` varchar(20), -- Teléfono del cliente
    `email_cliente` varchar(100), -- Email del cliente
    `cargo_cliente` varchar(255), -- Cargo del cliente
    `giro_cliente` varchar(255), -- Giro del cliente
    `comuna_cliente` varchar(255), -- Comuna del cliente
    `ciudad_cliente` varchar(255), -- Ciudad del cliente
    `tipo_cliente` varchar(255), -- Tipo del cliente
    PRIMARY KEY (`id_cliente`) -- Definición de la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA PROYECTOS ------------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Proyectos si existe
DROP TABLE IF EXISTS `Proyectos`;

-- Crear la tabla Proyectos
CREATE TABLE `Proyectos` (
    `id_proyecto` int NOT NULL AUTO_INCREMENT, -- Identificador único del proyecto
    `nombre_proyecto` varchar(255), -- Nombre del proyecto
    `codigo_proyecto` varchar(50) NOT NULL, -- Código del proyecto
    `tipo_trabajo` varchar(255) NOT NULL, -- Tipo de trabajo del proyecto
    `area_trabajo` varchar(255) NOT NULL, -- Área de trabajo del proyecto
    `riesgo_proyecto` varchar(255), -- Riesgo asociado al proyecto
    PRIMARY KEY (`id_proyecto`) -- Definición de la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA COTIZACIONES ---------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Cotizaciones si existe
DROP TABLE IF EXISTS `Cotizaciones`;

-- Crear la tabla Cotizaciones
CREATE TABLE `Cotizaciones` (
    `id_cotizacion` int NOT NULL AUTO_INCREMENT, -- Identificador único de la cotización
    `numero_cotizacion` varchar(50) UNIQUE NOT NULL, -- Número de cotización (debe ser único)
    `fecha_emision` date NOT NULL, -- Fecha de emisión de la cotización
    `fecha_validez` date NOT NULL, -- Fecha de validez de la cotización
    `dias_compra` varchar(50), -- Días de compra relacionados con la cotización
    `dias_trabajo` varchar(50), -- Días de trabajo relacionados con la cotización
    `trabajadores` int, -- Número de trabajadores asignados
    `horario` varchar(50), -- Horario de trabajo
    `colacion` varchar(50), -- Colación incluida
    `entrega` varchar(50), -- Entrega especificada
    `id_cliente` int NOT NULL, -- ID del cliente (clave foránea)
    `id_proyecto` int NOT NULL, -- ID del proyecto (clave foránea)
    `id_empresa` int NOT NULL, -- ID de la empresa (clave foránea)
    PRIMARY KEY (`id_cotizacion`), -- Definición de la clave primaria
    FOREIGN KEY (`id_cliente`) REFERENCES `Clientes`(`id_cliente`) ON DELETE CASCADE, -- Clave foránea hacia Clientes
    FOREIGN KEY (`id_proyecto`) REFERENCES `Proyectos`(`id_proyecto`) ON DELETE CASCADE, -- Clave foránea hacia Proyectos
    FOREIGN KEY (`id_empresa`) REFERENCES `Empresa`(`id_empresa`) ON DELETE CASCADE -- Clave foránea hacia Empresa
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA ENCARGADOS -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Encargados si existe
DROP TABLE IF EXISTS `Encargados`;

-- Crear la tabla Encargados
CREATE TABLE `Encargados` (
    `id_encargado` int NOT NULL AUTO_INCREMENT, -- Identificador único del encargado
    `nombre_encargado` varchar(255) NOT NULL, -- Nombre del encargado
    `email_encargado` varchar(100), -- Email del encargado
    `fono_encargado` varchar(20), -- Teléfono del encargado
    `celular_encargado` varchar(20), -- Celular del encargado
    `proyecto_encargado` varchar(255), -- Proyecto asociado al encargado
    PRIMARY KEY (`id_encargado`) -- Definición de la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA VENDEDORES -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Vendedores si existe
DROP TABLE IF EXISTS `Vendedores`;

-- Crear la tabla Vendedores
CREATE TABLE `Vendedores` (
    `id_vendedor` int NOT NULL AUTO_INCREMENT, -- Identificador único del vendedor
    `nombre_vendedor` varchar(255) NOT NULL, -- Nombre del vendedor
    `email_vendedor` varchar(100), -- Email del vendedor
    `fono_vendedor` varchar(20), -- Teléfono del vendedor
    `celular_vendedor` varchar(20), -- Celular del vendedor
    PRIMARY KEY (`id_vendedor`) -- Definición de la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Confirmar cambios
COMMIT;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- FIN SCRIPT DE BASE DE DATOS ------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Creado por [Tu Nombre o Empresa]
-- Contacto: [Tu Correo Electrónico]
-- Creado, Programado y Diseñado por [Tu Nombre o Empresa]
