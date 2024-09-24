-- Sitio Web Creado por ITred Spa.
-- Direccion: Guido Reni #4190
-- Pedro Aguirre Cerda - Santiago - Chile
-- contacto@itred.cl o itred.spa@gmail.com
-- https://www.itred.cl
-- Creado, Programado y Diseñado por ITred Spa.
-- BPPJ

-- -----------------------------------------------------------------------------------------------------------------------------
-- ------------------------------------- INICIO SCRIPT DE BASE DE DATOS itredspa_bd .SQL ---------------------------------------
-- -----------------------------------------------------------------------------------------------------------------------------

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- -
-- base de datos: `itredspa_bd`
-- -

-- Selección de la base de datos para usar
CREATE DATABASE IF NOT EXISTS `itredspa_bd` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE itredspa_bd;
-- ------------------------------------------------------------------------------------------------------------

-- Eliminar la tabla FotosPerfil si existe
DROP TABLE IF EXISTS E_FotosPerfil;

-- Crear la tabla FotosPerfil
CREATE TABLE E_FotosPerfil (
    id_foto INT NOT NULL AUTO_INCREMENT, -- Identificador único de la foto
    ruta_foto VARCHAR(255) NOT NULL, -- Ruta del archivo de la foto
    fecha_subida DATETIME DEFAULT CURRENT_TIMESTAMP, -- Fecha de carga de la foto
    PRIMARY KEY (id_foto) -- Definición de la clave primaria
) ENGINE=InnoDB;

-- Eliminar la tabla Empresa si existe
DROP TABLE IF EXISTS E_Empresa;

-- Crear la tabla Empresa
CREATE TABLE E_Empresa (
    id_empresa INT NOT NULL AUTO_INCREMENT, -- Identificador único de la empresa
    id_foto INT, -- Identificador de la foto de la empresa
    rut_empresa VARCHAR(20) , -- RUT de la empresa
    nombre_empresa VARCHAR(255) NOT NULL, -- Nombre de la empresa
    area_empresa VARCHAR(255), -- Área de la empresa
    direccion_empresa VARCHAR(255), -- Dirección de la empresa
    telefono_empresa VARCHAR(20), -- Teléfono de la empresa
    email_empresa VARCHAR(100), -- Email de la empresa
    fecha_creacion VARCHAR(80), -- fecha de creacion de la empresa
    dias_validez INT,
    PRIMARY KEY (id_empresa), -- Definición de la clave primaria
    FOREIGN KEY (id_foto) REFERENCES E_FotosPerfil(id_foto) ON DELETE CASCADE -- Definición de la clave foránea
) ENGINE=InnoDB ;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA CLIENTES -------------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Clientes si existe
DROP TABLE IF EXISTS Clientes;

-- Crear la tabla Clientes
CREATE TABLE C_Clientes (
    id_cliente int NOT NULL AUTO_INCREMENT, -- Identificador único del cliente
    nombre_cliente varchar(255) NOT NULL, -- Nombre del cliente
    empresa_cliente varchar(255), -- Empresa del cliente
    rut_cliente varchar(20) , -- RUT del cliente (debe ser único)
    direccion_cliente varchar(255), -- Dirección del cliente
    lugar_cliente varchar(255), -- Lugar del cliente
    telefono_cliente varchar(20), -- Teléfono del cliente
    email_cliente varchar(100), -- Email del cliente
    cargo_cliente varchar(255), -- Cargo del cliente
    giro_cliente varchar(255), -- Giro del cliente
    comuna_cliente varchar(255), -- Comuna del cliente
    ciudad_cliente varchar(255), -- Ciudad del cliente
    tipo_cliente varchar(255), -- Tipo del cliente
    PRIMARY KEY (id_cliente) -- Definición de la clave primaria
) ENGINE=InnoDB ;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA PROYECTOS ------------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Proyectos si existe
DROP TABLE IF EXISTS Proyectos;

-- Crear la tabla Proyectos
CREATE TABLE C_Proyectos (
    id_proyecto int NOT NULL AUTO_INCREMENT, -- Identificador único del proyecto
    nombre_proyecto varchar(255), -- Nombre del proyecto
    codigo_proyecto varchar(50) NOT NULL, -- Código del proyecto
    tipo_trabajo varchar(255) NOT NULL, -- Tipo de trabajo del proyecto
    area_trabajo varchar(255) NOT NULL, -- Área de trabajo del proyecto
    riesgo_proyecto varchar(255), -- Riesgo asociado al proyecto
    dias_compra VARCHAR(50), -- Días de compra relacionados con la cotización
    dias_trabajo VARCHAR(50), -- Días de trabajo relacionados con la cotización
    trabajadores INT, -- Número de trabajadores asignados
    horario VARCHAR(50), -- Horario de trabajo
    colacion VARCHAR(50), -- Colación incluida
    entrega VARCHAR(50), -- Entrega especificada
    PRIMARY KEY (id_proyecto) -- Definición de la clave primaria
) ENGINE=InnoDB ;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA ENCARGADOS -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Encargados si existe
DROP TABLE IF EXISTS C_Encargados;

-- Crear la tabla Encargados
CREATE TABLE C_Encargados (
    id_encargado int NOT NULL AUTO_INCREMENT, -- Identificador único del encargado
    rut_encargado varchar(20) , -- RUT del cliente (debe ser único)
    nombre_encargado varchar(255) NOT NULL, -- Nombre del encargado
    email_encargado varchar(100), -- Email del encargado
    fono_encargado varchar(20), -- Teléfono del encargado
    celular_encargado varchar(20), -- Celular del encargado
    PRIMARY KEY (id_encargado) -- Definición de la clave primaria
) ENGINE=InnoDB ;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA VENDEDORES -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Vendedores si existe
DROP TABLE IF EXISTS C_Vendedores;

-- Crear la tabla Vendedores
CREATE TABLE C_Vendedores (
    id_vendedor int NOT NULL AUTO_INCREMENT, -- Identificador único del vendedor
    rut_vendedor varchar(20) , -- RUT del cliente (debe ser único)
    nombre_vendedor varchar(255) NOT NULL, -- Nombre del vendedor
    email_vendedor varchar(100), -- Email del vendedor
    fono_vendedor varchar(20), -- Teléfono del vendedor
    celular_vendedor varchar(20), -- Celular del vendedor
    PRIMARY KEY (id_vendedor) -- Definición de la clave primaria
) ENGINE=InnoDB ;

CREATE TABLE E_Bancos (
    id_banco INT AUTO_INCREMENT PRIMARY KEY,
    nombre_banco VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE E_Tipo_Cuenta (
    id_tipocuenta INT AUTO_INCREMENT PRIMARY KEY,
    tipocuenta VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255)
);

CREATE TABLE E_Cuenta_Bancaria (
    id_cuenta INT AUTO_INCREMENT PRIMARY KEY,
    rut_titular VARCHAR(12) NOT NULL,
    nombre_titular VARCHAR(255) NOT NULL,
    id_banco INT NOT NULL,
    id_tipocuenta INT NOT NULL,
    numero_cuenta VARCHAR(20) NOT NULL,
    celular INT ,
    email_banco VARCHAR(255) NOT NULL,
    id_empresa INT NOT NULL,
    FOREIGN KEY (id_banco) REFERENCES E_Bancos(id_banco),
    FOREIGN KEY (id_tipocuenta) REFERENCES E_Tipo_Cuenta(id_tipocuenta),
    FOREIGN KEY (id_empresa) REFERENCES E_Empresa(id_empresa)
);


-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA COTIZACIONES ---------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Cotizaciones si existe
DROP TABLE IF EXISTS C_Cotizaciones;

-- Crear la tabla Cotizaciones actualizada
CREATE TABLE C_Cotizaciones (
    id_cotizacion INT NOT NULL AUTO_INCREMENT,
    numero_cotizacion VARCHAR(50) NOT NULL,
    fecha_emision DATE, 
    fecha_validez DATE, 
    id_cliente INT, 
    id_proyecto INT, 
    id_empresa INT, 
    id_vendedor INT, 
    id_encargado INT, 
    PRIMARY KEY (id_cotizacion),
    FOREIGN KEY (id_cliente) REFERENCES C_Clientes(id_cliente) ON DELETE CASCADE, 
    FOREIGN KEY (id_proyecto) REFERENCES C_Proyectos(id_proyecto) ON DELETE CASCADE, 
    FOREIGN KEY (id_empresa) REFERENCES E_Empresa(id_empresa) ON DELETE CASCADE, 
    FOREIGN KEY (id_vendedor) REFERENCES C_Vendedores(id_vendedor) ON DELETE SET NULL,
    FOREIGN KEY (id_encargado) REFERENCES C_Encargados(id_encargado) ON DELETE SET NULL
) ENGINE=InnoDB ;



-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA TITULOS ---------------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Titulos si existe
DROP TABLE IF EXISTS C_Titulos;

-- Crear la tabla Titulos
CREATE TABLE C_Titulos (
    id_titulo INT NOT NULL AUTO_INCREMENT,
    id_cotizacion INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_titulo),
    FOREIGN KEY (id_cotizacion) REFERENCES C_Cotizaciones(id_cotizacion) ON DELETE CASCADE
) ENGINE=InnoDB ;




-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA SUB_TITULOS ---------------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 


CREATE TABLE C_Subtitulos (
    id_subtitulo INT NOT NULL AUTO_INCREMENT,
    id_titulo INT NOT NULL,     -- ID del título
    nombre VARCHAR(255),
    PRIMARY KEY (id_subtitulo),
    FOREIGN KEY (id_titulo) REFERENCES C_Titulos(id_titulo) ON DELETE CASCADE
) ENGINE=InnoDB ;



-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA C_Detalles ----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla C_Detalles si existe
DROP TABLE IF EXISTS C_Detalles;

-- Crear la tabla C_Detalles
CREATE TABLE C_Detalles (
    id_detalle INT NOT NULL AUTO_INCREMENT,
    id_titulo INT,
    tipo VARCHAR(50),
    nombre_producto VARCHAR(255),
    descripcion TEXT,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    descuento_porcentaje DECIMAL(5,2) DEFAULT 0,
    total DECIMAL(10,2),
    PRIMARY KEY (id_detalle),

    FOREIGN KEY (id_titulo) REFERENCES C_Titulos(id_titulo) ON DELETE CASCADE
) ENGINE=InnoDB ;





-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA DETALLE C_Totales ----------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla C_Totales si existe
DROP TABLE IF EXISTS C_Totales;

-- Crear la tabla C_Totales
CREATE TABLE C_Totales (
    id_total INT NOT NULL AUTO_INCREMENT,
    id_cotizacion INT NOT NULL,
    sub_total DECIMAL(10,2),
    descuento_global DECIMAL(5,2),
    monto_neto DECIMAL(10,2),
    iva_valor DECIMAL(5,2),
    total_iva DECIMAL(10,2),
    total_final DECIMAL(10,2),
    PRIMARY KEY (id_total),
    FOREIGN KEY (id_cotizacion) REFERENCES C_Cotizaciones(id_cotizacion) ON DELETE CASCADE
) ENGINE=InnoDB ;




CREATE TABLE p_tipo_producto (
    id_tipo_producto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tipo_producto VARCHAR(255) NOT NULL
) ENGINE=InnoDB ;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA DETALLE Productos ----------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Crear la tabla Productos
DROP TABLE IF EXISTS P_Productos;

-- Crea la tabla P_Productos con el nuevo campo id_tipo_producto
CREATE TABLE P_Productos (
    id_producto INT NOT NULL AUTO_INCREMENT, -- Identificador único del producto
    nombre_producto VARCHAR(255) NOT NULL, -- Nombre del producto
    descripcion_producto TEXT, -- Descripción del producto
    precio_producto DECIMAL(10,2) NOT NULL, -- Precio del producto
    id_foto INT, -- ID de la foto del producto (clave foránea)
    id_tipo_producto INT, -- Nuevo campo para el tipo de producto (clave foránea)
    id_empresa INT, 
    PRIMARY KEY (id_producto), -- Definición de la clave primaria

    -- Definición de la clave foránea para id_foto
    FOREIGN KEY (id_foto) REFERENCES E_FotosPerfil(id_foto) ON DELETE CASCADE,
    FOREIGN KEY (id_tipo_producto) REFERENCES p_tipo_producto(id_tipo_producto) ON DELETE SET NULL, -- Puedes usar ON DELETE CASCADE si prefieres eliminar los productos cuando se elimina un tipo
    FOREIGN KEY (id_empresa) REFERENCES E_Empresa(id_empresa) ON DELETE CASCADE 
) ENGINE=InnoDB ;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA pago -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla pago si existe
DROP TABLE IF EXISTS C_pago;

-- Crear la tabla pago
CREATE TABLE C_pago (
    id_pago INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cotizacion INT NOT NULL, -- ID de la cotización (clave foránea)
    numero_pago INT,
    descripcion VARCHAR(255) ,
    porcentaje_pago INT(3)  DEFAULT 0, 
    monto_pago INT(10) DEFAULT 0,
    fecha_pago DATE ,
    forma_pago VARCHAR(50),
    FOREIGN KEY (id_cotizacion) REFERENCES C_Cotizaciones(id_cotizacion) ON DELETE CASCADE
) ENGINE=InnoDB ;

COMMIT;


-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA Condiciones_Generales -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Crear la tabla Condiciones_Generales
DROP TABLE IF EXISTS C_Condiciones_Generales;

CREATE TABLE C_Condiciones_Generales (
    id_condiciones INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_empresa INT NOT NULL, -- ID de la cotización (clave foránea)
    descripcion_condiciones TEXT NOT NULL, -- Descripción de las condiciones generales
    estado BOOLEAN DEFAULT FALSE, -- Estado de la condición (por defecto, falso)
    FOREIGN KEY (id_empresa) REFERENCES E_Empresa(id_empresa) ON DELETE CASCADE -- Clave foránea hacia Cotizaciones
) ENGINE=InnoDB ;


-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA Requisitos_Basicos -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 


-- Crear la tabla Requisitos_Basicos
DROP TABLE IF EXISTS E_Requisitos_Basicos;
CREATE TABLE E_Requisitos_Basicos (
    id_requisitos INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    indice INT NOT NULL, -- nueva tabla?
    descripcion_condiciones VARCHAR(255) NOT NULL,
    estado BOOLEAN DEFAULT FALSE, -- Estado de la condición (por defecto, falso)
    id_empresa INT NOT NULL, -- ID de la empresa (clave foránea)

    FOREIGN KEY (id_empresa) REFERENCES E_Empresa(id_empresa) ON DELETE CASCADE -- Clave foránea hacia Empresa
) ENGINE=InnoDB ;


-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA obligaciones del cliente-----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 


CREATE TABLE E_obligaciones_cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    indice INT NOT NULL,
    descripcion TEXT NOT NULL,
    estado BOOLEAN DEFAULT FALSE, -- Estado de la condición (por defecto, falso)
    id_empresa INT NOT NULL,
    FOREIGN KEY (id_empresa) REFERENCES E_Empresa(id_empresa) ON DELETE CASCADE 
);

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA firmas -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

CREATE TABLE E_Firmas (
    id_firma INT AUTO_INCREMENT PRIMARY KEY,
    id_empresa INT NOT NULL,
    titulo_firma VARCHAR(255) NOT NULL,
    nombre_encargado_firma VARCHAR(255) NULL,
    cargo_encargado_firma VARCHAR(255) NULL,
    telefono_encargado_firma VARCHAR(255) NULL,
    nombre_empresa_firma VARCHAR(255) NULL,
    area_empresa_firma VARCHAR(255) NULL,
    telefono_empresa_firma VARCHAR(255) NULL,
    firma_digital VARCHAR(255) NULL ,
    email_firma VARCHAR(70) NULL,
    direccion_firma VARCHAR(70) NULL,
    rut_firma VARCHAR(70) NULL,
    FOREIGN KEY (id_empresa) REFERENCES e_Empresa(id_empresa)
);



-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- INSERT DATOS ----------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 



 -- Insertar datos en la tabla Bancos
INSERT INTO E_Bancos (nombre_banco) VALUES
('Banco de Chile'),
('Banco Santander Chile'),
('Banco Estado'),
('Banco BICE'),
('Banco Itaú'),
('Banco Security'),
('Banco Consorcio'),
('Banco BBVA'),
('Banco Falabella'),
('Banco Penta'),
('Scotiabank Chile'),
('HSBC Bank Chile'),
('Coopeuch'),
('Banco del Desarrollo');

 -- Insertar datos en la tabla Tipo_cuenta
INSERT INTO E_Tipo_Cuenta (tipocuenta, descripcion) VALUES
('Cuenta RUT', 'Cuenta de ahorro o corriente con disponibilidad inmediata de fondos'),
('Cuenta Vista', 'Cuenta de ahorro o corriente con disponibilidad inmediata de fondos'),
('Cuenta Corriente', 'Cuenta con chequera y posibilidad de sobregiro'),
('Cuenta Ahorro', 'Cuenta de ahorro con interés sobre el saldo'),
('Cuenta Chequera Electrónica', 'Cuenta corriente con chequera electrónica'),
('Cuenta Vista en Moneda Extranjera', 'Cuenta en divisas extranjeras'),
('Cuenta de Ahorro a Plazo', 'Cuenta con interés a plazo fijo'),
('Cuenta Corriente Internacional', 'Cuenta corriente con uso internacional'),
('Cuenta Nómina', 'Cuenta para recibir pagos de nómina'),
('Cuenta de Inversión', 'Cuenta asociada a productos de inversión');

INSERT INTO p_tipo_producto (tipo_producto) VALUES ('nuevo');
INSERT INTO p_tipo_producto (tipo_producto) VALUES ('insumo');
INSERT INTO p_tipo_producto (tipo_producto) VALUES ('producto');
INSERT INTO p_tipo_producto (tipo_producto) VALUES ('materia');
INSERT INTO p_tipo_producto (tipo_producto) VALUES ('ferreteria');
INSERT INTO p_tipo_producto (tipo_producto) VALUES ('profesional');
INSERT INTO p_tipo_producto (tipo_producto) VALUES ('tecnico');
INSERT INTO p_tipo_producto (tipo_producto) VALUES ('maestro');
INSERT INTO p_tipo_producto (tipo_producto) VALUES ('ayudante');

-- Insertar datos en la tabla E_FotosPerfil
INSERT INTO E_FotosPerfil (id_foto, ruta_foto, fecha_subida)
VALUES (1, '../../imagenes/programa_cotizacion/prueba2.jpg', '2024-09-09 17:25:20');

-- Insertar datos en la tabla E_Empresa
INSERT INTO E_Empresa (
    id_foto, 
    rut_empresa, 
    nombre_empresa, 
    area_empresa, 
    direccion_empresa, 
    telefono_empresa, 
    email_empresa, 
    fecha_creacion,
    dias_validez
) VALUES (
    1, -- ID de la foto asociada
    '12345678-9', -- RUT de la empresa
    'ITred Spa', -- Nombre de la empresa
    'Tecnología de Información', -- Área de la empresa
    'Guido Reni #4190', -- Dirección de la empresa
    '1234567890', -- Teléfono de la empresa
    'contacto@itred.cl', -- Email de la empresa
    '2024-09-01', -- Fecha de creación
    10 -- validez de cotizacion
);

-- Insertar datos en la tabla C_Clientes
INSERT INTO C_Clientes (
    nombre_cliente, 
    empresa_cliente, 
    rut_cliente, 
    direccion_cliente, 
    lugar_cliente, 
    telefono_cliente, 
    email_cliente, 
    cargo_cliente, 
    giro_cliente, 
    comuna_cliente, 
    ciudad_cliente, 
    tipo_cliente
) VALUES (
    'Juan Pérez', -- Nombre del cliente
    'Ejemplo S.A.', -- Empresa del cliente
    '98765432-1', -- RUT del cliente
    'Av. Siempre Viva 123', -- Dirección del cliente
    'Santiago', -- Lugar del cliente
    '0987654321', -- Teléfono del cliente
    'juan.perez@ejemplo.com', -- Email del cliente
    'Gerente', -- Cargo del cliente
    'Retail', -- Giro del cliente
    'Providencia', -- Comuna del cliente
    'Santiago', -- Ciudad del cliente
    'Corporativo' -- Tipo del cliente
);

-- Insertar datos en la tabla C_Proyectos
INSERT INTO C_Proyectos (
    nombre_proyecto, 
    codigo_proyecto, 
    tipo_trabajo, 
    area_trabajo, 
    riesgo_proyecto, 
    dias_compra, 
    dias_trabajo, 
    trabajadores, 
    horario, 
    colacion, 
    entrega
) VALUES (
    'Proyecto Alpha', -- Nombre del proyecto
    'PROJ-001', -- Código del proyecto
    'Desarrollo de Software', -- Tipo de trabajo
    'Tecnología', -- Área de trabajo
    'Bajo', -- Riesgo asociado
    '5', -- Días de compra
    '10', -- Días de trabajo
    5, -- Número de trabajadores
    '09:00 - 18:00', -- Horario de trabajo
    'Sí', -- Colación incluida
    'Finalización en 30 días' -- Entrega especificada
);

-- Insertar datos en la tabla C_Encargados
INSERT INTO C_Encargados (
    rut_encargado, 
    nombre_encargado, 
    email_encargado, 
    fono_encargado, 
    celular_encargado
) VALUES (
    '12345678-9', -- RUT del encargado
    'Ana Gómez', -- Nombre del encargado
    'ana.gomez@itred.cl', -- Email del encargado
    '123456789', -- Teléfono del encargado
    '987654321' -- Celular del encargado
);

-- Insertar datos en la tabla C_Vendedores
INSERT INTO C_Vendedores (
    rut_vendedor, 
    nombre_vendedor, 
    email_vendedor, 
    fono_vendedor, 
    celular_vendedor
) VALUES (
    '23456789-0', -- RUT del vendedor
    'Luis Martínez', -- Nombre del vendedor
    'luis.martinez@itred.cl', -- Email del vendedor
    '234567890', -- Teléfono del vendedor
    '876543210' -- Celular del vendedor
);

-- Insertar datos en la tabla C_Cotizaciones
INSERT INTO C_Cotizaciones (
    numero_cotizacion, 
    fecha_emision, 
    fecha_validez, 
    id_cliente, 
    id_proyecto, 
    id_empresa, 
    id_vendedor, 
    id_encargado
) VALUES (
    'COT-001', -- Número de cotización
    '2024-09-01', -- Fecha de emisión
    '2024-09-30', -- Fecha de validez
    1, -- ID del cliente
    1, -- ID del proyecto
    1, -- ID de la empresa
    1, -- ID del vendedor
    1 -- ID del encargado
);

-- Insertar datos en la tabla C_Titulos
INSERT INTO C_Titulos (
    id_cotizacion, 
    nombre
) VALUES (
    1, -- ID de la cotización
    'Título Ejemplo' -- Nombre del título
);

-- Insertar datos en la tabla C_Subtitulos
INSERT INTO C_Subtitulos (
    id_titulo, 
    nombre
) VALUES (
    1, -- ID del título
    'Subtítulo Ejemplo' -- Nombre del subtítulo
);

-- Insertar datos en la tabla C_Detalles
INSERT INTO C_Detalles (
    id_titulo, 
    tipo, 
    nombre_producto, 
    descripcion, 
    cantidad, 
    precio_unitario, 
    descuento_porcentaje, 
    total
) VALUES (
    1, -- ID del título
    'Producto', -- Tipo
    'Producto Ejemplo', -- Nombre del producto
    'Descripción del producto ejemplo', -- Descripción
    10, -- Cantidad
    100.00, -- Precio unitario
    5.00, -- Descuento porcentaje
    950.00 -- Total
);

-- Insertar datos en la tabla C_Totales
INSERT INTO C_Totales (
    id_cotizacion, 
    sub_total, 
    descuento_global, 
    monto_neto, 
    iva_valor, 
    total_iva, 
    total_final
) VALUES (
    1, -- ID de la cotización
    950.00, -- Sub total
    50.00, -- Descuento global
    900.00, -- Monto neto
    19.00, -- IVA valor
    171.00, -- Total IVA
    1071.00 -- Total final
);

-- Insertar datos en la tabla P_Productos
INSERT INTO P_Productos (
    nombre_producto, 
    descripcion_producto, 
    precio_producto, 
    id_foto, 
    id_tipo_producto, 
    id_empresa
) VALUES (
    'Producto A', -- Nombre del producto
    'Descripción del producto A', -- Descripción
    150.00, -- Precio del producto
    1, -- ID de la foto del producto
    1, -- ID del tipo de producto
    1 -- ID de la empresa
);

-- Insertar datos en la tabla C_pago
INSERT INTO C_pago (
    id_cotizacion, 
    descripcion, 
    porcentaje_pago, 
    monto_pago, 
    fecha_pago
) VALUES (
    1, -- ID de la cotización
    'pago por trabajo inicial', -- Descripción
    20, -- Porcentaje de pago
    180.00, -- Monto del pago
    '2024-09-05' -- Fecha del pago
);

-- Insertar datos en la tabla C_Condiciones_Generales
INSERT INTO C_Condiciones_Generales (
    id_empresa, 
    descripcion_condiciones, 
    estado
) VALUES (
    1, -- ID de la empresa
    'Condiciones generales del contrato', -- Descripción de las condiciones generales
    TRUE -- Estado (verdadero)
);

-- Insertar datos en la tabla E_Requisitos_Basicos
INSERT INTO E_Requisitos_Basicos (
    indice, 
    descripcion_condiciones, 
    id_empresa
) VALUES (
    1, -- Índice del requisito
    'Requisito básico para la empresa', -- Descripción de las condiciones
    1 -- ID de la empresa
);

-- Insertar una cuenta bancaria ficticia
INSERT INTO E_Cuenta_Bancaria (
    rut_titular, 
    nombre_titular, 
    id_banco, 
    id_tipocuenta, 
    numero_cuenta, 
    celular, 
    email_banco, 
    id_empresa
) VALUES (
    '12345678-9', -- RUT del titular
    'Nombre del Titular', -- Nombre del titular
    1, -- ID del banco (ajustar según el ID real del banco en E_Bancos)
    1, -- ID del tipo de cuenta (ajustar según el ID real del tipo de cuenta en E_Tipo_Cuenta)
    '1234567890', -- Número de cuenta ficticio
    987654321, -- Celular ficticio
    'banco@empresa.com', -- Email del banco
    1 -- ID de la empresa (ajustar según el ID real en E_Empresa)
);



-- Confirmar cambios
COMMIT;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- FIN SCRIPT DE BASE DE DATOS ------------------------------------------
-- ------------------------------------------------------------------------------------------------------------

-- Sitio Web Creado por ITred Spa.
-- Direccion: Guido Reni #4190
-- Pedro Aguirre Cerda - Santiago - Chile
-- contacto@itred.cl o itred.spa@gmail.com
-- https://www.itred.cl
-- Creado, Programado y Diseñado por ITredSpa.