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
    ------------------------------------- INICIO ITred Spa Get Tipos Cuenta.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$conn = new mysqli('localhost', 'root', '', 'itredspa_bd');
?>



<?php
header('Content-Type: application/json');

// Crear la conexión
$conn = new mysqli('localhost','root','','itredspa_bd');


// Consultar tipo de cuenta
$sql_tipo_cuenta = "SELECT id_tipocuenta, tipocuenta FROM E_Tipo_Cuenta";
$result_tipo_cuenta = $conn->query($sql_tipo_cuenta);

$tipos_cuenta = [];

// Procesar resultados de tipo de cuenta
if ($result_tipo_cuenta->num_rows > 0) {
    while ($row = $result_tipo_cuenta->fetch_assoc()) {
        $tipos_cuenta[] = $row;
    }
}

$conn->close();

// Enviar datos en formato JSON
echo json_encode($tipos_cuenta);
?>

