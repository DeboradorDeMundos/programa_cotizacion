<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->

<!-- ------------------------------------------------------------------------------------------------------------
    ------------------------------------- INICIO ITred Spa Descargar cotizacion .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->


    <?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Verificar si se ha proporcionado el ID de la cotización
if (isset($_GET['id'])) {
    $id_cotizacion = intval($_GET['id']);

    // Consulta para obtener los detalles de la cotización
    $sql = "SELECT c.fecha_emision, c.fecha_validez, t.total_final, 
                   p.nombre_proyecto, cl.nombre_cliente, cl.rut_cliente, 
                   cl.direccion_cliente, cl.telefono_cliente, cl.email_cliente,
                   v.nombre_vendedor
            FROM C_Cotizaciones c
            JOIN C_Proyectos p ON c.id_proyecto = p.id_proyecto
            JOIN C_Clientes cl ON c.id_cliente = cl.id_cliente
            JOIN C_Vendedores v ON c.id_vendedor = v.id_vendedor
            JOIN C_Totales t ON c.id_cotizacion = t.id_cotizacion
            WHERE c.id_cotizacion = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id_cotizacion);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró la cotización
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Crear el contenido para descargar
        $contenido = "Cotización N° " . $id_cotizacion . "\n";
        $contenido .= "Fecha de Emisión: " . $row['fecha_emision'] . "\n";
        $contenido .= "Fecha de Validez: " . $row['fecha_validez'] . "\n";
        $contenido .= "Total: " . $row['total_final'] . "\n";
        $contenido .= "Proyecto: " . $row['nombre_proyecto'] . "\n";
        $contenido .= "Cliente: " . $row['nombre_cliente'] . " (" . $row['rut_cliente'] . ")\n";
        $contenido .= "Dirección: " . $row['direccion_cliente'] . "\n";
        $contenido .= "Teléfono: " . $row['telefono_cliente'] . "\n";
        $contenido .= "Email: " . $row['email_cliente'] . "\n";
        $contenido .= "Vendedor: " . $row['nombre_vendedor'] . "\n";

        // Configurar las cabeceras para descargar el archivo
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="cotizacion_' . $id_cotizacion . '.txt"');
        header('Content-Length: ' . strlen($contenido));

        // Enviar el contenido
        echo $contenido;
    } else {
        echo "No se encontró la cotización.";
    }

    $stmt->close();
} else {
    echo "ID de cotización no proporcionado.";
}

$mysqli->close();
?>




<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Descargar Cotizacion .PHP -----------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->
