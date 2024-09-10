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
    ------------------------------------- INICIO ITred Spa Requisitos basicos.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');
?>
<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->


<!-- falta php de esta funcion -->

<h2>Requisitos basicos</h2>
<div id="requisito-container">
    
        <!-- Aquí se agregarán dinámicamente las filas de condiciones -->
</div>

<div style="margin-top: 10px;">
    <button id="add-requisito-btn" type="button">Agregar nuevo requisito</button>
    <button id="remove-requisito-btn" type="button" style="display: none;">Eliminar último requisito</button>
</div>

<!-- ---------------------
-- INICIO CIERRE CONEXION BD --
     --------------------- -->
     <?php
     $mysqli->close();
?>
<!-- ---------------------
     -- FIN CIERRE CONEXION BD --
     --------------------- -->


<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Requisitos basicos .PHP ----------------------------------------
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
