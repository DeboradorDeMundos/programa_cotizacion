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

CREATE TABLE E_tipo_firma (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL UNIQUE
);

-- Eliminar la tabla Empresa si existe
DROP TABLE IF EXISTS E_Empresa;

-- Crear la tabla Empresa
CREATE TABLE E_Empresa (
    id_empresa INT NOT NULL AUTO_INCREMENT, -- Identificador único de la empresa
    id_foto INT, -- Identificador de la foto de la empresa
    rut_empresa VARCHAR(20) UNIQUE NOT NULL, -- RUT de la empresa
    nombre_empresa VARCHAR(255) NOT NULL, -- Nombre de la empresa
    area_empresa VARCHAR(255) NOT NULL, -- Área de la empresa
    direccion_empresa VARCHAR(255), -- Dirección de la empresa
    ciudad_empresa VARCHAR(100), -- Ciudad de la empresa
    pais_empresa VARCHAR(100), -- País de la empresa
    telefono_empresa VARCHAR(20), -- Teléfono de la empresa
    email_empresa VARCHAR(100), -- Email de la empresa
    web_empresa VARCHAR(255), -- Sitio web de la empresa
    fecha_creacion DATE, -- Fecha de creación de la empresa
    dias_validez INT, -- Días de validez
    id_tipo_firma INT, -- Identificador del tipo de firma
    PRIMARY KEY (id_empresa), -- Definición de la clave primaria
    FOREIGN KEY (id_foto) REFERENCES E_FotosPerfil(id_foto) ON DELETE CASCADE, -- Definición de la clave foránea
    FOREIGN KEY (id_tipo_firma) REFERENCES E_tipo_firma(id) ON DELETE SET NULL -- Definición de la clave foránea para tipo de firma
) ENGINE=InnoDB;


CREATE TABLE E_Encargados (
    id_encargado INT NOT NULL AUTO_INCREMENT, -- Identificador único del encargado
    rut_encargado VARCHAR(20), -- RUT del encargado (debe ser único)
    nombre_encargado VARCHAR(255) NOT NULL, -- Nombre del encargado
    cargo_encargado VARCHAR(100), -- Cargo del encargado
    email_encargado VARCHAR(100), -- Email del encargado
    fono_encargado VARCHAR(20), -- Teléfono del encargado
    celular_encargado VARCHAR(20), -- Celular del encargado
    id_empresa INT, -- Identificador de la empresa a la que pertenece el encargado
    PRIMARY KEY (id_encargado), -- Definición de la clave primaria
    FOREIGN KEY (id_empresa) REFERENCES E_Empresa(id_empresa) ON DELETE SET NULL -- Clave foránea para referenciar la empresa
) ENGINE=InnoDB;


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
    descripcion_riesgo varchar(255),
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
    id_subtitulo INT,
    tipo VARCHAR(50),
    nombre_producto VARCHAR(255),
    descripcion TEXT,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    descuento_porcentaje DECIMAL(5,2) DEFAULT 0,
    total DECIMAL(10,2),
    PRIMARY KEY (id_detalle),
    FOREIGN KEY (id_subtitulo) REFERENCES C_Subtitulos(id_subtitulo) ON DELETE CASCADE,
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
    total_final_letras varchar()
    PRIMARY KEY (id_total),
    FOREIGN KEY (id_cotizacion) REFERENCES C_Cotizaciones(id_cotizacion) ON DELETE CASCADE
) ENGINE=InnoDB ;


-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA DETALLE p_tipo_producto ----------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

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
-- ------------------------------------- TABLA C_Cotizacion_Condiciones -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 


-- Crear la tabla intermedia Cotizacion_Condiciones
DROP TABLE IF EXISTS C_Cotizacion_Condiciones;

CREATE TABLE C_Cotizacion_Condiciones (
    id_cotizacion_condiciones INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cotizacion INT NOT NULL, -- Clave foránea hacia Cotizaciones
    id_condiciones INT NOT NULL, -- Clave foránea hacia Condiciones Generales
    FOREIGN KEY (id_cotizacion) REFERENCES C_Cotizaciones(id_cotizacion) ON DELETE CASCADE,
    FOREIGN KEY (id_condiciones) REFERENCES C_Condiciones_Generales(id_condiciones) ON DELETE CASCADE,
  --  UNIQUE KEY (id_cotizacion, id_condiciones) -- Para evitar duplicados
) ENGINE=InnoDB;



-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA E_Requisitos_Basicos -----------------------------------------------------
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
-- ------------------------------------- TABLA C_Cotizaciones_Requisitos -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 



-- Crear la tabla intermedia Cotizaciones_Requisitos
DROP TABLE IF EXISTS C_Cotizaciones_Requisitos;

CREATE TABLE C_Cotizaciones_Requisitos (
    id_cotizacion_requisito INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cotizacion INT NOT NULL, -- Clave foránea hacia Cotizaciones
    id_requisitos INT NOT NULL, -- Clave foránea hacia Requisitos Básicos
    FOREIGN KEY (id_cotizacion) REFERENCES C_Cotizaciones(id_cotizacion) ON DELETE CASCADE,
    FOREIGN KEY (id_requisitos) REFERENCES E_Requisitos_Basicos(id_requisitos) ON DELETE CASCADE,
   -- UNIQUE KEY (id_cotizacion, id_requisitos) -- Para evitar duplicados
) ENGINE=InnoDB;


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
-- ------------------------------------- TABLA C_Cotizaciones_Obligaciones-----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 



-- Crear la tabla intermedia Cotizaciones_Obligaciones
DROP TABLE IF EXISTS C_Cotizaciones_Obligaciones;

CREATE TABLE C_Cotizaciones_Obligaciones (
    id_cotizacion_obligacion INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cotizacion INT NOT NULL, -- Clave foránea hacia Cotizaciones
    id_obligacion INT NOT NULL, -- Clave foránea hacia Obligaciones del Cliente
    FOREIGN KEY (id_cotizacion) REFERENCES C_Cotizaciones(id_cotizacion) ON DELETE CASCADE,
    FOREIGN KEY (id_obligacion) REFERENCES E_obligaciones_cliente(id) ON DELETE CASCADE,
    -- UNIQUE KEY (id_cotizacion, id_obligacion) -- Para evitar duplicados
) ENGINE=InnoDB;




-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA C_Observaciones-----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 



-- Crear la tabla Observaciones
DROP TABLE IF EXISTS C_Observaciones;

CREATE TABLE C_Observaciones (
    id_observacion INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cotizacion INT NOT NULL, -- Clave foránea hacia Cotizaciones
    observacion TEXT NOT NULL, -- Campo para guardar la observación
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación de la observación
    FOREIGN KEY (id_cotizacion) REFERENCES C_Cotizaciones(id_cotizacion) ON DELETE CASCADE
) ENGINE=InnoDB;



-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA firmas -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

CREATE TABLE E_Firmas (
    id_firma INT AUTO_INCREMENT PRIMARY KEY,
    id_empresa INT NOT NULL,
    titulo_firma VARCHAR(255) NOT NULL,
    nombre_encargado_firma VARCHAR(255) NULL,
    cargo_encargado_firma VARCHAR(100) NULL, -- Campo de cargo del encargado
    telefono_encargado_firma VARCHAR(20) NULL,
    nombre_empresa_firma VARCHAR(255) NULL,
    area_empresa_firma VARCHAR(255) NULL,
    telefono_empresa_firma VARCHAR(20) NULL,
    firma_digital VARCHAR(255) NULL,
    email_firma VARCHAR(100) NULL,
    direccion_firma VARCHAR(255) NULL,
    ciudad_firma VARCHAR(100) NULL, -- Campo para la ciudad
    pais_firma VARCHAR(100) NULL, -- Campo para el país
    rut_firma VARCHAR(20) NULL,
    web_firma VARCHAR(255) NULL, -- Campo para el sitio web
    FOREIGN KEY (id_empresa) REFERENCES E_Empresa(id_empresa)
);



-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- INSERT DATOS ----------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

INSERT INTO E_tipo_firma (tipo) VALUES ('automatica');
INSERT INTO E_tipo_firma (tipo) VALUES ('manual');
INSERT INTO E_tipo_firma (tipo) VALUES ('digital');
INSERT INTO E_tipo_firma (tipo) VALUES ('foto');

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
VALUES (1, '../../imagenes/programa_cotizacion/prueba2.png', '2024-09-09 17:25:20');

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
    dias_validez,
    id_tipo_firma
) VALUES (
    1, -- ID de la foto asociada
    '12345678-9', -- RUT de la empresa
    'ITred Spa', -- Nombre de la empresa
    'Tecnología de Información', -- Área de la empresa
    'Guido Reni #4190', -- Dirección de la empresa
    '1234567890', -- Teléfono de la empresa
    'contacto@itred.cl', -- Email de la empresa
    '2024-09-01', -- Fecha de creación
    10, -- validez de cotizacion
    1
);

-- Insertar datos en la tabla E_Encargados
INSERT INTO E_Encargados (
    rut_encargado, 
    nombre_encargado, 
    email_encargado, 
    fono_encargado, 
    celular_encargado, 
    id_empresa
) VALUES (
    '12345678-9', -- RUT del encargado
    'Carlos Ruiz', -- Nombre del encargado
    'carlos.ruiz@itred.cl', -- Email del encargado
    '123456789', -- Teléfono del encargado
    '987654321', -- Celular del encargado
    1 -- ID de la empresa
);

-- Insertar datos en la tabla C_Condiciones_Generales
INSERT INTO C_Condiciones_Generales (id_empresa, descripcion_condiciones, estado) VALUES
(1, 'Condición general 1: Cumplir con todas las normativas legales vigentes.', TRUE),
(1, 'Condición general 2: Realizar informes mensuales de avance del proyecto.', TRUE),
(1, 'Condición general 3: Proveer acceso a la documentación necesaria para el trabajo.', TRUE),
(1, 'Condición general 4: Garantizar la confidencialidad de la información compartida.', TRUE),
(1, 'Condición general 5: Proporcionar un plan de trabajo detallado antes del inicio.', TRUE),
(1, 'Condición general 6: Realizar reuniones quincenales de seguimiento con el equipo.', TRUE),
(1, 'Condición general 7: Responder a los correos electrónicos en un plazo no mayor a 24 horas.', TRUE),
(1, 'Condición general 8: Asegurar la disponibilidad de los recursos necesarios para el proyecto.', TRUE),
(1, 'Condición general 9: Proveer retroalimentación constructiva durante el proceso.', TRUE),
(1, 'Condición general 10: Cumplir con los plazos establecidos en el cronograma del proyecto.', TRUE);

-- Insertar datos en la tabla E_Requisitos_Basicos
INSERT INTO E_Requisitos_Basicos (indice, descripcion_condiciones, estado, id_empresa) VALUES
(1, 'Requisito básico 1: Registro de la empresa en el sistema.', TRUE, 1),
(2, 'Requisito básico 2: Presentar documentación legal actualizada.', TRUE, 1),
(3, 'Requisito básico 3: Cumplimiento de normativas de seguridad laboral.', TRUE, 1),
(4, 'Requisito básico 4: Tener un responsable de gestión de calidad.', TRUE, 1),
(5, 'Requisito básico 5: Disponer de un plan de contingencia ante emergencias.', TRUE, 1),
(6, 'Requisito básico 6: Realizar capacitaciones periódicas para los empleados.', TRUE, 1),
(7, 'Requisito básico 7: Implementar un sistema de gestión de recursos humanos.', TRUE, 1),
(8, 'Requisito básico 8: Mantener un inventario actualizado de los bienes.', TRUE, 1),
(9, 'Requisito básico 9: Contar con un canal de comunicación interna eficiente.', TRUE, 1),
(10, 'Requisito básico 10: Cumplir con las auditorías internas programadas.', TRUE, 1);

-- Insertar datos en la tabla E_obligaciones_cliente
INSERT INTO E_obligaciones_cliente (indice, descripcion, estado, id_empresa) VALUES
(1, 'Obligación 1: Proporcionar información veraz sobre la empresa.', TRUE, 1),
(2, 'Obligación 2: Cumplir con los plazos de pago establecidos en el contrato.', TRUE, 1),
(3, 'Obligación 3: Colaborar en la entrega de documentación requerida.', TRUE, 1),
(4, 'Obligación 4: Mantener actualizados los datos de contacto.', TRUE, 1),
(5, 'Obligación 5: Notificar cambios relevantes en la operación de la empresa.', TRUE, 1),
(6, 'Obligación 6: Garantizar el acceso a las instalaciones para auditorías.', TRUE, 1),
(7, 'Obligación 7: Cumplir con las normativas de seguridad establecidas.', TRUE, 1),
(8, 'Obligación 8: Proveer capacitación al personal sobre el uso de servicios.', TRUE, 1),
(9, 'Obligación 9: Responder a las consultas realizadas por la empresa en tiempo y forma.', TRUE, 1),
(10, 'Obligación 10: Colaborar en la implementación de mejoras sugeridas.', TRUE, 1);

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

-- Insertar cuentas bancarias ficticias
INSERT INTO E_Cuenta_Bancaria (
    rut_titular, 
    nombre_titular, 
    id_banco, 
    id_tipocuenta, 
    numero_cuenta, 
    celular, 
    email_banco, 
    id_empresa
) VALUES 
('87654321-0', 'Pedro González', 1, 1, '2345678901', 987654321, 'pedro.gonzalez@empresa.com', 1),
('13579246-8', 'María Rodríguez', 1, 1, '3456789012', 987654321, 'maria.rodriguez@empresa.com', 1),
('24681357-9', 'Luis Fernández', 1, 1, '4567890123', 987654321, 'luis.fernandez@empresa.com', 1),
('35792468-0', 'Ana Torres', 1, 1, '5678901234', 987654321, 'ana.torres@empresa.com', 1);

-- Insertar una firma para la empresa 1
INSERT INTO E_Firmas (
    id_empresa, 
    titulo_firma, 
    nombre_encargado_firma, 
    cargo_encargado_firma, 
    telefono_encargado_firma, 
    nombre_empresa_firma, 
    area_empresa_firma, 
    telefono_empresa_firma, 
    firma_digital, 
    email_firma, 
    direccion_firma, 
    rut_firma
) VALUES (
    1, -- ID de la empresa
    'Firma de Ejemplo', -- Título de la firma
    'Carlos Ruiz', -- Nombre del encargado de la firma
    'Gerente General', -- Cargo del encargado
    '123456789', -- Teléfono del encargado
    'ITred Spa', -- Nombre de la empresa
    'Tecnología de Información', -- Área de la empresa
    '9876543210', -- Teléfono de la empresa
    'firma_digital.png', -- Ruta de la firma digital
    'carlos.ruiz@itred.cl', -- Email del encargado
    'Guido Reni #4190', -- Dirección de la firma
    '12345678-9' -- RUT de la firma
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