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
    ------------------------------------- INICIO ITred Spa Crear producto .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

<?php
// Establece la conexión a la base de datos de ITred Spa
$conn = new mysqli('localhost', 'root', '', 'ITredSpa_bd');
?>
<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->
<!-- ------------------------------------------------------------------------------------------------------------
    ------------------------------------- INICIO ITred Spa creacion producto .PHP --------------------------------------
------------------------------------------------------------------------------------------------------------- -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Creación de Productos</title>
    <!-- Enlace a la hoja de estilos para el formulario de creación de productos -->
    <link rel="stylesheet" href="../../css/crear_producto/crear_producto.css">
</head>
<body>
    <div class="contenedor">
        <div class="form-contenedor">
            <!-- Título: Incluye el formulario de creación de producto -->
            <!-- Incluye el formulario de creación de producto -->
            <?php include 'formulario_creacion_producto.php'; ?>
        </div>
    </div>
</body>
</html>

<!-- ------------------------------------------------------------------------------------------------------------
-------------------------------------- FIN ITred Spa Creacion producto .PHP -----------------------------------
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