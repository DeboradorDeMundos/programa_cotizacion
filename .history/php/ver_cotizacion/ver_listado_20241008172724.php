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
// Establece la conexión a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Obtiene el ID de la empresa desde la URL
$id_empresa = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Filtros (recibidos por GET)
$numero_cotizacion = isset($_GET['numero_cotizacion']) ? $_GET['numero_cotizacion'] : '';
$estado = isset($_GET['estado']) ? $_GET['estado'] : '';
$fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : '';
$fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : '';

// Construye la consulta SQL inicial
$sql = "SELECT c.id_cotizacion AS cotizacion_id, c.fecha_emision, c.fecha_validez, c.numero_cotizacion, c.estado, 
               t.total_final, p.nombre_proyecto AS proyecto_descripcion, cl.nombre_cliente AS cliente_nombre, 
               v.nombre_vendedor AS vendedor_nombre
        FROM C_Cotizaciones c
        JOIN C_Proyectos p ON c.id_proyecto = p.id_proyecto
        JOIN C_Clientes cl ON c.id_cliente = cl.id_cliente
        JOIN C_Vendedores v ON c.id_vendedor = v.id_vendedor
        JOIN C_Totales t ON c.id_cotizacion = t.id_cotizacion
        WHERE c.id_empresa = ?";

// Crea un array para almacenar las condiciones del WHERE
$condiciones = [];
$parametros = [$id_empresa]; // Parametros para bind_param

// Añade condiciones según los filtros ingresados
if ($numero_cotizacion != '') {
    $condiciones[] = "c.numero_cotizacion LIKE ?";
    $parametros[] = "%$numero_cotizacion%";
}

if ($estado != '') {
    $condiciones[] = "c.estado = ?";
    $parametros[] = $estado;
}

if ($fecha_inicio != '' && $fecha_fin != '') {
    $condiciones[] = "c.fecha_emision BETWEEN ? AND ?";
    $parametros[] = $fecha_inicio;
    $parametros[] = $fecha_fin;
}

// Si hay filtros, añade las condiciones a la consulta
if (count($condiciones) > 0) {
    $sql .= " AND " . implode(" AND ", $condiciones);
}

// Prepara la consulta
$stmt = $mysqli->prepare($sql);

// Crea dinámicamente el tipo de los parámetros (i = entero, s = string)
$tipos_param = str_repeat('s', count($parametros) - 1); // El primero es entero (id_empresa)
$tipos_param = 'i' . $tipos_param;

// Asigna los parámetros a la consulta
$stmt->bind_param($tipos_param, ...$parametros);

// Ejecuta la consulta
$stmt->execute();

// Obtiene el resultado
$result = $stmt->get_result();

$mensaje = "";

// Verifica si se obtuvieron filas de la consulta
if ($result->num_rows > 0) {
    $mensaje .= "<h1>Listado de Cotizaciones</h1>";
    $mensaje .= "<table border='1'>";
    $mensaje .= "<tr>
                    <th>Numero Cotización</th>
                    <th>Fecha Emisión</th>
                    <th>Fecha Validez</th>
                    <th>Total</th>
                    <th>Proyecto</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>";

    // Itera sobre cada fila del resultado de la consulta
    while ($row = $result->fetch_assoc()) {
        $mensaje .= "<tr>";
        $mensaje .= "<td>" . htmlspecialchars($row['numero_cotizacion']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['fecha_emision']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['fecha_validez']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['total_final']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['proyecto_descripcion']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_nombre']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['vendedor_nombre']) . "</td>";
        $mensaje .= "<td>" . htmlspecialchars($row['estado']) . "</td>";
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
    $mensaje = "<p>No hay cotizaciones que coincidan con los filtros.</p>";
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


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cotizaciones</title>
    <link rel="stylesheet" href="../../css/programa_cotizacion/ver_listado.css">
</head>
<body>
<div><?php include 'filtros_busqueda.php'; ?></div>
    <?php echo $mensaje; ?>
    <ul>
        <li><a href="../nueva_cotizacion/nueva_cotizacion.php?id=<?php echo $id_empresa; ?>">Crear Cotización</a></li>
        <li><a href="../../programa_cotizacion.php">Volver al Menú</a></li>
    </ul>
</body>
</html>


<script src="../../js/ver_cotizacion/ver_listado.js"></script> 
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
