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
    ------------------------------------- INICIO ITred Spa Procesar Cotizacion .PHP --------------------------------------
 ------------------------------------------------------------------------------------------------------------- -->

 <?php

// Crear la conexión
$mysqli = new mysqli('localhost','root','','itredspa_bd');






00



//// Recibir datos del formulario encargado
//falta agregar rut encargado.
$enc_nombre = $_POST['enc_nombre'];
$enc_email = $_POST['enc_email'];
$enc_fono = $_POST['enc_fono'];
$enc_celular = $_POST['enc_celular'];
$enc_proyecto = $_POST['enc_proyecto'];

// Insertar o actualizar el encargado
$sql = "INSERT INTO C_Encargados (nombre_encargado, email_encargado, fono_encargado, celular_encargado)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nombre_encargado=VALUES(nombre_encargado), email_encargado=VALUES(email_encargado), fono_encargado=VALUES(fono_encargado), celular_encargado=VALUES(celular_encargado)";
$stmt = $mysqli->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $mysqli->error);
}
$stmt->bind_param("ssss", $enc_nombre, $enc_email, $enc_fono, $enc_celular);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
$id_encargado = $mysqli->insert_id;
echo "Encargado insertado/actualizado. ID: $id_encargado<br>";




//// Recibir datos del formulario vendedor
// falta rut de vendedor.
$vendedor_nombre = $_POST['vendedor_nombre'];
$vendedor_email = $_POST['vendedor_email'];
$vendedor_fono = $_POST['vendedor_telefono'];
$vendedor_celular = $_POST['vendedor_celular'];

// Insertar o actualizar el vendedor
$sql = "INSERT INTO C_Vendedores (nombre_vendedor, email_vendedor, fono_vendedor, celular_vendedor)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nombre_vendedor=VALUES(nombre_vendedor), email_vendedor=VALUES(email_vendedor), fono_vendedor=VALUES(fono_vendedor), celular_vendedor=VALUES(celular_vendedor)";
$stmt = $mysqli->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $mysqli->error);
}
$stmt->bind_param("ssss", $vendedor_nombre, $vendedor_email, $vendedor_fono, $vendedor_celular);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}

$id_vendedor = $mysqli->insert_id;
echo "Vendedor insertado/actualizado. ID: $id_vendedor<br>";




//INSERTAR DATOS En la tabla cotizaciones
// Obtener id_cliente
$sql = "SELECT id_cliente FROM C_Clientes WHERE rut_cliente = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $cliente_rut);
$stmt->execute();
$stmt->bind_result($id_cliente);
$stmt->fetch();
$stmt->close();
if (!$id_cliente) {
    die("Error: Cliente no encontrado.");
}
// Obtener id_proyecto
$sql = "SELECT id_proyecto FROM C_Proyectos WHERE codigo_proyecto = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $proyecto_codigo);
$stmt->execute();
$stmt->bind_result($id_proyecto);
$stmt->fetch();
$stmt->close();
if (!$id_proyecto) {
    die("Error: Proyecto no encontrado.");
}
// Obtener id_empresa
$sql = "SELECT id_empresa FROM E_Empresa WHERE rut_empresa = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $empresa_rut);
$stmt->execute();
$stmt->bind_result($id_empresa);
$stmt->fetch();
$stmt->close();
if (!$id_empresa) {
    die("Error: Empresa no encontrada.");
}
// Recibir datos del formulario cotizacion
$numero_cotizacion = $_POST['numero_cotizacion'];
$fecha_validez = $_POST['fecha_validez'];
$fecha_emision = $_POST['fecha_emision'];

// Insertar en la tabla Cotizaciones
$sql_cotizaciones = "INSERT INTO C_Cotizaciones (
    numero_cotizacion, fecha_emision, fecha_validez,
    id_cliente, id_proyecto, id_empresa, id_vendedor, id_encargado
) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql_cotizaciones);
$stmt->bind_param(
    "sssiiiii",
    $numero_cotizacion, $fecha_emision, $fecha_validez, 
    $id_cliente, $id_proyecto, $id_empresa, $id_vendedor, $id_encargado
);
$stmt->execute();

if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}

$id_cotizacion = $mysqli->insert_id;
echo "Cotización insertada. ID: $id_cotizacion<br>";






// Recibir datos del formulario
$detalles_titulo = $_POST['detalle_titulo'] ?? [];
$detalles_subtitulo = $_POST['detalle_subtitulo'] ?? [];
$detalles_cantidad = $_POST['detalle_cantidad'] ?? [];
$detalles_descripcion = $_POST['detalle_descripcion'] ?? [];
$detalles_precio_unitario = $_POST['detalle_precio_unitario'] ?? [];
$detalles_descuento = $_POST['detalle_descuento'] ?? [];
$detalles_tipo = $_POST['tipo_producto'] ?? [];
$detalles_nombre_producto = $_POST['nombre_producto'] ?? [];

// Estructurar los datos en arrays anidados
$estructura_datos = [];

foreach ($detalles_titulo as $titulo_index => $titulo) {
    $estructura_datos[$titulo_index] = [
        'titulo' => $titulo,
        'subtitulos' => [],
        'detalles' => [],
    ];

    // Asignar subtítulos y detalles correspondientes a cada título
    foreach ($detalles_subtitulo[$titulo_index] ?? [] as $subtitulo_index => $subtitulo) {
        $estructura_datos[$titulo_index]['subtitulos'][] = $subtitulo;
    }

    foreach ($detalles_cantidad[$titulo_index] ?? [] as $detalle_index => $cantidad) {
        $precio_unitario = floatval($detalles_precio_unitario[$titulo_index][$detalle_index] ?? 0);
        $descuento = floatval($detalles_descuento[$titulo_index][$detalle_index] ?? 0);
        $total = ($precio_unitario * $cantidad) - (($precio_unitario * $cantidad) * ($descuento / 100));

        $estructura_datos[$titulo_index]['detalles'][] = [
            'tipo' => $detalles_tipo[$titulo_index][$detalle_index] ?? '',
            'nombre_producto' => $detalles_nombre_producto[$titulo_index][$detalle_index] ?? '',
            'descripcion' => $detalles_descripcion[$titulo_index][$detalle_index] ?? '',
            'cantidad' => intval($cantidad),
            'precio_unitario' => $precio_unitario,
            'descuento' => $descuento,
            'total' => round($total, 2),
        ];
    }
}

// Preparar las consultas de inserción
$sql_insert_titulo = "INSERT INTO C_Titulos (id_cotizacion, nombre) VALUES (?, ?)";
$sql_insert_subtitulo = "INSERT INTO C_Subtitulos (id_titulo, nombre) VALUES (?, ?)";
$sql_insert_detalle = "INSERT INTO C_Detalles (id_titulo, tipo, nombre_producto, descripcion, cantidad, precio_unitario, descuento_porcentaje, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt_insert_titulo = $mysqli->prepare($sql_insert_titulo);
$stmt_insert_subtitulo = $mysqli->prepare($sql_insert_subtitulo);
$stmt_insert_detalle = $mysqli->prepare($sql_insert_detalle);

if (!$stmt_insert_titulo || !$stmt_insert_subtitulo || !$stmt_insert_detalle) {
    die("Error al preparar las consultas: " . $mysqli->error);
}

// Comenzar una transacción para asegurar consistencia
$mysqli->begin_transaction();

try {
    foreach ($estructura_datos as $titulo_index => $data) {
        // Insertar el título y obtener su ID
        $stmt_insert_titulo->bind_param("is", $id_cotizacion, $data['titulo']);
        if (!$stmt_insert_titulo->execute()) {
            throw new Exception("Error al insertar título: " . $stmt_insert_titulo->error);
        }
        $id_titulo = $stmt_insert_titulo->insert_id;

        // Insertar los subtítulos asociados
        foreach ($data['subtitulos'] as $subtitulo) {
            $stmt_insert_subtitulo->bind_param("is", $id_titulo, $subtitulo);
            if (!$stmt_insert_subtitulo->execute()) {
                throw new Exception("Error al insertar subtítulo: " . $stmt_insert_subtitulo->error);
            }
        }

        // Insertar los detalles asociados
        foreach ($data['detalles'] as $detalle) {
            $stmt_insert_detalle->bind_param(
                "isssiddi",
                $id_titulo,
                $detalle['tipo'],
                $detalle['nombre_producto'],
                $detalle['descripcion'],
                $detalle['cantidad'],
                $detalle['precio_unitario'],
                $detalle['descuento'],
                $detalle['total']
            );
            if (!$stmt_insert_detalle->execute()) {
                throw new Exception("Error al insertar detalle: " . $stmt_insert_detalle->error);
            }
        }
    }

    // Confirmar la transacción
    $mysqli->commit();

} catch (Exception $e) {
    // En caso de error, deshacer la transacción
    $mysqli->rollback();
    echo "Error al insertar los datos: " . $e->getMessage();
}

// Cerrar las consultas preparadas
$stmt_insert_titulo->close();
$stmt_insert_subtitulo->close();
$stmt_insert_detalle->close();





$sub_total = $_POST['sub_total'] ?? 0;
$descuento_global = $_POST['descuento_global_porcentaje'] ?? 0;
$monto_neto = $_POST['monto_neto'] ?? 0;
$iva_valor = $_POST['iva_porcentaje'] ?? 0;
$total_iva = $_POST['total_iva'] ?? 0;
$total_final = $_POST['total_final'] ?? 0;

// Inserta los totales
$sql_insert_totales = "INSERT INTO C_Totales (id_cotizacion, sub_total, descuento_global, monto_neto, iva_valor, total_iva, total_final) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql_insert_totales);
$stmt->bind_param("idididd", $id_cotizacion, $sub_total, $descuento_global, $monto_neto, $iva_valor, $total_iva, $total_final);
$stmt->execute();
$id_total = $stmt->insert_id; // Obtener el ID del total recién insertado
echo "Totales insertados correctamente. ID: $id_total<br>";



// Recibir los datos del formulario para pago
$numero_pago = $_POST['numero_pago'] ?? null;
$pago_descripcion = $_POST['descripcion_pago'] ?? null;
$porcentaje_pago = $_POST['porcentaje_pago'] ?? null;
$monto_pago = $_POST['monto_pago'] ?? null;
$fecha_pago = $_POST['fecha_pago'] ?? null;
$forma_pago = $_POST['forma_pago'] ?? null;

// Validar datos obligatorios
if (is_null($porcentaje_pago) || is_null($monto_pago) || is_null($fecha_pago) || is_null($forma_pago)) {
    die("Faltan datos obligatorios.");
}

// Insertar datos en la tabla pago
$sql = "INSERT INTO C_pago (id_cotizacion, numero_pago, descripcion, porcentaje_pago, monto_pago, fecha_pago, forma_pago)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $mysqli->error);
}

// Asignar los parámetros de forma correcta
$stmt->bind_param("iisdiss", $id_cotizacion, $numero_pago, $pago_descripcion, $porcentaje_pago, $monto_pago, $fecha_pago, $forma_pago);

// Ejecutar la consulta y manejar posibles errores
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}

echo "pago insertado correctamente. ID: " . $mysqli->insert_id;





// Mostrar el contenido del POST para depuración
echo "<pre>";
print_r($_POST);
echo "</pre>";



// <!-- ---------------------
//  -- INICIO CIERRE CONEXION BD --
//     --------------------- -->     
     
     $mysqli->close();
//     <!-- ---------------------
//       -- FIN CIERRE CONEXION BD --
//      --------------------- -->



exit();
?>



<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Procesar Cotizacion .PHP -----------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITredSpa.
BPPJ
-->