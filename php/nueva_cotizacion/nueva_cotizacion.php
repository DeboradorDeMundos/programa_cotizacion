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
    ------------------------------------- INICIO ITred Spa Nueva cotizacion .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
    -- INICIO CONEXION BD --
    ------------------------ -->

<?php
    // Establece la conexión a la base de datos de ITred Spa
    $mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd');
?>
<!-- ---------------------
     -- FIN CONEXION BD --
     ----------------------- -->



<!DOCTYPE html>
<html lang="es">
<head> <!-- Abre el elemento de cabecera que contiene metadatos y enlaces a recursos externos -->
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres como UTF-8 para asegurar la correcta visualización de caracteres especiales y diversos idiomas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista en dispositivos móviles. width=device-width asegura que el ancho de la página se ajuste al ancho de la pantalla del dispositivo, y initial-scale=1.0 establece el nivel de zoom inicial -->
    <title>Formulario de Cotización</title> <!-- Define el título de la página que se muestra en la pestaña del navegador -->
    <link rel="stylesheet" href="../../css/nueva_cotizacion/nueva_cotizacion.css"> <!-- Enlaza una hoja de estilo externa que se encuentra en la ruta especificada para estilizar el contenido de la página -->
</head> <!-- Cierra el elemento de cabecera -->
<body> <!-- Abre el elemento del cuerpo de la página donde se coloca el contenido visible -->
    <div class="contenedor"> <!-- Contenedor principal que puede ayudar a centrar y organizar el contenido en la página -->
        <form id="formulario-cotizacion" method="POST" action="" enctype="multipart/form-data">
            <!-- Formulario con ID "formulario-cotizacion". Usa el método POST para enviar los datos al servidor. El atributo "action" define el archivo al que se enviarán los datos. "enctype" especifica que el formulario puede enviar archivos -->
            <a href="javascript:history.back()" class="boton-fijado">Volver</a>
            <!-- Fila 1 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <?php include 'cargar_logo_empresa.php'; ?>

                <?php include 'cuadro_rojo_cotizacion.php'; ?>

                <fieldset class="box-6 cuadro-datos"> 
                    <label for="fecha_emision">Fecha de Emisión:</label> <!-- Etiqueta para el campo de entrada de la fecha de emisión -->
                    <input type="date" id="fecha_emision" name="fecha_emision" required> <!-- Campo de fecha para seleccionar la fecha de emisión. Es obligatorio --> 
                </fieldset>
            </div>
            <!-- Fila 2 -->
            <?php include 'datos_empresa.php'; ?>

            <!-- Fila 3 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <?php include 'detalle_proyecto.php'; ?>  
            </div> <!-- Cierra la fila -->

            <!-- Fila 4 -->
            <?php include 'detalle_cliente.php'; ?>

            <!-- Fila 5 -->
            <?php include 'detalle_encargado.php'; ?>

            <!-- Fila 6 -->
            <?php include 'detalle_vendedor.php'; ?>

            <!-- Sección que guarda los datos de la cotizacion -->
            <?php include 'detalle_cotizacion.php'; ?>
            <!-- sección para Detalle de Cotización -->
            <?php include 'detalle.php'; ?>
            
            <!-- Sección para los cálculos finales -->
            <?php include 'detalle_total.php'; ?>
            <!-- Sección para los observaciones -->
            <?php include 'observaciones.php'; ?>
            <br>
            <!-- Sección para los Pagos -->
            <?php include 'pago.php'; ?>
            
            <br>
            
            <?php include 'traer_condiciones.php'; ?>

            <?php include 'traer_requisitos.php'; ?>

            <?php include 'obligaciones_cliente.php'; ?>
    
            <button type="submit" class="submit">Crear cotizacion</button> <!-- Botón para enviar el formulario y generar la cotización -->
        </form> <!-- Cierra el formulario -->
    </div> <!-- Cierra el contenedor principal -->

    <?php include 'traer_datos_bancarios.php'; ?>

    <?php include 'firma.php'; ?>
            
    <script src="../../js/nueva_cotizacion/nueva_cotizacion.js"></script> <!-- Enlaza nuevamente el archivo JavaScript para manejar la lógica del formulario de cotización -->
    <script src="../../js/crear_empresa/upload_logo.js"></script>
    <script src="../../js/nueva_cotizacion/cargar_logo_empresa.js"></script> 
    <script src="../../js/nueva_cotizacion/cuadro_rojo_cotizacion.js"></script> 
    <script src="../../js/nueva_cotizacion/pago.js"></script> 
</body>
</html>
<!-- ---------------------
-- INICIO CIERRE CONEXION BD --
     --------------------- -->
<?php
    $mysqli->close();
?>
<!-- ---------------------
     -- FIN CIERRE CONEXION BD --
     --------------------- -->

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa nueva cotizacion .PHP -----------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITredSpa.
BPPJ
-->