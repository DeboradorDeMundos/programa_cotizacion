<?php
// Configuración del servidor MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itredspa_bd";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoger datos del formulario
//datos de la empresa que genera la cotización encabezado
$empresa_rut = $_POST['empresa_rut'] ?? null;
$empresa_nombre = $_POST['empresa_nombre'] ?? null;
$empresa_area = $_POST['empresa_area'] ?? null;
$empresa_direccion = $_POST['empresa_direccion'] ?? null;
$numero_cotizacion = $_POST['numero_cotizacion'] ?? null;
$validez_cotizacion = (int)($_POST['validez_cotizacion'] ?? 0);
$fecha_validez = date('Y-m-d', strtotime("+$validez_cotizacion days"));
$fecha_emision = $_POST['fecha_emision'] ?? null;
$empresa_telefono = $_POST['empresa_telefono'] ?? null;
$empresa_email = $_POST['empresa_email'] ?? null;

//datos de vendedor-encargado
$enc_proyecto = $_POST['enc_proyecto'] ?? null;
$enc_proyecto = $_POST['enc_proyecto'] ?? null;

//datos del proyecto   
$proyecto_nombre = $_POST['proyecto_nombre'] ?? null;
$proyecto_codigo = $_POST['codigo_prov'] ?? null;  
$tipo_trabajo = $_POST['tipo_trabajo'] ?? null; 
$area_trabajo = $_POST['area_trabajo'] ?? null;
$proyecto_riesgo = $_POST['riesgo'] ?? null;

//datos del cliente
$cliente_nombre = $_POST['cliente_nombre'] ?? null;
$cliente_empresa = $_POST['cliente_empresa'] ?? null;
$cliente_rut = $_POST['cliente_rut'] ?? null;
$cliente_rut = $_POST['cliente_direccion'] ?? null;
$cliente_lugar = $_POST['cliente_lugar'] ?? null;
$cliente_fono = $_POST['cliente_fono'] ?? null;
$cliente_email = $_POST['cliente_email'] ?? null;
$cliente_cargo = $_POST['cliente_email'] ?? null;
$cliente_giro = $_POST['cliente_giro'] ?? null;
$cliente_comuna = $_POST['cliente_comuna'] ?? null;
$cliente_ciudad = $_POST['cliente_ciudad'] ?? null;

//Datos extras
$dias_compra = $_POST['dias_compra'] ?? null;
$dias_trabajo = $_POST['dias_trabajo'] ?? null;
$trabajadores = $_POST['trabajadores'] ?? null;
$horario = $_POST['horario'] ?? null;
$colacion = $_POST['colacion'] ?? null;
$entrega = $_POST['entrega'] ?? null;




// Validar los datos
if (!$cliente_rut || !$cliente_nombre || !$empresa_nombre) {
    die("Error: Datos requeridos faltantes.");
}

// Insertar nuevo cliente si no existe
$cliente_id = obtenerClienteId($conn, $cliente_rut);
if (!$cliente_id) {
    $sql_cliente = "INSERT INTO Clientes (nombre_cliente, rut, direccion, telefono, email) VALUES (?, ?, ?, ?, ?)";
    $stmt_cliente = $conn->prepare($sql_cliente);
    $stmt_cliente->bind_param("sssss", $cliente_nombre, $cliente_rut, $_POST['cliente_direccion'], $_POST['cliente_fono'], $_POST['cliente_email']);
    if ($stmt_cliente->execute()) {
        $cliente_id = $stmt_cliente->insert_id;
    } else {
        die("Error al insertar el cliente: " . $stmt_cliente->error);
    }
    $stmt_cliente->close();
}

// Insertar nueva empresa si no existe
$empresa_id = obtenerEmpresaId($conn, $empresa_nombre);
if (!$empresa_id) {
    $sql_empresa = "INSERT INTO Empresa (nombre_empresa, direccion, telefono, email) VALUES (?, ?, ?, ?)";
    $stmt_empresa = $conn->prepare($sql_empresa);
    $stmt_empresa->bind_param("ssss", $empresa_nombre, $empresa_direccion, $empresa_telefono, $empresa_email);
    if ($stmt_empresa->execute()) {
        $empresa_id = $stmt_empresa->insert_id;
    } else {
        die("Error al insertar la empresa: " . $stmt_empresa->error);
    }
    $stmt_empresa->close();
}

// Insertar nuevo proyecto
$sql_proyecto = "INSERT INTO Proyectos (nombre_trabajo, codigo_proyecto, area_trabajo, riesgo_trabajo) VALUES (?, ?, ?, ?)";
$stmt_proyecto = $conn->prepare($sql_proyecto);
$stmt_proyecto->bind_param("ssss", $proyecto_nombre, $codigo_prov, $area_trabajo, $riesgo);
if ($stmt_proyecto->execute()) {
    $proyecto_id = $stmt_proyecto->insert_id;
} else {
    die("Error al insertar el proyecto: " . $stmt_proyecto->error);
}
$stmt_proyecto->close();

// Insertar datos en la tabla Cotizaciones
$sql_cotizacion = "INSERT INTO Cotizaciones (numero_cotizacion, fecha_emision, fecha_validez, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega, id_cliente, id_proyecto, id_empresa) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_cotizacion = $conn->prepare($sql_cotizacion);
$stmt_cotizacion->bind_param("ssssiiiiiiii", $numero_cotizacion, $fecha_emision, $fecha_validez, $dias_compra, $dias_trabajo, $trabajadores, $horario, $colacion, $entrega, $cliente_id, $proyecto_id, $empresa_id);
if ($stmt_cotizacion->execute()) {
    $cotizacion_id = $stmt_cotizacion->insert_id;

    // Insertar datos en la tabla Items_Cotizacion
    $total = $cantidad * $precio_unitario;
    $sql_item = "INSERT INTO Items_Cotizacion (id_cotizacion, descripcion, cantidad, precio_unitario, total) VALUES (?, ?, ?, ?, ?)";
    $stmt_item = $conn->prepare($sql_item);
    $stmt_item->bind_param("isidd", $cotizacion_id, $descripcion_servicio, $cantidad, $precio_unitario, $total);
    if ($stmt_item->execute()) {
        echo "Cotización generada exitosamente.";
    } else {
        die("Error al insertar el ítem: " . $stmt_item->error);
    }
} else {
    die("Error al insertar la cotización: " . $stmt_cotizacion->error);
}

$stmt_cotizacion->close();
$stmt_item->close();
$conn->close();

// Función para obtener el ID del cliente por RUT
function obtenerClienteId($conn, $rut) {
    $sql = "SELECT id_cliente FROM Clientes WHERE rut = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $rut);
    $stmt->execute();
    $stmt->bind_result($id_cliente);
    $stmt->fetch();
    $stmt->close();
    return $id_cliente;
}

// Función para obtener el ID de la empresa por nombre
function obtenerEmpresaId($conn, $nombre_empresa) {
    $sql = "SELECT id_empresa FROM Empresa WHERE nombre_empresa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_empresa);
    $stmt->execute();
    $stmt->bind_result($id_empresa);
    $stmt->fetch();
    $stmt->close();
    return $id_empresa;
}
?>
