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
    ------------------------------------- INICIO ITred Spa Crear Empresa .PHP --------------------------------------
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
     <!-- Abre el elemento de cabecera que contiene metadatos y enlaces a recursos externos -->
<head> 
<!-- Define la codificación de caracteres como UTF-8 para asegurar la correcta visualización de caracteres especiales y diversos idiomas -->    
<meta charset="UTF-8"> 
    <!-- Configura la vista en dispositivos móviles. width=device-width asegura que el ancho de la página se ajuste al ancho de la pantalla del dispositivo, y initial-scale=1.0 establece el nivel de zoom inicial -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!-- Define el título de la página que se muestra en la pestaña del navegador -->
    <title>Formulario de Cotización</title> 
    <!-- Enlaza una hoja de estilo externa que se encuentra en la ruta especificada para estilizar el contenido de la página -->
    <link rel="stylesheet" href="../../css/crear_empresa/crear_empresa.css"> 
</head> <!-- Cierra el elemento de cabecera -->
<body> <!-- Abre el elemento del cuerpo de la página donde se coloca el contenido visible -->
    <div class="contenedor"> <!-- Contenedor principal que puede ayudar a centrar y organizar el contenido en la página -->
        
        <!-- Título: Formulario de cotización -->
        <form id="formulario-cotizacion" method="POST" action="" enctype="multipart/form-data">
           
            <!-- Título: Enlace para volver a la página anterior -->
            <a href="../../programa_cotizacion.php" class="boton-fijado">Volver</a>
            
            <!-- Fila 1 -->
            <!-- Título: Fila 1 - Logo y cuadro rojo -->
            <div class="row"> 

                <!-- Incluye el archivo para la carga del logo -->
                <?php include 'upload_logo.php'; ?>

                <!-- Incluye el archivo para mostrar el cuadro rojo -->
                <?php include 'cuadro_rojo.php'; ?>
                
            </div> <!-- Cierra la fila 1 -->

            <!-- Fila 2 -->
            <!-- Título: Fila 2 - Formularios -->
            <!-- Incluye el archivo para el formulario de empresa -->
            <?php include 'formulario_empresa.php'; ?>

            <!-- Incluye el archivo para el formulario del encargado -->
            <?php include 'formulario_encargado.php'; ?>

            <!-- Incluye el archivo para el formulario del vendedor -->
            <?php include 'formulario_vendedor.php'; ?>            

            <!-- Fila para cuentas bancarias -->
            <!-- Título: Fila de cuentas bancarias -->
            <!-- Incluye el archivo para el formulario de cuenta -->
            <?php include 'formulario_cuenta.php';?>

            <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
            <div class="row"> 
                <div class="box-12 data-box">
                    <h2>TRANSFERENCIAS A:</h2>
                    <table id="tabla-cuentas" border="1">
                        <!-- La tabla se llenará dinámicamente -->
                    </table>
                </div>
            </div>

            <!-- Título: Requisitos básicos -->
            <div class="row"> 
                <div class="box-12 data-box">
                    <!-- Incluye el archivo para los requisitos básicos -->
                    <?php include 'requisitos_basicos.php';?>
                </div>
            </div>

            <!-- Título: Condiciones generales -->
            <div class="row"> 
                <div class="box-12 data-box">
                    <!-- Incluye el archivo para las condiciones generales -->
                    <?php include 'condiciones_generales.php';?>
                </div>
            </div>
            
            <!-- Título: Obligaciones del cliente -->
            <div class="row"> 
                <div class="box-12 data-box">
                    <!-- Incluye el archivo para las obligaciones del cliente -->
                    <?php include 'obligaciones_cliente.php';?>
                </div>
            </div>

            <!-- Título: Firma -->
            <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
            <div class="row"> 
                <div class="box-12 data-box">
                    <!-- Incluye el archivo para la firma -->
                    <?php include 'firma.php';?>
                </div>
            </div>

            <!-- Título: Botón para enviar el formulario y generar la cotización -->
            <button type="submit" id="boton-subir" class="subir">Crear empresa</button> 
            <!-- Cierra el formulario -->
        </form> 
        <!-- Cierra el contenedor principal -->
    </div> 
    <!-- Enlaza un archivo JavaScript externo para actualizar el logo o realizar otras actualizaciones -->
    <script src="../../js/crear_empresa/crear_empresa.js"></script> 
</body>
</html>

<!-- ---------------------
     -- INICIO CIERRE CONEXION BD --
     --------------------- -->
<?php
// Cierra la conexión a la base de datos
$mysqli->close();
?>
<!-- ---------------------
     -- FIN CIERRE CONEXION BD --
     --------------------- -->






<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa crear_empresa .PHP -----------------------------------
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