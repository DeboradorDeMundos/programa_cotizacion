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
    ------------------------------------- INICIO ITred Spa Get Bancos.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->


<?php
// Consultar bancos
$sql_bancos = "SELECT id_banco, nombre_banco FROM E_Bancos";
$result_bancos = $mysqli->query($sql_bancos);

// Verificar si hay resultados y generar opciones HTML
if ($result_bancos->num_rows > 0) {
    // Opción predeterminada
    echo '<option value="">Seleccionar Banco</option>';
    
    // Generar cada opción basada en los resultados de la consulta
    while ($row = $result_bancos->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['id_banco']) . '">' . htmlspecialchars($row['nombre_banco']) . '</option>';
    }
} else {
    echo '<option value="">No hay bancos disponibles</option>';
}
?>




<!-- ----------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Get Bancos .PHP ----------------------------------------
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
