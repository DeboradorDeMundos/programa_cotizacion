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

        // Crear el contenido PDF básico
        $contenido = "%PDF-1.4\n";
        $contenido .= "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
        $contenido .= "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 /MediaBox [0 0 612 792] >>\nendobj\n";
        $contenido .= "3 0 obj\n<< /Type /Page /Parent 2 0 R /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>\nendobj\n";
        $contenido .= "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n";
        $contenido .= "5 0 obj\n<< /Length 6 0 R >>\nstream\n";

        // Mover el texto a una posición específica para el título de la cotización
        $contenido .= "BT\n/F1 24 Tf\n100 750 Td\n(Cotización N° " . $id_cotizacion . ") Tj\n";

        // Cambiar a una fuente más pequeña para los detalles
        $contenido .= "/F1 12 Tf\n100 730 Td\n(Fecha de Emisión: " . $row['fecha_emision'] . ") Tj\n";
        $contenido .= "100 710 Td\n(Fecha de Validez: " . $row['fecha_validez'] . ") Tj\n";
        $contenido .= "100 690 Td\n(Total: " . $row['total_final'] . ") Tj\n";
        $contenido .= "100 670 Td\n(Proyecto: " . $row['nombre_proyecto'] . ") Tj\n";
        $contenido .= "100 650 Td\n(Cliente: " . $row['nombre_cliente'] . " (" . $row['rut_cliente'] . ")) Tj\n";
        $contenido .= "100 630 Td\n(Dirección: " . $row['direccion_cliente'] . ") Tj\n";
        $contenido .= "100 610 Td\n(Teléfono: " . $row['telefono_cliente'] . ") Tj\n";
        $contenido .= "100 590 Td\n(Email: " . $row['email_cliente'] . ") Tj\n";
        $contenido .= "100 570 Td\n(Vendedor: " . $row['nombre_vendedor'] . ") Tj\n";

        // Finalizar el bloque de texto
        $contenido .= "ET\nendstream\nendobj\n";

        // Añadir el tamaño de contenido
        $contenido .= "6 0 obj\n" . strlen($contenido) . "\nendobj\n";
        $contenido .= "xref\n0 7\n0000000000 65535 f \n";
        $contenido .= "0000000010 00000 n \n0000000060 00000 n \n0000000110 00000 n \n";
        $contenido .= "0000000170 00000 n \n0000000290 00000 n \n0000000410 00000 n \n";
        $contenido .= "trailer\n<< /Size 7 /Root 1 0 R >>\nstartxref\n500\n%%EOF";

        // Configurar las cabeceras para descargar el archivo PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="cotizacion_' . $id_cotizacion . '.pdf"');
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
