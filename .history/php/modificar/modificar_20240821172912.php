<?php
include '../../db_config.php';

// Obtener el ID de la cotización desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $nombre = $_POST['nombre'];
    $codigo_prov = $_POST['codigo_prov'];
    $cliente_empresa = $_POST['cliente_empresa'];
    $cliente_rut = $_POST['cliente_rut'];
    $cliente_direccion = $_POST['cliente_direccion'];
    $cliente_fono = $_POST['cliente_fono'];
    $cliente_email = $_POST['cliente_email'];
    $cantidad = $_POST['cantidad'];
    $descripcion = $_POST['descripcion'];
    $precio_unitario = $_POST['precio_unitario'];
    $total = $cantidad * $precio_unitario; // Calcular el total

    // Preparar la consulta para actualizar la cotización
    $sql_cotizacion = "UPDATE Cotizaciones SET
                Validez = ?, -- O cualquier otro campo que quieras actualizar
                TotalGeneral = ?
            WHERE ID = ?";
    $stmt_cotizacion = $conn->prepare($sql_cotizacion);
    $stmt_cotizacion->bind_param(
        "di",
        $validez,
        $total_general,
        $id
    );

    // Preparar la consulta para actualizar los detalles del servicio
    $sql_detalle = "UPDATE DetalleServicios SET
                Cantidad = ?,
                Descripcion = ?,
                Precio_Unitario = ?,
                Total = ?
            WHERE ID_Cotizacion = ?";
    $stmt_detalle = $conn->prepare($sql_detalle);
    $stmt_detalle->bind_param(
        "isddi",
        $cantidad,
        $descripcion,
        $precio_unitario,
        $total,
        $id
    );

    // Ejecutar las consultas de actualización
    $exito_cotizacion = $stmt_cotizacion->execute();
    $exito_detalle = $stmt_detalle->execute();

    if ($exito_cotizacion && $exito_detalle) {
        $mensaje = "<p>Cotización actualizada con éxito.</p>";
    } else {
        $mensaje = "<p>Error al actualizar la cotización.</p>";
    }
    $stmt_cotizacion->close();
    $stmt_detalle->close();
} else if ($id > 0) {
    // Preparar la consulta para obtener los detalles de la cotización
    $sql = "SELECT c.ID AS cotizacion_id, c.Fecha, c.Validez, c.TotalGeneral, 
                  p.Descripcion AS proyecto_descripcion, p.Codigo AS proyecto_codigo, 
                  cl.Nombre AS cliente_nombre, cl.RUT AS cliente_rut, 
                  cl.Empresa AS cliente_empresa, cl.Direccion AS cliente_direccion, 
                  cl.Telefono AS cliente_telefono, cl.Email AS cliente_email,
                  v.Nombre AS vendedor_nombre,
                  ds.Cantidad, ds.Descripcion AS detalle_descripcion, ds.Precio_Unitario, ds.Total
           FROM Cotizaciones c
           JOIN Proyectos p ON c.ID_Proyecto = p.ID
           JOIN Clientes cl ON c.ID_Cliente = cl.ID
           JOIN Vendedores v ON c.ID_Vendedor = v.ID
           LEFT JOIN DetalleServicios ds ON c.ID = ds.ID_Cotizacion
           WHERE c.ID = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
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
    <title>Modificar Cotización</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php echo isset($mensaje) ? $mensaje : ''; ?>
    
    <?php if (isset($row)): ?>
    <h1>Modificar Cotización</h1>
    <form action="" method="post">
        <label for="nombre">Nombre del Proyecto:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($row['proyecto_descripcion']); ?>" required><br>

        <label for="codigo_prov">Código:</label>
        <input type="text" id="codigo_prov" name="codigo_prov" value="<?php echo htmlspecialchars($row['proyecto_codigo']); ?>" required><br>

        <label for="cliente_empresa">Empresa:</label>
        <input type="text" id="cliente_empresa" name="cliente_empresa" value="<?php echo htmlspecialchars($row['cliente_empresa']); ?>" required><br>

        <label for="cliente_rut">RUT:</label>
        <input type="text" id="cliente_rut" name="cliente_rut" value="<?php echo htmlspecialchars($row['cliente_rut']); ?>" required><br>

        <label for="cliente_direccion">Dirección:</label>
        <input type="text" id="cliente_direccion" name="cliente_direccion" value="<?php echo htmlspecialchars($row['cliente_direccion']); ?>" required><br>

        <label for="cliente_fono">Teléfono:</label>
        <input type="text" id="cliente_fono" name="cliente_fono" value="<?php echo htmlspecialchars($row['cliente_telefono']); ?>" required><br>

        <label for="cliente_email">Email:</label>
        <input type="email" id="cliente_email" name="cliente_email" value="<?php echo htmlspecialchars($row['cliente_email']); ?>" required><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($row['Cantidad']); ?>" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($row['detalle_descripcion']); ?></textarea><br>

        <label for="precio_unitario">Precio Unitario:</label>
        <input type="number" id="precio_unitario" name="precio_unitario" step="0.01" value="<?php echo htmlspecialchars($row['Precio_Unitario']); ?>" required><br>

        <input type="submit" value="Actualizar Cotización">
    </form>
    <?php endif; ?>

    <ul>
        <li><a href="../prediseñados/ver_cotizacion.php?id=<?php echo $id; ?>">Ver Cotización</a></li>
        <li><a href="../ver_listado/ver_listado.php">Volver al Listado</a></li>
    </ul>
</body>
</html>
