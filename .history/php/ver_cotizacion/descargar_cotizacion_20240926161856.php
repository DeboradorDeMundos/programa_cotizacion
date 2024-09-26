<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

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

    // Verificar si se encontró la cotización
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Funciones auxiliares para el PDF
        function escapeString($text) {
            return strtr($text, array('(' => '\(', ')' => '\)', '\\' => '\\\\', '/' => '\/'));
        }

        function beginPage() {
            return "BT\n";
        }

        function endPage() {
            return "ET\n";
        }

        function setFont($font, $size) {
            return "/$font $size Tf\n";
        }

        function setColor($r, $g, $b) {
            return "$r $g $b rg\n";
        }

        function drawText($x, $y, $text) {
            return "$x $y Td\n(" . escapeString($text) . ") Tj\n";
        }

        function drawLine($x1, $y1, $x2, $y2, $width = 1) {
            return "$width w\n$x1 $y1 m $x2 $y2 l S\n";
        }

        function drawRect($x, $y, $width, $height, $fill = false) {
            return "$x $y $width $height " . ($fill ? "re f" : "re S") . "\n";
        }

        // Crear el contenido básico del PDF
        $contenido_pdf = "%PDF-1.4\n";
        $contenido_pdf .= "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
        $contenido_pdf .= "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n";
        $contenido_pdf .= "3 0 obj\n<< /Type /Page /Parent 2 0 R /Resources << /Font << /F1 4 0 R /F2 5 0 R >> /XObject << /Im1 6 0 R >> >> /MediaBox [0 0 612 792] /Contents 7 0 R >>\nendobj\n";
        $contenido_pdf .= "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n";
        $contenido_pdf .= "5 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >>\nendobj\n";

        // Agregar la imagen del logo al PDF
        $ruta_logo = $row['ruta_foto'];
        $ruta_logo_absoluta = realpath(dirname(__FILE__) . '/' . $ruta_logo);
        
        if (file_exists($ruta_logo_absoluta)) {
            $img_data = file_get_contents($ruta_logo_absoluta);
            $img_length = strlen($img_data);
            list($width, $height) = getimagesize($ruta_logo_absoluta);
            
            $contenido_pdf .= "6 0 obj\n<< /Type /XObject /Subtype /Image /Width $width /Height $height /ColorSpace /DeviceRGB /BitsPerComponent 8 /Filter /DCTDecode /Length $img_length >>\nstream\n";
            $contenido_pdf .= $img_data;
            $contenido_pdf .= "\nendstream\nendobj\n";

            $scale = min(100 / $width, 100 / $height);
            $scaled_width = $width * $scale;
            $scaled_height = $height * $scale;
        }

        // Contenido de la página
        $contenido_pdf .= "7 0 obj\n<< /Length 8 0 R >>\nstream\n";
        
        // Dibujar logo
        if (file_exists($ruta_logo_absoluta)) {
            $contenido_pdf .= "q\n";
            $contenido_pdf .= "$scaled_width 0 0 $scaled_height 50 700 cm\n";
            $contenido_pdf .= "/Im1 Do\n";
            $contenido_pdf .= "Q\n";
        }

        $contenido_pdf .= beginPage();

        // Fondo del título
        $contenido_pdf .= setColor(0.9, 0.9, 1);
        $contenido_pdf .= drawRect(0, 750, 612, 42, true);

        // Título principal
        $contenido_pdf .= setColor(0.2, 0.2, 0.6);
        $contenido_pdf .= setFont('F2', 24);
        $contenido_pdf .= drawText(200, 760, "COTIZACION");
        
        // Información de la empresa
        $contenido_pdf .= setColor(0, 0, 0);
        $contenido_pdf .= setFont('F2', 12);
        $contenido_pdf .= drawText(50, 700, $row['nombre_empresa']);
        $contenido_pdf .= setFont('F1', 10);
        $contenido_pdf .= drawText(50, 685, "Direccion: " . $row['direccion_empresa']);
        $contenido_pdf .= drawText(50, 670, "Telefono: " . $row['telefono_empresa']);
        $contenido_pdf .= drawText(50, 655, "Email: " . $row['email_empresa']);

        // Datos de la cotización
        $contenido_pdf .= setFont('F2', 12);
        $contenido_pdf .= drawText(400, 700, "Cotizacion N°: " . $id_cotizacion);
        $contenido_pdf .= setFont('F1', 10);
        $contenido_pdf .= drawText(400, 685, "Fecha de Emision: " . $row['fecha_emision']);
        $contenido_pdf .= drawText(400, 670, "Fecha de Validez: " . $row['fecha_validez']);

        // Línea separadora
        $contenido_pdf .= setColor(0.7, 0.7, 0.9);
        $contenido_pdf .= drawLine(50, 640, 562, 640, 2);

        // Datos del cliente
        $contenido_pdf .= setColor(0.2, 0.2, 0.6);
        $contenido_pdf .= setFont('F2', 14);
        $contenido_pdf .= drawText(50, 620, "Informacion del Cliente");
        $contenido_pdf .= setColor(0, 0, 0);
        $contenido_pdf .= setFont('F1', 10);
        $contenido_pdf .= drawText(50, 600, "Nombre: " . $row['nombre_cliente']);
        $contenido_pdf .= drawText(50, 585, "RUT: " . $row['rut_cliente']);
        $contenido_pdf .= drawText(50, 570, "Direccion: " . $row['direccion_cliente']);
        $contenido_pdf .= drawText(50, 555, "Telefono: " . $row['telefono_cliente']);
        $contenido_pdf .= drawText(50, 540, "Email: " . $row['email_cliente']);

        // Datos del proyecto
        $contenido_pdf .= setColor(0.2, 0.2, 0.6);
        $contenido_pdf .= setFont('F2', 14);
        $contenido_pdf .= drawText(50, 510, "Detalles del Proyecto");
        $contenido_pdf .= setColor(0, 0, 0);
        $contenido_pdf .= setFont('F1', 10);
        $contenido_pdf .= drawText(50, 490, "Nombre del Proyecto: " . $row['nombre_proyecto']);

        // Total
        $contenido_pdf .= setColor(0.2, 0.2, 0.6);
        $contenido_pdf .= setFont('F2', 16);
        $contenido_pdf .= drawText(400, 450, "Total Final:");
        $contenido_pdf .= setColor(0, 0, 0);
        $contenido_pdf .= drawText(400, 430, "$" . $row['total_final']);

        // Pie de página
        $contenido_pdf .= setColor(0.5, 0.5, 0.5);
        $contenido_pdf .= setFont('F1', 8);
        $contenido_pdf .= drawText(50, 50, "Gracias por su preferencia. Para cualquier consulta, no dude en contactarnos.");

        $contenido_pdf .= endPage();

        // Termina el contenido del PDF
        $contenido_pdf .= "endstream\nendobj\n";

        // Añadir la longitud del contenido
        $contenido_pdf .= "8 0 obj\n" . strlen($contenido_pdf) . "\nendobj\n";
        $contenido_pdf .= "xref\n0 9\n0000000000 65535 f \n";
        $contenido_pdf .= "0000000010 00000 n \n0000000060 00000 n \n0000000110 00000 n \n";
        $contenido_pdf .= "0000000290 00000 n \n0000000360 00000 n \n0000000430 00000 n \n";
        $contenido_pdf .= "0000000740 00000 n \n0000003740 00000 n \n";
        $contenido_pdf .= "trailer\n<< /Size 9 /Root 1 0 R >>\nstartxref\n3770\n%%EOF";

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