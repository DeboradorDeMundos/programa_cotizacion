<?php
include '../../db_config.php';

// Consulta para obtener las cotizaciones
$sql = "SELECT * FROM nombre_proyecto"; // Ajusta según tu estructura de base de datos
$result = $conn->query($sql);

$mensaje = "<h1>Listado de Cotizaciones</h1>";
if ($result->num_rows > 0) {
    $mensaje .= "<table border='1'>
                    <tr>
                        <th>Proyecto</th>
                        <th>Código Prov</th>
                        <th>Empresa</th>
                        <th>RUT</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>E-mail</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Precio Unitario</th>
                    </tr>";
    while ($row = $result->fetch_assoc()) {
        $mensaje .= "<tr>
                        <td>" . htmlspecialchars($row['nombre']) . "</td>
                        <td>" . htmlspecialchars($row['codigo_prov']) . "</td>
                        <td>" . htmlspecialchars($row['empresa']) . "</td>
                        <td>" . htmlspecialchars($row['rut']) . "</td>
                        <td>" . htmlspecialchars($row['direccion']) . "</td>
                        <td>" . htmlspecialchars($row['fono']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['cantidad']) . "</td>
                        <td>" . htmlspecialchars($row['descripcion']) . "</td>
                        <td>" . htmlspecialchars($row['precio_unitario']) . "</td>
                    </tr>";
    }
    $mensaje .= "</table>";
} else {
    $mensaje = "No se encontraron cotizaciones.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cotizaciones</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <h1>Ver Cotizaciones</h1>
    <?php echo $mensaje; ?>
    <ul>
        <li><a href="../index.php">Volver Al Menu</a></li>
    </ul>
</body>
</html>
