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
    ------------------------------------- INICIO ITred Spa Traer condiciones.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- Checkbox para mostrar/ocultar condiciones generales -->
<!-- Checkbox para mostrar/ocultar condiciones generales -->
<label>
    <input type="checkbox" id="toggle-conditions" onclick="toggleConditions()"> Agregar condiciones generales
</label>

<!-- Tabla para las condiciones generales -->
<table id="conditions-table" style="display: none;">
    <tr>
        <th style="background-color:lightgray" colspan="2">CONDICIONES GENERALES</th>
    </tr>
    <?php if (!empty($condiciones)): ?>
        <?php foreach ($condiciones as $condicion): ?>
            <tr>
                <td><?php echo htmlspecialchars($condicion['id_condiciones']) . '.- ' . htmlspecialchars($condicion['descripcion_condiciones']); ?></td>
                <td>
                    <input type="checkbox" name="condicion_check[]" value="<?php echo $condicion['id_condiciones']; ?>" />
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="2">No hay condiciones generales disponibles.</td>
        </tr>
    <?php endif; ?>
</table>

<script>
function toggleConditions() {
    const checkbox = document.getElementById('toggle-conditions');
    const table = document.getElementById('conditions-table');
    table.style.display = checkbox.checked ? 'table' : 'none';
}
</script>

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
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->

