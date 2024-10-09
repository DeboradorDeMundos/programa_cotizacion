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
    ------------------------------------- INICIO ITred Spa Traer pago .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->
     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd');
?>
<!-- ---------------------
// FIN CONEXION BD --
// --------------------- -->

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

        // Insertar o actualizar datos en la tabla pago
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Pago</title>
    <script>
    function addPayment() {
        // Contenedor donde se agregan los pagos
        const contenedor = document.getElementById('payments-contenedor');
    
        // Crear un nuevo bloque de pago
        const paymentBlock = document.createElement('div');
        paymentBlock.classList.add('payment-block');
    
        // Generar el HTML para un nuevo pago
        paymentBlock.innerHTML = `
            <hr>
            <h4>Pago</h4>
            <label>N° Pago:</label>
            <input type="number" name="numero_pago[]" required>
            <label>Descripción de pago:</label>
            <textarea name="descripcion_pago[]" placeholder="Descripción del pago"></textarea>
            <label>% De pago:</label>
            <input type="number" id="porcentaje-pago" name="porcentaje_pago[]" min="0" max="100" required oninput="calcularPago(this)">
            <label>Monto de pago:</label>
            <input type="number" id="monto-pago" name="monto_pago[]" min="0" required readonly>
            <label>Fecha de pago:</label>
            <input type="date" name="fecha_pago[]" required>
        `;
    
        // Agregar el bloque al contenedor
        contenedor.appendChild(paymentBlock);
    }
    
    function calcularPago() {
        // Obtén los elementos del DOM
        const porcentajePagoInput = document.getElementById('porcentaje-pago');
        const totalFinalInput = document.getElementById('total_final');
        const montoPagoInput = document.getElementById('monto-pago');
    
        // Lee los valores y asigna 0 si no están presentes o son inválidos
        const porcentajeAdelanto = parseFloat(porcentajePagoInput ? porcentajePagoInput.value : 0) || 0;
        const totalFinal = parseFloat(totalFinalInput ? totalFinalInput.value : 0) || 0;
    
        // Calcula el monto del adelanto
        const montoAdelanto = (totalFinal * (porcentajeAdelanto / 100)).toFixed(2);
    
        // Asigna el monto calculado al campo correspondiente
        if (montoPagoInput) {
            montoPagoInput.value = montoAdelanto;
        } else {
            console.error("El elemento 'monto-pago' no está disponible en el DOM.");
        }
    }
    </script>
</head>
<body>
    <form method="POST">
        <fieldset id="payment-section">
            <legend>Información de pago</legend>
            <button type="button" onclick="addPayment()">Agregar Pago</button>
            <div id="payments-contenedor">
                <?php
                if (!empty($pagos)) {
                    foreach ($pagos as $index => $pago) {
                        ?>
                        <div class="payment-block">
                            <hr>
                            <h4>Pago <?php echo $pago['numero_pago']; ?></h4>
                            <label>N° Pago:</label>
                            <input type="number" name="numero_pago[]" value="<?php echo $pago['numero_pago']; ?>" required>
                            <label>Descripción de pago:</label>
                            <textarea name="descripcion_pago[]" placeholder="Descripción del pago"><?php echo $pago['descripcion']; ?></textarea>
                            <label>% De pago:</label>
                            <input type="number" id="porcentaje-pago-<?php echo $index; ?>" name="porcentaje_pago[]" value="<?php echo $pago['porcentaje_pago']; ?>" min="0" max="100" required oninput="calcularPago(this)">
                            <label>Monto de pago:</label>
                            <input type="number" id="monto-pago-<?php echo $index; ?>" name="monto_pago[]" value="<?php echo $pago['monto_pago']; ?>" readonly>
                            <label>Fecha de pago:</label>
                            <input type="date" name="fecha_pago[]" value="<?php echo $pago['fecha_pago']; ?>" required>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </fieldset>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>