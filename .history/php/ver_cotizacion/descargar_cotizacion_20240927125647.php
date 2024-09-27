<?php
// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Establecer el conjunto de caracteres a UTF-8
$mysqli->set_charset('utf8');

// Verificar si se ha proporcionado el ID de la cotizacion
if (isset($_GET['id'])) {
    $id_cotizacion = intval($_GET['id']);

    // Consulta para obtener los detalles de la cotizacion y la empresa
    $sql = "SELECT c.fecha_emision, c.fecha_validez, t.total_final, 
                   p.nombre_proyecto, p.codigo_proyecto, p.tipo_trabajo, 
                   p.area_trabajo, p.riesgo_proyecto, p.dias_compra, 
                   p.dias_trabajo, p.trabajadores, p.horario, p.colacion, 
                   p.entrega, cl.nombre_cliente, cl.rut_cliente, 
                   cl.direccion_cliente, cl.telefono_cliente, cl.email_cliente,
                   v.nombre_vendedor, e.nombre_empresa, e.rut_empresa, e.direccion_empresa, 
                   e.telefono_empresa, e.email_empresa, e.area_empresa, ef.ruta_foto
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

        // Crear el contenido basico del PDF
        $contenido_pdf = "%PDF-1.4\n";
        $contenido_pdf .= "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
        $contenido_pdf .= "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 /MediaBox [0 0 612 792] >>\nendobj\n";
        $contenido_pdf .= "3 0 obj\n<< /Type /Page /Parent 2 0 R /Resources << /Font << /F1 4 0 R >> /XObject << /Im1 6 0 R >> >> /Contents 5 0 R >>\nendobj\n";
        $contenido_pdf .= "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>\nendobj\n";

        // Agregar la imagen del logo al PDF
        $ruta_logo = $row['ruta_foto'];
        $ruta_logo_absoluta = realpath(dirname(__FILE__) . '/' . $ruta_logo);

        // Definir márgenes y posiciones
        $margen_superior = 50;
        $margen_izquierdo = 50;
        $espacio_vertical = 15; // Espacio vertical entre líneas
        $ancho_recuadro = 200;
        $alto_recuadro = 100;

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

        // Contenido de la pagina
        $contenido_pdf .= "5 0 obj\n<< /Length 7 0 R >>\nstream\n";

        // Posicion del logo
        if (file_exists($ruta_logo_absoluta)) {
            $contenido_pdf .= "q\n";
            $contenido_pdf .= "$scaled_width 0 0 $scaled_height $margen_izquierdo " . (710 - $margen_superior) . " cm\n";  // Posicion y tamaño del logo
            $contenido_pdf .= "/Im1 Do\n";
            $contenido_pdf .= "Q\n";
        }

        // Cuadro rojo para los datos de la cotizacion
        $contenido_pdf .= "q\n1 0 0 RG\n"; // Color rojo
        $contenido_pdf .= "2 w\n"; // Espesor del borde
        $contenido_pdf .= ($margen_izquierdo + 360) . " " . (700 - $margen_superior) . " $ancho_recuadro $alto_recuadro re S\n"; // Rectángulo más grande
        $contenido_pdf .= "Q\n";

        // Texto de los datos de la cotizacion en el cuadro rojo
        $contenido_pdf .= "BT\n/F1 12 Tf\n" . ($margen_izquierdo + 370) . " " . (780 - $margen_superior) . " Td\n(Detalle Cotizacion) Tj\n"; // Titulo del cuadro rojo
        $contenido_pdf .= "0 -$espacio_vertical Td\n(RUT de la Empresa: " . utf8_decode($row['rut_empresa']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Numero de Cotizacion: " . $id_cotizacion . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Dias Validez: 30) Tj\n"; // Cambia los días de validez según necesites
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Fecha de Validez: " . utf8_decode($row['fecha_validez']) . ") Tj\n";
        $contenido_pdf .= "ET\n";

        // Fecha de emision debajo del cuadro rojo
        $contenido_pdf .= "BT\n/F1 12 Tf\n" . ($margen_izquierdo + 370) . " " . (680 - $margen_superior) . " Td\n(Fecha de Emision: " . utf8_decode($row['fecha_emision']) . ") Tj\n";
        $contenido_pdf .= "ET\n";

        // Encabezado de los detalles de la empresa
        $contenido_pdf .= "BT\n/F1 14 Tf\n" . ($margen_izquierdo) . " " . (660 - $margen_superior) . " Td\n(Detalle empresa) Tj\n"; // Titulo de la seccion de empresa
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Nombre: " . utf8_decode($row['nombre_empresa']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Área: " . utf8_decode($row['area_empresa']) . ") Tj\n"; // Cambia el área según necesites
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Direccion: " . utf8_decode($row['direccion_empresa']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Telefono: " . utf8_decode($row['telefono_empresa']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Email: " . utf8_decode($row['email_empresa']) . ") Tj\n";
        $contenido_pdf .= "ET\n";

        // Separador entre Detalle Empresa y Detalle Proyecto
        $contenido_pdf .= "q\n0 0 0 RG\n"; // Color negro
        $contenido_pdf .= "1 w\n"; // Espesor del borde
        $contenido_pdf .= "$margen_izquierdo " . (575 - $margen_superior) . " 500 1 re S\n"; // Linea de separacion
        $contenido_pdf .= "Q\n";

        // Titulo de Detalle Proyecto
        $contenido_pdf .= "BT\n/F1 14 Tf\n" . ($margen_izquierdo) . " " . (560 - $margen_superior) . " Td\n(Detalle Proyecto) Tj\n"; // Titulo de la seccion de proyecto
        $contenido_pdf .= "ET\n";

        // Detalles del proyecto a la izquierda
        $contenido_pdf .= "BT\n/F1 12 Tf\n" . ($margen_izquierdo) . " " . (540 - $margen_superior) . " Td\n(Nombre: " . utf8_decode($row['nombre_proyecto']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Código: " . utf8_decode($row['codigo_proyecto']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Área de Trabajo: " . utf8_decode($row['area_trabajo']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Tipo de Trabajo: " . utf8_decode($row['tipo_trabajo']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Riesgo: " . utf8_decode($row['riesgo_proyecto']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Días de Compra: " . utf8_decode($row['dias_compra']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Días de Trabajo: " . utf8_decode($row['dias_trabajo']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Número de Trabajadores: " . utf8_decode($row['trabajadores']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Horario: " . utf8_decode($row['horario']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Colación: " . utf8_decode($row['colacion']) . ") Tj\n";
        $contenido_pdf .= "0 -$espacio_vertical Td\n(Entrega: " . utf8_decode($row['entrega']) . ") Tj\n";
        $contenido_pdf .= "ET\n";

        // Finalizar el contenido del PDF
        $contenido_pdf .= "endstream\nendobj\n";
        $contenido_pdf .= "xref\n0 7\n0000000000 65535 f \n";
        for ($i = 1; $i <= 6; $i++) {
            $contenido_pdf .= str_pad(strlen($contenido_pdf), 10, '0', STR_PAD_LEFT) . ' 00000 n \n';
        }
        $contenido_pdf .= "trailer\n<< /Size 7 /Root 1 0 R >>\n";
        $contenido_pdf .= "startxref\n" . strlen($contenido_pdf) . "\n%%EOF";

        // Generar el PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="cotizacion_' . $id_cotizacion . '.pdf"');
        echo $contenido_pdf;

    } else {
        echo "No se encontró la cotización.";
    }

    $stmt->close();
} else {
    echo "ID de cotización no especificado.";
}

$mysqli->close();
?>
