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
               v.nombre_vendedor, e.nombre_empresa, e.rut_empresa, 
               e.direccion_empresa, e.telefono_empresa, e.email_empresa, 
               e.area_empresa, ef.ruta_foto,
               -- campos de cuenta bancaria
               cb.nombre_titular, cb.numero_cuenta, b.nombre_banco AS nombre_banco, 
               tc.tipocuenta AS tipo_cuenta,
               -- Campos de titulos, subtitulos y detalles
               ti.nombre AS titulo, st.nombre AS subtitulo, 
               d.nombre_producto, d.descripcion, d.cantidad, d.precio_unitario, d.total
        FROM C_Cotizaciones c
        JOIN C_Proyectos p ON c.id_proyecto = p.id_proyecto
        JOIN C_Clientes cl ON c.id_cliente = cl.id_cliente
        JOIN C_Vendedores v ON c.id_vendedor = v.id_vendedor
        JOIN C_Totales t ON c.id_cotizacion = t.id_cotizacion
        JOIN e_Empresa e ON c.id_empresa = e.id_empresa
        JOIN e_fotosPerfil ef ON e.id_foto = ef.id_foto
        -- Join para cuenta bancaria
        LEFT JOIN E_Cuenta_Bancaria cb ON e.id_empresa = cb.id_empresa
        LEFT JOIN E_Bancos b ON cb.id_banco = b.id_banco
        LEFT JOIN E_Tipo_Cuenta tc ON cb.id_tipocuenta = tc.id_tipocuenta
        -- Join para titulos, subtitulos y detalles
        LEFT JOIN C_Titulos ti ON c.id_cotizacion = ti.id_cotizacion
        LEFT JOIN C_Subtitulos st ON ti.id_titulo = st.id_titulo
        LEFT JOIN C_Detalles d ON ti.id_titulo = d.id_titulo
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
        $contenido_pdf .= "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>\nendobj\n";
    
        // Agregar la imagen del logo al PDF
        $ruta_logo = $row['ruta_foto'];
        $ruta_logo_absoluta = realpath(dirname(__FILE__) . '/' . $ruta_logo);
    
        // Definir margen superior
        $margen_superior = 50;
    
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
            $contenido_pdf .= "$scaled_width 0 0 $scaled_height 50 " . (710 - $margen_superior) . " cm\n";  // Posición y tamaño del logo
            $contenido_pdf .= "/Im1 Do\n";
            $contenido_pdf .= "Q\n";
        }
    
        // Cuadro rojo para los datos de la cotización
        $contenido_pdf .= "q\n1 0 0 RG\n"; // Color rojo
        $contenido_pdf .= "2 w\n"; // Espesor del borde
        $contenido_pdf .= "400 " . (700 - $margen_superior) . " 200 100 re S\n"; // Rectángulo más grande
        $contenido_pdf .= "Q\n";
    
        // Texto de los datos de la cotización en el cuadro rojo
        $contenido_pdf .= "BT\n/F1 12 Tf\n410 " . (780 - $margen_superior) . " Td\n(Detalle Cotización) Tj\n"; // Título del cuadro rojo
        $contenido_pdf .= "0 -15 Td\n(RUT de la Empresa: " . utf8_decode($row['rut_empresa']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Número de Cotización: " . $id_cotizacion . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Días Validez: 30) Tj\n"; // Puedes cambiar los días de validez según necesites
        $contenido_pdf .= "0 -15 Td\n(Fecha de Validez: " . utf8_decode($row['fecha_validez']) . ") Tj\n";
        $contenido_pdf .= "ET\n";
    
        // Fecha de emisión debajo del cuadro rojo
        $contenido_pdf .= "BT\n/F1 12 Tf\n410 " . (680 - $margen_superior) . " Td\n(Fecha de Emisión: " . utf8_decode($row['fecha_emision']) . ") Tj\n";
        $contenido_pdf .= "ET\n";
    
        // Encabezado de los detalles de la empresa
        $contenido_pdf .= "BT\n/F1 14 Tf\n50 " . (660 - $margen_superior) . " Td\n(Detalle Empresa) Tj\n"; // Título de la sección de empresa
        $contenido_pdf .= "0 -15 Td\n(Nombre: " . utf8_decode($row['nombre_empresa']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Área: " . utf8_decode($row['area_empresa']) . ") Tj\n"; // Puedes cambiar el área según necesites
        $contenido_pdf .= "0 -15 Td\n(Dirección: " . utf8_decode($row['direccion_empresa']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Teléfono: " . utf8_decode($row['telefono_empresa']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Email: " . utf8_decode($row['email_empresa']) . ") Tj\n";
        $contenido_pdf .= "ET\n";
        
    
        // Separador entre Detalle Empresa y Detalle Proyecto
        $contenido_pdf .= "q\n0 0 0 RG\n"; // Color negro
        $contenido_pdf .= "0.5 w\n"; // Espesor del borde
        $contenido_pdf .= "50 " . (575 - $margen_superior) . " 500 1 re S\n"; // Línea de separación
        $contenido_pdf .= "Q\n";
    
        // Título de Detalle Proyecto
        $contenido_pdf .= "BT\n/F1 14 Tf\n50 " . (560 - $margen_superior) . " Td\n(Detalle Proyecto) Tj\n"; // Título de la sección de proyecto
        $contenido_pdf .= "ET\n";
    
        // Detalles del proyecto a la izquierda
        $contenido_pdf .= "BT\n/F1 12 Tf\n50 " . (540 - $margen_superior) . " Td\n(Nombre: " . utf8_decode($row['nombre_proyecto']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Código: " . utf8_decode($row['codigo_proyecto']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Área de Trabajo: " . utf8_decode($row['area_trabajo']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Tipo de Trabajo: " . utf8_decode($row['tipo_trabajo']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Riesgo: " . utf8_decode($row['riesgo_proyecto']) . ") Tj\n";
        $contenido_pdf .= "ET\n";
    
        // Detalles del proyecto a la derecha
        $contenido_pdf .= "BT\n/F1 12 Tf\n400 " . (540 - $margen_superior) . " Td\n(Días de Compra: " . utf8_decode($row['dias_compra']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Días de Trabajo: " . utf8_decode($row['dias_trabajo']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Número de Trabajadores: " . utf8_decode($row['trabajadores']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Horario: " . utf8_decode($row['horario']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Colación: " . utf8_decode($row['colacion']) . ") Tj\n";
        $contenido_pdf .= "ET\n";
    
        // Separador entre Detalle Proyecto y Detalle Productos
        $contenido_pdf .= "q\n0 0 0 RG\n"; // Color negro
        $contenido_pdf .= "0.5 w\n"; // Espesor del borde
        $contenido_pdf .= "50 " . (400 - $margen_superior) . " 500 1 re S\n"; // Línea de separación
        $contenido_pdf .= "Q\n";
    
        // Título de Detalle Productos
        $contenido_pdf .= "BT\n/F1 14 Tf\n50 " . (30 - $margen_superior) . " Td\n(Detalle Productos) Tj\n"; // Título de la sección de productos
        $contenido_pdf .= "ET\n";
    
        // Detalles de los productos (ejemplo con los primeros detalles de productos)
        // Aquí, puedes iterar sobre las filas de la tabla C_Detalles
        $contenido_pdf .= "BT\n/F1 12 Tf\n50 " . (370 - $margen_superior) . " Td\n(Producto 1: " . utf8_decode($row['producto1']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Cantidad: " . utf8_decode($row['cantidad1']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Precio: " . utf8_decode($row['precio1']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Descripción: " . utf8_decode($row['descripcion1']) . ") Tj\n";
        $contenido_pdf .= "ET\n";


        // Información de la cuenta bancaria
        $contenido_pdf .= "BT\n/F1 14 Tf\n50 " . (200 - $margen_superior) . " Td\n(Información Bancaria) Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Nombre Titular: " . utf8_decode($row['nombre_titular']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Número de Cuenta: " . utf8_decode($row['numero_cuenta']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Banco: " . utf8_decode($row['nombre_banco']) . ") Tj\n";
        $contenido_pdf .= "0 -15 Td\n(Tipo de Cuenta: " . utf8_decode($row['tipo_cuenta']) . ") Tj\n";
        $contenido_pdf .= "ET\n";
    
        // Finalizar contenido
        $contenido_pdf .= "endstream\nendobj\n";
    
        // Agregar las referencias de longitud
        $contenido_pdf .= "7 0 obj\n" . strlen($contenido_pdf) . "\nendobj\n";
    
        // Finalizar el documento PDF
        $contenido_pdf .= "xref\n0 8\n0000000000 65535 f \n0000000010 00000 n \n0000000061 00000 n \n0000000112 00000 n \n0000000179 00000 n \n0000000223 00000 n \n0000000467 00000 n \n0000001023 00000 n \n";
        $contenido_pdf .= "trailer\n<< /Size 8 /Root 1 0 R >>\nstartxref\n";
        $contenido_pdf .= (strlen($contenido_pdf) - strlen("xref\n0 8\n0000000000 65535 f \n0000000010 00000 n \n0000000061 00000 n \n0000000112 00000 n \n0000000179 00000 n \n0000000223 00000 n \n0000000467 00000 n \n0000001023 00000 n \n"));
        $contenido_pdf .= "\n%%EOF";
    
        // Generar y descargar el PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="cotizacion_' . $id_cotizacion . '.pdf"');
        echo $contenido_pdf;
    } else {
        echo "No se encontraron datos para la cotización.";
    }
}
$mysqli->close();
?>
