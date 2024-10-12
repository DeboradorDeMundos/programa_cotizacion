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
    // Consulta para obtener las obligaciones del cliente
    $query_obligaciones = "SELECT id, indice, descripcion, estado FROM E_obligaciones_cliente WHERE id_empresa = ?";
    if ($stmt_obligaciones = $mysqli->prepare($query_obligaciones)) {
        $stmt_obligaciones->bind_param('i', $id);
        $stmt_obligaciones->execute();
        $result_obligaciones = $stmt_obligaciones->get_result();
        $obligaciones = $result_obligaciones->fetch_all(MYSQLI_ASSOC);
        $stmt_obligaciones->close();
    } else {
        echo "<p>Error al preparar la consulta de obligaciones del cliente: " . $mysqli->error . "</p>";
    }
?> 
<!-- Checkbox para mostrar/ocultar obligaciones del cliente --> 
<link rel="stylesheet" href="../../css/ver_cotizacion/obligaciones_cliente.css">
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
                    <input type="checkbox" name="obligacion_check[]" value="<?php echo htmlspecialchars($obligacion['id']); ?>" />
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="2">No hay obligaciones del cliente disponibles.</td>
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
        $stmt_delete = $mysqli->prepare($sql_delete);
        $stmt_delete->bind_param('i', $id_cotizacion);
        $stmt_delete->execute();

        // Inserta las nuevas obligaciones seleccionadas
        $sql_insert = "INSERT INTO c_cotizaciones_obligaciones (id_cotizacion, id_obligacion) VALUES (?, ?)";
        $stmt_insert = $mysqli->prepare($sql_insert);

        foreach ($obligaciones_seleccionadas as $id_obligacion) {
            $stmt_insert->bind_param('ii', $id_cotizacion, $id_obligacion);
            $stmt_insert->execute();
        }

        $stmt_insert->close();
    }
    
    // Continuar con el resto del flujo de creación de la cotización
    echo "obligaciones del cliente guardadas correctamente.";
}
?>

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
