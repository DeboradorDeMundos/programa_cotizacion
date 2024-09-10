<?php
include '../db_config.php';

// Obtener datos de la base de datos
$sql = "SELECT * FROM nombre_proyecto ORDER BY ID DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los datos
    $row = $result->fetch_assoc();
    echo "<h1>Cotización Generada</h1>";
    echo "<p>Proyecto: " . $row['nombre'] . "</p>";
    // Mostrar más datos si es necesario
} else {
    echo "No se encontraron cotizaciones.";
}

$conn->close();
?>
