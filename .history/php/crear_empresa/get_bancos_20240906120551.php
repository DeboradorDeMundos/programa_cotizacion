<?php
header('Content-Type: application/json');


// Crear la conexión
$conn = new mysqli('localhost','root','','itredspa_bd');

// Consultar bancos
$sql_bancos = "SELECT id_banco, nombre_banco FROM E_Bancos";
$result_bancos = $conn->query($sql_bancos);

$bancos = [];

// Procesar resultados de bancos
if ($result_bancos->num_rows > 0) {
    while ($row = $result_bancos->fetch_assoc()) {
        $bancos[] = $row;
    }
}

$conn->close();

// Enviar datos en formato JSON
echo json_encode($bancos);
?>



<!-- ------------------------------------------------------------------------------------------------------------
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
