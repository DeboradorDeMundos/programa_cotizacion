<?php
header('Content-Type: application/json');


// Crear la conexión
$conn = new mysqli('localhost','root','','itredspa_bd');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

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
