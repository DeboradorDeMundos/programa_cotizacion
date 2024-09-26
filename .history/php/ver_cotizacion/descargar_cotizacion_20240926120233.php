<?php
// Función para generar el contenido del PDF
function generarPDFCotizacion($id_cotizacion, $datos_empresa, $datos_cliente, $productos, $total_final, $fecha_emision, $fecha_validez) {
    // Crear el contenido PDF básico
    $contenido = "%PDF-1.4\n";
    $contenido .= "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
    $contenido .= "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 /MediaBox [0 0 612 792] >>\nendobj\n";
    $contenido .= "3 0 obj\n<< /Type /Page /Parent 2 0 R /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>\nendobj\n";
    $contenido .= "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n";
    $contenido .= "5 0 obj\n<< /Length 6 0 R >>\nstream\n";

    // Encabezado de la empresa
    $contenido .= "BT\n/F1 14 Tf\n100 770 Td\n(" . $datos_empresa['nombre'] . ") Tj\n";
    $contenido .= "100 750 Td\n(Dirección: " . $datos_empresa['direccion'] . ") Tj\n";
    $contenido .= "100 730 Td\n(Teléfono: " . $datos_empresa['telefono'] . ") Tj\n";
    $contenido .= "100 710 Td\n(Email: " . $datos_empresa['email'] . ") Tj\n";

    // Título de la cotización
    $contenido .= "/F1 16 Tf\n100 680 Td\n(Cotización N° " . $id_cotizacion . ") Tj\n";

    // Información del cliente
    $contenido .= "/F1 12 Tf\n100 650 Td\n(Cliente: " . $datos_cliente['nombre'] . ") Tj\n";
    $contenido .= "100 630 Td\n(Dirección: " . $datos_cliente['direccion'] . ") Tj\n";
    $contenido .= "100 610 Td\n(Teléfono: " . $datos_cliente['telefono'] . ") Tj\n";
    $contenido .= "100 590 Td\n(Email: " . $datos_cliente['email'] . ") Tj\n";

    // Fecha de emisión y validez
    $contenido .= "100 560 Td\n(Fecha de Emisión: " . $fecha_emision . ") Tj\n";
    $contenido .= "100 540 Td\n(Fecha de Validez: " . $fecha_validez . ") Tj\n";

    // Título de los productos
    $contenido .= "/F1 14 Tf\n100 510 Td\n(Detalles de los productos/servicios) Tj\n";

    // Tabla de productos
    $y = 490;
    foreach ($productos as $producto) {
        $contenido .= "100 $y Td\n(Producto: " . $producto['descripcion'] . ", Cantidad: " . $producto['cantidad'] . ", Precio: $" . $producto['precio'] . ") Tj\n";
        $y -= 20; // Mover hacia abajo para el siguiente producto
    }

    // Total final
    $contenido .= "100 $y Td\n(Total Final: $" . $total_final . ") Tj\n";

    // Cerrar el bloque de texto
    $contenido .= "ET\nendstream\nendobj\n";

    // Añadir el tamaño de contenido
    $contenido .= "6 0 obj\n" . strlen($contenido) . "\nendobj\n";
    $contenido .= "xref\n0 7\n0000000000 65535 f \n";
    $contenido .= "0000000010 00000 n \n0000000060 00000 n \n0000000110 00000 n \n";
    $contenido .= "0000000170 00000 n \n0000000290 00000 n \n0000000410 00000 n \n";
    $contenido .= "trailer\n<< /Size 7 /Root 1 0 R >>\nstartxref\n500\n%%EOF";

    return $contenido;
}

// Datos de prueba para la cotización
$id_cotizacion = 1;
$datos_empresa = [
    'nombre' => 'ITred Spa',
    'direccion' => 'Guido Reni #4190, Santiago',
    'telefono' => '+56 9 1234 5678',
    'email' => 'contacto@itred.cl'
];
$datos_cliente = [
    'nombre' => 'Juan Pérez',
    'direccion' => 'Av. Siempre Viva 123, Santiago',
    'telefono' => '+56 9 8765 4321',
    'email' => 'juan.perez@example.com'
];
$productos = [
    ['descripcion' => 'Servicio de Desarrollo Web', 'cantidad' => 1, 'precio' => 500000],
    ['descripcion' => 'Mantenimiento Mensual', 'cantidad' => 6, 'precio' => 80000]
];
$total_final = 980000;
$fecha_emision = '2024-09-25';
$fecha_validez = '2024-10-25';

// Generar el PDF
$contenido_pdf = generarPDFCotizacion($id_cotizacion, $datos_empresa, $datos_cliente, $productos, $total_final, $fecha_emision, $fecha_validez);

// Configurar las cabeceras para descargar el archivo PDF
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="cotizacion_' . $id_cotizacion . '.pdf"');
header('Content-Length: ' . strlen($contenido_pdf));

// Enviar el contenido
echo $contenido_pdf;
?>
