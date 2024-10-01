<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd');

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
        <div class="header-container">
            <img alt="Company Logo" class="logo" src="<?php echo $url_foto; ?>"/>
            <div class="header">
                <h1><?php echo $items[0]['nombre_empresa']; ?></h1>
                <h2><?php echo $items[0]['nombre_empresa']; ?></h2>
                <div class="contact-info">
                    <p>DIRECCIÓN: <?php echo $items[0]['direccion_empresa']; ?></p>
                    <p>TELÉFONO: <?php echo $items[0]['telefono_empresa']; ?></p>
                    <p>E-MAIL: <?php echo $items[0]['email_empresa']; ?></p>
                    <p>WEB: <?php echo $items[0]['web_empresa']; ?></p>
                </div>
            </div>
            <div class="invoice-info">
                <p>R.U.T.: 19.279.652-0</p>
                <h3>FACTURA ELECTRÓNICA</h3>
                <p>Nº: 133</p>
                <p class="sii-info">S.I.I. - SISTEMA DE PRUEBAS</p>
            </div>
        </div>
        <table class="customer-info">
            <tbody>
                <tr>
                    <td>
                        <strong>SEÑOR(ES):</strong> <?php echo $items[0]['nombre_cliente']; ?><br>
                        <strong>RUT:</strong> <?php echo $items[0]['rut_cliente']; ?><br>
                        <strong>DIRECCIÓN:</strong> <?php echo $items[0]['direccion_cliente']; ?><br>
                        <strong>GIRO:</strong> <?php echo $items[0]['giro_cliente']; ?><br>
                        <strong>COMUNA:</strong> <?php echo $items[0]['comuna_cliente']; ?><br>
                        <strong>CIUDAD:</strong> <?php echo $items[0]['ciudad_cliente']; ?><br>
                        <strong>TELÉFONO:</strong> <?php echo $items[0]['telefono_cliente']; ?><br>
                        <strong>FORMA PAGO:</strong> <!-- Aquí iría la forma de pago (déjalo vacío) -->
                    </td>
                    <td>
                        <strong>F. EMISIÓN:</strong> <?php echo $items[0]['fecha_emision']; ?><br>
                        <strong>F. VENCIMIENTO:</strong> <?php echo $items[0]['fecha_validez']; ?><br>
                        <strong>CABECERA:</strong><br>
                        <strong>CABECERA1:</strong> <!-- Aquí puedes agregar más información si es necesario -->
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>DOCUMENTOS DE REFERENCIA</strong><br>
                        Cotización: <?php echo $id_cotizacion; ?>, Fecha: <?php echo $items[0]['fecha_emision']; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="items">
            <tr>
                <th class="nombre_producto">CÓDIGO</th>
                <th class="descripcion">DESCRIPCIÓN</th>
                <th class="cant">CANT.</th>
                <th class="precio_unitario">precio_unitario</th>
                <th class="dscto">DSCTO.</th>
                <th class="total">TOTAL</th>
            </tr>
            <tr>
                <td>
                    <?php foreach ($items as $item): ?>
                        <?php echo $item['nombre_producto']; ?><br><br>
                    <?php endforeach; ?>
                </td>
                <td>
                    <?php foreach ($items as $item): ?>
                        <?php echo $item['descripcion']; ?><br><br>
                    <?php endforeach; ?>
                </td>
                <td>
                    <?php foreach ($items as $item): ?>
                        <?php echo $item['cantidad']; ?><br><br>
                    <?php endforeach; ?>
                </td>
                <td>
                    <?php foreach ($items as $item): ?>
                        <?php echo $item['precio_unitario']; ?><br><br>
                    <?php endforeach; ?>
                </td>
                <td>
                    <?php foreach ($items as $item): ?>
                        <?php echo $item['descuento_porcentaje']; ?><br><br>
                    <?php endforeach; ?>
                </td> <!-- Cambié 'descuento_porcentaje' a 'descuento_porcentaje' -->
                <td>
                    <?php foreach ($items as $item): ?>
                        <?php echo $item['total']; ?><br><br>
                    <?php endforeach; ?>
                </td>
            </tr>
        </table>
   <div class="totals-container">
    <table class="observations">
     <tr>
      <td>
       OBSERVACIONES
      </td>
     </tr>
     <tr class="large-cell">
      <td>
      </td>
     </tr>
    </table>
    <table class="totals">
            <tr>
                <td>Sub-total</td>
                <td>$ <?php echo number_format($totales['sub_total'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Monto descuento_porcentaje</td>
                <td>$ <?php echo number_format($totales['descuento_global'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>19% I.V.A.</td>
                <td>$ <?php echo number_format($totales['total_iva'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Monto neto</td>
                <td>$ <?php echo number_format($totales['monto_neto'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>TOTAL</td>
                <td>$ <?php echo number_format($totales['total_final'], 0, ',', '.'); ?></td>
            </tr>
        </table>
   </div>
   <table class="totals">
    <tr class="son">
     <td colspan="2">
      SON: QUINIENTOS NOVENTA Y CINCO PESOS
     </td>
    </tr>
   </table>
   <div class="barcode-container">
        <!-- Tabla de información bancaria -->
        <h3>Información de Cuentas Bancarias</h3>
        <?php foreach ($bancos as $banco): ?>
        <table class="bank-info">
            <tr>
                <td>
                    <strong>BANCO:</strong> <?php echo $banco['nombre_banco']; ?><br>
                    <strong>TIPO CUENTA:</strong> <?php echo $banco['tipocuenta']; ?><br>
                    <strong>N° CUENTA:</strong> <?php echo $banco['numero_cuenta']; ?><br>
                    <strong>RUT:</strong> <?php echo $banco['rut_titular']; ?><br>
                    <strong>TITULAR:</strong> <?php echo $banco['nombre_titular']; ?><br>
                    <strong>ENVIAR EMAIL A:</strong> <?php echo $banco['email_banco']; ?>
                </td>
            </tr>
        </table>
        <?php endforeach; ?>
   </div>
   <div class="barcode">
    <img alt="Barcode" height="50" src="../../imagenes/programa_cotizacion/prueba2.png" width="800"/>
   </div>
   <?php foreach ($titulos as $titulo_id => $titulo): ?>
    <table border="1">
        <tr>
            <th rowspan="15" class="vertical-text">T<br>i<br>t<br>u<br>l<br>o<br><br><?php echo $titulo['nombre']; ?></th>
            <th>nombre_producto</th>
            <th>descripcion</th>
            <th>cantidad</th>
            <th>precio_unitario</th>
            <th>descuento_porcentaje</th>
            <th>total</th>
        </tr>

        <tr>
            <?php 
            $codigos = [];
            $descripciones = [];
            $cantidades = [];
            $precios = [];
            $descuentos = [];
            $totales_detalle = [];

            foreach ($titulo['detalles'] as $detalle) {
                $codigos[] = $detalle['nombre_producto'];
                $descripciones[] = $detalle['descripcion'];
                $cantidades[] = $detalle['cantidad'];
                $precios[] = $detalle['precio_unitario'];
                $descuentos[] = $detalle['descuento_porcentaje'];
                $totales_detalle[] = $detalle['total'];
            }

            // Imprimir los datos en las filas correspondientes
            ?>
            <td><?php echo implode('<br>', $codigos); ?></td>
            <td><?php echo implode('<br>', $descripciones); ?></td>
            <td><?php echo implode('<br>', $cantidades); ?></td>
            <td><?php echo implode('<br>', $precios); ?></td>
            <td><?php echo implode('<br>', $descuentos); ?></td>
            <td><?php echo implode('<br>', $totales_detalle); ?></td>
        </tr>

        <?php 
        // Imprimir los subtítulos si existen
        foreach ($titulo['detalles'] as $detalle) {
            if (!empty($detalle['subtitulos'])) {
                foreach ($detalle['subtitulos'] as $subtitulo) {
                    echo "<tr><td colspan='6' class='subtitle'>{$subtitulo}</td></tr>";
                }
            }
        }
        ?>
    </table>
<?php endforeach; ?>
  </div>
 </body>
</html>