<?php
include '../db_config.php';

// Inicializar variables para los mensajes
$mensaje = "";

// Verificar si el método de solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escapar los datos recibidos del formulario para evitar inyecciones SQL
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

    // Crear la consulta SQL para insertar los datos
    $sql = "INSERT INTO nombre_proyecto (nombre, tipo_proyecto_id, plantilla_proyecto_id) VALUES ('$proyecto', 1, 1)";

    // Ejecutar la consulta y manejar el resultado
    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de confirmación con los datos
        header("Location: confirmacion.php?proyecto=" . urlencode($proyecto) . "&cod_prov=" . urlencode($cod_prov) . "&cliente_empresa=" . urlencode($cliente_empresa) . "&cliente_rut=" . urlencode($cliente_rut) . "&cliente_direccion=" . urlencode($cliente_direccion) . "&cliente_fono=" . urlencode($cliente_fono) . "&cliente_email=" . urlencode($cliente_email) . "&cantidad=" . urlencode($cantidad) . "&descripcion=" . urlencode($descripcion) . "&precio_unitario=" . urlencode($precio_unitario));
        exit();
    } else {
        $mensaje = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
