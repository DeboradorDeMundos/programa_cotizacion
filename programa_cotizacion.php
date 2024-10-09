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
    ------------------------------------- INICIO ITred Spa Programa Cotizacion.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');
?>

<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menú Principal - Cotización ITred Spa</title>
        <link rel="stylesheet" href="css/programa_cotizacion/programa_cotizacion.css">
    </head>

    <body>
    <!-- Incluye el menú de navegación desde un archivo PHP externo -->
    <?php include 'php/programa_cotizacion/menu.php'; ?>

    <!-- Formulario para seleccionar la Empresa -->
    <form method="POST" action="">

        <!-- Incluye el archivo PHP que maneja la selección de empresas -->
        <?php include 'php/programa_cotizacion/seleccionar_empresa.php'; ?>

            <!-- boton seleccionar empresa -->
            <input type="hidden" id="selected-empresa" name="empresa" />
            <button type="submit">Seleccionar</button>
    </form>

        
        <!-- Carga el archivo JavaScript para la funcionalidad del formulario -->
        <script src="js/programa_cotizacion/programa_cotizacion.js"></script> 

    </body>
</html>




<!-- ---------------------
-- INICIO CIERRE CONEXION BD --
     --------------------- -->
<?php
$mysqli->close(); // Cierra la conexión a la base de datos
?>
<!-- ---------------------
     -- FIN CIERRE CONEXION BD --
     --------------------- -->

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Programa Cotizacion .PHP ----------------------------------------
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
