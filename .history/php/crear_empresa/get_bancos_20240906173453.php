

     <?php
// Establece la conexión a la base de datos de ITred Spa
$conn = new mysqli('localhost', 'root', '', 'itredspa_bd');
?>
<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->


     <?php
// Establece la conexión a la base de datos de ITred Spa
$conn = new mysqli('localhost', 'root', '', 'itredspa_bd');


header('Content-Type: application/json');

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



