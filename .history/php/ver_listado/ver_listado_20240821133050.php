<?php
include '../../db_config.php';

// Obtén todas las cotizaciones de la base de datos
$sql = "SELECT * FROM nombre_proyecto";
$result = $conn->query($sql);

$mensaje = "";
if ($result->num_rows > 0) {
    $mensaje .= "<h1>Listado de Cotizaciones</h1>";
    $mensaje .= "<table border='1'>";
    $mensaje .= "<tr>
                    <th>Proyecto</th>
                    <th>Código Prov</th>
                    <th>Empresa</th>
                    <th>RUT</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Precio Unitario</th>
                    <th>Acciones</th>
                </tr>";
    while ($row = $result->fetch_assoc()) {
        $mensaje .= "<tr>";
        $mensaje .= "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['codigo_prov']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_empresa']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_rut']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_direccion']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_fono']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_email']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cantidad']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['precio_unitario']) . "</td>";
        // Añadir los botones de acción
        $mensaje .= "<td>
                        <a href='../modificar/modificar.php?id=" . $row['ID'] . "'>Modificar</a> |
                        <a href='../eliminar/eliminar.php?id=" . $row['ID'] . "'>Eliminar</a>
                        <a href='../ver_cotizacion/ver_cotizacion.php?id=" . $row['ID'] . "'>Ver</a>                        
                     </td>";
        $mensaje .= "</tr>";
    }
    $mensaje .= "</table>";
} else {
    $mensaje = "<p>No hay cotizaciones disponibles.</p>";
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

    <?php echo $mensaje; ?>
    <ul>
        <li><a href="../crear_nuevo/crear.php">Crear Cotización</a></li>
        <li><a href="../../index.php">Volver al Menú</a></li>
    </ul>
</body>
</html>
