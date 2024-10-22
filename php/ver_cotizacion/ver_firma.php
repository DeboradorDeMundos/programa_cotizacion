<?php
// Obtener el ID de la cotización desde el parámetro de la URL
$id_cotizacion = isset($_GET['id_cotizacion']) ? intval($_GET['id_cotizacion']) : 0;

if ($id_cotizacion > 0) {
    // Definir URLs para los botones
    $url_cotizacion = "ver_cotizacion.php?id=10";
    $url_firma = "detalle_firma.php?id=10";
} else {
    echo "<p>ID de cotización no válido.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Firma</title>
    <link rel="stylesheet" href="../../css/ver_cotizacion/ver_firma.css">
</head>
<body>

<div class="contenedor">
    <!-- TÍTULO: FIRMA Y COTIZACIÓN -->
    <h1>Firma y Cotización</h1>
    <!-- TÍTULO: INSTRUCCIÓN PARA EL USUARIO -->
    <p>Elige una opción para ver los detalles de la cotización o la firma.</p>

    <!-- TÍTULO: BOTÓN PARA VER COTIZACIÓN -->
    <!-- Botón para ver cotización -->
    <a href="<?php echo $url_cotizacion; ?>" class="btn">Ver Cotización</a>

    <!-- TÍTULO: BOTÓN PARA VER FIRMA -->
    <!-- Botón para ver firma -->
    <a href="<?php echo $url_firma; ?>" class="btn btn-secondary">Ver Firma</a>
</div>

</body>
</html>