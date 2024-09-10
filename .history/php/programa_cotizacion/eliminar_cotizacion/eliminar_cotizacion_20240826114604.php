<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->

<!-- ------------------------------------------------------------------------------------------------------------
    ------------------------------------- INICIO ITred Spa Ver Cotización .PHP ---------------------------------
    ------------------------------------------------------------------------------------------------------------- -->


<?php
// Habilitar el reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
