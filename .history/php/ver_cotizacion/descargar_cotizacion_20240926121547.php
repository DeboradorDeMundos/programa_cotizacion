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

        // Crear el contenido básico del PDF
        $contenido_pdf = "%PDF-1.4\n";
        $contenido_pdf .= "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
        $contenido_pdf .= "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 /MediaBox [0 0 612 792] >>\nendobj\n";
        $contenido_pdf .= "3 0 obj\n<< /Type /Page /Parent 2 0 R /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>\nendobj\n";
        $contenido_pdf .= "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n";
        $contenido_pdf .= "5 0 obj\n<< /Length 6 0 R >>\nstream\n";

        // Comienza el contenido del PDF
        $contenido_pdf .= "BT\n/F1 14 Tf\n70 770 Td\n(ITred Spa) Tj\n"; // Encabezado de empresa

        // Datos de la cotización
        $contenido_pdf .= "0 -20 Td\n(Cotización N°: " . $id_cotizacion . ") Tj\n";
        $contenido_pdf .= "0 -20 Td\n(Fecha de Emisión: " . $row['fecha_emision'] . ") Tj\n";
        $contenido_pdf .= "0 -20 Td\n(Fecha de Validez: " . $row['fecha_validez'] . ") Tj\n";

        // Datos del cliente
        $contenido_pdf .= "0 -40 Td\n(Cliente: " . $row['nombre_cliente'] . " (" . $row['rut_cliente'] . ")) Tj\n";
        $contenido_pdf .= "0 -20 Td\n(Dirección: " . $row['direccion_cliente'] . ") Tj\n";
        $contenido_pdf .= "0 -20 Td\n(Teléfono: " . $row['telefono_cliente'] . ") Tj\n";
        $contenido_pdf .= "0 -20 Td\n(Email: " . $row['email_cliente'] . ") Tj\n";

        // Datos del proyecto
        $contenido_pdf .= "0 -40 Td\n(Proyecto: " . $row['nombre_proyecto'] . ") Tj\n";
        $contenido_pdf .= "0 -20 Td\n(Total Final: $" . $row['total_final'] . ") Tj\n";

        // Termina el contenido del PDF
        $contenido_pdf .= "ET\nendstream\nendobj\n";

        // Añadir la longitud del contenido
        $contenido_pdf .= "6 0 obj\n" . strlen($contenido_pdf) . "\nendobj\n";
        $contenido_pdf .= "xref\n0 7\n0000000000 65535 f \n";
        $contenido_pdf .= "0000000010 00000 n \n0000000060 00000 n \n0000000110 00000 n \n";
        $contenido_pdf .= "0000000170 00000 n \n0000000290 00000 n \n0000000410 00000 n \n";
        $contenido_pdf .= "trailer\n<< /Size 7 /Root 1 0 R >>\nstartxref\n500\n%%EOF";

        // Configurar las cabeceras para descargar el archivo PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="cotizacion_' . $id_cotizacion . '.pdf"');
        header('Content-Length: ' . strlen($contenido_pdf));

        // Enviar el contenido
        echo $contenido_pdf;
    } else {
        echo "No se encontró la cotización.";
    }

    $stmt->close();
} else {
    echo "ID de cotización no proporcionado.";
}

$mysqli->close();
?>
