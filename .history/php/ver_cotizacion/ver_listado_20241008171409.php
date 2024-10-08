<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->

<!-- ------------------------------------------------------------------------------------------------------------
    ------------------------------------- INICIO ITred Spa Ver Listado .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');


// Obtiene el ID de la empresa desde la URL
$id_empresa = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Define la consulta SQL para seleccionar los datos de cotizaciones filtradas por id_empresa
$sql = "SELECT c.id_cotizacion AS cotizacion_id, c.fecha_emision, c.fecha_validez, t.total_final, 
               p.nombre_proyecto AS proyecto_descripcion, p.codigo_proyecto AS proyecto_codigo, 
               cl.nombre_cliente AS cliente_nombre, cl.rut_cliente AS cliente_rut, 
               cl.direccion_cliente AS cliente_direccion, 
               cl.telefono_cliente AS cliente_telefono, cl.email_cliente AS cliente_email,
               v.nombre_vendedor AS vendedor_nombre
        FROM C_Cotizaciones c
        JOIN C_Proyectos p ON c.id_proyecto = p.id_proyecto
        JOIN C_Clientes cl ON c.id_cliente = cl.id_cliente
        JOIN C_Vendedores v ON c.id_vendedor = v.id_vendedor
        JOIN C_Totales t ON c.id_cotizacion = t.id_cotizacion
        WHERE c.id_empresa = ?"; // Filtra por id_empresa en C_Cotizaciones

// Prepara y ejecuta la consulta
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id_empresa);
$stmt->execute();

// Obtiene el resultado
$result = $stmt->get_result();

$mensaje = "";

// Verifica si se obtuvieron filas de la consulta
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
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Vendedor</th>
                    <th>Acciones</th>
                </tr>";

    // Itera sobre cada fila del resultado de la consulta
    while ($row = $result->fetch_assoc()) {
        $mensaje .= "<tr>";
        $mensaje .= "<td>" . htmlspecialchars($row['fecha_emision']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['fecha_validez']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['total_final']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['proyecto_descripcion']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['proyecto_codigo']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_nombre']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_rut']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_direccion']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_telefono']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_email']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['vendedor_nombre']) . "</td>";
        $mensaje .= "<td>
                        <a href='ver.php?id=" . $row['cotizacion_id'] . "'>|Ver</a> |
                        <a href='modificar_cotizacion.php?id=" . $row['cotizacion_id'] . "'>Modificar</a> |
                        <a href='eliminar_cotizacion.php?id=" . $row['cotizacion_id'] . "'>Eliminar</a> |
                        <a href='descargar_cotizacion.php?id=" . $row['cotizacion_id'] . "'>Descargar</a>
                     </td>";
        $mensaje .= "</tr>";
    }
    $mensaje .= "</table>";
} else {
    $mensaje = "<p>No hay cotizaciones disponibles para esta empresa.</p>";
}

// Cierra la conexión a la base de datos
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cotizaciones</title>
    <link rel="stylesheet" href="../../css/programa_cotizacion/ver_listado.css">
</head>
<body>
    <div>Filtro Busqueda</div>
    
    <?php echo $mensaje; ?>
    <ul>
        <li><a href="../nueva_cotizacion/nueva_cotizacion.php?id=<?php echo $id_empresa; ?>">Crear Cotización</a></li>
        <li><a href="../../programa_cotizacion.php">Volver al Menú</a></li>
    </ul>
</body>
</html>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  Ver Listado .PHP -----------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->
