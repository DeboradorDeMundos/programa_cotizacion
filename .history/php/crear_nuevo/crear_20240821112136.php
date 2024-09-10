<?php
include '../db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proyecto = $conn->real_escape_string($_POST['proyecto']);
    $cod_prov = $conn->real_escape_string($_POST['cod_prov']);
    $cliente_empresa = $conn->real_escape_string($_POST['cliente_empresa']);
    $cliente_rut = $conn->real_escape_string($_POST['cliente_rut']);
    $cliente_direccion = $conn->real_escape_string($_POST['cliente_direccion']);
    $cliente_fono = $conn->real_escape_string($_POST['cliente_fono']);
    $cliente_email = $conn->real_escape_string($_POST['cliente_email']);
    $cantidad = intval($_POST['cantidad']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $precio_unitario = floatval($_POST['precio_unitario']);

    $sql = "INSERT INTO nombre_proyecto (nombre, tipo_proyecto_id, plantilla_proyecto_id) VALUES ('$proyecto', 1, 1)";

    if ($conn->query($sql) === TRUE) {
        echo "<h1>Cotización Generada</h1>";
        echo "<p>Proyecto: " . htmlspecialchars($proyecto) . "</p>";
        // Mostrar más datos si es necesario
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
