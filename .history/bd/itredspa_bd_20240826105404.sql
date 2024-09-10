--Sitio Web Creado por ITred Spa.
--Direccion: Guido Reni #4190
--Pedro Agui Cerda - Santiago - Chile
--contacto@itred.cl o itred.spa@gmail.com
--https://www.itred.cl
--Creado, Programado y Diseñado por ITred Spa.
--BPPJ

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- INICIO SCRIPT DE BASE DE DATOS ---------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

s-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- CONEXION BD --------------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Configuraciones iniciales
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Selección de la base de datos para usar
USE `itredspa_bd`;
-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- FIN CONEXION BD --------------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

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
    `id_vendedor` int, -- ID del vendedor (clave foránea)
    `id_encargado` int, -- ID del encargado (clave foránea)
    `total` decimal(10,2) DEFAULT 0.00, -- Total de la cotización
    `descuento` decimal(10,2) DEFAULT 0.00, -- Descuento aplicado a la cotización
    `iva` decimal(10,2) DEFAULT 0.00, -- IVA calculado (19%)
    `total_con_descuento` decimal(10,2) DEFAULT 0.00, -- Total después de aplicar el descuento
    PRIMARY KEY (`id_cotizacion`), -- Definición de la clave primaria
    FOREIGN KEY (`id_cliente`) REFERENCES `Clientes`(`id_cliente`) ON DELETE CASCADE, -- Clave foránea hacia Clientes
    FOREIGN KEY (`id_proyecto`) REFERENCES `Proyectos`(`id_proyecto`) ON DELETE CASCADE, -- Clave foránea hacia Proyectos
    FOREIGN KEY (`id_empresa`) REFERENCES `Empresa`(`id_empresa`) ON DELETE CASCADE, -- Clave foránea hacia Empresa
    FOREIGN KEY (`id_vendedor`) REFERENCES `Vendedores`(`id_vendedor`) ON DELETE SET NULL, -- Clave foránea hacia Vendedores
    FOREIGN KEY (`id_encargado`) REFERENCES `Encargados`(`id_encargado`) ON DELETE SET NULL -- Clave foránea hacia Encargados
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
ALTER TABLE cotizaciones
MODIFY descuento DECIMAL(10, 2) DEFAULT 0;

ALTER TABLE cotizaciones
MODIFY total_con_descuento DECIMAL(10, 2) DEFAULT 0;
-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA TITULOS ---------------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Titulos si existe
DROP TABLE IF EXISTS `Titulos`;

-- Crear la tabla Titulos
CREATE TABLE `Titulos` (
    `id_titulo` int NOT NULL AUTO_INCREMENT, -- Identificador único del título
    `nombre` varchar(255) NOT NULL, -- Nombre del título
    PRIMARY KEY (`id_titulo`) -- Definición de la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA DESCRIPCIONES ----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Descripciones si existe
DROP TABLE IF EXISTS `Descripciones`;

-- Crear la tabla Descripciones
CREATE TABLE `Descripciones` (
    `id_descripcion` int NOT NULL AUTO_INCREMENT, -- Identificador único de la descripción
    `id_titulo` int NOT NULL, -- ID del título (clave foránea)
    `descripcion` text NOT NULL, -- Descripción detallada del ítem o servicio
    `precio_unitario` decimal(10,2) NOT NULL, -- Precio unitario del ítem o servicio
    PRIMARY KEY (`id_descripcion`), -- Definición de la clave primaria
    FOREIGN KEY (`id_titulo`) REFERENCES `Titulos`(`id_titulo`) ON DELETE CASCADE -- Clave foránea hacia Titulos
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA DETALLE COTIZACION ----------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Detalle_Cotizacion si existe
DROP TABLE IF EXISTS `Detalle_Cotizacion`;

-- Crear la tabla Detalle_Cotizacion
CREATE TABLE `Detalle_Cotizacion` (
    `id_detalle` int NOT NULL AUTO_INCREMENT, -- Identificador único del detalle
    `id_cotizacion` int NOT NULL, -- ID de la cotización (clave foránea)
    `id_descripcion` int NOT NULL, -- ID de la descripción (clave foránea)
    `cantidad` int NOT NULL, -- Cantidad del ítem o servicio
    PRIMARY KEY (`id_detalle`), -- Definición de la clave primaria
    FOREIGN KEY (`id_cotizacion`) REFERENCES `Cotizaciones`(`id_cotizacion`) ON DELETE CASCADE, -- Clave foránea hacia Cotizaciones
    FOREIGN KEY (`id_descripcion`) REFERENCES `Descripciones`(`id_descripcion`) ON DELETE CASCADE -- Clave foránea hacia Descripciones
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;


-- Eliminar la tabla FotosPerfil si existe
DROP TABLE IF EXISTS FotosPerfil;

-- Crear la tabla FotosPerfil
CREATE TABLE FotosPerfil (
    id_foto int NOT NULL AUTO_INCREMENT, -- Identificador único de la foto
    id_empresa int NOT NULL, -- ID de la empresa (clave foránea)
    ruta_foto varchar(255) NOT NULL, -- Ruta del archivo de la foto
    fecha_subida datetime DEFAULT CURRENT_TIMESTAMP, -- Fecha de carga de la foto
    PRIMARY KEY (id_foto), -- Definición de la clave primaria
    FOREIGN KEY (id_empresa) REFERENCES Empresa(id_empresa) ON DELETE CASCADE -- Clave foránea hacia Empresa
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Confirmar cambios
COMMIT;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- FIN SCRIPT DE BASE DE DATOS ------------------------------------------
-- ------------------------------------------------------------------------------------------------------------

--Sitio Web Creado por ITred Spa.
--Direccion: Guido Reni #4190
--Pedro Agui Cerda - Santiago - Chile
--contacto@itred.cl o itred.spa@gmail.com
--https://www.itred.cl
--Creado, Programado y Diseñado por ITred Spa.
--BPPJ