
-- Sitio Web Creado por ITred Spa.
-- Direccion: Guido Reni #4190
-- Pedro Agui Cerda - Santiago - Chile
-- contacto@itred.cl o itred.spa@gmail.com
-- https://www.itred.cl
-- Creado, Programado y Diseñado por ITred Spa.
-- BPPJ



-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------ INICIO ITred Spa Base de Datos itredspa_bd .SQL ----------------------------------
-- ------------------------------------------------------------------------------------------------------------ --



-- ------------------------------------------------------------------------------------------------------------
-- Configuraciones iniciales
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; -- Configura el modo SQL
START TRANSACTION; -- Inicia una transacción
SET time_zone = "+00:00"; -- Configura la zona horaria

-- Creación de la base de datos con codificación y collation adecuados
CREATE DATABASE IF NOT EXISTS `ITredSpa_bd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci; -- Crea la base de datos si no existe
USE `ITredSpa_bd`; -- Selecciona la base de datos para usar

-- Tabla Clientes
DROP TABLE IF EXISTS `Clientes`; -- Elimina la tabla si ya existe
CREATE TABLE `Clientes` (
    `id_cliente` int NOT NULL AUTO_INCREMENT, -- Identificador único del cliente
    `nombre_cliente` varchar(255) NOT NULL, -- Nombre del cliente
    `empresa` varchar(255), -- Empresa del cliente
    `rut` varchar(20) UNIQUE NOT NULL, -- RUT del cliente, debe ser único
    `direccion` varchar(255), -- Dirección del cliente
    `telefono` varchar(20), -- Teléfono del cliente
    `email` varchar(100), -- Email del cliente
    PRIMARY KEY (`id_cliente`) -- Clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci; -- Motor y codificación

-- Tabla Proyectos
DROP TABLE IF EXISTS `Proyectos`; -- Elimina la tabla si ya existe
CREATE TABLE `Proyectos` (
    `id_proyecto` int NOT NULL AUTO_INCREMENT, -- Identificador único del proyecto
    `codigo_proyecto` varchar(50) NOT NULL, -- Código del proyecto
    `tipo_trabajo` varchar(255) NOT NULL, -- Tipo de trabajo
    `area_trabajo` varchar(255) NOT NULL, -- Área de trabajo
    `riesgo_trabajo` varchar(255), -- Riesgo asociado
    PRIMARY KEY (`id_proyecto`) -- Clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci; -- Motor y codificación

-- Tabla Empresa
DROP TABLE IF EXISTS `Empresa`; -- Elimina la tabla si ya existe
CREATE TABLE `Empresa` (
    `id_empresa` int NOT NULL AUTO_INCREMENT, -- Identificador único de la empresa
    `nombre_empresa` varchar(255) NOT NULL, -- Nombre de la empresa
    `direccion` varchar(255), -- Dirección de la empresa
    `telefono` varchar(20), -- Teléfono de la empresa
    `email` varchar(100), -- Email de la empresa
    `whatsapp` varchar(20), -- WhatsApp de la empresa
    PRIMARY KEY (`id_empresa`) -- Clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci; -- Motor y codificación

-- Tabla Cotizaciones
DROP TABLE IF EXISTS `Cotizaciones`; -- Elimina la tabla si ya existe
CREATE TABLE `Cotizaciones` (
    `id_cotizacion` int NOT NULL AUTO_INCREMENT, -- Identificador único de la cotización
    `numero_cotizacion` varchar(50) UNIQUE NOT NULL, -- Número de la cotización, debe ser único
    `fecha_emision` date NOT NULL, -- Fecha de emisión
    `fecha_validez` date NOT NULL, -- Fecha de validez
    `dias_compra` varchar(50), -- Días de compra
    `dias_trabajo` varchar(50), -- Días de trabajo
    `trabajadores` int, -- Número de trabajadores
    `horario` varchar(50), -- Horario de trabajo
    `colacion` varchar(50), -- Colación
    `entrega` varchar(50), -- Entrega
    `id_cliente` int NOT NULL, -- Identificador del cliente
    `id_proyecto` int NOT NULL, -- Identificador del proyecto
    `id_empresa` int NOT NULL, -- Identificador de la empresa
    `total_neto` int, -- Total neto en pesos chilenos
    `iva` int, -- IVA en pesos chilenos
    `total_con_iva` int, -- Total con IVA en pesos chilenos
    `descuento` int, -- Descuento en pesos chilenos
    `total_final` int, -- Total final en pesos chilenos
    FOREIGN KEY (`id_cliente`) REFERENCES `Clientes`(`id_cliente`) ON DELETE CASCADE, -- Clave foránea para cliente
    FOREIGN KEY (`id_proyecto`) REFERENCES `Proyectos`(`id_proyecto`) ON DELETE CASCADE, -- Clave foránea para proyecto
    FOREIGN KEY (`id_empresa`) REFERENCES `Empresa`(`id_empresa`) ON DELETE CASCADE, -- Clave foránea para empresa
    PRIMARY KEY (`id_cotizacion`) -- Clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci; -- Motor y codificación

-- Tabla Items_Cotizacion
DROP TABLE IF EXISTS `Items_Cotizacion`; -- Elimina la tabla si ya existe
CREATE TABLE `Items_Cotizacion` (
    `id_item` int NOT NULL AUTO_INCREMENT, -- Identificador único del ítem
    `id_cotizacion` int NOT NULL, -- Identificador de la cotización asociada
    `descripcion` text NOT NULL, -- Descripción del ítem
    `cantidad` int NOT NULL, -- Cantidad
    `precio_unitario` int NOT NULL, -- Precio unitario en pesos chilenos
    `total` int AS (cantidad * precio_unitario) STORED, -- Total calculado en pesos chilenos
    PRIMARY KEY (`id_item`), -- Clave primaria
    FOREIGN KEY (`id_cotizacion`) REFERENCES `Cotizaciones`(`id_cotizacion`) ON DELETE CASCADE -- Clave foránea para cotización
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci; -- Motor y codificación

-- Tabla Tipo Proyecto
DROP TABLE IF EXISTS `tipo_proyecto`; -- Elimina la tabla si ya existe
CREATE TABLE `tipo_proyecto` (
    `id_tipo` int NOT NULL AUTO_INCREMENT, -- Identificador único del tipo de proyecto
    `codigo_tipo` varchar(50) NOT NULL, -- Código del tipo de proyecto
    `nombre_tipo` varchar(50) NOT NULL, -- Nombre del tipo de proyecto
    PRIMARY KEY (`id_tipo`) -- Clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci; -- Motor y codificación

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

COMMIT; -- Confirma los cambios realizados en la transacción

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
