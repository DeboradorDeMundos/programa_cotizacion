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
    ------------------------------------- INICIO ITred Spa Filtro Busqueda .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->


<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

<?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Verifica la conexión
if ($mysqli->connect_error) {
    die("Error en la conexión: " . $mysqli->connect_error);
}

// Obtiene el ID de la empresa desde la URL
$id_empresa = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Parámetros de filtros
$fecha_desde = isset($_GET['fecha_desde']) ? $_GET['fecha_desde'] : '';
$fecha_hasta = isset($_GET['fecha_hasta']) ? $_GET['fecha_hasta'] : '';
$estado = isset($_GET['estado']) ? $_GET['estado'] : '';
$numero_cotizacion = isset($_GET['numero_cotizacion']) ? $_GET['numero_cotizacion'] : '';

// Define la consulta SQL base para seleccionar los datos de cotizaciones filtradas por id_empresa
$sql = "SELECT c.id_cotizacion AS cotizacion_id, c.fecha_emision, c.fecha_validez, t.total_final, 
               p.nombre_proyecto AS proyecto_descripcion, p.codigo_proyecto AS proyecto_codigo, 
               cl.nombre_cliente AS cliente_nombre, cl.rut_cliente AS cliente_rut, 
               cl.direccion_cliente AS cliente_direccion, 
               cl.telefono_cliente AS cliente_telefono, cl.email_cliente AS cliente_email,
               v.nombre_vendedor AS vendedor_nombre, c.estado
        FROM C_Cotizaciones c
        JOIN C_Proyectos p ON c.id_proyecto = p.id_proyecto
        JOIN C_Clientes cl ON c.id_cliente = cl.id_cliente
        JOIN C_Vendedores v ON c.id_vendedor = v.id_vendedor
        JOIN C_Totales t ON c.id_cotizacion = t.id_cotizacion
        WHERE c.id_empresa = ?";

// Agregar filtros a la consulta si los valores están presentes
if (!empty($fecha_desde)) {
    $sql .= " AND c.fecha_emision >= ?";
}
if (!empty($fecha_hasta)) {
    $sql .= " AND c.fecha_emision <= ?";
}
if (!empty($estado)) {
    $sql .= " AND c.estado = ?";
}
if (!empty($numero_cotizacion)) {
    $sql .= " AND c.id_cotizacion = ?";
}

// Preparar la consulta
$stmt = $mysqli->prepare($sql);

// Vincular parámetros
$parametros = [$id_empresa]; // Inicialmente, solo id_empresa

// Agregar parámetros dinámicos según los filtros aplicados
if (!empty($fecha_desde)) {
    $parametros[] = $fecha_desde;
}
if (!empty($fecha_hasta)) {
    $parametros[] = $fecha_hasta;
}
if (!empty($estado)) {
    $parametros[] = $estado;
}
if (!empty($numero_cotizacion)) {
    $parametros[] = $numero_cotizacion;
}

// Vincular los valores dinámicamente a la consulta
$tipos = str_repeat('s', count($parametros)); // Define los tipos de parámetros (todos string o integer)
$stmt->bind_param($tipos, ...$parametros);

// Ejecutar la consulta
$stmt->execute();

// Obtener el resultado
$result = $stmt->get_result();

$mensaje = "";

// Verificar si se obtuvieron filas de la consulta
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
                    <th>Estado</th>
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
    $mensaje = "<p>No hay cotizaciones disponibles para esta empresa con los filtros aplicados.</p>";
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

<div>   
    <!-- Filtros de búsqueda -->
    <form method="GET" action="">
        <label for="fecha_desde">Fecha desde:</label>
        <input type="date" name="fecha_desde" id="fecha_desde" value="<?php echo htmlspecialchars($fecha_desde); ?>">

        <label for="fecha_hasta">Fecha hasta:</label>
        <input type="date" name="fecha_hasta" id="fecha_hasta" value="<?php echo htmlspecialchars($fecha_hasta); ?>">

        <label for="estado">Estado:</label>
        <select name="estado" id="estado">
            <option value="">Todos</option>
            <option value="pendiente" <?php if ($estado == 'pendiente') echo 'selected'; ?>>Pendiente</option>
            <option value="aprobada" <?php if ($estado == 'aprobada') echo 'selected'; ?>>Aprobada</option>
            <option value="rechazada" <?php if ($estado == 'rechazada') echo 'selected'; ?>>Rechazada</option>
        </select>

        <label for="numero_cotizacion">Número de cotización:</label>
        <input type="text" name="numero_cotizacion" id="numero_cotizacion" value="<?php echo htmlspecialchars($numero_cotizacion); ?>">

        <button type="submit">Filtrar</button>
    </form>
</div>

<?php echo $mensaje; ?>

<ul>
    <li><a href="../nueva_cotizacion/nueva_cotizacion.php?id=<?php echo $id_empresa; ?>">Crear Cotización</a></li>
    <li><a href="../../programa_cotizacion.php">Volver al Menú</a></li>
</ul>

</body>
</html>


<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Filtro Busqueda .PHP -----------------------------------
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
