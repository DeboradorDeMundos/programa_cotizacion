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
// Verificar si $row no es nulo antes de realizar la consulta
if ($row !== null) {
    // Consulta para obtener las condiciones generales de la empresa
    $query_condiciones = "SELECT id_condiciones, descripcion_condiciones FROM em_Condiciones_Generales WHERE id_empresa = ?";
    
    // Preparar la consulta
    if ($stmt_cond = $mysqli->prepare($query_condiciones)) {
        // Vincular el parámetro de la consulta
        $stmt_cond->bind_param('i', $id);
        // Ejecutar la consulta
        $stmt_cond->execute();
        // Obtener el resultado de la consulta
        $result_cond = $stmt_cond->get_result();
        // Obtener todas las condiciones como un arreglo asociativo
        $condiciones = $result_cond->fetch_all(MYSQLI_ASSOC);
        // Cerrar la declaración
        $stmt_cond->close();
    } else {
        // Mostrar error si no se pudo preparar la consulta
        echo "<p>Error al preparar la consulta de condiciones generales: " . $mysqli->error . "</p>";
    }
} else {
    // Mostrar mensaje si no se encontró la empresa
    echo "<p>No se encontró la empresa con el ID proporcionado.</p>";
}
?> 

<!-- TÍTULO: CHECKBOX PARA MOSTRAR/OCULTAR CONDICIONES GENERALES -->
<label>
    <input type="checkbox" id="toggle-conditions" onclick="toggleConditions()"> Agregar condiciones generales
</label>

<!-- TÍTULO: TABLA PARA CONDICIONES GENERALES -->
<table id="conditions-table" style="display: none;">
    <tr>
        <th style="background-color:lightgray" colspan="2">CONDICIONES GENERALES</th>
    </tr>
    <?php if (isset($condiciones) && !empty($condiciones)): // Verificar si $condiciones está definido ?>
        <?php foreach ($condiciones as $condicion): ?>
            <tr>
                <td>
                    <?php echo htmlspecialchars($condicion['id_condiciones']) . '.- ' . htmlspecialchars($condicion['descripcion_condiciones']); ?>
                </td>
                <td>
                    <input type="checkbox" name="condicion_check[]" value="<?php echo htmlspecialchars($condicion['id_condiciones']); ?>" />
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="2">No hay condiciones generales disponibles.</td>
        </tr>
    <?php endif; ?>
</table>

<script src="../../js/nueva_cotizacion/traer_condiciones.js"></script> 

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

