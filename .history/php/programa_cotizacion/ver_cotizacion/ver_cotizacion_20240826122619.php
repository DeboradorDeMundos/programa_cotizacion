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
error_reporting(E_ALL); // Muestra todos los errores en la pantalla
ini_set('display_errors', 1); // Habilita la visualización de errores en la pantalla

// Establecer la conexión a la base de datos usando mysqli
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd'); // Conecta a la base de datos en localhost con usuario 'root' y sin contraseña, usando la base de datos 'itredspa_bd'

// Obtener el ID de la cotización desde la URL y asegurarse de que sea un número entero
$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Si el parámetro 'id' está en la URL, lo convierte a entero; de lo contrario, se establece a 0

// Verificar que el ID es válido (mayor que 0)
if ($id > 0) {
    // Consulta SQL para obtener los detalles de la cotización
    $sql = "SELECT c.*, p.*, cl.*, v.*, e.*, en.*, d.*,  ds.cantidad, 
    (ds.cantidad * d.precio_unitario) AS detalle_total 
    FROM Cotizaciones c
    JOIN Proyectos p ON c.id_proyecto = p.id_proyecto
    JOIN Clientes cl ON c.id_cliente = cl.id_cliente
    JOIN Vendedores v ON c.id_vendedor = v.id_vendedor
    JOIN Empresa e ON c.id_empresa = e.id_empresa
    LEFT JOIN Encargados en ON c.id_encargado = en.id_encargado
    LEFT JOIN Detalle_Cotizacion ds ON c.id_cotizacion = ds.id_cotizacion
    LEFT JOIN Descripciones d ON ds.id_descripcion = d.id_descripcion
    WHERE c.id_cotizacion = ?"; // Consulta para obtener datos de la cotización junto con detalles relacionados

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare($sql); // Prepara la consulta SQL
    $stmt->bind_param("i", $id); // Asocia el parámetro 'id' a la consulta
    $stmt->execute(); // Ejecuta la consulta
    $result = $stmt->get_result(); // Obtiene el resultado de la consulta
    
    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Obtiene los datos de la cotización en un arreglo asociativo

        // Inicio del HTML para mostrar los datos
        echo "<div style='font-family: Arial, sans-serif; font-size: 12px;'>";
        echo "<div style='display: flex; justify-content: space-between;'>";
        echo "<div>";
        echo "<img src='path_to_your_logo.png' alt='Logo' style='width: 100px;'>"; // Muestra el logo de la empresa
        echo "<h2 style='margin: 0; font-size: 24px;'>ITRED SPA</h2>"; // Muestra el nombre de la empresa
        echo "<p style='margin: 0; font-size: 12px;'>TECNOLOGIA Y CONSTRUCCION</p>"; // Descripción de la empresa
        echo "<p style='margin: 0; font-size: 12px;'>DIRECCION: GUIDO RENI #4190, PEDRO AGUIRRE CERDA - SANTIAGO</p>"; // Dirección de la empresa
        echo "<p style='margin: 0; font-size: 12px;'>FONO: (+56 9) 7242 5972</p>"; // Teléfono de contacto
        echo "<p style='margin: 0; font-size: 12px;'>E-MAIL: CONTACTO@ITRED.CL</p>"; // Correo electrónico de contacto
        echo "</div>";
        echo "<div style='text-align: right;'>";
        echo "<p style='border: 2px solid red; padding: 5px; font-size: 14px;'>RUT: 77.243.277-1 <br> ORDEN DE TRABAJO<br>N°" . htmlspecialchars($row['numero_cotizacion']) ."<br>VALIDA HASTA EL " . htmlspecialchars($row['fecha_validez']) ."</p>"; // Información de la cotización
        echo "</div>";
        echo "</div>";
        echo "<hr>"; // Línea horizontal separadora

        // Mostrar detalles del proyecto
        echo "<h4 style='margin: 0; font-size: 18px;'>PROYECTO: INSTALACION MEMORIA RAM Y SOPORTE PC EQUIPO 1</h4>"; // Título del proyecto
        echo "<div style='display: flex; justify-content: space-between; margin-top: 10px'>";
        echo "<div>";
        echo "<table>"; // Tabla para mostrar información del proyecto
        echo "<tr><td style='font-size: 14px;'><strong>Proyecto</strong></td><td style='font-size: 12px;'>" . htmlspecialchars($row['nombre_proyecto']);
        echo "<tr><td style='font-size: 14px;'><strong>COD. PROY</strong></td><td style='font-size: 12px;'>" . htmlspecialchars($row['id_proyecto']);
        echo "<tr><td style='font-size: 14px;'><strong>AREA TRABAJO</strong></td><td style='font-size: 12px;'>" . htmlspecialchars($row['area_trabajo']);
        echo "<tr><td style='font-size: 14px;'><strong>RISGO TRAB.</strong></td><td style='font-size: 12px;'>" . htmlspecialchars($row['riesgo_proyecto']);
        echo "</table>";
        echo "</div>";
        echo "<div style='text-align: right; padding-right: 20px;' >";
        echo "<table>"; // Tabla para mostrar información adicional del proyecto
        echo "<tr><td style='font-size: 14px;'><strong>DIAS COMPRA</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['dias_compra']);
        echo "<tr><td style='font-size: 14px;'><strong>DIAS TRABAJO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['dias_trabajo']);
        echo "<tr><td style='font-size: 14px;'><strong>TRABAJADORES</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['trabajadores']);
        echo "<tr><td style='font-size: 14px;'><strong>HORARIO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['horario']);
        echo "<tr><td style='font-size: 14px;'><strong>COLACION</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['colacion']);
        echo "<tr><td style='font-size: 14px;'><strong>ENTREGA</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['entrega']);
        echo "</table>";
        echo "</div>";
        echo "</div>";

        // Mostrar detalles del cliente
        echo "<h3 style='margin: 0; font-size: 18px;'>DATOS CLIENTES</h3>"; // Título de los datos del cliente
        echo "<div style='display: flex; justify-content: space-between; margin-top: 10px'>";
        echo "<div>";
        echo "<table>"; // Tabla para mostrar información del cliente
        echo "<tr><td style='font-size: 14px;'><strong>SR/TA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['nombre_cliente']);
        echo "<tr><td style='font-size: 14px;'><strong>EMPRESA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['empresa_cliente']);
        echo "<tr><td style='font-size: 14px;'><strong>RUT: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['rut_cliente']);
        echo "<tr><td style='font-size: 14px;'><strong>DIRECCION: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['direccion_cliente']);
        echo "<tr><td style='font-size: 14px;'><strong>OF./DEPTO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['lugar_cliente']);
        echo "<tr><td style='font-size: 14px;'><strong>FONO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['telefono_cliente']);
        echo "<tr><td style='font-size: 14px;'><strong>E-MAIL:</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['email_cliente']);
        echo "</table>";
        echo "</div>";
        echo "<div>";
        echo "<table>"; // Tabla para mostrar información de contacto adicional
        echo "<tr><td style='font-size: 14px;'><strong>ENCARGADO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['nombre_encargado']);
        echo "<tr><td style='font-size: 14px;'><strong>TELEFONO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['telefono_encargado']);
        echo "<tr><td style='font-size: 14px;'><strong>EMAIL: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['email_encargado']);
        echo "</table>";
        echo "</div>";
        echo "</div>";

        // Mostrar detalles del vendedor
        echo "<h3 style='margin: 0; font-size: 18px;'>DATOS VENDEDOR</h3>"; // Título de los datos del vendedor
        echo "<div style='display: flex; justify-content: space-between; margin-top: 10px'>";
        echo "<div>";
        echo "<table>"; // Tabla para mostrar información del vendedor
        echo "<tr><td style='font-size: 14px;'><strong>SR/TA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['nombre_vendedor']);
        echo "<tr><td style='font-size: 14px;'><strong>EMPRESA: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['empresa_vendedor']);
        echo "<tr><td style='font-size: 14px;'><strong>RUT: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['rut_vendedor']);
        echo "<tr><td style='font-size: 14px;'><strong>DIRECCION: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['direccion_vendedor']);
        echo "<tr><td style='font-size: 14px;'><strong>OF./DEPTO</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['lugar_vendedor']);
        echo "<tr><td style='font-size: 14px;'><strong>FONO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['telefono_vendedor']);
        echo "<tr><td style='font-size: 14px;'><strong>E-MAIL:</strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['email_vendedor']);
        echo "</table>";
        echo "</div>";
        echo "<div>";
        echo "<table>"; // Tabla para mostrar información adicional de contacto del vendedor
        echo "<tr><td style='font-size: 14px;'><strong>ENCARGADO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['nombre_encargado_vendedor']);
        echo "<tr><td style='font-size: 14px;'><strong>TELEFONO: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['telefono_encargado_vendedor']);
        echo "<tr><td style='font-size: 14px;'><strong>EMAIL: </strong></td><td style='font-size: 10px;'>" . htmlspecialchars($row['email_encargado_vendedor']);
        echo "</table>";
        echo "</div>";
        echo "</div>";

        // Mostrar detalles de los servicios
        echo "<h3 style='margin: 0; font-size: 18px;'>DETALLE DE SERVICIOS</h3>"; // Título de los detalles de servicios
        echo "<table border='1' cellspacing='0' cellpadding='5' style='width: 100%; border-collapse: collapse;'>"; // Tabla para mostrar detalles de servicios
        echo "<thead>";
        echo "<tr>";
        echo "<th style='font-size: 14px;'>Descripcion</th>"; // Encabezado de la columna Descripción
        echo "<th style='font-size: 14px;'>Cantidad</th>"; // Encabezado de la columna Cantidad
        echo "<th style='font-size: 14px;'>Valor Unitario</th>"; // Encabezado de la columna Valor Unitario
        echo "<th style='font-size: 14px;'>Total</th>"; // Encabezado de la columna Total
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        // Obtener los detalles de servicios desde el resultado de la consulta
        while ($detail = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td style='font-size: 12px;'>" . htmlspecialchars($detail['descripcion']);
            echo "<td style='font-size: 12px;'>" . htmlspecialchars($detail['cantidad']);
            echo "<td style='font-size: 12px;'>" . htmlspecialchars($detail['precio_unitario']);
            echo "<td style='font-size: 12px;'>" . htmlspecialchars($detail['detalle_total']);
            echo "</tr>";
        }
        
        // Calcular el total de la cotización
        $total_sql = "SELECT SUM(ds.cantidad * d.precio_unitario) AS total FROM Detalle_Cotizacion ds 
        JOIN Descripciones d ON ds.id_descripcion = d.id_descripcion 
        WHERE ds.id_cotizacion = ?";
        $total_stmt = $conn->prepare($total_sql); // Prepara la consulta para calcular el total
        $total_stmt->bind_param("i", $id); // Asocia el parámetro 'id'
        $total_stmt->execute(); // Ejecuta la consulta
        $total_result = $total_stmt->get_result(); // Obtiene el resultado
        $total_row = $total_result->fetch_assoc(); // Obtiene el total de la cotización

        echo "<tr>";
        echo "<td colspan='3' style='font-size: 14px; text-align: right;'><strong>Total</strong></td>"; // Muestra el total
        echo "<td style='font-size: 14px;'>" . htmlspecialchars($total_row['total']);
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        echo "</div>";

    } else {
        // Si no se encontraron resultados
        echo "<p>No se encontraron detalles para la cotización solicitada.</p>"; // Mensaje cuando no hay resultados
    }
} else {
    // Si el ID no es válido
    echo "<p>ID de cotización no válido.</p>"; // Mensaje cuando el ID no es válido
}

// Cerrar la conexión a la base de datos
$stmt->close(); // Cierra la consulta preparada
$mysqli->close(); // Cierra la conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Cotización</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <ul>
        <li><a href="../crear_nuevo/crear.php">Crear Cotización</a></li>
        <li><a href="../modificar/modificar.php?id=<?php echo $id; ?>">Modificar Cotización</a></li>
        <li><a href="../eliminar/eliminar.php?id=<?php echo $id; ?>">Eliminar Cotización</a></li>
        <li><a href="../ver_listado/ver_listado.php">Volver al Listado</a></li>
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