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
// Crea una nueva conexión a la base de datos MySQL usando mysqli
$mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd'); // Conecta a la base de datos con parámetros: servidor, usuario, contraseña, base de datos

// Verifica si ocurrió un error durante la conexión
// Si hay un error, muestra un mensaje y detiene la ejecución del script
if ($mysqli->connect_error) { // Comprueba si hay un error en la conexión
    die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error); // Muestra el error y termina el script
}
?>

<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->

<!DOCTYPE html> <!-- Define el tipo de documento como HTML5 -->
<html lang="es"> <!-- Define el idioma de la página como español -->
<head>
    <meta charset="UTF-8"> <!-- Establece el conjunto de caracteres a UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista para dispositivos móviles -->
    <title>Menú Principal - Cotización ITred Spa</title> <!-- Define el título de la página que aparece en la pestaña del navegador -->
    <link rel="stylesheet" href="css/index.css"> <!-- Incluye la hoja de estilos CSS externa -->
</head>
<body>
    <h1>Menú Principal - Cotización ITred Spa</h1> <!-- Encabezado principal de la página -->
    <nav>
        <ul>
            <li><a href="php/crear_nuevo/crear.php">Crear Cotización</a></li> <!-- Enlace para crear una nueva cotización -->
            <li><a href="php/ver_listado/ver_listado.php">Ver listado Cotización</a></li> <!-- Enlace para ver el listado de cotizaciones -->
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
