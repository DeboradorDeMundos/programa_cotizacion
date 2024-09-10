<?php
include '../../db_config.php';

// Obtener el ID de la cotización desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Preparar la consulta para eliminar la cotización
    $sql = "DELETE FROM nombre_proyecto WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $mensaje = "Cotización eliminada con éxito.";
    } else {
        $mensaje = "Error al eliminar la cotización.";
    }
    $stmt->close();
} else {
    $mensaje = "ID inválido.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cotización</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/confirmar_eliminacion.js" defer></script>
</head>
<body>
    <p><?php echo $mensaje; ?></p>
    <ul>
        <li><a href="../ver_listado/ver_listado.php">Volver al Listado</a></li>
    </ul>
</body>
</html>
