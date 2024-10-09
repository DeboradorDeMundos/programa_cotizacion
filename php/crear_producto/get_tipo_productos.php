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
    ------------------------------------- INICIO ITred Spa Get Tipo Productos .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

<?php
// Establece la conexión a la base de datos de ITred Spa
$conn = new mysqli('localhost', 'root', '', 'ITredSpa_bd');
?>
<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->

<?php

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los tipos de productos
$sql = "SELECT id_tipo_producto, tipo_producto FROM p_tipo_producto";
$result = $conn->query($sql);

// Preparar opciones para el select
$options = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value=\"" . $row["id_tipo_producto"] . "\">" . htmlspecialchars($row["tipo_producto"]) . "</option>";
    }
} else {
    $options = "<option value=\"\">No hay tipos de productos disponibles</option>";
}

echo $options;
$conn->close();
?>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Get Tipo Productos .PHP ----------------------------------------
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