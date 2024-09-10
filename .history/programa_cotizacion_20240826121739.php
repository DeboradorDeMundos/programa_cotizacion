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
    ------------------------------------- INICIO ITred Spa Menú básico .PHP --------------------------------------
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
    <!-- Define el conjunto de caracteres del documento como UTF-8 -->
    <meta charset="UTF-8">
    <!-- Define la configuración de la vista para dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Define el título de la página que aparece en la pestaña del navegador -->
    <title>Menú Principal - Cotización ITred Spa</title>
    <!-- Incluye el archivo CSS para estilos de la página -->
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <!-- Encabezado principal de la página -->
    <h1>Menú Principal - Cotización ITred Spa</h1>
    <nav>
        <!-- Menú de navegación con enlaces a otras páginas -->
        <ul>
            
            <li><a href="php/programa_cotizacion/formulario_cotizacion/formulario_cotizacion.php">Crear Cotización</a></li><!-- Enlace para crear una nueva cotización -->

            <li><a href="php/ver_listado/ver_listado.php">Ver listado Cotización</a></li><!-- Enlace para ver el listado de cotizaciones -->
        </ul>
    </nav>
</body>
</html>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Menú básico .PHP ----------------------------------------
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
