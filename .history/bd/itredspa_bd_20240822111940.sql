
-- Sitio Web Creado por ITred Spa.
-- Direccion: Guido Reni #4190
-- Pedro Agui Cerda - Santiago - Chile
-- contacto@itred.cl o itred.spa@gmail.com
-- https://www.itred.cl
-- Creado, Programado y Diseñado por ITred Spa.
-- BPPJ
-->


-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- INICIO SCRIPT DE BASE DE DATOS --------------------------------------
-- -------------------------------------------------------------------------------------------------------------->

-- Configuraciones iniciales
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Selección de la base de datos para usar
USE `ITredSpa_bd`;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA CLIENTES ----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------

-- Eliminar la tabla Clientes si existe
DROP TABLE IF EXISTS `Clientes`;

-- Crear la tabla Clientes
CREATE TABLE `Clientes` (
    `id_cliente` int NOT NULL AUTO_INCREMENT, -- Identificador único del cliente
    `nombre_cliente` varchar(255) NOT NULL, -- Nombre del cliente
    `empresa` varchar(255), -- Empresa del cliente
    `rut` varchar(20) UNIQUE NOT NULL, -- RUT del cliente (debe ser único)
    `direccion` varchar(255), -- Dirección del cliente
    `telefono` varchar(20), -- Teléfono del cliente
    `email` varchar(100), -- Email del cliente
    PRIMARY KEY (`id_cliente`) -- Definición de la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA PROYECTOS ---------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------

-- Eliminar la tabla Proyectos si existe
DROP TABLE IF EXISTS `Proyectos`;

-- Crear la tabla Proyectos
CREATE TABLE `Proyectos` (
    `id_proyecto` int NOT NULL AUTO_INCREMENT, -- Identificador único del proyecto
    `codigo_proyecto` varchar(50) NOT NULL, -- Código del proyecto
    `tipo_trabajo` varchar(255) NOT NULL, -- Tipo de trabajo del proyecto
    `area_trabajo` varchar(255) NOT NULL, -- Área de trabajo del proyecto
    `riesgo_trabajo` varchar(255), -- Riesgo asociado al proyecto
    PRIMARY KEY (`id_proyecto`) -- Definición de la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA EMPRESA -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------

-- Eliminar la tabla Empresa si existe
DROP TABLE IF EXISTS `Empresa`;

-- Crear la tabla Empresa
CREATE TABLE `Empresa` (
    `id_empresa` int NOT NULL AUTO_INCREMENT, -- Identificador único de la empresa
    `nombre_empresa` varchar(255) NOT NULL, -- Nombre de la empresa
    `direccion` varchar(255), -- Dirección de la empresa
    `telefono` varchar(20), -- Teléfono de la empresa
    `email` varchar(100), -- Email de la empresa
    `whatsapp` varchar(20), -- WhatsApp de la empresa
    PRIMARY KEY (`id_empresa`) -- Definición de la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA COTIZACIONES -------------------------------------------------
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
    `total_neto` int, -- Total neto de la cotización (en pesos chilenos)
    `iva` int, -- IVA de la cotización (en pesos chilenos)
    `total_con_iva` int, -- Total con IVA (en pesos chilenos)
    `descuento` int, -- Descuento aplicado (en pesos chilenos)
    `total_final` int, -- Total final después de descuentos (en pesos chilenos)
    PRIMARY KEY (`id_cotizacion`), -- Definición de la clave primaria
    FOREIGN KEY (`id_cliente`) REFERENCES `Clientes`(`id_cliente`) ON DELETE CASCADE, -- Clave foránea hacia Clientes
    FOREIGN KEY (`id_proyecto`) REFERENCES `Proyectos`(`id_proyecto`) ON DELETE CASCADE, -- Clave foránea hacia Proyectos
    FOREIGN KEY (`id_empresa`) REFERENCES `Empresa`(`id_empresa`) ON DELETE CASCADE -- Clave foránea hacia Empresa
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA ITEMS_COTIZACION ---------------------------------------------
-- ------------------------------------------------------------------------------------------------------------

-- Eliminar la tabla Items_Cotizacion si existe
DROP TABLE IF EXISTS `Items_Cotizacion`;

-- Crear la tabla Items_Cotizacion
CREATE TABLE `Items_Cotizacion` (
    `id_item` int NOT NULL AUTO_INCREMENT, -- Identificador único del ítem
    `id_cotizacion` int NOT NULL, -- ID de la cotización (clave foránea)
    `descripcion` text NOT NULL, -- Descripción del ítem
    `cantidad` int NOT NULL, -- Cantidad del ítem
    `precio_unitario` int NOT NULL, -- Precio unitario del ítem (en pesos chilenos)
    `total` int AS (cantidad * precio_unitario) STORED, -- Total calculado del ítem (en pesos chilenos)
    PRIMARY KEY (`id_item`), -- Definición de la clave primaria
    FOREIGN KEY (`id_cotizacion`) REFERENCES `Cotizaciones`(`id_cotizacion`) ON DELETE CASCADE -- Clave foránea hacia Cotizaciones
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA TIPO PROYECTO ------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------

-- Eliminar la tabla tipo_proyecto si existe
DROP TABLE IF EXISTS `tipo_proyecto`;

-- Crear la tabla tipo_proyecto
CREATE TABLE `tipo_proyecto` (
    `id_tipo` int NOT NULL AUTO_INCREMENT, -- Identificador único del tipo de proyecto
    `codigo_tipo` varchar(50) NOT NULL, -- Código del tipo de proyecto
    `nombre_tipo` varchar(50) NOT NULL, -- Nombre del tipo de proyecto
    PRIMARY KEY (`id_tipo`) -- Definición de la clave primaria
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

-- Confirmar cambios
COMMIT;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- FIN SCRIPT DE BASE DE DATOS ----------------------------------------
-- ------------------------------------------------------------------------------------------------------------

-- ------------------------------------------------------------------------------------------------------------
-- -------------------------------- FIN ITred Spa Base de Datos itredspa_bd .SQL ------------------------------
-- ------------------------------------------------------------------------------------------------------------ --


-- Sitio Web Creado por ITred Spa.
-- Direccion: Guido Reni #4190
-- Pedro Agui Cerda - Santiago - Chile
-- contacto@itred.cl o itred.spa@gmail.com
-- https://www.itred.cl
-- Creado, Programado y Diseñado por ITred Spa.
-- BPPJ
