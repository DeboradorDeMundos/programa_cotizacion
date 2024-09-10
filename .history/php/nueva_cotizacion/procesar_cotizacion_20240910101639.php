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


// Definir la ruta de subida de archivos
$upload_dir = '../../imagenes/cotizacion/'; // Ruta relativa desde el archivo PHP
// Inicializar la variable para el ID de la foto
$empresa_id_foto = null;
// Verificar si el archivo fue subido sin errores
if (isset($_FILES['logo_upload']) && $_FILES['logo_upload']['error'] == UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['logo_upload']['tmp_name'];
    $name = basename($_FILES['logo_upload']['name']);

    // Validar el tipo de archivo
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['logo_upload']['type'], $allowed_types)) {
        die("Error: Tipo de archivo no permitido.");
    }

    $upload_file = $upload_dir . $name;

    // Mover el archivo cargado al directorio de destino
    if (move_uploaded_file($tmp_name, $upload_file)) {
        echo "Imagen subida correctamente.";

        // Insertar la ruta de la foto en la tabla FotosPerfil
        $sql_foto = "INSERT INTO C_FotosPerfil (ruta_foto) VALUES (?)";
        $stmt_foto = $mysqli->prepare($sql_foto);
        $stmt_foto->bind_param("s", $upload_file);
        if ($stmt_foto->execute()) {
            echo "Foto del perfil insertada correctamente.";
            
            // Obtener el ID de la foto recién insertada
            $empresa_id_foto = $mysqli->insert_id;
        } else {
            die("Error al insertar la foto del perfil: " . $stmt_foto->error);
        }
        $stmt_foto->close();
    } else {
        die("Error al subir la imagen.");
    }
} else {
    echo "No se subió una imagen.";
}


// Recibir datos del formulario empresa
$empresa_id = $_POST['empresa_id'];
$empresa_rut = $_POST['empresa_rut'];
$empresa_nombre = $_POST['empresa_nombre'];
$empresa_area = $_POST['empresa_area'];
$empresa_direccion = $_POST['empresa_direccion'];
$empresa_telefono = $_POST['empresa_telefono'];
$empresa_email = $_POST['empresa_email'];

// Insertar o actualizar la empresa
$sql = "INSERT INTO E_Empresa (rut_empresa, id_foto, nombre_empresa, area_empresa, direccion_empresa, telefono_empresa, email_empresa)
        VALUES (?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nombre_empresa=VALUES(nombre_empresa), area_empresa=VALUES(area_empresa), direccion_empresa=VALUES(direccion_empresa), telefono_empresa=VALUES(telefono_empresa), email_empresa=VALUES(email_empresa)";
$stmt = $mysqli->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $mysqli->error);
}
$stmt->bind_param("sisssss", $empresa_rut, $empresa_id_foto, $empresa_nombre, $empresa_area, $empresa_direccion, $empresa_telefono, $empresa_email);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
// Obtener el ID de la empresa después de la inserción/actualización
$id_empresa = $mysqli->insert_id;
echo "Empresa insertada/actualizada. ID: $id_empresa<br>";




//// Recibir datos del formulario cliente
$cliente_nombre = $_POST['cliente_nombre'];
$cliente_rut = $_POST['cliente_rut'];
$cliente_empresa = $_POST['cliente_empresa'];
$cliente_direccion = $_POST['cliente_direccion'];
$cliente_lugar = $_POST['cliente_lugar'];
$cliente_fono = $_POST['cliente_fono'];
$cliente_email = $_POST['cliente_email'];
$cliente_cargo = $_POST['cliente_cargo'];
$cliente_giro = $_POST['cliente_giro'];
$cliente_comuna = $_POST['cliente_comuna'];
$cliente_ciudad = $_POST['cliente_ciudad'];
$cliente_tipo = $_POST['cliente_tipo'];

// Insertar o actualizar el cliente
$sql = "INSERT INTO C_Clientes (nombre_cliente, empresa_cliente, rut_cliente, direccion_cliente, lugar_cliente, telefono_cliente, email_cliente, cargo_cliente, giro_cliente, comuna_cliente, ciudad_cliente, tipo_cliente)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nombre_cliente=VALUES(nombre_cliente), empresa_cliente=VALUES(empresa_cliente), direccion_cliente=VALUES(direccion_cliente), lugar_cliente=VALUES(lugar_cliente), telefono_cliente=VALUES(telefono_cliente), email_cliente=VALUES(email_cliente), cargo_cliente=VALUES(cargo_cliente), giro_cliente=VALUES(giro_cliente), comuna_cliente=VALUES(comuna_cliente), ciudad_cliente=VALUES(ciudad_cliente), tipo_cliente=VALUES(tipo_cliente)";
$stmt = $mysqli->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $mysqli->error);
}
$stmt->bind_param("ssssssssssss", $cliente_nombre, $cliente_empresa, $cliente_rut, $cliente_direccion, $cliente_lugar, $cliente_fono, $cliente_email, $cliente_cargo, $cliente_giro, $cliente_comuna, $cliente_ciudad, $cliente_tipo);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
$id_cliente = $mysqli->insert_id;
echo "Cliente insertado/actualizado. ID: $id_cliente<br>";





// Recibir datos del formulario para C_Proyectos
$proyecto_nombre = $_POST['proyecto_nombre'];
$proyecto_codigo = $_POST['proyecto_codigo'];
$tipo_trabajo = $_POST['tipo_trabajo'];
$area_trabajo = $_POST['area_trabajo'];
$riesgo = $_POST['riesgo'];
$dias_compra = $_POST['dias_compra'];
$dias_trabajo = $_POST['dias_trabajo'];
$trabajadores = $_POST['trabajadores'];
$horario = $_POST['horario'];
$colacion = $_POST['colacion'];
$entrega = $_POST['entrega'];

// Insertar o actualizar el proyecto
$sql = "INSERT INTO C_Proyectos (nombre_proyecto, codigo_proyecto, tipo_trabajo, area_trabajo, riesgo_proyecto, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE 
            nombre_proyecto=VALUES(nombre_proyecto), 
            codigo_proyecto=VALUES(codigo_proyecto), 
            tipo_trabajo=VALUES(tipo_trabajo), 
            area_trabajo=VALUES(area_trabajo), 
            riesgo_proyecto=VALUES(riesgo_proyecto),
            dias_compra=VALUES(dias_compra),
            dias_trabajo=VALUES(dias_trabajo),
            trabajadores=VALUES(trabajadores),
            horario=VALUES(horario),
            colacion=VALUES(colacion),
            entrega=VALUES(entrega)";
$stmt = $mysqli->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $mysqli->error);
}
$stmt->bind_param("sssssiissss", $proyecto_nombre, $proyecto_codigo, $tipo_trabajo, $area_trabajo, $riesgo, $dias_compra, $dias_trabajo, $trabajadores, $horario, $colacion, $entrega);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
$id_proyecto = $mysqli->insert_id;
echo "Proyecto insertado/actualizado. ID: $id_proyecto<br>";



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
$detalles_tipo = $_POST['detalle_tipo'] ?? [];
$detalles_nombre_producto = $_POST['nombre_producto'] ?? [];

// Verificar el número de títulos
$numero_titulos = count($detalles_titulo);

// Preparar las consultas de inserción
$sql_insert_titulo = "INSERT INTO C_Titulos (id_cotizacion, nombre) VALUES (?, ?)";
$sql_insert_subtitulo = "INSERT INTO C_Subtitulos (id_titulo, nombre) VALUES (?, ?)";
$sql_insert_detalle = "INSERT INTO C_Detalles (id_titulo, tipo, nombre_producto, descripcion, cantidad, precio_unitario, descuento_porcentaje, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt_insert_titulo = $mysqli->prepare($sql_insert_titulo);
$stmt_insert_subtitulo = $mysqli->prepare($sql_insert_subtitulo);
$stmt_insert_detalle = $mysqli->prepare($sql_insert_detalle);

// Crear un array para guardar los IDs de los títulos
$titulos_ids = [];

// Comenzar una transacción para asegurar consistencia
$mysqli->begin_transaction();

try {
    // Insertar los títulos y obtener sus IDs
    for ($index = 0; $index < $numero_titulos; $index++) {
        $titulo = $detalles_titulo[$index] ?? '';
        if ($titulo) {
            $stmt_insert_titulo->bind_param("is", $id_cotizacion, $titulo);
            $stmt_insert_titulo->execute();
            $id_titulo = $stmt_insert_titulo->insert_id;
            $titulos_ids[$index] = $id_titulo;
            echo "Título insertado correctamente. ID: $id_titulo<br>";
        } else {
            echo "Falta el título para el índice $index.<br>";
        }
    }

    // Insertar los subtítulos para cada título
    $sub_index = 0;
    foreach ($titulos_ids as $index => $id_titulo) {
        // Insertar los subtítulos correspondientes a este título
        $num_subtitulos_por_titulo = count($detalles_subtitulo) / $numero_titulos;
        for ($i = 0; $i < $num_subtitulos_por_titulo; $i++) {
            $subtitulo = $detalles_subtitulo[$sub_index] ?? '';
            if ($subtitulo) {
                $stmt_insert_subtitulo->bind_param("is", $id_titulo, $subtitulo);
                $stmt_insert_subtitulo->execute();
                $id_subtitulo = $stmt_insert_subtitulo->insert_id;
                echo "Subtítulo insertado correctamente. ID: $id_subtitulo<br>";
            }
            $sub_index++;
        }
    }

    // Insertar los detalles para cada título
    for ($detalle_index = 0; $detalle_index < count($detalles_cantidad); $detalle_index++) {
        // Calcula el índice del título correspondiente
        $titulo_index = intdiv($detalle_index, $numero_titulos);

        // Verificar si todos los datos relevantes están presentes
        $descripcion = $detalles_descripcion[$detalle_index] ?? '';
        $precio_unitario = $detalles_precio_unitario[$detalle_index] ?? 0;
        $cantidad = $detalles_cantidad[$detalle_index] ?? 0;
        $descuento = $detalles_descuento[$detalle_index] ?? 0;
        $tipo = $detalles_tipo[$detalle_index] ?? '';
        $nombre_producto = $detalles_nombre_producto[$detalle_index] ?? '';

        // Evitar insertar filas vacías o con valores nulos
        if (!empty($nombre_producto) && $cantidad > 0 && $precio_unitario > 0) {
            // Verificar que el título correcto está asignado
            if (isset($titulos_ids[$titulo_index])) {
                $id_titulo = $titulos_ids[$titulo_index];

                // Calcular el precio final
                $precio_final = $precio_unitario - ($precio_unitario * ($descuento / 100));

                // Insertar el detalle
                $stmt_insert_detalle->bind_param(
                    "isssiddi",
                    $id_titulo,
                    $tipo,
                    $nombre_producto,
                    $descripcion,
                    $cantidad,
                    $precio_unitario,
                    $descuento,
                    $precio_final
                );
                $stmt_insert_detalle->execute();
                $id_detalle = $stmt_insert_detalle->insert_id;
                echo "Detalle insertado correctamente. ID: $id_detalle<br>";
            }
        } else {
            echo "Detalle omitido debido a datos incompletos para el índice $detalle_index.<br>";
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



// Recibir los datos del formulario para ADELANTO
$adelanto_descripcion = $_POST['adelanto_descripcion'] ?? null;
$porcentaje_adelanto = $_POST['porcentaje_adelanto'] ?? null;
$monto_adelanto = $_POST['monto_adelanto'] ?? null;
$fecha_adelanto = $_POST['fecha_adelanto'] ?? null;

// Verificar que todos los campos necesarios estén presentes
if ($porcentaje_adelanto === null || $monto_adelanto === null || $fecha_adelanto === null) {
    die("Error: Todos los campos del adelanto son requeridos.");
}

// Validar que el porcentaje y el monto sean numéricos
if (!is_numeric($porcentaje_adelanto) || !is_numeric($monto_adelanto)) {
    die("Error: El porcentaje y el monto deben ser numéricos.");
}

// Validar que el porcentaje esté entre 0 y 100
if ($porcentaje_adelanto < 0 || $porcentaje_adelanto > 100) {
    die("Error: El porcentaje debe estar entre 0 y 100.");
}

// Insertar datos en la tabla Adelanto
$sql = "INSERT INTO C_Adelanto (id_cotizacion, porcentaje_adelanto, monto_adelanto, fecha_adelanto, descripcion)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $mysqli->error);
}
$stmt->bind_param("iddss", $id_cotizacion, $porcentaje_adelanto, $monto_adelanto, $fecha_adelanto, $adelanto_descripcion);

$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}

echo "Adelanto insertado correctamente. ID: " . $mysqli->insert_id;





//insertar datos en la tabla condiciones generales
// Recibir los datos del formulario
$descripcion_condiciones = $_POST['descripcion_condiciones'];
$estado_condiciones = $_POST['estado_condiciones'] ;


// Insertar datos en la tabla Condiciones_Generales
$sql = "INSERT INTO C_Condiciones_Generales (id_cotizacion, descripcion_condiciones, estado) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $mysqli->error);
}

foreach ($descripcion_condiciones as $key => $descripcion) {
    $estado = isset($estado_condiciones[$key]) ? 1 : 0;
    $stmt->bind_param("isi", $id_cotizacion, $descripcion, $estado);
    
    if (!$stmt->execute()) {
        die("Error al insertar: " . $stmt->error);
    }
}

echo "Condiciones generales insertadas correctamente.";
$stmt->close();



//<!-- ---------------------
//-- INICIO CIERRE CONEXION BD --
//     --------------------- -->     
     
     $mysqli->close();
//<!-- ---------------------
//     -- FIN CIERRE CONEXION BD --
 //    --------------------- -->


// Cerrar la conexión
$mysqli->close();
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