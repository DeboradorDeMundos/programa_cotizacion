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
    ------------------------------------- INICIO ITred Spa Obligaciones cliente .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->


<!-- Checkbox para mostrar/ocultar obligaciones del cliente --> 
<label>
    <input type="checkbox" id="toggle-obligaciones" onclick="toggleObligaciones()"> Mostrar obligaciones del cliente
</label>

<!-- Tabla para las obligaciones del cliente -->
<table id="obligaciones-table" style="display: none;">
    <tr>
        <th style="background-color:lightgray" colspan="2">OBLIGACIONES DEL CLIENTE</th>
    </tr>
    <?php if (!empty($obligaciones)): ?>
        <?php foreach ($obligaciones as $obligacion): ?>
            <tr>
                <td>
                    <?php echo htmlspecialchars($obligacion['indice']) . '.- ' . htmlspecialchars($obligacion['descripcion']); ?>
                </td>
                <td>
                    <input type="checkbox" name="obligacion_check[]" <?php echo $obligacion['estado'] ? 'checked' : ''; ?>/>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="2">No hay obligaciones del cliente disponibles.</td>
        </tr>
    <?php endif; ?>
</table>

<script>
function toggleObligaciones() {
    const checkbox = document.getElementById('toggle-obligaciones');
    const table = document.getElementById('obligaciones-table');
    // Muestra u oculta la tabla según el estado del checkbox
    table.style.display = checkbox.checked ? 'table' : 'none';
}
</script>

     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Obligaciones cliente .PHP ----------------------------------------
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
