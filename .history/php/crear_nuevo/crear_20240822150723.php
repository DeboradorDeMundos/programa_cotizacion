<?php
include '../../db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proyecto_nombre = $conn->real_escape_string($_POST['proyecto_nombre']);
    $codigo_prov = $conn->real_escape_string($_POST['codigo_prov']);
    $area_trabajo = $conn->real_escape_string($_POST['area_trabajo']);
    $riesgo = $conn->real_escape_string($_POST['riesgo']);
    
    $cliente_nombre = $conn->real_escape_string($_POST['cliente_nombre']);
    $cliente_rut = $conn->real_escape_string($_POST['cliente_rut']);
    $cliente_empresa = $conn->real_escape_string($_POST['cliente_empresa']);
    $cliente_direccion = $conn->real_escape_string($_POST['cliente_direccion']);
    $cliente_fono = $conn->real_escape_string($_POST['cliente_fono']);
    $cliente_email = $conn->real_escape_string($_POST['cliente_email']);

    $vendedor_nombre = $conn->real_escape_string($_POST['vendedor_nombre']);
    $vendedor_email = $conn->real_escape_string($_POST['vendedor_email']);
    $vendedor_fono = $conn->real_escape_string($_POST['vendedor_fono']);

    $fecha_cotizacion = $conn->real_escape_string($_POST['fecha_cotizacion']);
    $validez_cotizacion = intval($_POST['validez_cotizacion']);

    $cantidad = intval($_POST['cantidad']);
    $descripcion_servicio = $conn->real_escape_string($_POST['descripcion_servicio']);
    $precio_unitario = floatval($_POST['precio_unitario']);
    $total_servicio = $cantidad * $precio_unitario;

    $dias_compra = intval($_POST['dias_compra']);
    $dias_trabajo = intval($_POST['dias_trabajo']);
    $trabajadores = intval($_POST['trabajadores']);
    $horario = $conn->real_escape_string($_POST['horario']);
    $colacion = $conn->real_escape_string($_POST['colacion']);
    $entrega = $conn->real_escape_string($_POST['entrega']);
    
    $conn->begin_transaction();

    try {
        // Insertar en la tabla Clientes
        $sql_cliente = "INSERT INTO Clientes (nombre_cliente, rut, empresa, direccion, telefono, email) 
                        VALUES ('$cliente_nombre', '$cliente_rut', '$cliente_empresa', '$cliente_direccion', '$cliente_fono', '$cliente_email')";
        $conn->query($sql_cliente);
        $cliente_id = $conn->insert_id;

        // Insertar en la tabla Proyectos
        $sql_proyecto = "INSERT INTO Proyectos (codigo_proyecto, tipo_trabajo, area_trabajo, riesgo_trabajo) 
                         VALUES ('$codigo_prov', '$proyecto_nombre', '$area_trabajo', '$riesgo')";
        $conn->query($sql_proyecto);
        $proyecto_id = $conn->insert_id;

        // Insertar en la tabla Empresa
        $sql_empresa = "INSERT INTO Empresa (nombre_empresa, direccion, telefono, email, whatsapp) 
                        VALUES ('$vendedor_nombre', '', '$vendedor_fono', '$vendedor_email', '')";
        $conn->query($sql_empresa);
        $empresa_id = $conn->insert_id;

        // Calcular totales
        $total_neto = $total_servicio;
        $iva = $total_neto * 0.19;
        $total_con_iva = $total_neto + $iva;
        $descuento = 0; // Asumiendo que no hay descuento por defecto
        $total_final = $total_con_iva - $descuento;

        // Insertar en la tabla Cotizaciones
        $sql_cotizacion = "INSERT INTO Cotizaciones (numero_cotizacion, fecha_emision, fecha_validez, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega, id_cliente, id_proyecto, id_empresa, total_neto, iva, total_con_iva, descuento, total_final) 
                           VALUES (CONCAT('COT-', LPAD('$proyecto_id', 5, '0')), '$fecha_cotizacion', DATE_ADD('$fecha_cotizacion', INTERVAL $validez_cotizacion DAY), '$dias_compra', '$dias_trabajo', '$trabajadores', '$horario', '$colacion', '$entrega', '$cliente_id', '$proyecto_id', '$empresa_id', '$total_neto', '$iva', '$total_con_iva', '$descuento', '$total_final')";
        $conn->query($sql_cotizacion);
        $cotizacion_id = $conn->insert_id;

        // Insertar en la tabla Items_Cotizacion
        $sql_item_cotizacion = "INSERT INTO Items_Cotizacion (id_cotizacion, descripcion, cantidad, precio_unitario, total) 
                                VALUES ('$cotizacion_id', '$descripcion_servicio', '$cantidad', '$precio_unitario', '$total_servicio')";
        $conn->query($sql_item_cotizacion);

        $conn->commit();

        header("Location: ../ver_listado/ver_listado.php");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error al guardar la cotización: " . $e->getMessage();
    }
}
?>
