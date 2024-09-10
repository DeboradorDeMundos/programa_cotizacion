<?php
// Incluye el archivo de conexión a la base de datos
include '../../index.php';  // Asegúrate de que la ruta a tu archivo de conexión sea correcta

// Verifica que el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene los datos del formulario
    $numero_cotizacion = $_POST['numero_cotizacion'];
    $fecha_emision = $_POST['fecha_emision'];
    $fecha_validez = $_POST['fecha_validez'];
    $dias_compra = $_POST['dias_compra'];
    $dias_trabajo = $_POST['dias_trabajo'];
    $trabajadores = $_POST['trabajadores'];
    $horario = $_POST['horario'];
    $colacion = $_POST['colacion'];
    $entrega = $_POST['entrega'];
    $id_cliente = $_POST['id_cliente'];
    $id_proyecto = $_POST['id_proyecto'];
    $id_empresa = $_POST['id_empresa'];
    $total_neto = $_POST['total_neto'];
    $iva = $_POST['iva'];
    $total_con_iva = $_POST['total_con_iva'];
    $descuento = $_POST['descuento'];
    $total_final = $_POST['total_final'];

    // Prepara la consulta SQL
    $sql = "INSERT INTO Cotizaciones (numero_cotizacion, fecha_emision, fecha_validez, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega, id_cliente, id_proyecto, id_empresa, total_neto, iva, total_con_iva, descuento, total_final) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara la sentencia
    if ($stmt = $mysqli->prepare($sql)) {
        // Vincula los parámetros
        $stmt->bind_param('ssssssisiiiidddd', 
            $numero_cotizacion, 
            $fecha_emision, 
            $fecha_validez, 
            $dias_compra, 
            $dias_trabajo, 
            $trabajadores, 
            $horario, 
            $colacion, 
            $entrega, 
            $id_cliente, 
            $id_proyecto, 
            $id_empresa, 
            $total_neto, 
            $iva, 
            $total_con_iva, 
            $descuento, 
            $total_final
        );

        // Ejecuta la sentencia
        if ($stmt->execute()) {
            echo 'Cotización guardada correctamente.';
        } else {
            echo 'Error al guardar la cotización: ' . $stmt->error;
        }

        // Cierra la sentencia
        $stmt->close();
    } else {
        echo 'Error al preparar la consulta: ' . $mysqli->error;
    }

    // Cierra la conexión
    $mysqli->close();
} else {
    echo 'Método de solicitud no permitido.';
}
?>
