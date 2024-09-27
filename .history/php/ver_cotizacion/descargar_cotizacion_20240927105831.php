<?php
require('fpdf.php');

// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');
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

        // Crear el PDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Establecer fuente y tamaño
        $pdf->SetFont('Arial', 'B', 16);

        // Agregar el logo
        $ruta_logo = $row['ruta_foto'];
        if (file_exists($ruta_logo)) {
            $pdf->Image($ruta_logo, 10, 10, 30);
        }

        // Título de la empresa
        $pdf->Cell(0, 10, utf8_decode($row['nombre_empresa']), 0, 1, 'C');

        // Datos de la empresa
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'RUT: ' . $row['rut_cliente'], 0, 1);
        $pdf->Cell(0, 10, 'Dirección: ' . utf8_decode($row['direccion_empresa']), 0, 1);
        $pdf->Cell(0, 10, 'Teléfono: ' . $row['telefono_empresa'], 0, 1);
        $pdf->Cell(0, 10, 'Email: ' . $row['email_empresa'], 0, 1);

        // Datos del cliente
        $pdf->Cell(0, 10, 'Cliente: ' . utf8_decode($row['nombre_cliente']), 0, 1);
        $pdf->Cell(0, 10, 'Dirección: ' . utf8_decode($row['direccion_cliente']), 0, 1);
        $pdf->Cell(0, 10, 'Teléfono: ' . $row['telefono_cliente'], 0, 1);
        $pdf->Cell(0, 10, 'Email: ' . $row['email_cliente'], 0, 1);

        // Datos del proyecto
        $pdf->Cell(0, 10, 'Proyecto: ' . utf8_decode($row['nombre_proyecto']), 0, 1);

        // Total final
        $pdf->Cell(0, 10, 'Total Final: $' . number_format($row['total_final'], 2), 0, 1);

        // Generar el PDF
        $pdf->Output('D', 'cotizacion_' . $id_cotizacion . '.pdf');
    } else {
        echo "No se encontró la cotización.";
    }

    $stmt->close();
} else {
    echo "ID de cotización no proporcionado.";
}

$mysqli->close();
?>
