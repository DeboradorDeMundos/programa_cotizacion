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
    ------------------------------------- INICIO ITred Spa pago.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->



     <fieldset id="payment-section">
    <legend>Información de pago</legend>
    <button type="button" onclick="addPayment()">Agregar Pago</button>
    <div id="payments-container">
        <!-- Aquí se agregarán dinámicamente los pagos -->
    </div>
</fieldset>



<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario para pago
    $id_cotizacion = isset($_POST['id_cotizacion']) ? intval($_POST['id_cotizacion']) : null;
    $numero_pago = isset($_POST['numero_pago']) ? intval($_POST['numero_pago']) : null;
    $pago_descripcion = isset($_POST['descripcion_pago']) ? trim($_POST['descripcion_pago']) : null;
    $porcentaje_pago = isset($_POST['porcentaje_pago']) ? floatval($_POST['porcentaje_pago']) : null;
    $monto_pago = isset($_POST['monto_pago']) ? floatval($_POST['monto_pago']) : null;
    $fecha_pago = isset($_POST['fecha_pago']) ? trim($_POST['fecha_pago']) : null;
    $forma_pago = isset($_POST['forma_pago']) ? trim($_POST['forma_pago']) : null;

    // Validar datos obligatorios
    if (is_null($id_cotizacion) || is_null($porcentaje_pago) || is_null($monto_pago) || is_null($fecha_pago) || is_null($forma_pago)) {
        die("Faltan datos obligatorios.");
    }

    // Insertar datos en la tabla pago
    $sql = "INSERT INTO C_pago (id_cotizacion, numero_pago, descripcion, porcentaje_pago, monto_pago, fecha_pago, forma_pago)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $mysqli->error);
    }

    // Asignar los parámetros de forma correcta
    $stmt->bind_param("iisdiss", $id_cotizacion, $numero_pago, $pago_descripcion, $porcentaje_pago, $monto_pago, $fecha_pago, $forma_pago);

    // Ejecutar la consulta y manejar posibles errores
    if ($stmt->execute()) {
        echo "Pago insertado correctamente. ID: " . $stmt->insert_id;
    } else {
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }

    $stmt->close();
}

?>




     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa pago.PHP ----------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->
