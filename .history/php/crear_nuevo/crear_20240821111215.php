<?php

include '../db_config.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $proyecto = $_POST['proyecto'];
    $cod_prov = $_POST['cod_prov'];
    $cliente_empresa = $_POST['cliente_empresa'];
    $cliente_rut = $_POST['cliente_rut'];
    $cliente_direccion = $_POST['cliente_direccion'];
    $cliente_fono = $_POST['cliente_fono'];
    $cliente_email = $_POST['cliente_email'];
    $cantidad = $_POST['cantidad'];
    $descripcion = $_POST['descripcion'];
    $precio_unitario = $_POST['precio_unitario'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO nombre_proyecto (nombre, tipo_proyecto_id, plantilla_proyecto_id) VALUES ('$proyecto', 1, 1)"; // Ejemplo, ajusta según tu esquema

    if ($conn->query($sql) === TRUE) {
        echo "Cotización generada exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
