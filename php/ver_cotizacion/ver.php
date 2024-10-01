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

// Obtener el id_cotizacion (puedes obtenerlo dinámicamente según lo necesites)
$id_cotizacion = 2; // Ejemplo, ajusta según sea necesario

// Consulta para obtener los datos de la empresa, cliente y detalles de la cotización
$query = "
    SELECT 
        cot.id_empresa,
        e.nombre_empresa,
        e.direccion_empresa,
        e.telefono_empresa,
        e.email_empresa,
        e.web_empresa,
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
        det.nombre_producto,
        det.descripcion,  
        det.cantidad,   
        det.precio_unitario,  
        det.descuento_porcentaje AS descuento_porcentaje,  
        det.total           
    FROM C_Cotizaciones cot
    JOIN C_Clientes c ON cot.id_cliente = c.id_cliente
    JOIN E_Empresa e ON cot.id_empresa = e.id_empresa
    JOIN C_Titulos tit ON cot.id_cotizacion = tit.id_cotizacion  
    JOIN C_Detalles det ON tit.id_titulo = det.id_titulo  
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
        total.total_final
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
$mysqli->close();
?>
<html>
<head>
    <link rel="stylesheet" href="../../css/ver_cotizacion/ver.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px; /* Smaller font size */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px; /* Add space between tables */
        }
        th, td {
            border: 1px solid black;
            padding: 4px; /* Smaller padding */
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
        }
        .vertical-text {
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }
        .subtitle {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">

        <?php include 'header.php'; ?>

        <?php include 'info_cliente.php'; ?>

        <?php include 'detalle.php'; ?>

        <?php include 'totales.php'; ?>

   <table class="totals">
    <tr class="son">
     <td colspan="2">
      SON: QUINIENTOS NOVENTA Y CINCO PESOS
     </td>
    </tr>
   </table>

    <?php include 'bancos.php'; ?>

   <div class="barcode">
    <img alt="Barcode" height="50" src="../../imagenes/programa_cotizacion/prueba2.png" width="800"/>
   </div>
  </div>
 </body>
</html>

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
