<?php
// Procesar la cotización
// Establecer la conexión a la base de datos
$servername = "localhost"; // Cambia esto por el nombre del servidor
$username = "root"; // Cambia esto por el nombre de usuario
$password = ""; // Cambia esto por la contraseña
$dbname = "itredspa_bd"; // Cambia esto por el nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

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
$vendedor_fono = $_POST['vendedor_fono'];
$vendedor_celular = $_POST['vendedor_celular'];
$dias_compra = $_POST['dias_compra'];
$dias_trabajo = $_POST['dias_trabajo'];
$trabajadores = $_POST['trabajadores'];
$horario = $_POST['horario'];
$colacion = $_POST['colacion'];
$entrega = $_POST['entrega'];

// Insertar la empresa si no existe
$sql = "INSERT IGNORE INTO Empresa (rut_empresa, nombre_empresa, area_empresa, direccion_empresa, telefono_empresa, email_empresa) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $empresa_rut, $empresa_nombre, $empresa_area, $empresa_direccion, $empresa_telefono, $empresa_email);
$stmt->execute();
$id_empresa = $conn->insert_id; // Obtener el ID de la empresa insertada o existente

// Insertar el cliente si no existe
$sql = "INSERT IGNORE INTO Clientes (nombre_cliente, empresa_cliente, rut_cliente, direccion_cliente, lugar_cliente, telefono_cliente, email_cliente, cargo_cliente, giro_cliente, comuna_cliente, ciudad_cliente, tipo_cliente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssss", $cliente_nombre, $cliente_empresa, $cliente_rut, $cliente_direccion, $cliente_lugar, $cliente_fono, $cliente_email, $cliente_cargo, $cliente_giro, $cliente_comuna, $cliente_ciudad, $cliente_tipo);
$stmt->execute();
$id_cliente = $conn->insert_id; // Obtener el ID del cliente insertado o existente

// Insertar el proyecto si no existe
$sql = "INSERT IGNORE INTO Proyectos (nombre_proyecto, codigo_proyecto, tipo_trabajo, area_trabajo, riesgo_proyecto) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $proyecto_nombre, $proyecto_codigo, $tipo_trabajo, $area_trabajo, $riesgo);
$stmt->execute();
$id_proyecto = $conn->insert_id; // Obtener el ID del proyecto insertado o existente

// Insertar el encargado si no existe
$sql = "INSERT IGNORE INTO Encargados (nombre_encargado, email_encargado, fono_encargado, celular_encargado) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $enc_nombre, $enc_email, $enc_fono, $enc_celular);
$stmt->execute();
$id_encargado = $conn->insert_id; // Obtener el ID del encargado insertado o existente

// Insertar el vendedor si no existe
$sql = "INSERT IGNORE INTO Vendedores (nombre_vendedor, email_vendedor, fono_vendedor, celular_vendedor) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $vendedor_nombre, $vendedor_email, $vendedor_fono, $vendedor_celular);
$stmt->execute();
$id_vendedor = $conn->insert_id; // Obtener el ID del vendedor insertado o existente

// Insertar la cotización
$sql = "INSERT INTO Cotizaciones (numero_cotizacion, fecha_emision, fecha_validez, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega, id_cliente, id_proyecto, id_empresa, id_vendedor, id_encargado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssiiiisii", $numero_cotizacion, $fecha_emision, $fecha_emision, $dias_compra, $dias_trabajo, $trabajadores, $horario, $colacion, $entrega, $id_cliente, $id_proyecto, $id_empresa, $id_vendedor, $id_encargado);
$stmt->execute();
$id_cotizacion = $conn->insert_id; // Obtener el ID de la cotización insertada

// Insertar los detalles de la cotización
$detalles_titulo = $_POST['detalle_titulo'];
$detalles_cantidad = $_POST['detalle_cantidad'];
$detalles_descripcion = $_POST['detalle_descripcion'];
$detalles_precio_unitario = $_POST['detalle_precio_unitario'];
$detalles_descuento = $_POST['detalle_descuento'];

foreach ($detalles_titulo as $index => $titulo) {
    // Insertar el título
    $sql = "INSERT INTO Titulos (nombre) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $titulo);
    $stmt->execute();
    $id_titulo = $conn->insert_id; // Obtener el ID del título insertado

    // Insertar la descripción
    $descripcion = $detalles_descripcion[$index];
    $precio_unitario = $detalles_precio_unitario[$index];
    $sql = "INSERT INTO Descripciones (id_titulo, descripcion, precio_unitario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isd", $id_titulo, $descripcion, $precio_unitario);
    $stmt->execute();
    $id_descripcion = $conn->insert_id; // Obtener el ID de la descripción insertada

    // Insertar el detalle de la cotización
    $cantidad = $detalles_cantidad[$index];
    $descuento = $detalles_descuento[$index];
    $sql = "INSERT INTO Detalle_Cotizacion (id_cotizacion, id_descripcion, cantidad) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $id_cotizacion, $id_descripcion, $cantidad);
    $stmt->execute();
}

// Cerrar la conexión
$conn->close();

// Redirigir al usuario a una página de confirmación o mostrar un mensaje de éxito
header("Location: confirmacion.php");
exit();
?>
