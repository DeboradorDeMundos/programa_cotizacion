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
    }
} 
?> 

<!-- TÍTULO: CONTENEDOR DE CONDICIONES GENERALES -->
<div id="condiciones-generales" class="cuadro-datos">
    <!-- TÍTULO: ENCABEZADO DE CONDICIONES GENERALES -->
    <h3>Condiciones Generales</h3>
    <div class="field">
        <!-- TÍTULO: CAMPO DE DESCRIPCIÓN -->
        <label for="descripcion_condiciones">Descripción:</label>
        <!-- TÍTULO: CAMPO PARA INGRESAR DESCRIPCIÓN DE LA CONDICIÓN -->
        <!-- Campo para ingresar la descripción de la condición -->
        <input type="text" id="descripcion_condiciones" name="descripcion_condiciones[]" placeholder="Descripción de la condición" required>
        <!-- TÍTULO: CHECKBOX PARA ESTADO DE LA CONDICIÓN -->
        <!-- Checkbox para indicar el estado de la condición -->
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
