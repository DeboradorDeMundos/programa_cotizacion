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
// Habilitar el reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Crear la conexión
$conn = new mysqli('localhost','root','','itredspa_bd');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa<br>";

// Recibir datos del formulario cotizacion
$numero_cotizacion = $_POST['numero_cotizacion'];
$fecha_validez = $_POST['fecha_validez'];
$fecha_emision = $_POST['fecha_emision'];



//// Recibir datos del formulario vendedor
$vendedor_nombre = $_POST['vendedor_nombre'];
$vendedor_email = $_POST['vendedor_email'];
$vendedor_fono = $_POST['vendedor_telefono'];
$vendedor_celular = $_POST['vendedor_celular'];

//// Recibir datos del formulario cuenta_banco
$nombre_titular = $_POST['nombre_titular'];
$rut_titular = $_POST['rut_titular'];
$id_banco = $_POST['id_banco'];
$id_tipocuenta = $_POST['id_tipocuenta'];
$numero_cuenta = $_POST['numero_cuenta'];
$celular_cuenta = $_POST['celular'];
$email_banco = $_POST['email_banco'];

//// Recibir datos del formulario descripcion/desgloce de cotización
$sub_total = $_POST['sub_total'] ?? 0;
$descuento_global = $_POST['descuento_global_porcentaje'] ?? 0;
$monto = $_POST['monto']?? 0;
$monto_neto = $_POST['monto_neto'] ?? 0;
$iva_valor = $_POST['iva_porcentaje']?? 0;
$total_iva = $_POST['total_iva']?? 0;
$total_final = $_POST['total_final']?? 0;

// Recibir los datos del adelanto
$porcentaje_adelanto = $_POST['porcentaje_adelanto'];
$monto_adelanto = $_POST['monto_adelanto'];
$fecha_adelanto = $_POST['fecha_adelanto'];




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
        $stmt_foto = $conn->prepare($sql_foto);
        $stmt_foto->bind_param("s", $upload_file);
        if ($stmt_foto->execute()) {
            echo "Foto del perfil insertada correctamente.";
            
            // Obtener el ID de la foto recién insertada
            $empresa_id_foto = $conn->insert_id;
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
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("sisssss", $empresa_rut, $empresa_id_foto, $empresa_nombre, $empresa_area, $empresa_direccion, $empresa_telefono, $empresa_email);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
// Obtener el ID de la empresa después de la inserción/actualización
$id_empresa = $conn->insert_id;
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
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("ssssssssssss", $cliente_nombre, $cliente_empresa, $cliente_rut, $cliente_direccion, $cliente_lugar, $cliente_fono, $cliente_email, $cliente_cargo, $cliente_giro, $cliente_comuna, $cliente_ciudad, $cliente_tipo);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
$id_cliente = $conn->insert_id;
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
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("sssssiissss", $proyecto_nombre, $proyecto_codigo, $tipo_trabajo, $area_trabajo, $riesgo, $dias_compra, $dias_trabajo, $trabajadores, $horario, $colacion, $entrega);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
$id_proyecto = $conn->insert_id;
echo "Proyecto insertado/actualizado. ID: $id_proyecto<br>";



//// Recibir datos del formulario encargado
//falta agregar rut
$enc_nombre = $_POST['enc_nombre'];
$enc_email = $_POST['enc_email'];
$enc_fono = $_POST['enc_fono'];
$enc_celular = $_POST['enc_celular'];
$enc_proyecto = $_POST['enc_proyecto'];

// Insertar o actualizar el encargado
$sql = "INSERT INTO Encargados (nombre_encargado, email_encargado, fono_encargado, celular_encargado)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nombre_encargado=VALUES(nombre_encargado), email_encargado=VALUES(email_encargado), fono_encargado=VALUES(fono_encargado), celular_encargado=VALUES(celular_encargado)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("ssss", $enc_nombre, $enc_email, $enc_fono, $enc_celular);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
$id_encargado = $conn->insert_id;
echo "Encargado insertado/actualizado. ID: $id_encargado<br>";

// Insertar o actualizar el vendedor
$sql = "INSERT INTO Vendedores (nombre_vendedor, email_vendedor, fono_vendedor, celular_vendedor)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE nombre_vendedor=VALUES(nombre_vendedor), email_vendedor=VALUES(email_vendedor), fono_vendedor=VALUES(fono_vendedor), celular_vendedor=VALUES(celular_vendedor)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("ssss", $vendedor_nombre, $vendedor_email, $vendedor_fono, $vendedor_celular);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}

$id_vendedor = $conn->insert_id;
echo "Vendedor insertado/actualizado. ID: $id_vendedor<br>";
// Insertar datos en la tabla Cuenta_Bancaria
$sql = "INSERT INTO Cuenta_Bancaria (rut_titular, nombre_titular, id_banco, id_tipocuenta, numero_cuenta, celular, email_banco, id_empresa)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("ssiiissi", $rut_titular, $nombre_titular,  $id_banco, $id_tipocuenta, $numero_cuenta, $celular_cuenta, $email_banco, $empresa_id);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}

$id_cuenta = $conn->insert_id;
echo "Cuenta bancaria insertada. ID: $id_cuenta<br>";


// Insertar la cotización
// Obtener id_cliente
$sql = "SELECT id_cliente FROM Clientes WHERE rut_cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cliente_rut);
$stmt->execute();
$stmt->bind_result($id_cliente);
$stmt->fetch();
$stmt->close();

// Obtener id_proyecto
$sql = "SELECT id_proyecto FROM proyectos WHERE codigo_proyecto = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $proyecto_codigo);
$stmt->execute();
$stmt->bind_result($id_proyecto);
$stmt->fetch();
$stmt->close();

// Obtener id_empresa
$sql = "SELECT id_empresa FROM empresa WHERE rut_empresa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $empresa_rut);
$stmt->execute();
$stmt->bind_result($id_empresa);
$stmt->fetch();
$stmt->close();

// Insertar en la tabla Cotizaciones
$sql_cotizaciones = "INSERT INTO Cotizaciones (
    numero_cotizacion, fecha_emision, fecha_validez, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega,
    id_cliente, id_proyecto, id_empresa, id_vendedor, id_encargado, id_cuenta, sub_total, descuento_global, monto, monto_neto,
    iva_valor, total_iva, total_final, id_adelanto, id_condiciones, id_requisitos
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql_cotizaciones);
$stmt->bind_param(
    "ssssssisssiiiiiiiididiiii",
    $numero_cotizacion, $fecha_emision, $fecha_validez, $dias_compra, $dias_trabajo, $trabajadores, $horario, $colacion, $entrega,
    $id_cliente, $id_proyecto, $id_empresa, $id_vendedor, $id_encargado, $id_cuenta, $sub_total, $descuento_global, $monto, $monto_neto,
    $iva_valor, $total_iva, $total_final, $id_adelanto, $id_condiciones, $id_requisitos
);
$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}
$id_cotizacion = $conn->insert_id;
echo "Cotización insertada. ID: $id_cotizacion<br>";

echo "<pre>";
print_r($_POST);
echo "</pre>";


// Procesar detalles
$detalles_titulo = $_POST['detalle_titulo'] ?? [];
$detalles_cantidad = $_POST['detalle_cantidad'] ?? [];
$detalles_descripcion = $_POST['detalle_descripcion'] ?? [];
$detalles_precio_unitario = $_POST['detalle_precio_unitario'] ?? [];
$detalles_descuento = $_POST['detalle_descuento'] ?? [];

// Verifica que todos los arrays tengan la misma longitud
$numero_detalles = count($detalles_titulo);

for ($index = 0; $index < $numero_detalles; $index++) {
    // Verifica que los índices existen antes de acceder
    $titulo = $detalles_titulo[$index] ?? '';
    $descripcion = $detalles_descripcion[$index] ?? '';
    $precio_unitario = $detalles_precio_unitario[$index] ?? 0;
    $cantidad = $detalles_cantidad[$index] ?? 0;
    $descuento = $detalles_descuento[$index] ?? 0;

    // Inserta el título
    if ($titulo) {
        $sql_insert_titulo = "INSERT INTO Titulos (nombre) VALUES (?)";
        $stmt = $conn->prepare($sql_insert_titulo);
        $stmt->bind_param("s", $titulo);
        $stmt->execute();
        $id_titulo = $stmt->insert_id; // Obtener el ID del título recién insertado
        echo "Título insertado correctamente. ID: $id_titulo<br>";

        // Calcular el precio final después del descuento
        $precio_final = $precio_unitario - ($precio_unitario * ($descuento / 100));

        // Inserta la descripción, solo si no está vacía
        if ($descripcion) {
            $sql_insert_descripcion = "INSERT INTO Descripciones (id_titulo, descripcion, precio_unitario) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql_insert_descripcion);
            $stmt->bind_param("isd", $id_titulo, $descripcion, $precio_final);
            $stmt->execute();
            $id_descripcion = $stmt->insert_id; // Obtener el ID de la descripción recién insertada
            echo "Descripción insertada correctamente. ID: $id_descripcion<br>";

            // Inserta el detalle de la cotización
            $sql_insert_detalle = "INSERT INTO Detalle_Cotizacion (id_cotizacion, id_descripcion, cantidad) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql_insert_detalle);
            $stmt->bind_param("iii", $id_cotizacion, $id_descripcion, $cantidad);
            $stmt->execute();
            echo "Detalle de cotización insertado. ID Descripción: $id_descripcion, Cantidad: $cantidad<br>";
        } else {
            // Inserta un registro en Descripciones con descripción nula si no se proporciona descripción
            $sql_insert_descripcion = "INSERT INTO Descripciones (id_titulo, descripcion, precio_unitario) VALUES (?, '', ?)";
            $stmt = $conn->prepare($sql_insert_descripcion);
            $stmt->bind_param("id", $id_titulo, $precio_final);
            $stmt->execute();
            $id_descripcion = $stmt->insert_id; // Obtener el ID de la descripción recién insertada
            echo "Descripción (vacía) insertada correctamente. ID: $id_descripcion<br>";

            // Inserta el detalle de la cotización sin descripción
            $sql_insert_detalle = "INSERT INTO Detalle_Cotizacion (id_cotizacion, id_descripcion, cantidad) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql_insert_detalle);
            $stmt->bind_param("iii", $id_cotizacion, $id_descripcion, $cantidad);
            $stmt->execute();
            echo "Detalle de cotización insertado sin descripción. ID Descripción: $id_descripcion, Cantidad: $cantidad<br>";
        }
    } else {
        echo "Falta el título para el índice $index.<br>";}
}

// Recibir los datos del formulario
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
$sql = "INSERT INTO adelanto (id_cotizacion, porcentaje_adelanto, monto_adelanto, fecha_adelanto, descripcion)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("iddss", $id_cotizacion, $porcentaje_adelanto, $monto_adelanto, $fecha_adelanto, $adelanto_descripcion);

$stmt->execute();
if ($stmt->error) {
    die("Error en la ejecución de la consulta: " . $stmt->error);
}

echo "Adelanto insertado correctamente. ID: " . $conn->insert_id;





//insertar datos en la tabla condiciones generales
// Recibir los datos del formulario
$descripcion_condiciones = $_POST['descripcion_condiciones'];
$estado_condiciones = $_POST['estado_condiciones'];

// Insertar datos en la tabla Condiciones_Generales
$sql = "INSERT INTO Condiciones_Generales (id_cotizacion, descripcion_condiciones, estado) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
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



// Cerrar la conexión
$conn->close();
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
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->
