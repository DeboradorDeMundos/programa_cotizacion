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
    ------------------------------------- INICIO ITred Spa Ver .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Verificar la conexión
if ($mysqli->connect_error) {
    die('Error de conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_cotizacion = (int) $_GET['id'];
    // Ejecutar consulta SQL con el ID recibido
} else {
    die("Error: ID de cotización no válida.");
}


// Consulta para obtener los datos de la empresa, cliente y detalles de la cotización
$query = "
    SELECT 
        cot.id_empresa,
        cot.numero_cotizacion,
        e.nombre_empresa,
        e.direccion_empresa,
        e.telefono_empresa,
        e.email_empresa,
        e.web_empresa,
        e.rut_empresa,
        e.id_foto,
        c.nombre_cliente,
        c.rut_cliente,
        c.direccion_cliente,
        c.giro_cliente,
        c.comuna_cliente,
        c.ciudad_cliente,
        c.telefono_cliente,
        cot.fecha_emision,
        cot.fecha_validez,
        enc.nombre_encargado,
        enc.rut_encargado,
        enc.email_encargado,
        enc.fono_encargado,
        enc.celular_encargado,
        ven.nombre_vendedor,
        ven.rut_vendedor,
        ven.email_vendedor,
        ven.fono_vendedor,
        ven.celular_vendedor
    FROM C_Cotizaciones cot
    JOIN C_Clientes c ON cot.id_cliente = c.id_cliente
    JOIN E_Empresa e ON cot.id_empresa = e.id_empresa
    JOIN C_Encargados enc ON cot.id_encargado = enc.id_encargado 
    JOIN C_Vendedores ven ON cot.id_vendedor = ven.id_vendedor 
    WHERE cot.id_cotizacion = ?
";

// Preparar la consulta
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id_cotizacion);

// Ejecutar la consulta
$stmt->execute();

// Obtener los resultados
$result = $stmt->get_result();

// Verificar si hay resultados
if ($result->num_rows > 0) {
    $items = $result->fetch_all(MYSQLI_ASSOC);
    $id_empresa = $items[0]['id_empresa']; // Guardar id_empresa para la siguiente consulta
    $id_foto = $items[0]['id_foto']; // Guardar id_foto para cargar la imagen

    $query_foto = "SELECT ruta_foto FROM e_fotosperfil WHERE id_foto = ?";
    $stmt_foto = $mysqli->prepare($query_foto);
    $stmt_foto->bind_param("i", $id_foto);
    
    // Ejecutar la consulta para la foto
    $stmt_foto->execute();
    $result_foto = $stmt_foto->get_result();
    
    // Verificar si se encontró la foto
    if ($result_foto->num_rows > 0) {
        $foto = $result_foto->fetch_assoc();
        $ruta_foto = $foto['ruta_foto']; // Obtener la ruta de la foto
    } else {
        $ruta_foto = null; // No se encontró la foto
    }
} else {
    echo "No se encontró la cotización o la empresa relacionada.";
}

// Consulta para obtener los totales
$query_totales = "
    SELECT 
        total.sub_total,
        total.descuento_global,
        total.total_iva,
        total.monto_neto,
        total.total_final,
        upper(total.total_final_letras) AS total_final_letras
    FROM C_Totales total
    JOIN C_Cotizaciones cot ON total.id_cotizacion = cot.id_cotizacion
    WHERE cot.id_cotizacion = ?
";

// Preparar la consulta de totales
$stmt_totales = $mysqli->prepare($query_totales);
$stmt_totales->bind_param("i", $id_cotizacion);

// Ejecutar la consulta de totales
$stmt_totales->execute();

// Obtener los resultados de totales
$result_totales = $stmt_totales->get_result();

// Verificar si hay resultados de totales
if ($result_totales->num_rows > 0) {
    $totales = $result_totales->fetch_assoc();
} else {
    echo "No se encontraron totales para esta cotización.";
}

// Aquí comienza el nuevo bloque de código para obtener los títulos, detalles y subtítulos

// Consulta para obtener los títulos, detalles y subtítulos relacionados con la cotización
$query_titulos = "
    SELECT 
        t.id_titulo AS titulo_id,
        t.nombre,
        d.id_detalle AS detalle_id,
        d.nombre_producto,
        d.descripcion,
        d.cantidad,
        d.precio_unitario,
        d.descuento_porcentaje,
        d.total,
        s.nombre AS subtitulo_nombre
    FROM C_Cotizaciones c
    JOIN C_Titulos t ON t.id_cotizacion = c.id_cotizacion
    JOIN C_Detalles d ON d.id_titulo = t.id_titulo
    LEFT JOIN C_Subtitulos s ON s.id_subtitulo = d.id_subtitulo
    WHERE c.id_cotizacion = ?
";

// Preparar y ejecutar la consulta
$stmt_titulos = $mysqli->prepare($query_titulos);
$stmt_titulos->bind_param("i", $id_cotizacion);
$stmt_titulos->execute();
$result_titulos = $stmt_titulos->get_result();

// Estructura para almacenar los datos
$titulos = [];
while ($row = $result_titulos->fetch_assoc()) {
    $titulo_id = $row['titulo_id'];

    // Si el título no existe aún en el array, lo agregamos
    if (!isset($titulos[$titulo_id])) {
        $titulos[$titulo_id] = [
            'nombre' => $row['nombre'],
            'detalles' => []
        ];
    }

    // Añadir detalles y subtítulos
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['nombre_producto'] = $row['nombre_producto'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['descripcion'] = $row['descripcion'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['cantidad'] = $row['cantidad'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['precio_unitario'] = $row['precio_unitario'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['descuento_porcentaje'] = $row['descuento_porcentaje'];
    $titulos[$titulo_id]['detalles'][$row['detalle_id']]['total'] = $row['total'];
    
    if (!empty($row['subtitulo_nombre'])) {
        $titulos[$titulo_id]['detalles'][$row['detalle_id']]['subtitulos'][] = $row['subtitulo_nombre'];
    }
}

// Cerrar la conexión de la consulta de títulos
$stmt_titulos->close();

// Consulta para obtener las cuentas bancarias de la empresa
$query_bancos = "
    SELECT 
        cb.rut_titular,
        cb.nombre_titular,
        cb.numero_cuenta,
        cb.email_banco,
        b.nombre_banco,
        tc.tipocuenta
    FROM E_Cuenta_Bancaria cb
    JOIN E_Bancos b ON cb.id_banco = b.id_banco
    JOIN E_Tipo_Cuenta tc ON cb.id_tipocuenta = tc.id_tipocuenta
    WHERE cb.id_empresa = ?
";

// Preparar la consulta de cuentas bancarias
$stmt_bancos = $mysqli->prepare($query_bancos);
$stmt_bancos->bind_param("i", $id_empresa);

// Ejecutar la consulta de cuentas bancarias
$stmt_bancos->execute();

// Obtener los resultados de cuentas bancarias
$result_bancos = $stmt_bancos->get_result();

// Verificar si hay resultados de cuentas bancarias
$bancos = [];
if ($result_bancos->num_rows > 0) {
    $bancos = $result_bancos->fetch_all(MYSQLI_ASSOC);
} else {
    echo "No se encontraron cuentas bancarias para esta empresa.";
}

// Cerrar las conexiones
$stmt->close();
$stmt_bancos->close();

$sql_firma = "
    SELECT 
        f.id_firma,
        f.id_empresa,
        f.titulo_firma, 
        f.nombre_encargado_firma, 
        f.cargo_encargado_firma, 
        f.telefono_encargado_firma,
        f.nombre_empresa_firma, 
        f.area_empresa_firma,
        f.telefono_empresa_firma, 
        f.firma_digital,
        f.email_firma, 
        f.direccion_firma, 
        f.ciudad_firma,
        f.pais_firma,
        f.rut_firma,
        f.web_firma,
        e.id_tipo_firma AS tipo_firma
    FROM E_Firmas f
    JOIN e_empresa e ON f.id_empresa = e.id_empresa
    WHERE f.id_empresa = ? 
    LIMIT 1";

if ($stmt_firma = $mysqli->prepare($sql_firma)) {
    $stmt_firma->bind_param("i", $id_empresa);
    $stmt_firma->execute();
    $result_firma = $stmt_firma->get_result();

    if ($result_firma->num_rows == 1) {
        $firma = $result_firma->fetch_assoc();
        
        $tipo_firma = $firma['tipo_firma'];
    } else {
        $firma = null; // No hay firma manual
    }

    $stmt_firma->close();
} else {
    echo "<p>Error al preparar la consulta de la firma: " . $mysqli->error . "</p>";
}

$query_requisitos = "
    SELECT r.id_requisitos,r.indice, r.descripcion_condiciones
    FROM e_requisitos_basicos AS r
    JOIN c_cotizaciones_requisitos AS cr ON r.id_requisitos = cr.id_requisitos
    WHERE cr.id_cotizacion = ?
";

// Preparar y ejecutar la consulta para obtener requisitos
$stmt_requisitos = $mysqli->prepare($query_requisitos);
$stmt_requisitos->bind_param("i", $id_cotizacion);
$stmt_requisitos->execute();
$result_requisitos = $stmt_requisitos->get_result();

// Verificar si hay resultados de requisitos
$requisitos = [];
if ($result_requisitos->num_rows > 0) {
    while ($row = $result_requisitos->fetch_assoc()) {
        $requisitos[] = $row; // Guardar los requisitos en el array
    }
} else {
    echo "No se encontraron requisitos seleccionados para esta cotización.";
}

// Cerrar la conexión de la consulta de requisitos
$stmt_requisitos->close();

$query_condiciones = "
    SELECT r.id_condiciones, r.descripcion_condiciones
    FROM c_condiciones_generales AS r
    JOIN c_cotizacion_condiciones AS cr ON r.id_condiciones = cr.id_condiciones
    WHERE cr.id_cotizacion = ?
";

// Preparar y ejecutar la consulta para obtener requisitos
$stmt_condiciones = $mysqli->prepare($query_condiciones);
$stmt_condiciones->bind_param("i", $id_cotizacion);
$stmt_condiciones->execute();
$result_condiciones = $stmt_condiciones->get_result();

// Verificar si hay resultados de requisitos
$condiciones = [];
if ($result_condiciones->num_rows > 0) {
    while ($row = $result_condiciones->fetch_assoc()) {
        $condiciones[] = $row; // Guardar los requisitos en el array
    }
} else {
    echo "No se encontraron condiciones seleccionados para esta cotización.";
}

// Cerrar la conexión de la consulta de requisitos
$stmt_condiciones->close();

$query_obligaciones = "
    SELECT r.id, indice,  r.descripcion
    FROM e_obligaciones_cliente AS r
    JOIN c_cotizaciones_obligaciones AS cr ON r.id = cr.id_obligacion
    WHERE cr.id_cotizacion = ?
";

// Preparar y ejecutar la consulta para obtener requisitos
$stmt_obligaciones = $mysqli->prepare($query_obligaciones);
$stmt_obligaciones->bind_param("i", $id_cotizacion);
$stmt_obligaciones->execute();
$result_obligaciones = $stmt_obligaciones->get_result();

// Verificar si hay resultados de requisitos
$obligaciones = [];
if ($result_obligaciones->num_rows > 0) {
    while ($row = $result_obligaciones->fetch_assoc()) {
        $obligaciones[] = $row; // Guardar los requisitos en el array
    }
} else {
    echo "No se encontraron obligaciones seleccionados para esta cotización.";
}

// Cerrar la conexión de la consulta de requisitos
$stmt_obligaciones->close();


// Consulta para obtener observaciones
$query_observaciones = "
    SELECT o.id_observacion, o.observacion
    FROM C_Observaciones AS o
    WHERE o.id_cotizacion = ?
";

// Preparar y ejecutar la consulta para obtener observaciones
$stmt_observaciones = $mysqli->prepare($query_observaciones);
$stmt_observaciones->bind_param("i", $id_cotizacion);
$stmt_observaciones->execute();
$result_observaciones = $stmt_observaciones->get_result();

// Verificar si hay resultados de observaciones
$observaciones = [];
if ($result_observaciones->num_rows > 0) {
    while ($row = $result_observaciones->fetch_assoc()) {
        $observaciones[] = $row; // Guardar las observaciones en el array
    }
} else {
    echo "No se encontraron observaciones para esta cotización.";
}

// Cerrar la conexión de la consulta de observaciones
$stmt_observaciones->close();



?>
<html>
<head>
    <link rel="stylesheet" href="../../css/ver_cotizacion/ver.css">
</head>
<body>
        <!-- Contenedor de botones -->
    <!-- Contenedor de botones -->
    <div class="button-contenedor">
        <button class="button volver" onclick="window.history.back()">Volver</button>
        <button class="button imprimir" onclick="imprimir()">Imprimir</button>
    </div>
    <div class="contenedor">

        <?php include 'header.php'; ?>

        <?php include 'info_cliente.php'; ?>

        <?php include 'detalle.php'; ?>

        
        <?php include 'totales.php'; ?>


        <table class="totals">
    <tr class="son">
        <td colspan="2">
            <strong>SON:</strong> <span id="total_final_letras"><?php echo htmlspecialchars($totales['total_final_letras']); ?></span> PESOS
        </td>
    </tr>
</table>


    <?php include 'bancos.php'; ?>

    <table>
    <tr>
        <td>
            <?php include 'ver_requisitos.php'; ?>
        </td>
        <td>
            <?php include 'ver_condiciones.php'; ?>
        </td>
        <td>
            <?php include 'ver_obligaciones.php'; ?>
        </td>
    </tr>
    </table>

    <table>
    <tr>
        <td>
            <?php include '../nueva_cotizacion/firma.php'; ?>

        </td>
    </tr>
    </table>

    
  </div>
    <button onclick="imprimir()">Imprimir</button>
 </body>
 <script src="../../js/ver_cotizacion/ver.js"></script> 
</html>


<?php 

// Cerrar la conexión principal al final
$mysqli->close();
?>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  Ver .PHP -----------------------------------
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
