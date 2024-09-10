<?php
include '../../db_config.php';

$sql = "SELECT c.ID AS cotizacion_id, c.Fecha, c.Validez, c.TotalGeneral, 
               p.Descripcion AS proyecto_descripcion, p.Codigo AS proyecto_codigo, 
               cl.Nombre AS cliente_nombre, cl.RUT AS cliente_rut, 
               cl.Empresa AS cliente_empresa, cl.Direccion AS cliente_direccion, 
               cl.Telefono AS cliente_telefono, cl.Email AS cliente_email,
               v.Nombre AS vendedor_nombre
        FROM Cotizaciones c
        JOIN Proyectos p ON c.ID_Proyecto = p.ID
        JOIN Clientes cl ON c.ID_Cliente = cl.ID
        JOIN Vendedores v ON c.ID_Vendedor = v.ID";

$result = $conn->query($sql);

$mensaje = "";
if ($result->num_rows > 0) {
    $mensaje .= "<h1>Listado de Cotizaciones</h1>";
    $mensaje .= "<table border='1'>";
    $mensaje .= "<tr>
                    <th>Fecha</th>
                    <th>Validez</th>
                    <th>Total</th>
                    <th>Proyecto</th>
                    <th>Código Prov</th>
                    <th>Cliente</th>
                    <th>RUT</th>
                    <th>Empresa</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Vendedor</th>
                    <th>Acciones</th>
                </tr>";
    while ($row = $result->fetch_assoc()) {
        $mensaje .= "<tr>";
        $mensaje .= "<td>" . htmlspecialchars($row['Fecha']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['Validez']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['TotalGeneral']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['proyecto_descripcion']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['proyecto_codigo']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_nombre']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_rut']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_empresa']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_direccion']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_telefono']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_email']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['vendedor_nombre']) . "</td>";
        // Añadir los botones de acción
        $mensaje .= "<td>
                        <a href='../prediseñados/ver_cotizacion.php?id=" . $row['cotizacion_id'] . "'>|Ver</a> |
                        <a href='../modificar/modificar.php?id=" . $row['cotizacion_id'] . "'>Modificar</a> |
                        <a href='../eliminar/eliminar.php?id=" . $row['cotizacion_id'] . "'>Eliminar</a> |
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
