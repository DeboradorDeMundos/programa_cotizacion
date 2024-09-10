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
    ------------------------------------- INICIO ITred Spa Ver Cotización .PHP ---------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<?php
// Habilitar el reporte de errores para facilitar la depuración
error_reporting(E_ALL); // Muestra todos los errores
ini_set('display_errors', 1); // Habilita la visualización de errores en la pantalla

// Establecer la conexión a la base de datos usando mysqli
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd'); // Conecta a la base de datos en localhost con usuario 'root' y sin contraseña, usando la base de datos 'itredspa_bd'

// Verificar si se recibió un ID a través de la URL y convertirlo en un entero
$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Obtiene el ID de la URL o establece $id a 0 si no se proporciona

if ($id > 0) { // Verifica si el ID es válido (mayor que 0)
    // Preparar la consulta SQL para obtener la cotización y sus detalles
    $sql = "SELECT c.*, p.nombre_proyecto AS proyecto_descripcion, p.codigo_proyecto AS proyecto_codigo, 
                   cl.nombre_cliente AS cliente_nombre, cl.rut_cliente AS cliente_rut, 
                   cl.empresa_cliente AS cliente_empresa, cl.direccion_cliente AS cliente_direccion, 
                   cl.telefono_cliente AS cliente_telefono, cl.email_cliente AS cliente_email,
                   v.nombre_vendedor AS vendedor_nombre,
                   ds.cantidad, d.descripcion AS detalle_descripcion, d.precio_unitario AS detalle_precio_unitario, ds.cantidad * d.precio_unitario AS detalle_total
            FROM Cotizaciones c
            JOIN Proyectos p ON c.id_proyecto = p.id_proyecto
            JOIN Clientes cl ON c.id_cliente = cl.id_cliente
            JOIN Vendedores v ON c.id_vendedor = v.id_vendedor
            LEFT JOIN Detalle_Cotizacion ds ON c.id_cotizacion = ds.id_cotizacion
            JOIN Descripciones d ON ds.id_descripcion = d.id_descripcion
            WHERE c.id_cotizacion = ?"; // Consulta SQL que obtiene todos los detalles de la cotización usando un parámetro para el ID de la cotización

    // Preparar y ejecutar la consulta SQL
    $stmt = $mysqli->prepare($sql); // Prepara la consulta SQL
    $stmt->bind_param("i", $id); // Vincula el parámetro entero $id a la consulta
    $stmt->execute(); // Ejecuta la consulta SQL
    $result = $stmt->get_result(); // Obtiene el resultado de la consulta

    if ($result->num_rows > 0) { // Verifica si se encontraron resultados
        $row = $result->fetch_assoc(); // Obtiene los datos de la cotización como un array asociativo

        // Inicio del HTML para mostrar los datos
        echo "<div style='font-family: Arial, sans-serif;'>"; // Inicia un contenedor con una fuente específica
        echo "<h1 style='margin: 0;'>ITRED SPA</h1>"; // Muestra el nombre de la empresa en un encabezado
        echo "<h5 style='margin: 0;'>
                <span style='font-size: 14px; font-weight: bold;'>Tecnología y Construcción</span></h5>"; // Muestra el eslogan de la empresa
        echo "<h5 style='margin: 0;'>
                <span style='font-size: 14px; font-weight: bold;'>Dirección:</span> 
                <span style='font-size: 12px;'>GUIDO RENI #4190, PEDRO AGUIRRE CERDA - SANTIAGO</span></h5>"; // Muestra la dirección de la empresa
        echo "<h5 style='margin: 0;'>
                <span style='font-size: 14px; font-weight: bold;'>FONO:</span> 
                <span style='font-size: 12px;'>(+56 9) 7242 5972</span></h5>"; // Muestra el número de teléfono
        echo "<h5 style='margin-top: 0;'>
                <span style='font-size: 14px; font-weight: bold;'>E-MAIL:</span> 
                <span style='font-size: 12px;'>CONTACTO@ITRED.CL</span></h5>"; // Muestra el correo electrónico
        echo "<table>"; // Inicia una tabla para mostrar los datos de la cotización
        echo "<tr><td style='font-size: 14px;'><strong>Proyecto</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']); // Muestra la descripción del proyecto
        echo "<tr><td style='font-size: 14px;'><strong>COD. PROY</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_codigo']); // Muestra el código del proyecto
        echo "<tr><td style='font-size: 14px;'><strong>AREA TRABAJO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']); // Muestra el área de trabajo (duplicado del campo de descripción del proyecto, posiblemente un error)
        echo "<tr><td style='font-size: 14px;'><strong>RISGO TRAB.</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']); // Muestra el riesgo del trabajo (duplicado del campo de descripción del proyecto, posiblemente un error)
        echo "</table>"; // Finaliza la tabla
        echo "<h3>DATOS CLIENTES</h3>"; // Muestra un encabezado para los datos del cliente
        echo "<table>"; // Inicia una tabla para mostrar los datos del cliente
        echo "<tr><td style='font-size: 14px;'><strong>SR/TA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']); // Muestra el nombre del cliente (probablemente un error al usar el campo de descripción del proyecto)
        echo "<tr><td style='font-size: 14px;'><strong>EMPRESA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_codigo']); // Muestra la empresa del cliente (probablemente un error al usar el campo de código del proyecto)
        echo "<tr><td style='font-size: 14px;'><strong>RUT: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']); // Muestra el RUT del cliente (probablemente un error al usar el campo de descripción del proyecto)
        echo "<tr><td style='font-size: 14px;'><strong>DIRECCION: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']); // Muestra la dirección del cliente (probablemente un error al usar el campo de descripción del proyecto)
        echo "<tr><td style='font-size: 14px;'><strong>OF./DEPTO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']); // Muestra oficina/departamento del cliente (probablemente un error al usar el campo de descripción del proyecto)
        echo "<tr><td style='font-size: 14px;'><strong>FONO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_codigo']); // Muestra el teléfono del cliente (probablemente un error al usar el campo de código del proyecto)
        echo "<tr><td style='font-size: 14px;'><strong>E-MAIL: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['proyecto_descripcion']); // Muestra el email del cliente (probablemente un error al usar el campo de descripción del proyecto)
        echo "</table>"; // Finaliza la tabla
        echo "<h3>DATOS EMPRESA</h3>"; // Muestra un encabezado para los datos de la empresa
        echo "<table>"; // Inicia una tabla para mostrar los datos de la empresa
        echo "<tr><td><strong>ENC. PROYEC.: </strong></td><td>" . htmlspecialchars($row['proyecto_descripcion']) ."</tr>"; // Muestra el encargado del proyecto (probablemente un error al usar el campo de descripción del proyecto)
        echo "<tr><td><strong>E-MAIL: </strong></td><td>" . htmlspecialchars($row['cliente_nombre']) . "</td></tr>"; // Muestra el email de la empresa
        echo "<tr><td><strong>FONO: </strong></td><td>" . htmlspecialchars($row['cliente_empresa']) . "</td></tr>"; // Muestra el teléfono de la empresa
        echo "<tr><td><strong>WHATSAPP: </strong></td><td>" . htmlspecialchars($row['cliente_telefono']) . "</td></tr>"; // Muestra el WhatsApp de la empresa
        echo "<tr><td><strong>TIPO CLIENTE: </strong></td><td>" . htmlspecialchars($row['vendedor_nombre']) . "</td></tr>"; // Muestra el tipo de cliente (probablemente un error al usar el campo de nombre del vendedor)
        echo "<tr><td><strong>Validez</strong></td><td>" . htmlspecialchars($row['fecha_validez']) . "</td></tr>"; // Muestra la validez de la cotización
        echo "</table>"; // Finaliza la tabla
        
        echo "<h3>Detalles del Servicio</h3>"; // Muestra un encabezado para los detalles del servicio
        echo "<table border='1' cellpadding='5' cellspacing='0' width='100%'>"; // Inicia una tabla con borde y espaciado para los detalles del servicio
        echo "<tr><th>Cantidad</th><th>Descripción</th><th>Precio Unitario</th><th>Total</th></tr>"; // Muestra los encabezados de la tabla
        echo "<tr>"; // Inicia una fila de la tabla
        echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>"; // Muestra la cantidad del detalle
        echo "<td>" . htmlspecialchars($row['detalle_descripcion']) . "</td>"; // Muestra la descripción del detalle
        echo "<td>" . htmlspecialchars($row['detalle_precio_unitario']) . "</td>"; // Muestra el precio unitario del detalle
        echo "<td>" . htmlspecialchars($row['detalle_total']) . "</td>"; // Muestra el total del detalle
        echo "</tr>"; // Finaliza la fila de la tabla
        echo "</table>"; // Finaliza la tabla
        echo "</div>"; // Finaliza el contenedor
    } else { // Si no se encontraron resultados
        echo "<p>No se encontró la cotización con el ID proporcionado.</p>"; // Muestra un mensaje de error
    }
    $stmt->close(); // Cierra el statement preparado
} else { // Si el ID no es válido
    echo "<p>ID inválido.</p>"; // Muestra un mensaje de error
}

$mysqli->close(); // Cierra la conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Cotización</title>
    <link rel="stylesheet" href="css/index.css"> <!-- Enlaza con la hoja de estilos CSS -->
</head>
<body>
    <ul>
        <li><a href="../crear_nuevo/crear.php">Crear Cotización</a></li> <!-- Enlace para crear una nueva cotización -->
        <li><a href="../modificar/modificar.php?id=<?php echo $id; ?>">Modificar Cotización</a></li> <!-- Enlace para modificar la cotización actual -->
        <li><a href="../eliminar/eliminar.php?id=<?php echo $id; ?>">Eliminar Cotización</a></li> <!-- Enlace para eliminar la cotización actual -->
        <li><a href="../ver_listado/ver_listado.php">Volver al Listado</a></li> <!-- Enlace para volver al listado de cotizaciones -->
    </ul>
</body>
</html>



<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  Ver Cotización .PHP -----------------------------------
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