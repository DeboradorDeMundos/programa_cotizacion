<?php
// Habilitar el reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itredspa_bd";

// Crear la conexión
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa<br>";

// Obtener el ID de la cotización desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Preparar la consulta para eliminar la cotización
    $sql = "DELETE FROM cotizaciones WHERE id_cotizacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirigir a la página de lista de cotizaciones
        header("Location: ../ver_listado/ver_listado.php");
        exit(); // Asegurarse de que no se ejecute ningún código adicional
    } else {
        echo "Error al eliminar la cotización.";
    }
    $stmt->close();
} else {
    $mensaje = "ID inválido.";
}

$conn->close();
?>
