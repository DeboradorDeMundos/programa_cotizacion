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
    ------------------------------------- INICIO ITred Spa Obligaciones cliente .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

    <?php
// Inicializar variables para mensajes
$mensaje_error = '';
$mensaje_exito = '';

// Consulta para obtener las obligaciones del cliente
$query_obligaciones = "SELECT oc.id, oc.indice, oc.descripcion, oc.estado
                        FROM C_Cotizaciones cot
                        JOIN E_obligaciones_cliente oc ON oc.id_empresa = cot.id_empresa
                        WHERE cot.id_cotizacion = ?";
if ($stmt_obligaciones = $mysqli->prepare($query_obligaciones)) {
    $stmt_obligaciones->bind_param('i', $id_cotizacion);
    $stmt_obligaciones->execute();
    $result_obligaciones = $stmt_obligaciones->get_result();
    $obligaciones_todas = $result_obligaciones->fetch_all(MYSQLI_ASSOC);
    $stmt_obligaciones->close();

    if (empty($obligaciones_todas)) {
        $mensaje_error = "<p>No hay obligaciones del cliente disponibles.</p>";
    }
} else {
    $mensaje_error = "<p>Error al preparar la consulta de obligaciones del cliente: " . $mysqli->error . "</p>";
}

// Consulta para obtener las obligaciones seleccionadas
$query_obligaciones_seleccionadas = "
    SELECT r.id, r.indice, r.descripcion
    FROM e_obligaciones_cliente AS r
    JOIN c_cotizaciones_obligaciones AS cr ON r.id = cr.id_obligacion
    WHERE cr.id_cotizacion = ?
";

// Preparar y ejecutar la consulta para obtener obligaciones seleccionadas
$stmt_obligaciones_seleccionadas = $mysqli->prepare($query_obligaciones_seleccionadas);
$stmt_obligaciones_seleccionadas->bind_param("i", $id_cotizacion);
$stmt_obligaciones_seleccionadas->execute();
$result_obligaciones_seleccionadas = $stmt_obligaciones_seleccionadas->get_result();

// Verificar si hay resultados de obligaciones seleccionadas
$obligaciones_seleccionadas = [];
if ($result_obligaciones_seleccionadas->num_rows > 0) {
    while ($row = $result_obligaciones_seleccionadas->fetch_assoc()) {
        $obligaciones_seleccionadas[] = $row; // Guardar las obligaciones seleccionadas en el array
    }
} else {
    $mensaje_error .= "<p>No se encontraron obligaciones seleccionadas para esta cotización.</p>";
}

// Cerrar la conexión de la consulta de obligaciones seleccionadas
$stmt_obligaciones_seleccionadas->close();
?>

<!-- Checkbox para mostrar/ocultar obligaciones del cliente --> 
<link rel="stylesheet" href="../../css/ver_cotizacion/obligaciones_cliente.css">
<!-- Título: Checkbox para mostrar obligaciones del cliente -->
<label>
    <input type="checkbox" id="toggle-obligaciones" onclick="toggleObligaciones()"> Mostrar obligaciones del cliente
</label>

<!-- Título: Tabla de obligaciones del cliente -->
<table id="obligaciones-table" style="display: none;">
    <!-- Título: Encabezado de la tabla -->
    <tr>
        <th style="background-color:lightgray" colspan="2">OBLIGACIONES DEL CLIENTE</th>
    </tr>
    <?php if (!empty($obligaciones_todas)): ?>
        <?php foreach ($obligaciones_todas as $obligacion): ?>
            <!-- Título: Fila de obligación -->
            <tr>
                <td>
                    <!-- Título: Descripción de la obligación -->
                    <?php echo htmlspecialchars($obligacion['indice']) . '.- ' . htmlspecialchars($obligacion['descripcion']); ?>
                </td>
                <td>
                    <!-- Título: Checkbox de selección de obligación -->
                    <input type="checkbox" name="obligacion_check[]" value="<?php echo htmlspecialchars($obligacion['id']); ?>"
                        <?php echo in_array($obligacion['id'], array_column($obligaciones_seleccionadas, 'id')) ? 'checked' : ''; ?> />
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Título: Mensaje de error -->
        <tr>
            <td colspan="2"><?php echo $mensaje_error; ?></td>
        </tr>
    <?php endif; ?>
</table>

<script src="../../js/ver_cotizacion/obligaciones_cliente.js"></script> 

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ahora manejamos las obligaciones del cliente seleccionadas
    if (!empty($_POST['obligacion_check'])) {
        $obligaciones_seleccionadas = $_POST['obligacion_check']; // Obligaciones marcadas
        
        // Elimina cualquier obligación previamente almacenada para esta cotización
        $sql_delete = "DELETE FROM c_cotizaciones_obligaciones WHERE id_cotizacion = ?";
        if ($stmt_delete = $mysqli->prepare($sql_delete)) {
            $stmt_delete->bind_param('i', $id_cotizacion);
            $stmt_delete->execute();
            $stmt_delete->close();
        } else {
            $mensaje_error .= "<p>Error al preparar la eliminación de obligaciones: " . $mysqli->error . "</p>";
        }

        // Inserta las nuevas obligaciones seleccionadas
        $sql_insert = "INSERT INTO c_cotizaciones_obligaciones (id_cotizacion, id_obligacion) VALUES (?, ?)";
        if ($stmt_insert = $mysqli->prepare($sql_insert)) {
            foreach ($obligaciones_seleccionadas as $id_obligacion) {
                $stmt_insert->bind_param('ii', $id_cotizacion, $id_obligacion);
                $stmt_insert->execute();
            }
            $stmt_insert->close();
            $mensaje_exito = "Obligaciones del cliente guardadas correctamente.";
        } else {
            $mensaje_error .= "<p>Error al preparar la inserción de obligaciones: " . $mysqli->error . "</p>";
        }
    } else {
        $mensaje_error .= "<p>No se seleccionaron obligaciones del cliente.</p>";
    }
}
?>

<!-- Mostrar mensajes de error o éxito -->
<?php if (!empty($mensaje_error)): ?>
    <div class="error-message"><?php echo $mensaje_error; ?></div>
<?php endif; ?>

<?php if (!empty($mensaje_exito)): ?>
    <div class="success-message"><?php echo $mensaje_exito; ?></div>
<?php endif; ?>

     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Obligaciones cliente .PHP ----------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->
