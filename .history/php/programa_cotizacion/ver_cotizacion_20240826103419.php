<?php

// Habilitar el reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establecer la conexión a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT c.*, p.nombre_proyecto AS proyecto_descripcion, p.codigo_proyecto AS proyecto_codigo, 
                   cl.nombre_cliente AS cliente_nombre, cl.rut_cliente AS cliente_rut, 
                   cl.empresa_cliente AS cliente_empresa, cl.direccion_cliente AS cliente_direccion, 
                   cl.telefono_cliente AS cliente_telefono, cl.email_cliente AS cliente_email,
                   v.nombre_vendedor AS vendedor_nombre,
                   ds.cantidad, d.descripcion AS detalle_descripcion, d.precio_unitario AS detalle_precio_unitario, ds.cantidad * d.precio_unitario AS detalle_total
            FROM Cotizaciones c
            JOIN Proyectos p ON c.id_proyecto = p.id_proyecto
            JOIN Clientes cl ON c.id_cliente = cl.id_cliente
            JOIN Vendedores v ON c.id_vendedor = v.id_vendedor
            LEFT JOIN Detalle_Cotizacion ds ON c.id_cotizacion = ds.id_cotizacion
            JOIN Descripciones d ON ds.id_descripcion = d.id_descripcion
            WHERE c.id_cotizacion = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Inicio del HTML para mostrar los datos
        echo "<div style='font-family: Arial, sans-serif;'>";
        echo "<h1 style='margin: 0;'>ITRED SPA</h1>";
        echo "<h5 style='margin: 0;'>
                <span style='font-size: 14px; font-weight: bold;'>Tecnología y Construcción</span></h5>";
        echo "<h5 style='margin: 0;'>
                <span style='font-size: 14px; font-weight: bold;'>Dirección:</span> 
                <span style='font-size: 12px;'>GUIDO RENI #4190, PEDRO AGUIRRE CERDA - SANTIAGO</span></h5>";
        echo "<h5 style='margin: 0;'>
                <span style='font-size: 14px; font-weight: bold;'>FONO:</span> 
                <span style='font-size: 12px;'>(+56 9) 7242 5972</span></h5>";
        echo "<h5 style='margin-top: 0;'>
                <span style='font-size: 14px; font-weight: bold;'>E-MAIL:</span> 
                <span style='font-size: 12px;'>CONTACTO@ITRED.CL</span></h5>";
        echo "<table>";
        echo "<tr><td style='font-size: 14px;'><strong>Proyecto</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']);
        echo "<tr><td style='font-size: 14px;'><strong>COD. PROY</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_codigo']);
        echo "<tr><td style='font-size: 14px;'><strong>AREA TRABAJO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']);
        echo "<tr><td style='font-size: 14px;'><strong>RISGO TRAB.</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']);
        echo "</table>";
        echo "<h3>DATOS CLIENTES</h3>";
        echo "<table>";
        echo "<tr><td 'font-size: 14px;'><strong>SR/TA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']);
        echo "<tr><td 'font-size: 14px;'><strong>EMPRESA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_codigo']);
        echo "<tr><td 'font-size: 14px;'><strong>RUT: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']);
        echo "<tr><td 'font-size: 14px;'><strong>DIRECCION: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']);
        echo "<tr><td 'font-size: 14px;'><strong>OF./DEPTO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']);
        echo "<tr><td 'font-size: 14px;'><strong>FONO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_codigo']);
        echo "<tr><td 'font-size: 14px;'><strong>E-MAIL: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']);
        echo "</table>";
        echo "<h3>DATOS EMPRESA</h3>";
        echo "<table>";
        echo "<tr><td><strong>ENC. PROYEC.: </strong></td><td>" . htmlspecialchars($row['proyecto_descripcion']) ."</tr>";
        echo "<tr><td><strong>E-MAIL: </strong></td><td>" . htmlspecialchars($row['cliente_nombre']) . "</td></tr>";
        echo "<tr><td><strong>FONO: </strong></td><td>" . htmlspecialchars($row['cliente_empresa']) . "</td></tr>";
        echo "<tr><td><strong>WHATSAPP: </strong></td><td>" . htmlspecialchars($row['cliente_telefono']) . "</td></tr>";
        echo "<tr><td><strong>TIPO CLIENTE: </strong></td><td>" . htmlspecialchars($row['vendedor_nombre']) . "</td></tr>";
        echo "<tr><td><strong>Validez</strong></td><td>" . htmlspecialchars($row['fecha_validez']) . "</td></tr>";
        echo "</table>";
        
        echo "<h3>Detalles del Servicio</h3>";
        echo "<table border='1' cellpadding='5' cellspacing='0' width='100%'>";
        echo "<tr><th>Cantidad</th><th>Descripción</th><th>Precio Unitario</th><th>Total</th></tr>";
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>";
        echo "<td>" . htmlspecialchars($row['detalle_descripcion']) . "</td>";
        echo "<td>" . htmlspecialchars($row['detalle_precio_unitario']) . "</td>";
        echo "<td>" . htmlspecialchars($row['detalle_total']) . "</td>";
        echo "</tr>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p>No se encontró la cotización con el ID proporcionado.</p>";
    }
    $stmt->close();
} else {
    echo "<p>ID inválido.</p>";
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
    <ul>
        <li><a href="../crear_nuevo/crear.php">Crear Cotización</a></li>
        <li><a href="../modificar/modificar.php?id=<?php echo $id; ?>">Modificar Cotización</a></li>
        <li><a href="../eliminar/eliminar.php?id=<?php echo $id; ?>">Eliminar Cotización</a></li>
        <li><a href="../ver_listado/ver_listado.php">Volver al Listado</a></li>
    </ul>
</body>
</html>
