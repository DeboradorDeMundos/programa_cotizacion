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