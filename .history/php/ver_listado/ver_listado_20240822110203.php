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
    ------------------------------------- INICIO ITred Spa Ver Cotizaciones .PHP ---------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa usando mysqli
$mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd'); // Crea una conexión a la base de datos

// Verifica si la conexión fue exitosa
if ($mysqli->connect_error) { // Si hay un error de conexión
    die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error); // Muestra un mensaje de error y detiene la ejecución
}

// Define la consulta SQL para seleccionar los datos de cotizaciones
$sql = "SELECT c.ID AS cotizacion_id, c.Fecha, c.Validez, c.TotalGeneral, 
               p.Descripcion AS proyecto_descripcion, p.Codigo AS proyecto_codigo, 
               cl.Nombre AS cliente_nombre, cl.RUT AS cliente_rut, 
               cl.Empresa AS cliente_empresa, cl.Direccion AS cliente_direccion, 
               cl.Telefono AS cliente_telefono, cl.Email AS cliente_email,
               v.Nombre AS vendedor_nombre
        FROM Cotizaciones c
        JOIN Proyectos p ON c.ID_Proyecto = p.ID
        JOIN Clientes cl ON c.ID_Cliente = cl.ID
        JOIN Vendedores v ON c.ID_Vendedor = v.ID"; // Construye la consulta SQL para obtener los datos necesarios

// Ejecuta la consulta SQL y almacena el resultado
$result = $mysqli->query($sql); // Ejecuta la consulta en la base de datos usando la conexión $mysqli

$mensaje = ""; // Inicializa una variable para almacenar el contenido HTML

// Verifica si se obtuvieron filas de la consulta
if ($result->num_rows > 0) { // Si hay filas en el resultado
    $mensaje .= "<h1>Listado de Cotizaciones</h1>"; // Agrega un encabezado al mensaje
    $mensaje .= "<table border='1'>"; // Inicia una tabla HTML con borde
    $mensaje .= "<tr>
                    <th>Fecha</th>
                    <th>Validez</th>
                    <th>Total</th>
                    <th>Proyecto</th>
                    <th>Código Prov</th>
                    <th>Cliente</th>
                    <th>RUT</th>
                    <th>Empresa</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Vendedor</th>
                    <th>Acciones</th>
                </tr>"; // Agrega la fila de encabezado de la tabla

    // Itera sobre cada fila del resultado de la consulta
    while ($row = $result->fetch_assoc()) { // Obtiene una fila asociativa del resultado
        $mensaje .= "<tr>"; // Inicia una fila de la tabla
        // Agrega cada columna con los datos de la fila
        $mensaje .= "<td>" . htmlspecialchars($row['Fecha']) . "</td>"; // Fecha de la cotización
        $mensaje .= "<td>" . htmlspecialchars($row['Validez']) . "</td>"; // Validez de la cotización
        $mensaje .= "<td>" . htmlspecialchars($row['TotalGeneral']) . "</td>"; // Total general de la cotización
        $mensaje .= "<td>" . htmlspecialchars($row['proyecto_descripcion']) . "</td>"; // Descripción del proyecto
        $mensaje .= "<td>" . htmlspecialchars($row['proyecto_codigo']) . "</td>"; // Código del proyecto
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_nombre']) . "</td>"; // Nombre del cliente
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_rut']) . "</td>"; // RUT del cliente
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_empresa']) . "</td>"; // Empresa del cliente
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_direccion']) . "</td>"; // Dirección del cliente
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_telefono']) . "</td>"; // Teléfono del cliente
        $mensaje .= "<td>" . htmlspecialchars($row['cliente_email']) . "</td>"; // Email del cliente
        $mensaje .= "<td>" . htmlspecialchars($row['vendedor_nombre']) . "</td>"; // Nombre del vendedor
        // Añade los botones de acción para cada cotización
        $mensaje .= "<td>
                        <a href='../prediseñados/ver_cotizacion.php
