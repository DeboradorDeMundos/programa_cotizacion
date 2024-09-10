-- Sitio Web Creado por ITred Spa.
-- Direccion: Guido Reni #4190
-- Pedro Agui Cerda - Santiago - Chile
-- contacto@itred.cl o itred.spa@gmail.com
-- https://www.itred.cl
-- Creado, Programado y Diseñado por ITred Spa.
-- BPPJ

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- INICIO SCRIPT DE BASE DE DATOS ---------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- CONEXION BD --------------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 
-- Configuraciones iniciales
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Selección de la base de datos para usar
USE itredspa_bd;

-- Eliminar la tabla FotosPerfil si existe
DROP TABLE IF EXISTS E_FotosPerfil;

-- Crear la tabla FotosPerfil
CREATE TABLE E_FotosPerfil (
    id_foto INT NOT NULL AUTO_INCREMENT, -- Identificador único de la foto
    ruta_foto VARCHAR(255) NOT NULL, -- Ruta del archivo de la foto
    fecha_subida DATETIME DEFAULT CURRENT_TIMESTAMP, -- Fecha de carga de la foto
    PRIMARY KEY (id_foto) -- Definición de la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Eliminar la tabla Empresa si existe
DROP TABLE IF EXISTS Empresa;

-- Crear la tabla Empresa
CREATE TABLE E_Empresa (
    id_empresa INT NOT NULL AUTO_INCREMENT, -- Identificador único de la empresa
    id_foto INT, -- Identificador de la foto de la empresa
    rut_empresa VARCHAR(20) UNIQUE NOT NULL, -- RUT de la empresa
    nombre_empresa VARCHAR(255) NOT NULL, -- Nombre de la empresa
    area_empresa VARCHAR(255), -- Área de la empresa
    direccion_empresa VARCHAR(255), -- Dirección de la empresa
    telefono_empresa VARCHAR(20), -- Teléfono de la empresa
    email_empresa VARCHAR(100), -- Email de la empresa
    fecha_creacion DATE, -- fecha de creacion de la empresa
    PRIMARY KEY (id_empresa), -- Definición de la clave primaria
    FOREIGN KEY (id_foto) REFERENCES E_FotosPerfil(id_foto) ON DELETE CASCADE -- Definición de la clave foránea
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
    rut_cliente varchar(20) UNIQUE NOT NULL, -- RUT del cliente (debe ser único)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA ENCARGADOS -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Encargados si existe
DROP TABLE IF EXISTS Encargados;

-- Crear la tabla Encargados
CREATE TABLE C_Encargados (
    id_encargado int NOT NULL AUTO_INCREMENT, -- Identificador único del encargado
    nombre_encargado varchar(255) NOT NULL, -- Nombre del encargado
    email_encargado varchar(100), -- Email del encargado
    fono_encargado varchar(20), -- Teléfono del encargado
    celular_encargado varchar(20), -- Celular del encargado
    PRIMARY KEY (id_encargado) -- Definición de la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA VENDEDORES -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Vendedores si existe
DROP TABLE IF EXISTS Vendedores;

-- Crear la tabla Vendedores
CREATE TABLE C_Vendedores (
    id_vendedor int NOT NULL AUTO_INCREMENT, -- Identificador único del vendedor
    nombre_vendedor varchar(255) NOT NULL, -- Nombre del vendedor
    email_vendedor varchar(100), -- Email del vendedor
    fono_vendedor varchar(20), -- Teléfono del vendedor
    celular_vendedor varchar(20), -- Celular del vendedor
    PRIMARY KEY (id_vendedor) -- Definición de la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
    celular INT NOT NULL,
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
DROP TABLE IF EXISTS Cotizaciones;

-- Crear la tabla Cotizaciones actualizada
CREATE TABLE C_Cotizaciones (
    id_cotizacion INT NOT NULL AUTO_INCREMENT, -- Identificador único de la cotización
    numero_cotizacion VARCHAR(50) UNIQUE NOT NULL, -- Número de cotización (debe ser único)
    fecha_emision DATE , -- Fecha de emisión de la cotización
    fecha_validez DATE , -- Fecha de validez de la cotización
    id_cliente INT, -- ID del cliente (clave foránea)
    id_proyecto INT, -- ID del proyecto (clave foránea)
    id_empresa INT, -- ID de la empresa (clave foránea)
    id_vendedor INT, -- ID del vendedor (clave foránea)
    id_encargado INT, -- ID del encargado (clave foránea)
    id_cuenta INT, -- ID de la cuenta bancaria (clave foránea)
    id_detalle INT
    PRIMARY KEY (id_cotizacion), -- Definición de la clave primaria
    -- Definiciones de claves foráneas
    FOREIGN KEY (id_cliente) REFERENCES C_Clientes(id_cliente) ON DELETE CASCADE, -- Clave foránea hacia Clientes
    FOREIGN KEY (id_proyecto) REFERENCES C_Proyectos(id_proyecto) ON DELETE CASCADE, -- Clave foránea hacia Proyectos
    FOREIGN KEY (id_empresa) REFERENCES E_Empresa(id_empresa) ON DELETE CASCADE, -- Clave foránea hacia Empresa
    FOREIGN KEY (id_vendedor) REFERENCES C_Vendedores(id_vendedor) ON DELETE SET NULL, -- Clave foránea hacia Vendedores
    FOREIGN KEY (id_encargado) REFERENCES C_Encargados(id_encargado) ON DELETE SET NULL, -- Clave foránea hacia Encargados
    FOREIGN KEY (id_cuenta) REFERENCES E_Cuenta_Bancaria(id_cuenta) ON DELETE SET NULL -- Clave foránea hacia Cuenta_Bancaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;


-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA TITULOS ---------------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Titulos si existe
DROP TABLE IF EXISTS Titulos;

-- Crear la tabla Titulos
CREATE TABLE C_Titulos (
    id_titulo int NOT NULL AUTO_INCREMENT, -- Identificador único del título
    nombre varchar(255) NOT NULL, -- Nombre del título
    PRIMARY KEY (id_titulo) -- Definición de la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA DESCRIPCIONES ----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Descripciones si existe
DROP TABLE IF EXISTS Descripciones;

-- Crear la tabla Descripciones
CREATE TABLE C_Descripciones (
    id_descripcion int NOT NULL AUTO_INCREMENT, -- Identificador único de la descripción
    id_titulo int NOT NULL, -- ID del título (clave foránea)
    descripcion text NOT NULL, -- Descripción detallada del ítem o servicio
    precio_unitario decimal(10,2) NOT NULL, -- Precio unitario del ítem o servicio
    PRIMARY KEY (id_descripcion), -- Definición de la clave primaria
    FOREIGN KEY (id_titulo) REFERENCES Titulos(id_titulo) ON DELETE CASCADE -- Clave foránea hacia Titulos
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA DETALLE COTIZACION ----------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Detalle_Cotizacion si existe
DROP TABLE IF EXISTS Detalle_Cotizacion;

-- Crear la tabla Detalle_Cotizacion
CREATE TABLE C_Detalle_Cotizacion (
    id_detalle int NOT NULL AUTO_INCREMENT, -- Identificador único del detalle
    id_cotizacion int NOT NULL, -- ID de la cotización (clave foránea)
    id_descripcion int NOT NULL, -- ID de la descripción (clave foránea)sub_total INT(10), -- Sub Total de la cotización
    descuento_global INT(3), -- Descuento Global aplicado a la cotización (porcentaje)
    monto INT(10) DEFAULT 0, -- Monto de descuento de la cotización
    monto_neto DECIMAL(10,2), -- Monto Neto de la cotización
    iva_valor INT(2), -- Valor del IVA aplicado (19%)
    total_iva DECIMAL(10,2), -- Total del IVA de la cotización
    total_final INT(10), -- Total Final de la cotización
    PRIMARY KEY (id_detalle), -- Definición de la clave primaria
    FOREIGN KEY (id_cotizacion) REFERENCES Cotizaciones(id_cotizacion) ON DELETE CASCADE, -- Clave foránea hacia Cotizaciones
    FOREIGN KEY (id_descripcion) REFERENCES Descripciones(id_descripcion) ON DELETE CASCADE -- Clave foránea hacia Descripciones
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Crear la tabla Productos
DROP TABLE IF EXISTS Productos;

CREATE TABLE P_Productos (
    id_producto INT NOT NULL AUTO_INCREMENT, -- Identificador único del producto
    nombre_producto VARCHAR(255) NOT NULL, -- Nombre del producto
    descripcion_producto TEXT, -- Descripción del producto
    precio_producto DECIMAL(10,2) NOT NULL, -- Precio del producto
    id_empresa INT NOT NULL, -- ID de la empresa (clave foránea)
    id_foto INT, -- ID de la foto del producto (clave foránea)
    PRIMARY KEY (id_producto), -- Definición de la clave primaria

    -- Definición de la clave foránea
    FOREIGN KEY (id_empresa) REFERENCES Empresa(id_empresa) ON DELETE CASCADE, -- Clave foránea hacia Empresa
    FOREIGN KEY (id_foto) REFERENCES FotosPerfil(id_foto) ON DELETE CASCADE -- Definición de la clave foránea
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;


-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA ADELANTO -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Eliminar la tabla Adelanto si existe
DROP TABLE IF EXISTS Adelanto;

-- Crear la tabla Adelanto
CREATE TABLE C_Adelanto (
    id_adelanto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cotizacion INT NOT NULL, -- ID de la cotización (clave foránea)
    descripcion VARCHAR(255) ,
    porcentaje_adelanto INT(3)  DEFAULT 0, 
    monto_adelanto INT(10) DEFAULT 0,
    fecha_adelanto DATE ,
    FOREIGN KEY (id_cotizacion) REFERENCES Cotizaciones(id_cotizacion) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

COMMIT;


-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- TABLA Condiciones_Generales -----------------------------------------------------
-- ------------------------------------------------------------------------------------------------------------ 

-- Crear la tabla Condiciones_Generales
DROP TABLE IF EXISTS Condiciones_Generales;

CREATE TABLE C_Condiciones_Generales (
    id_condiciones INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_cotizacion INT NOT NULL, -- ID de la cotización (clave foránea)
    descripcion_condiciones TEXT NOT NULL, -- Descripción de las condiciones generales
    estado BOOLEAN DEFAULT FALSE, -- Estado de la condición (por defecto, falso)
    FOREIGN KEY (id_cotizacion) REFERENCES Cotizaciones(id_cotizacion) ON DELETE CASCADE -- Clave foránea hacia Cotizaciones
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
('Cuenta Vista', 'Cuenta de ahorro o corriente con disponibilidad inmediata de fondos'),
('Cuenta Corriente', 'Cuenta con chequera y posibilidad de sobregiro'),
('Cuenta Ahorro', 'Cuenta de ahorro con interés sobre el saldo'),
('Cuenta Chequera Electrónica', 'Cuenta corriente con chequera electrónica'),
('Cuenta Vista en Moneda Extranjera', 'Cuenta en divisas extranjeras'),
('Cuenta de Ahorro a Plazo', 'Cuenta con interés a plazo fijo'),
('Cuenta Corriente Internacional', 'Cuenta corriente con uso internacional'),
('Cuenta Nómina', 'Cuenta para recibir pagos de nómina'),
('Cuenta de Inversión', 'Cuenta asociada a productos de inversión');

INSERT INTO E_Empresa (
    id_foto, 
    rut_empresa, 
    nombre_empresa, 
    area_empresa, 
    direccion_empresa, 
    telefono_empresa, 
    email_empresa, 
    fecha_creacion
) VALUES (
    NULL, -- Suponiendo que no se proporciona una foto, se puede usar NULL
    '12345678-9', -- RUT de la empresa
    'Nombre de la Empresa S.A.', -- Nombre de la empresa
    'Área de Ejemplo', -- Área de la empresa (opcional)
    'Dirección de Ejemplo 123', -- Dirección de la empresa (opcional)
    '1234567890', -- Teléfono de la empresa (opcional)
    'contacto@empresa.com', -- Email de la empresa
    '2024-09-01' -- Fecha de creación (opcional)
);

-- Confirmar cambios
COMMIT;


-- ------------------------------------------------------------------------------------------------------------
-- ------------------------------------- FIN SCRIPT DE BASE DE DATOS ------------------------------------------
-- ------------------------------------------------------------------------------------------------------------

-- Sitio Web Creado por ITred Spa.
-- Direccion: Guido Reni #4190
-- Pedro Agui Cerda - Santiago - Chile
-- contacto@itred.cl o itred.spa@gmail.com
-- https://www.itred.cl
-- Creado, Programado y Diseñado por ITred Spa.
-- BPPJ