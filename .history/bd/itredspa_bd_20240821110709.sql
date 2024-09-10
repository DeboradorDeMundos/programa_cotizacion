-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------ INICIO ITred Spa Base de Datos itredspa_bd.sql ------------------------------
-- ------------------------------------------------------------------------------------------------------------

-- Configuración inicial
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Crear base de datos si no existe
CREATE DATABASE IF NOT EXISTS `itredspa_bd` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci;
USE `itredspa_bd`;

-- ----------------------------------------------------------
-- Estructura de la tabla `nombre_proyecto`
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `nombre_proyecto`;
CREATE TABLE `nombre_proyecto` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `tipo_proyecto_id` int DEFAULT NULL,
  `plantilla_proyecto_id` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- ----------------------------------------------------------
-- Estructura de la tabla `tipo_proyecto`
-- ----------------------------------------------------------
DROP TABLE IF EXISTS `tipo_proyecto`;
CREATE TABLE `tipo_proyecto` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `codigo_tipo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombre_tipo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- ----------------------------------------------------------
-- Volcado de datos para la tabla `tipo_proyecto`
-- ----------------------------------------------------------
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

-- Finaliza la transacción
COMMIT;

-- ------------------------------------------------------------------------------------------------------------
-- -------------------------------- FIN ITred Spa Base de Datos itredspa_bd.sql ------------------------------
-- ------------------------------------------------------------------------------------------------------------
