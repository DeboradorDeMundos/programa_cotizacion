<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Establecer el conjunto de caracteres a UTF-8
$mysqli->set_charset('utf8');


// Verificar si se ha proporcionado el ID de la cotización
if (isset($_GET['id'])) {
    $id_cotizacion = intval($_GET['id']);

    // Consulta para obtener los detalles de la cotización y la empresa
    $sql = "SELECT c.fecha_emision, c.fecha_validez, t.total_final, 
                   p.nombre_proyecto, cl.nombre_cliente, cl.rut_cliente, 
                   cl.direccion_cliente, cl.telefono_cliente, cl.email_cliente,
                   v.nombre_vendedor, e.nombre_empresa, e.direccion_empresa, 
                   e.telefono_empresa, e.email_empresa, ef.ruta_foto
            FROM C_Cotizaciones c
            JOIN C_Proyectos p ON c.id_proyecto = p.id_proyecto
            JOIN C_Clientes cl ON c.id_cliente = cl.id_cliente
            JOIN C_Vendedores v ON c.id_vendedor = v.id_vendedor
            JOIN C_Totales t ON c.id_cotizacion = t.id_cotizacion
            JOIN e_Empresa e ON c.id_empresa = e.id_empresa
            JOIN e_fotosPerfil ef ON e.id_foto = ef.id_foto
            WHERE c.id_cotizacion = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id_cotizacion);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        

        // Crear el contenido básico del PDF
        $contenido_pdf = "%PDF-1.4\n";
        $contenido_pdf .= "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
        $contenido_pdf .= "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 /MediaBox [0 0 612 792] >>\nendobj\n";
        $contenido_pdf .= "3 0 obj\n<< /Type /Page /Parent 2 0 R /Resources << /Font << /F1 4 0 R >> /XObject << /Im1 6 0 R >> >> /Contents 5 0 R >>\nendobj\n";
        $contenido_pdf .= "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Arial /Encoding /WinAnsiEncoding >>\nendobj\n";

        // Agregar la imagen del logo al PDF
        $ruta_logo = $row['ruta_foto'];
        $ruta_logo_absoluta = realpath(dirname(__FILE__) . '/' . $ruta_logo);

        if (file_exists($ruta_logo_absoluta)) {
            $img_data = file_get_contents($ruta_logo_absoluta);
            $img_length = strlen($img_data);
            list($width, $height) = getimagesize($ruta_logo_absoluta);

            // Definir imagen en el PDF
            $contenido_pdf .= "6 0 obj\n<< /Type /XObject /Subtype /Image /Width $width /Height $height /ColorSpace /DeviceRGB /BitsPerComponent 8 /Filter /DCTDecode /Length $img_length >>\nstream\n";
            $contenido_pdf .= $img_data;
            $contenido_pdf .= "\nendstream\nendobj\n";

            // Ajustar tamaño de la imagen
            $scale = min(100 / $width, 100 / $height);
            $scaled_width = $width * $scale;
            $scaled_height = $height * $scale;
        }

        // Contenido de la página
        $contenido_pdf .= "5 0 obj\n<< /Length 7 0 R >>\nstream\n";

        // Posición del logo
        if (file_exists($ruta_logo_absoluta)) {
            $contenido_pdf .= "q\n";
            $contenido_pdf .= "$scaled_width 0 0 $scaled_height 50 720 cm\n";  // Posición y tamaño del logo
            $contenido_pdf .= "/Im1 Do\n";
            $contenido_pdf .= "Q\n";
        }

        // Cuadro rojo para los datos de la cotización
        $contenido_pdf .= "q\n1 0 0 RG\n"; // Color rojo
        $contenido_pdf .= "2 w\n"; // Espesor del borde
        $contenido_pdf .= "400 700 200 80 re S\n"; // Rectángulo en la posición derecha superior
        $contenido_pdf .= "Q\n";
        // Texto de los datos de la cotización en el cuadro rojo
        $contenido_pdf .= "BT\n/F1 12 Tf\n410 750 Td\n(Cotización N°: " . $id_cotizacion . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Fecha de Emisión: " . $row['fecha_emision'] . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Fecha de Validez: " . $row['fecha_validez'] . ") Tj\n";
        $contenido_pdf .= "ET\n";



        // Encabezado de la empresa debajo del logo
        $contenido_pdf .= "BT\n/F1 14 Tf\n50 670 Td\n(" . $row['nombre_empresa'] . ") Tj\n"; // Nombre de la empresa
        $contenido_pdf .= "0 -15 Td\n(RUT: " . utf8_decode($row['rut_cliente']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Dirección: " . utf8_decode($row['direccion_empresa']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Teléfono: " . $row['telefono_empresa'] . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Email: " . $row['email_empresa'] . ") Tj\n";

        // Datos del cliente
        $contenido_pdf .= "0 -40 Td\n(Cliente: " . utf8_decode($row['nombre_cliente']) . " (" . $row['rut_cliente'] . ")) Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Dirección: " . utf8_decode($row['direccion_cliente']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Teléfono: " . $row['telefono_cliente'] . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Email: " . $row['email_cliente'] . ") Tj\n";

        // Proyecto
        $contenido_pdf .= "0 -40 Td\n(Proyecto: " . utf8_decode($row['nombre_proyecto']) . ") Tj\n";

        // Total Final
        $contenido_pdf .= "0 -40 Td\n(Total Final: $" . number_format($row['total_final'], 2) . ") Tj\n";

        // Termina el contenido del PDF
        $contenido_pdf .= "ET\nendstream\nendobj\n";

        // Añadir la longitud del contenido
        $contenido_pdf .= "7 0 obj\n" . strlen($contenido_pdf) . "\nendobj\n";
        $contenido_pdf .= "xref\n0 8\n0000000000 65535 f \n";
        $contenido_pdf .= "0000000010 00000 n \n0000000060 00000 n \n0000000110 00000 n \n";
        $contenido_pdf .= "0000000170 00000 n \n0000000290 00000 n \n0000000410 00000 n \n";
        $contenido_pdf .= "0000000510 00000 n \n";
        $contenido_pdf .= "trailer\n<< /Size 8 /Root 1 0 R >>\nstartxref\n600\n%%EOF";

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
