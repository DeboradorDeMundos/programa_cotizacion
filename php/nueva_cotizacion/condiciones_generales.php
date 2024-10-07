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
    ------------------------------------- INICIO ITred Spa Condiciones generales.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

    <?php
if ($row !== null) {
    // Consulta para obtener las condiciones generales
    $query_condiciones = "SELECT id_condiciones, descripcion_condiciones FROM C_Condiciones_Generales WHERE id_empresa = ?";
    if ($stmt_cond = $mysqli->prepare($query_condiciones)) {
        $stmt_cond->bind_param('i', $id);
        $stmt_cond->execute();
        $result_cond = $stmt_cond->get_result();
        $condiciones = $result_cond->fetch_all(MYSQLI_ASSOC);
        $stmt_cond->close();
    } else {
        echo "<p>Error al preparar la consulta de condiciones generales: " . $mysqli->error . "</p>";
    }
    } else {
        echo "<p>No se encontró la empresa con el ID proporcionado.</p>";
}
?> 

<div id="condiciones-generales" class="data-box">
    <h3>Condiciones Generales</h3>
    <div class="field">
        <label for="descripcion_condiciones">Descripción:</label>
        <input type="text" id="descripcion_condiciones" name="descripcion_condiciones[]" placeholder="Descripción de la condición" required>
        <input type="checkbox" id="estado_condiciones" name="estado_condiciones[]">
    </div>
</div>






     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa condiciones generales.PHP ----------------------------------------
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
