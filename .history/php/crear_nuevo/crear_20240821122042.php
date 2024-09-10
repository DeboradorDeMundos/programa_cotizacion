<?php
include 'db_config.php'; // Ajusta la ruta según tu estructura de carpetas

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
    <title>Crear Cotización</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <h1>Crear Cotización</h1>
    <form action="crear.php" method="POST">
        <h2>Datos de Cotización</h2>
        <!-- Información del Proyecto -->
        <label for="proyecto">Proyecto:</label>
        <input type="text" id="proyecto" name="proyecto" required><br><br>
        <label for="cod_prov">Código Prov:</label>
        <input type="text" id="cod_prov" name="cod_prov" required><br><br>
        <!-- Datos del Cliente -->
        <h3>Datos Cliente</h3>
        <label for="cliente_empresa">Empresa:</label>
        <input type="text" id="cliente_empresa" name="cliente_empresa" required><br><br>
        <label for="cliente_rut">RUT:</label>
        <input type="text" id="cliente_rut" name="cliente_rut" required><br><br>
        <label for="cliente_direccion">Dirección:</label>
        <input type="text" id="cliente_direccion" name="cliente_direccion" required><br><br>
        <label for="cliente_fono">Teléfono:</label>
        <input type="text" id="cliente_fono" name="cliente_fono" required><br><br>
        <label for="cliente_email">E-mail:</label>
        <input type="email" id="cliente_email" name="cliente_email" required><br><br>
        <!-- Detalles de los Servicios -->
        <h3>Detalles del Servicio</h3>
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" required><br><br>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" required></textarea><br><br>
        <label for="precio_unitario">Precio Unitario:</label>
        <input type="number" id="precio_unitario" name="precio_unitario" required><br><br>
        <input type="submit" value="Generar Cotización">
    </form>
    <div id="cotizacion_resultado">
        <?php echo $mensaje; ?>
    </div>
</body>
</html>
