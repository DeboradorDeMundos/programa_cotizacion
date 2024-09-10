<?php
// Incluye el archivo de conexión a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Define la ID de la empresa que está generando la cotización
$id_empresa = 1; // Cambia esto al ID real de la empresa

// Prepara la consulta SQL
$sql = "SELECT rut FROM Empresa WHERE id_empresa = ?";

// Prepara la sentencia
if ($stmt = $mysqli->prepare($sql)) {
    // Vincula los parámetros
    $stmt->bind_param('i', $id_empresa);

    // Ejecuta la sentencia
    $stmt->execute();

    // Obtiene el resultado
    $result = $stmt->get_result();
    $rut_empresa = $result->fetch_assoc()['rut'];

    // Devuelve el RUT como JSON
    echo json_encode(['rut' => $rut_empresa]);

    // Cierra la sentencia
    $stmt->close();
} else {
    echo json_encode(['error' => 'Error al preparar la consulta']);
}

// Cierra la conexión
$mysqli->close();
?>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  Obtener Rut Empresa .PHP -----------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->