<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->

<!-- ------------------------------------------------------------------------------------------------------------
    ------------------------------------- INICIO ITred Spa Eliminar cotizacion .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

<?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

// Verifica la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Obtener el ID de la cotización desde la URL

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$id_empresa = isset($_GET['id_empresa']) ? intval($_GET['id_empresa']) : 0;

if ($id > 0) {
    // Preparar la consulta para eliminar la cotización
    $sql = "DELETE FROM C_Cotizaciones WHERE id_cotizacion = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirigir a la página de lista de cotizaciones
        header("Location: ver_listado.php?id=" . $id_empresa);
        exit(); // Asegurarse de que no se ejecute ningún código adicional
    } else {
        echo "Error al eliminar la cotización.";
    }
    $stmt->close();
} else {
    echo "ID inválido.";
}

$mysqli->close();
?>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Eliminar Cotizacion .PHP -----------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->
