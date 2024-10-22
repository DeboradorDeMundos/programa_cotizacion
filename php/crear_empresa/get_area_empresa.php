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
    ------------------------------------- INICIO ITred Spa Get Area Empresa .PHP --------------------------------------
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

     <?php
// Consulta para obtener las áreas de empresa
$query = "SELECT id_area, nombre_area FROM Tp_Area";
$result = $mysqli->query($query);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {

    echo '<option value="">Seleccionar Area</option>';
    // Recorrer los resultados y crear opciones en el select
    while ($row = $result->fetch_assoc()) {
        // Mostrar solo el nombre en el texto de la opción, con el valor como id_area_empresa
        echo '<option value="' . htmlspecialchars($row['id_area']) . '">' . htmlspecialchars($row['nombre_area']) . '</option>';
    }
} else {
    // Si no hay áreas, mostrar mensaje en el select
    echo "<option value=''>No hay áreas disponibles</option>";
}
?>




<!-- ---------------------
-- INICIO CIERRE CONEXION BD --
--------------------- -->
<?php
$mysqli->close();
?>
<!-- ---------------------
     -- FIN CIERRE CONEXION BD --
     --------------------- -->


<!-- ----------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Get Area Empresa .PHP ----------------------------------------
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