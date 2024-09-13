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
    ------------------------------------- INICIO ITred Spa Detalle cotizacion.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->



    <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
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



    // Recibir datos del formulario cotización
    $numero_cotizacion = isset($_POST['numero_cotizacion']) ? trim($_POST['numero_cotizacion']) : null;
    $fecha_validez = isset($_POST['fecha_validez']) ? trim($_POST['fecha_validez']) : null;
    $fecha_emision = isset($_POST['fecha_emision']) ? trim($_POST['fecha_emision']) : null;
    $id_cliente = isset($_POST['id_cliente']) ? intval($_POST['id_cliente']) : null;
    $id_proyecto = isset($_POST['id_proyecto']) ? intval($_POST['id_proyecto']) : null;
    $id_empresa = isset($_POST['id_empresa']) ? intval($_POST['id_empresa']) : null;
    $id_vendedor = isset($_POST['id_vendedor']) ? intval($_POST['id_vendedor']) : null;
    $id_encargado = isset($_POST['id_encargado']) ? intval($_POST['id_encargado']) : null;

    // Validar datos obligatorios
    if (is_null($numero_cotizacion) || is_null($fecha_emision) || is_null($fecha_validez) || is_null($id_cliente) || is_null($id_proyecto) || is_null($id_empresa) || is_null($id_vendedor) || is_null($id_encargado)) {
        die("Faltan datos obligatorios para la cotización.");
    }

    // Insertar en la tabla Cotizaciones
    $sql_cotizaciones = "INSERT INTO C_Cotizaciones (
        numero_cotizacion, fecha_emision, fecha_validez,
        id_cliente, id_proyecto, id_empresa, id_vendedor, id_encargado
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql_cotizaciones);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $mysqli->error);
    }

    // Asignar los parámetros correctamente
    $stmt->bind_param(
        "sssiiiii",
        $numero_cotizacion, $fecha_emision, $fecha_validez, 
        $id_cliente, $id_proyecto, $id_empresa, $id_vendedor, $id_encargado
    );

    // Ejecutar la consulta y manejar posibles errores
    if ($stmt->execute()) {
        $id_cotizacion = $stmt->insert_id;
        echo "Cotización insertada correctamente. ID: $id_cotizacion<br>";
    } else {
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }

    $stmt->close();
}
?>


     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Detalle cotizacion.PHP ----------------------------------------
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
