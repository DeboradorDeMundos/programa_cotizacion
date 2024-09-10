<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->

<!-- ------------------------------------------------------------------------------------------------------------
    ------------------------------------- INICIO ITred Spa  .PHP --------------------------------------
    --

<?php
// Habilitar el reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Recibir datos del formulario
$empresa_rut = $_POST['empresa_rut'];
$empresa_nombre = $_POST['empresa_nombre'];
$empresa_area = $_POST['empresa_area'];
$empresa_direccion = $_POST['empresa_direccion'];
$numero_cotizacion = $_POST['numero_cotizacion'];
$validez_cotizacion = $_POST['validez_cotizacion'];
$fecha_emision = $_POST['fecha_emision'];
$empresa_telefono = $_POST['empresa_telefono'];
$empresa_email = $_POST['empresa_email'];
$proyecto_nombre = $_POST['proyecto_nombre'];
$proyecto_codigo = $_POST['proyecto_codigo'];
$area_trabajo = $_POST['area_trabajo'];
$tipo_trabajo = $_POST['tipo_trabajo'];
$riesgo = $_POST['riesgo'];
$cliente_nombre = $_POST['cliente_nombre'];
$cliente_rut = $_POST['cliente_rut'];
$cliente_empresa = $_POST['cliente_empresa'];
$cliente_direccion = $_POST['cliente_direccion'];
$cliente_lugar = $_POST['cliente_lugar'];
$cliente_fono = $_POST['cliente_fono'];
$cliente_email = $_POST['cliente_email'];
$cliente_cargo = $_POST['cliente_cargo'];
$cliente_giro = $_POST['cliente_giro'];
$cliente_comuna = $_POST['cliente_comuna'];
$cliente_ciudad = $_POST['cliente_ciudad'];
$cliente_tipo = $_POST['cliente_tipo'];
$enc_nombre = $_POST['enc_nombre'];
$enc_email = $_POST['enc_email'];
$enc_fono = $_POST['enc_fono'];
$enc_celular = $_POST['enc_celular'];
$enc_proyecto = $_POST['enc_proyecto'];
$vendedor_nombre = $_POST['vendedor_nombre'];
$vendedor_email = $_POST['vendedor_email'];
$vendedor_fono = $_POST['vendedor_telefono'];
$vendedor_celular = $_POST['vendedor_celular'];
$dias_compra = $_POST['dias_compra'];
$dias_trabajo = $_POST['dias_trabajo'];
$trabajadores = $_POST['trabajadores'];
$horario = $_POST['horario'];
$colacion = $_POST['colacion'];
$entrega = $_POST['entrega'];

// Insertar o actualizar la empresa
$sql = "INSERT INTO Empresa (rut_empresa, nombre_empresa, area_empresa, direccion_empresa, telefono_empresa, email_empresa)
        VALUES (?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nombre_empresa=VALUES(nombre_empresa), area_empresa=VALUES(area_empresa), direccion_empresa=VALUES(direccion_empresa), telefono_empresa=VALUES(telefono_empresa), email_empresa=VALUES(email_empresa)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("ssssss", $empresa_rut, $empresa_nombre, $empresa_area, $empresa_direccion, $empresa_telefono, $empresa_email);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
$id_empresa = $conn->insert_id;
echo "Empresa insertada/actualizada. ID: $id_empresa<br>";

// Insertar o actualizar el cliente
$sql = "INSERT INTO Clientes (nombre_cliente, empresa_cliente, rut_cliente, direccion_cliente, lugar_cliente, telefono_cliente, email_cliente, cargo_cliente, giro_cliente, comuna_cliente, ciudad_cliente, tipo_cliente)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nombre_cliente=VALUES(nombre_cliente), empresa_cliente=VALUES(empresa_cliente), direccion_cliente=VALUES(direccion_cliente), lugar_cliente=VALUES(lugar_cliente), telefono_cliente=VALUES(telefono_cliente), email_cliente=VALUES(email_cliente), cargo_cliente=VALUES(cargo_cliente), giro_cliente=VALUES(giro_cliente), comuna_cliente=VALUES(comuna_cliente), ciudad_cliente=VALUES(ciudad_cliente), tipo_cliente=VALUES(tipo_cliente)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("ssssssssssss", $cliente_nombre, $cliente_empresa, $cliente_rut, $cliente_direccion, $cliente_lugar, $cliente_fono, $cliente_email, $cliente_cargo, $cliente_giro, $cliente_comuna, $cliente_ciudad, $cliente_tipo);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
$id_cliente = $conn->insert_id;
echo "Cliente insertado/actualizado. ID: $id_cliente<br>";

// Insertar o actualizar el proyecto
$sql = "INSERT INTO Proyectos (nombre_proyecto, codigo_proyecto, tipo_trabajo, area_trabajo, riesgo_proyecto)
        VALUES (?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nombre_proyecto=VALUES(nombre_proyecto), codigo_proyecto=VALUES(codigo_proyecto), tipo_trabajo=VALUES(tipo_trabajo), area_trabajo=VALUES(area_trabajo), riesgo_proyecto=VALUES(riesgo_proyecto)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("sssss", $proyecto_nombre, $proyecto_codigo, $tipo_trabajo, $area_trabajo, $riesgo);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
$id_proyecto = $conn->insert_id;
echo "Proyecto insertado/actualizado. ID: $id_proyecto<br>";

// Insertar o actualizar el encargado
$sql = "INSERT INTO Encargados (nombre_encargado, email_encargado, fono_encargado, celular_encargado)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nombre_encargado=VALUES(nombre_encargado), email_encargado=VALUES(email_encargado), fono_encargado=VALUES(fono_encargado), celular_encargado=VALUES(celular_encargado)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("ssss", $enc_nombre, $enc_email, $enc_fono, $enc_celular);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
$id_encargado = $conn->insert_id;
echo "Encargado insertado/actualizado. ID: $id_encargado<br>";

// Insertar o actualizar el vendedor
$sql = "INSERT INTO Vendedores (nombre_vendedor, email_vendedor, fono_vendedor, celular_vendedor)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nombre_vendedor=VALUES(nombre_vendedor), email_vendedor=VALUES(email_vendedor), fono_vendedor=VALUES(fono_vendedor), celular_vendedor=VALUES(celular_vendedor)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("ssss", $vendedor_nombre, $vendedor_email, $vendedor_fono, $vendedor_celular);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
$id_vendedor = $conn->insert_id;
echo "Vendedor insertado/actualizado. ID: $id_vendedor<br>";

// Insertar la cotización
$sql = "SELECT id_cliente FROM Clientes WHERE rut_cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cliente_rut);
$stmt->execute();
$stmt->bind_result($id_cliente);
$stmt->fetch();
$stmt->close(); 

$sql = "SELECT id_proyecto FROM proyectos WHERE codigo_proyecto = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $proyecto_codigo);
$stmt->execute();
$stmt->bind_result($id_proyecto);
$stmt->fetch();
$stmt->close(); 

$sql = "SELECT id_empresa FROM empresa WHERE rut_empresa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $empresa_rut);
$stmt->execute();
$stmt->bind_result($id_empresa);
$stmt->fetch();
$stmt->close(); 

$sql = "INSERT INTO Cotizaciones (numero_cotizacion, fecha_emision, fecha_validez, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega, id_cliente, id_proyecto, id_empresa, id_vendedor, id_encargado)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("sssssiiiisiiii", $numero_cotizacion, $fecha_emision, $validez_cotizacion, $dias_compra, $dias_trabajo, $trabajadores, $horario, $colacion, $entrega, $id_cliente, $id_proyecto, $id_empresa, $id_vendedor, $id_encargado);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
$id_cotizacion = $conn->insert_id;
echo "Cotización insertada. ID: $id_cotizacion<br>";

// Insertar los detalles de la cotización
$detalles_titulo = isset($_POST['detalle_titulo']) ? $_POST['detalle_titulo'] : [];
$detalles_cantidad = isset($_POST['detalle_cantidad']) ? $_POST['detalle_cantidad'] : [];
$detalles_descripcion = isset($_POST['detalle_descripcion']) ? $_POST['detalle_descripcion'] : [];
$detalles_precio_unitario = isset($_POST['detalle_precio_unitario']) ? $_POST['detalle_precio_unitario'] : [];
$detalles_descuento = isset($_POST['detalle_descuento']) ? $_POST['detalle_descuento'] : [];

foreach ($detalles_titulo as $index => $titulo) {
    // Insertar el título
    $sql = "INSERT INTO Titulos (nombre) VALUES (?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("s", $titulo);
    $stmt->execute();
    if ($stmt->error) {
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }
    $id_titulo = $conn->insert_id;

    // Insertar la descripción
    $descripcion = $detalles_descripcion[$index];
    $precio_unitario = $detalles_precio_unitario[$index];
    $sql = "INSERT INTO Descripciones (id_titulo, descripcion, precio_unitario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("isd", $id_titulo, $descripcion, $precio_unitario);
    $stmt->execute();
    if ($stmt->error) {
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }
    $id_descripcion = $conn->insert_id;

    // Insertar el detalle de la cotización
    $cantidad = $detalles_cantidad[$index];
    $descuento = isset($detalles_descuento[$index]) ? $detalles_descuento[$index] : 0; // Asegúrate de que descuento tiene un valor predeterminado
    $sql = "INSERT INTO Detalle_Cotizacion (id_cotizacion, id_descripcion, cantidad) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("iid", $id_cotizacion, $id_descripcion, $cantidad);
    $stmt->execute();
    if ($stmt->error) {
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }
    echo "Detalle de la cotización insertado. ID Descripción: $id_descripcion<br>";
}

// Cerrar la conexión
$conn->close();
exit();
?>
