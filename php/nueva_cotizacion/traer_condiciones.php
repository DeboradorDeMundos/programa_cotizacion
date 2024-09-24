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
<label>
    <input type="checkbox" id="toggle-conditions" onclick="toggleConditions()"> Agregar condiciones generales
</label>

<table id="conditions-table" style="display: none;">
    <tr>
        <th style="background-color:lightgray" colspan="2">CONDICIONES GENERALES</th>
    </tr>
    <?php if (!empty($condiciones)): ?>
        <?php foreach ($condiciones as $condicion): ?>
            <tr>
                <td><?php echo htmlspecialchars($condicion['id_condiciones']) . '.- ' . htmlspecialchars($condicion['descripcion_condiciones']); ?></td>
                <td>
                    <!-- Checkbox para el estado de la condición -->
                    <input type="checkbox" name="condicion_check[]" <?php echo isset($condicion['estado']) && $condicion['estado'] ? 'checked' : ''; ?>/>
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
    // Muestra u oculta la tabla según el estado del checkbox
    table.style.display = checkbox.checked ? 'table' : 'none';
}
</script>


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

