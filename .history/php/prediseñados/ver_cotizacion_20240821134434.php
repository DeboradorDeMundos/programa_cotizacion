<?php
include '../../db_config.php';

// Obtener el ID de la cotización desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Preparar la consulta para obtener los detalles de la cotización
    $sql = "SELECT * FROM nombre_proyecto WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $mensaje = "<h1>Detalles de la Cotización</h1>";
        $mensaje .= "<table border='1'>";
        $mensaje .= "<tr><th>Campo</th><th>Valor</th></tr>";
        $mensaje .= "<tr><td>Proyecto</td><td>" . htmlspecialchars($row['nombre']) . "</td></tr>";
        $mensaje .= "<tr><td>Código Prov</td><td>" . htmlspecialchars($row['codigo_prov']) . "</td></tr>";
        $mensaje .= "<tr><td>Empresa</td><td>" . htmlspecialchars($row['cliente_empresa']) . "</td></tr>";
        $mensaje .= "<tr><td>RUT</td><td>" . htmlspecialchars($row['cliente_rut']) . "</td></tr>";
        $mensaje .= "<tr><td>Dirección</td><td>" . htmlspecialchars($row['cliente_direccion']) . "</td></tr>";
        $mensaje .= "<tr><td>Teléfono</td><td>" . htmlspecialchars($row['cliente_fono']) . "</td></tr>";
        $mensaje .= "<tr><td>Email</td><td>" . htmlspecialchars($row['cliente_email']) . "</td></tr>";
        $mensaje .= "<tr><td>Cantidad</td><td>" . htmlspecialchars($row['cantidad']) . "</td></tr>";
        $mensaje .= "<tr><td>Descripción</td><td>" . htmlspecialchars($row['descripcion']) . "</td></tr>";
        $mensaje .= "<tr><td>Precio Unitario</td><td>" . htmlspecialchars($row['precio_unitario']) . "</td></tr>";
        $mensaje .= "</table>";
    } else {
        $mensaje = "<p>No se encontró la cotización con el ID proporcionado.</p>";
    }
    $stmt->close();
} else {
    $mensaje = "<p>ID inválido.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Cotización</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php echo $mensaje; ?>
    <ul>
        <li><a href="../crear_nuevo/crear.php">Crear Cotización</a></li>
        <li><a href="../modificar/modificar.php?id=<?php echo $id; ?>">Modificar Cotización</a></li>
        <li><a href="../eliminar/eliminar.php?id=<?php echo $id; ?>">Eliminar Cotización</a></li>
        <li><a href="../ver_listado/ver_listado.php">Volver al Listado</a></li>
    </ul>
</body>
</html>
