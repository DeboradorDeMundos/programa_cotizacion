<?php
include '../../db_config.php';

// Obtener el ID de la cotización desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Preparar la consulta para obtener los detalles de la cotización
    $sql = "SELECT c.*, p.Descripcion AS proyecto_descripcion, p.Codigo AS proyecto_codigo, 
                   cl.Nombre AS cliente_nombre, cl.RUT AS cliente_rut, 
                   cl.Empresa AS cliente_empresa, cl.Direccion AS cliente_direccion, 
                   cl.Telefono AS cliente_telefono, cl.Email AS cliente_email,
                   v.Nombre AS vendedor_nombre,
                    ds.
            FROM destalleservicios ds
            JOIN Cotizaciones c on c.ID_Cotizaciones = c.ID
            JOIN Proyectos p ON c.ID_Proyecto = p.ID
            JOIN Clientes cl ON c.ID_Cliente = cl.ID
            JOIN Vendedores v ON c.ID_Vendedor = v.ID
            WHERE c.ID = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $mensaje = "<h1>Detalles de la Cotización</h1>";
        $mensaje .= "<table border='1'>";
        $mensaje .= "<tr><th>Campo</th><th>Valor</th></tr>";
        $mensaje .= "<tr><td>Fecha</td><td>" . htmlspecialchars($row['Fecha']) . "</td></tr>";
        $mensaje .= "<tr><td>Validez</td><td>" . htmlspecialchars($row['Validez']) . "</td></tr>";
        $mensaje .= "<tr><td>Total</td><td>" . htmlspecialchars($row['TotalGeneral']) . "</td></tr>";
        $mensaje .= "<tr><td>Proyecto</td><td>" . htmlspecialchars($row['proyecto_descripcion']) . "</td></tr>";
        $mensaje .= "<tr><td>Código Prov</td><td>" . htmlspecialchars($row['proyecto_codigo']) . "</td></tr>";
        $mensaje .= "<tr><td>Cliente</td><td>" . htmlspecialchars($row['cliente_nombre']) . "</td></tr>";
        $mensaje .= "<tr><td>RUT</td><td>" . htmlspecialchars($row['cliente_rut']) . "</td></tr>";
        $mensaje .= "<tr><td>Empresa</td><td>" . htmlspecialchars($row['cliente_empresa']) . "</td></tr>";
        $mensaje .= "<tr><td>Dirección</td><td>" . htmlspecialchars($row['cliente_direccion']) . "</td></tr>";
        $mensaje .= "<tr><td>Teléfono</td><td>" . htmlspecialchars($row['cliente_telefono']) . "</td></tr>";
        $mensaje .= "<tr><td>Email</td><td>" . htmlspecialchars($row['cliente_email']) . "</td></tr>";
        $mensaje .= "<tr><td>Cantidad</td><td>" . htmlspecialchars($row['cantidad']) . "</td></tr>";
        $mensaje .= "<tr><td>Descripción</td><td>" . htmlspecialchars($row['descripcion']) . "</td></tr>";
        $mensaje .= "<tr><td>Precio Unitario</td><td>" . htmlspecialchars($row['precio_unitario']) . "</td></tr>";
        $mensaje .= "<tr><td>Vendedor</td><td>" . htmlspecialchars($row['vendedor_nombre']) . "</td></tr>";
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
