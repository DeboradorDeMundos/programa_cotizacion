<?php
include '../../db_config.php';

$mensaje = "";

// Procesa el formulario si es una solicitud POST
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

    // Inserta los datos en la base de datos
    $sql = "INSERT INTO nombre_proyecto (nombre, tipo_proyecto_id, plantilla_proyecto_id) VALUES ('$proyecto', 1, 1)";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "<h1>Cotización Generada Exitosamente</h1>";
        $mensaje .= "<p><strong>Proyecto:</strong> " . htmlspecialchars($proyecto) . "</p>";
        $mensaje .= "<p><strong>Código Prov:</strong> " . htmlspecialchars($cod_prov) . "</p>";
        $mensaje .= "<p><strong>Empresa:</strong> " . htmlspecialchars($cliente_empresa) . "</p>";
        $mensaje .= "<p><strong>RUT:</strong> " . htmlspecialchars($cliente_rut) . "</p>";
        $mensaje .= "<p><strong>Dirección:</strong> " . htmlspecialchars($cliente_direccion) . "</p>";
        $mensaje .= "<p><strong>Teléfono:</strong> " . htmlspecialchars($cliente_fono) . "</p>";
        $mensaje .= "<p><strong>E-mail:</strong> " . htmlspecialchars($cliente_email) . "</p>";
        $mensaje .= "<p><strong>Cantidad:</strong> " . htmlspecialchars($cantidad) . "</p>";
        $mensaje .= "<p><strong>Descripción:</strong> " . htmlspecialchars($descripcion) . "</p>";
        $mensaje .= "<p><strong>Precio Unitario:</strong> " . htmlspecialchars($precio_unitario) . "</p>";
    } else {
        $mensaje = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización ITred Spa</title>
    <link rel="stylesheet" href="../css/index.css">
    <style>
        /* Asegúrate de ajustar la ruta de la imagen según tu estructura */
        .logo {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px;
        }
    </style>
</head>
<body>
    <!-- Imprime la imagen del logo en la esquina superior izquierda -->
    <img src="../../imagenes/crear_nuevo/logo.png" alt="Logo ITred Spa" class="logo">
    
    <?php echo $mensaje; ?>
</body>
</html>
