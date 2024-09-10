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
    ------------------------------------- INICIO ITred Spa Crear Empresa .PHP --------------------------------------
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


<!DOCTYPE html>
<html lang="es">
<head> <!-- Abre el elemento de cabecera que contiene metadatos y enlaces a recursos externos -->
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres como UTF-8 para asegurar la correcta visualización de caracteres especiales y diversos idiomas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista en dispositivos móviles. width=device-width asegura que el ancho de la página se ajuste al ancho de la pantalla del dispositivo, y initial-scale=1.0 establece el nivel de zoom inicial -->
    <title>Formulario de Cotización</title> <!-- Define el título de la página que se muestra en la pestaña del navegador -->
    <link rel="stylesheet" href="../../css/crear_empresa/crear_empresa.css"> <!-- Enlaza una hoja de estilo externa que se encuentra en la ruta especificada para estilizar el contenido de la página -->
</head> <!-- Cierra el elemento de cabecera -->
<body> <!-- Abre el elemento del cuerpo de la página donde se coloca el contenido visible -->
    <div class="container"> <!-- Contenedor principal que puede ayudar a centrar y organizar el contenido en la página -->
        <form id="cotizacion-form" method="POST" action="procesar_creacion_empresa.php" enctype="multipart/form-data">
            <!-- Formulario con ID "cotizacion-form". Usa el método POST para enviar los datos al servidor. El atributo "action" define el archivo al que se enviarán los datos. "enctype" especifica que el formulario puede enviar archivos -->
            <a href="javascript:history.back()" class="btn-fixed">Volver</a>
            <!-- Fila 1 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->

                <?php include 'upload_logo.php'; ?>

                <?php include 'cuadro_rojo.php'; ?>
                
            </div> <!-- Cierra la fila -->

            <!-- Fila 2 -->

            <?php include 'formulario_empresa.php'; ?>

            <!-- Fila para cuentas bancarias -->
            
            <?php include 'formulario_cuenta.php';?>

            <?php include 'condiciones_generales.php';?>

            <button type="submit" id="submit-button" class="subir">Crear empresa</button> <!-- Botón para enviar el formulario y generar la cotización -->
        </form> <!-- Cierra el formulario -->
    </div> <!-- Cierra el contenedor principal -->

    <h2>TRANSFERENCIAS A:</h2>
    <table id="accounts-table" border="1">
        <!-- La tabla se llenará dinámicamente -->
    </table>

    <p>SIN OTRO PARTICULAR, Y ESPERANDO QUE LA PRESENTE OFERTA SEA DE SU INTERÉS, SE DESPIDE ATENTAMENTE</p> <!-- Mensaje de despedida en la oferta -->
    <p>BARNER PATRICIO PIÑA JARA</p> <!-- Nombre del remitente -->
    <p>JEFE DE PROYECTO TECNOLOGIA Y CONSTRUCCION</p> <!-- Cargo del remitente -->
    <p>ITRED SPA.</p> <!-- Nombre de la empresa del remitente -->

    <script src="../../js/crear_empresa/actualizar_logo.js"></script>
    <script src="../../js/nueva_cotizacion/load_bancos.js"></script> 
    <script src="../../js/nueva_cotizacion/load_tipo_uenta.js"></script> 
    <script src="../../js/nueva_cotizacion/agregar_banco.js"></script> 
    <script src="../../js/crear_empresa/crear_empresa.js"></script> 
    <!-- Enlaza un archivo JavaScript externo para actualizar el logo o realizar otras actualizaciones -->
</body>
</html>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa crear_empresa .PHP -----------------------------------
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