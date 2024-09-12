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
    ------------------------------------- INICIO ITred Spa Get tipo cuenta.PHP --------------------------------------
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
// Consultar tipo de cuenta
$sql_tipo_cuenta = "SELECT id_tipocuenta, tipocuenta FROM E_Tipo_Cuenta";
$result_tipo_cuenta = $mysqli->query($sql_tipo_cuenta);

// Verificar si hay resultados y generar opciones HTML
if ($result_tipo_cuenta->num_rows > 0) {
    // Opciones predeterminadas
    echo '<option value="">Seleccionar Tipo de Cuenta</option>'; 
    
    // Generar cada opción basada en los resultados de la consulta
    while ($row = $result_tipo_cuenta->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['id_tipocuenta']) . '">' . htmlspecialchars($row['tipocuenta']) . '</option>';
    }
} else {
    echo '<option value="">No hay tipos de cuenta disponibles</option>';
}

?>


     
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Get tipo cuenta .PHP -----------------------------------
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