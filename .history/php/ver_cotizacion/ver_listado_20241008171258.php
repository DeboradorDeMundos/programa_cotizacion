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
    ------------------------------------- INICIO ITred Spa Ver Listado .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');


// Obtiene el ID de la empresa desde la URL
$id_empresa = isset($_GET['id']) ? intval($_GET['id']) : 0;



// Cierra la conexión a la base de datos
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cotizaciones</title>
    <link rel="stylesheet" href="../../css/programa_cotizacion/ver_listado.css">
</head>
<body>
    <div>   <?php include 'filtros_busqueda.php'; ?></div>
    
    <?php echo $mensaje; ?>
    <ul>
        <li><a href="../nueva_cotizacion/nueva_cotizacion.php?id=<?php echo $id_empresa; ?>">Crear Cotización</a></li>
        <li><a href="../../programa_cotizacion.php">Volver al Menú</a></li>
    </ul>
</body>
</html>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  Ver Listado .PHP -----------------------------------
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
