<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->

<!-- ------------------------------------------------------------------------------------------------------------
    ------------------------------------- INICIO ITred Spa Traer traer_pago .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

    <?php
$pagos = [];

if (isset($_GET['id']) && intval($_GET['id']) > 0) {
    $id_cotizacion = intval($_GET['id']);
    $sql_pagos = "SELECT numero_pago, descripcion, porcentaje_pago, monto_pago, fecha_pago 
                  FROM C_pago 
                  WHERE id_cotizacion = ?";

    $stmt = $mysqli->prepare($sql_pagos);
    $stmt->bind_param("i", $id_cotizacion);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $pagos = $result->fetch_all(MYSQLI_ASSOC); // Almacenar los pagos en un arreglo
    } else {
        echo "Error al obtener los pagos: " . $stmt->error;
    }

    $stmt->close();
}
?>

<?php

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asegúrate de que los datos sean arrays y no estén vacíos
    $numero_pago_array = isset($_POST['numero_pago']) ? $_POST['numero_pago'] : [];
    $pago_descripcion_array = isset($_POST['descripcion_pago']) ? $_POST['descripcion_pago'] : [];
    $porcentaje_pago_array = isset($_POST['porcentaje_pago']) ? $_POST['porcentaje_pago'] : [];
    $monto_pago_array = isset($_POST['monto_pago']) ? $_POST['monto_pago'] : [];
    $fecha_pago_array = isset($_POST['fecha_pago']) ? $_POST['fecha_pago'] : [];

    // Asegúrate de que haya datos en los arreglos
    if (empty($numero_pago_array) || empty($pago_descripcion_array) || empty($porcentaje_pago_array) || empty($monto_pago_array) || empty($fecha_pago_array)) {
        die("Faltan datos obligatorios.");
    }

    // Iterar sobre los datos del formulario
    foreach ($numero_pago_array as $index => $numero_pago) {
        // Recuperar los datos para esta iteración
        $pago_descripcion = isset($pago_descripcion_array[$index]) ? trim($pago_descripcion_array[$index]) : null;
        $porcentaje_pago = isset($porcentaje_pago_array[$index]) ? floatval($porcentaje_pago_array[$index]) : null;
        $monto_pago = isset($monto_pago_array[$index]) ? floatval($monto_pago_array[$index]) : null;
        $fecha_pago = isset($fecha_pago_array[$index]) ? trim($fecha_pago_array[$index]) : null;

        // Validar datos obligatorios para esta iteración
        if (is_null($numero_pago) || is_null($porcentaje_pago) || is_null($monto_pago) || is_null($fecha_pago)) {
            die("Faltan datos obligatorios en una de las entradas.");
        }

        // Insertar o actualizar datos en la tabla traer_pago
        $sql = "INSERT INTO C_pago (id_cotizacion, numero_pago, descripcion, porcentaje_pago, monto_pago, fecha_pago)
                VALUES (?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                descripcion = VALUES(descripcion), 
                porcentaje_pago = VALUES(porcentaje_pago), 
                monto_pago = VALUES(monto_pago), 
                fecha_pago = VALUES(fecha_pago)";
        
        $stmt = $mysqli->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $mysqli->error);
        }

        // Asignar los parámetros de forma correcta
        $stmt->bind_param("iisdis", $id_cotizacion, $numero_pago, $pago_descripcion, $porcentaje_pago, $monto_pago, $fecha_pago);

        // Ejecutar la consulta y manejar posibles errores
        if ($stmt->execute()) {
            echo "Pago insertado o actualizado correctamente. ID: " . $stmt->insert_id . "<br>";
        } else {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }
    }

    $stmt->close();
}

?>

<link rel="stylesheet" href="../../css/ver_cotizacion/traer_pago.css">
<!-- Título: Sección de información de pagos -->
<fieldset id="payment-section">
    <legend>Información de Pagos</legend>
    <!-- Título: Botón para agregar un nuevo pago -->
    <button type="button" onclick="AgregarPago()">Agregar Pago</button>
    
    <!-- Título: Tabla de pagos -->
    <table id="payment-table" <?php if (count($pagos) > 0) { echo 'style="display:table;"'; } else { echo 'style="display:none;"'; } ?>>
        <thead>
            <tr>
                <!-- Título: Cabecera de N° Pago -->
                <th>N° Pago</th>
                <!-- Título: Cabecera de Descripción de Pago -->
                <th>Descripción de Pago</th>
                <!-- Título: Cabecera de % De Pago -->
                <th>% De Pago</th>
                <!-- Título: Cabecera de Monto de Pago -->
                <th>Monto de Pago</th>
                <!-- Título: Cabecera de Fecha de Pago -->
                <th>Fecha de Pago</th>
                <!-- Título: Cabecera de Acción -->
                <th>Acción</th>
            </tr>
        </thead>
        <tbody id="payments-contenedor">
            <?php if (!empty($pagos)): ?>
                <?php foreach ($pagos as $pago): ?>
                    <tr>
                        <!-- Título: Número de pago (solo lectura) -->
                        <td>
                            <input type="hidden" name="numero_pago[]" value="<?php echo htmlspecialchars($pago['numero_pago']); ?>">
                            <?php echo htmlspecialchars($pago['numero_pago']); ?>
                        </td>
                        <!-- Título: Descripción editable -->
                        <td>
                            <input type="text" name="descripcion_pago[]" value="<?php echo htmlspecialchars($pago['descripcion']); ?>">
                        </td>
                        <!-- Título: Porcentaje de pago editable -->
                        <td>
                            <input type="number" name="porcentaje_pago[]" value="<?php echo htmlspecialchars($pago['porcentaje_pago']); ?>" step="0.01" min="0">
                        </td>
                        <!-- Título: Monto editable -->
                        <td>
                            <input type="number" name="monto_pago[]" value="<?php echo htmlspecialchars($pago['monto_pago']); ?>" step="0.01" min="0">
                        </td>
                        <!-- Título: Fecha editable -->
                        <td>
                            <input type="date" name="fecha_pago[]" value="<?php echo htmlspecialchars($pago['fecha_pago']); ?>">
                        </td>
                        <!-- Título: Acción para eliminar el pago -->
                        <td>
                            <button type="button" onclick="EliminarPago(<?php echo $pago['numero_pago']; ?>)">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <!-- Título: Mensaje cuando no hay pagos registrados -->
                    <td colspan="6">No hay pagos registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</fieldset>

<script src="../../js/ver_cotizacion/traer_pago.js"></script>

