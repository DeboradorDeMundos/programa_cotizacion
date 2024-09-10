<?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Verifica si hubo algún error en la conexión a la base de datos
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Verifica si el formulario fue enviado a través del método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Escapa los datos recibidos del formulario para evitar inyección SQL
    $proyecto_nombre = $mysqli->real_escape_string($_POST['proyecto_nombre']);
    $codigo_prov = $mysqli->real_escape_string($_POST['codigo_prov']);
    $area_trabajo = $mysqli->real_escape_string($_POST['area_trabajo']);
    $riesgo = $mysqli->real_escape_string($_POST['riesgo']);
    
    $cliente_nombre = $mysqli->real_escape_string($_POST['cliente_nombre']);
    $cliente_rut = $mysqli->real_escape_string($_POST['cliente_rut']);
    $cliente_empresa = $mysqli->real_escape_string($_POST['cliente_empresa']);
    $cliente_direccion = $mysqli->real_escape_string($_POST['cliente_direccion']);
    $cliente_fono = $mysqli->real_escape_string($_POST['cliente_fono']);
    $cliente_email = $mysqli->real_escape_string($_POST['cliente_email']);

    $vendedor_nombre = $mysqli->real_escape_string($_POST['vendedor_nombre']);
    $vendedor_email = $mysqli->real_escape_string($_POST['vendedor_email']);
    $vendedor_fono = $mysqli->real_escape_string($_POST['vendedor_fono']);

    $fecha_cotizacion = $mysqli->real_escape_string($_POST['fecha_cotizacion']);
    $validez_cotizacion = intval($_POST['validez_cotizacion']); // Convierte a entero

    $cantidad = intval($_POST['cantidad']); // Convierte a entero
    $descripcion_servicio = $mysqli->real_escape_string($_POST['descripcion_servicio']);
    $precio_unitario = floatval($_POST['precio_unitario']); // Convierte a decimal
    $total_servicio = $cantidad * $precio_unitario; // Calcula el total del servicio

    $dias_compra = intval($_POST['dias_compra']); // Convierte a entero
    $dias_trabajo = intval($_POST['dias_trabajo']); // Convierte a entero
    $trabajadores = intval($_POST['trabajadores']); // Convierte a entero
    $horario = $mysqli->real_escape_string($_POST['horario']);
    $colacion = $mysqli->real_escape_string($_POST['colacion']);
    $entrega = $mysqli->real_escape_string($_POST['entrega']);
    
    // Inicia una transacción para asegurar que todas las consultas se ejecuten correctamente
    $mysqli->begin_transaction();

    try {
        // Inserta los datos del cliente en la tabla Clientes
        $sql_cliente = "INSERT INTO Clientes (nombre_cliente, rut, empresa, direccion, telefono, email) 
                        VALUES ('$cliente_nombre', '$cliente_rut', '$cliente_empresa', '$cliente_direccion', '$cliente_fono', '$cliente_email')";
        $mysqli->query($sql_cliente);
        $cliente_id = $mysqli->insert_id; // Obtiene el ID del cliente recién insertado

        // Inserta los datos del proyecto en la tabla Proyectos
        $sql_proyecto = "INSERT INTO Proyectos (codigo_proyecto, tipo_trabajo, area_trabajo, riesgo_trabajo) 
                         VALUES ('$codigo_prov', '$proyecto_nombre', '$area_trabajo', '$riesgo')";
        $mysqli->query($sql_proyecto);
        $proyecto_id = $mysqli->insert_id; // Obtiene el ID del proyecto recién insertado

        // Inserta los datos del vendedor en la tabla Empresa
        $sql_empresa = "INSERT INTO Empresa (nombre_empresa, direccion, telefono, email, whatsapp) 
                        VALUES ('$vendedor_nombre', '', '$vendedor_fono', '$vendedor_email', '')";
        $mysqli->query($sql_empresa);
        $empresa_id = $mysqli->insert_id; // Obtiene el ID de la empresa recién insertada

        // Calcula los totales para la cotización
        $total_neto = $total_servicio; // Total antes de impuestos
        $iva = $total_neto * 0.19; // Calcula el IVA (19%)
        $total_con_iva = $total_neto + $iva; // Suma el IVA al total neto
        $descuento = 0; // Asume que no hay descuento por defecto
        $total_final = $total_con_iva - $descuento; // Calcula el total final

        // Inserta los datos de la cotización en la tabla Cotizaciones
        $sql_cotizacion = "INSERT INTO Cotizaciones (numero_cotizacion, fecha_emision, fecha_validez, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega, id_cliente, id_proyecto, id_empresa, total_neto, iva, total_con_iva, descuento, total_final) 
                           VALUES (CONCAT('COT-', LPAD('$proyecto_id', 5, '0')), '$fecha_cotizacion', DATE_ADD('$fecha_cotizacion', INTERVAL $validez_cotizacion DAY), '$dias_compra', '$dias_trabajo', '$trabajadores', '$horario', '$colacion', '$entrega', '$cliente_id', '$proyecto_id', '$empresa_id', '$total_neto', '$iva', '$total_con_iva', '$descuento', '$total_final')";
        $mysqli->query($sql_cotizacion);
        $cotizacion_id = $mysqli->insert_id; // Obtiene el ID de la cotización recién insertada

        // Inserta los detalles del servicio en la tabla Items_Cotizacion
        $sql_item_cotizacion = "INSERT INTO Items_Cotizacion (id_cotizacion, descripcion, cantidad, precio_unitario, total) 
                                VALUES ('$cotizacion_id', '$descripcion_servicio', '$cantidad', '$precio_unitario', '$total_servicio')";
        $mysqli->query($sql_item_cotizacion);

        // Confirma la transacción (si todas las consultas anteriores fueron exitosas)
        $mysqli->commit();

        // Redirige a la página que muestra el listado de cotizaciones
        header("Location: ../ver_listado/ver_listado.php");
        exit();
    } catch (Exception $e) {
        // Si hay un error, revierte la transacción
        $mysqli->rollback();
        // Muestra un mensaje de error
        echo "Error al guardar la cotización: " . $e->getMessage();
    }
}
?>
