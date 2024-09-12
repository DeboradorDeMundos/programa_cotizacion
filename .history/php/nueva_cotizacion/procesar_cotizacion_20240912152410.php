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