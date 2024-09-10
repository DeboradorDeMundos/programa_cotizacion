<?php
// procesar_cotizacion.php
header('Content-Type: application/json');

// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Verifica si la conexión fue exitosa
if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de Conexión']);
    exit();
}

// Obtiene los datos del formulario
$proyecto_nombre = $_POST['proyecto_nombre'];
$codigo_prov = $_POST['codigo_prov'];
$area_trabajo = $_POST['area_trabajo'];
$riesgo = $_POST['riesgo'];

$cliente_nombre = $_POST['cliente_nombre'];
$cliente_rut = $_POST['cliente_rut'];
$cliente_empresa = $_POST['cliente_empresa'];
$cliente_direccion = $_POST['cliente_direccion'];
$cliente_fono = $_POST['cliente_fono'];
$cliente_email = $_POST['cliente_email'];

$vendedor_nombre = $_POST['vendedor_nombre'];
$vendedor_email = $_POST['vendedor_email'];
$vendedor_fono = $_POST['vendedor_fono'];

$fecha_cotizacion = $_POST['fecha_cotizacion'];
$validez_cotizacion = $_POST['validez_cotizacion'];
$cantidad = $_POST['cantidad'];
$descripcion_servicio = $_POST['descripcion_servicio'];
$precio_unitario = $_POST['precio_unitario'];

$dias_compra = $_POST['dias_compra'];
$dias_trabajo = $_POST['dias_trabajo'];
$trabajadores = $_POST['trabajadores'];
$horario = $_POST['horario'];
$colacion = $_POST['colacion'];
$entrega = $_POST['entrega'];

// Prepara la consulta SQL para insertar la cotización
$stmt = $mysqli->prepare("INSERT INTO Cotizaciones (numero_cotizacion, fecha_emision, fecha_validez, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega, id_cliente, id_proyecto, id_empresa, total_neto, iva, total_con_iva, descuento, total_final) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$numero_cotizacion = 'COT-' . mt_rand(1000, 9999); // Genera un número de cotización único
$total_neto = $cantidad * $precio_unitario; // Ejemplo de cálculo del total neto
$iva = $total_neto * 0.19; // Ejemplo de cálculo del IVA
$total_con_iva = $total_neto + $iva;
$descuento = 0; // O se puede calcular si hay algún descuento
$total_final = $total_con_iva - $descuento;

$stmt->bind_param('sssssssssiiidddd', $numero_cotizacion, $fecha_cotizacion, $fecha_cotizacion, $dias_compra, $dias_trabajo, $trabajadores, $horario, $colacion, $entrega, $cliente_id, $proyecto_id, $empresa_id, $total_neto, $iva, $total_con_iva, $descuento, $total_final);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al guardar la cotización']);
}

$stmt->close();
$mysqli->close();
?>
