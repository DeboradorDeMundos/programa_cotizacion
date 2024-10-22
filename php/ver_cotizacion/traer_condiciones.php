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
    ------------------------------------- INICIO ITred Spa Traer condiciones.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
    <?php
// Verificar si $items no es nulo antes de realizar la consulta
if ($items !== null) {
    // Consulta para obtener todas las condiciones generales de la empresa
    $query_condiciones = "SELECT 
                            con.id_condiciones, 
                            con.descripcion_condiciones 
                            FROM C_Cotizaciones cot
                            JOIN  C_Condiciones_Generales con on con.id_empresa = cot.id_empresa
                            WHERE cot.id_cotizacion = ?";
    
    // Preparar la consulta
    if ($stmt_cond = $mysqli->prepare($query_condiciones)) {
        // Vincular el parámetro de la consulta
        $stmt_cond->bind_param('i', $id_cotizacion);
        // Ejecutar la consulta
        if ($stmt_cond->execute()) {
            // Obtener el resultado de la consulta
            $result_cond = $stmt_cond->get_result();
            // Obtener todas las condiciones como un arreglo asociativo
            $condiciones = $result_cond->fetch_all(MYSQLI_ASSOC);
            
            // Cerrar la declaración
            $stmt_cond->close();
        } else {
            // Mostrar error si la consulta falla
            echo "<p>Error al ejecutar la consulta de condiciones generales: " . $stmt_cond->error . "</p>";
        }
    } else {
        // Mostrar error si no se pudo preparar la consulta
        echo "<p>Error al preparar la consulta de condiciones generales: " . $mysqli->error . "</p>";
    }
} else {
    // Mostrar mensaje si no se encontró la empresa
    echo "<p>No se encontró la empresa con el ID proporcionado.</p>";
}

// Consulta para obtener las condiciones seleccionadas de la cotización
$query_condiciones_seleccionadas = "SELECT con.id_condiciones                             
                                    FROM C_Cotizaciones cot
                                    JOIN  c_cotizacion_condiciones con on con.id_cotizacion = cot.id_cotizacion
                                    WHERE cot.id_cotizacion = ?";

// Preparar la consulta
if ($stmt_seleccionadas = $mysqli->prepare($query_condiciones_seleccionadas)) {
    // Vincular el parámetro de la consulta
    $stmt_seleccionadas->bind_param('i', $id_cotizacion);
    // Ejecutar la consulta
    if ($stmt_seleccionadas->execute()) {
        $result_seleccionadas = $stmt_seleccionadas->get_result();

        // Almacenar las condiciones seleccionadas en un array
        $condiciones_seleccionadas = [];
        while ($row_seleccionada = $result_seleccionadas->fetch_assoc()) {
            $condiciones_seleccionadas[] = $row_seleccionada['id_condiciones'];
        }

        $stmt_seleccionadas->close();
    } else {
        // Mostrar error si la consulta falla
        echo "<p>Error al ejecutar la consulta de condiciones seleccionadas: " . $stmt_seleccionadas->error . "</p>";
    }
} else {
    // Mostrar error si no se pudo preparar la consulta
    echo "<p>Error al preparar la consulta de condiciones seleccionadas: " . $mysqli->error . "</p>";
}
?>

<!-- TÍTULO: CHECKBOX PARA MOSTRAR/OCULTAR CONDICIONES GENERALES -->
<!-- Checkbox para mostrar/ocultar condiciones generales -->
<label>
    <input type="checkbox" id="toggle-conditions" onclick="toggleConditions()"> Agregar condiciones generales
</label>

<!-- TÍTULO: TABLA PARA LAS CONDICIONES GENERALES -->
<!-- Tabla para las condiciones generales -->
<table id="conditions-table" style="display: none;">
    <!-- TÍTULO: ENCABEZADO DE LA TABLA -->
    <!-- Encabezado de la tabla -->
    <tr>
        <th style="background-color:lightgray" colspan="2">CONDICIONES GENERALES</th>
    </tr>
    <!-- TÍTULO: VERIFICACIÓN DE CONDICIONES DISPONIBLES -->
    <?php if (isset($condiciones) && !empty($condiciones)): ?>
        <!-- TÍTULO: ITERACIÓN SOBRE LAS CONDICIONES -->
        <?php foreach ($condiciones as $condicion): ?>
            <tr>
                <!-- TÍTULO: CELDA DE DESCRIPCIÓN DE LA CONDICIÓN -->
                <td>
                    <?php echo htmlspecialchars($condicion['id_condiciones']) . '.- ' . htmlspecialchars($condicion['descripcion_condiciones']); ?>
                </td>
                <!-- TÍTULO: CELDA DE CHECKBOX PARA LA CONDICIÓN -->
                <td>
                    <input type="checkbox" name="condicion_check[]" value="<?php echo htmlspecialchars($condicion['id_condiciones']); ?>"
                        <?php echo in_array($condicion['id_condiciones'], $condiciones_seleccionadas) ? 'checked' : ''; ?> />
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- TÍTULO: MENSAJE CUANDO NO HAY CONDICIONES DISPONIBLES -->
        <tr>
            <td colspan="2">No hay condiciones generales disponibles.</td>
        </tr>
    <?php endif; ?>
</table>

<script src="../../js/ver_cotizacion/traer_condiciones.js"></script> 

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ahora manejamos las condiciones generales seleccionadas
    if (!empty($_POST['condicion_check'])) {
        $condiciones_seleccionadas = $_POST['condicion_check']; // Condiciones marcadas
        
        // Elimina cualquier condición previamente almacenada para esta cotización en la tabla c_cotizacion_condiciones
        $sql_delete = "DELETE FROM c_cotizacion_condiciones WHERE id_cotizacion = ?";
        $stmt_delete = $mysqli->prepare($sql_delete);
        $stmt_delete->bind_param('i', $id_cotizacion);
        $stmt_delete->execute();

        // Inserta las nuevas condiciones seleccionadas en c_cotizacion_condiciones
        $sql_insert = "INSERT INTO c_cotizacion_condiciones (id_cotizacion, id_condiciones) VALUES (?, ?)";
        $stmt_insert = $mysqli->prepare($sql_insert);

        foreach ($condiciones_seleccionadas as $id_condicion) {
            $stmt_insert->bind_param('ii', $id_cotizacion, $id_condicion);
            $stmt_insert->execute();
        }

        $stmt_insert->close();
    }
    
    echo "Cotización y condiciones generales guardadas correctamente.";
}
?>

     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Traer condiciones.PHP ----------------------------------------
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

