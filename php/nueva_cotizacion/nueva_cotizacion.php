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
            <!-- TÍTULO: ENLACE PARA VOLVER -->
            
            <!-- Fila 1 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <!-- TÍTULO: LOGO DE LA EMPRESA -->
                <?php include 'cargar_logo_empresa.php'; ?>

                <!-- TÍTULO: CUADRO ROJO DE COTIZACIÓN -->
                <?php include 'cuadro_rojo_cotizacion.php'; ?>

                <fieldset class="box-6 cuadro-datos"> 
                    <!-- TÍTULO: SECCIÓN DE DATOS -->
                    <label for="fecha_emision">Fecha de Emisión:</label> <!-- Etiqueta para el campo de entrada de la fecha de emisión -->
                    <input type="date" id="fecha_emision" name="fecha_emision" required> <!-- Campo de fecha para seleccionar la fecha de emisión. Es obligatorio --> 
                </fieldset>
            </div>
            <!-- Fila 2 -->
            <!-- TÍTULO: DATOS DE LA EMPRESA -->
            <?php include 'datos_empresa.php'; ?>

            <!-- Fila 3 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <!-- TÍTULO: DETALLE DEL PROYECTO -->
                <?php include 'detalle_proyecto.php'; ?>  
            </div> <!-- Cierra la fila -->

            <!-- Fila 4 -->
            <!-- TÍTULO: DETALLE DEL CLIENTE -->
            <?php include 'detalle_cliente.php'; ?>

            <!-- Fila 5 -->
            <!-- TÍTULO: DETALLE DEL ENCARGADO -->
            <?php include 'detalle_encargado.php'; ?>

            <!-- Fila 6 -->
            <!-- TÍTULO: DETALLE DEL VENDEDOR -->
            <?php include 'detalle_vendedor.php'; ?>

            <!-- TÍTULO: DETALLE DE COTIZACIÓN -->
            <?php include 'detalle_cotizacion.php'; ?>
            
            <!-- TÍTULO: DETALLE GENERAL -->
            <?php include 'detalle.php'; ?>

            <!-- TÍTULO: CÁLCULOS FINALES -->
            <?php include 'detalle_total.php'; ?>

            <!-- TÍTULO: OBSERVACIONES -->
            <?php include 'observaciones.php'; ?>
            
            <br>
            <!-- TÍTULO: SECCIÓN PARA LOS PAGOS -->
            <?php include 'pago.php'; ?>
            
            <br>
            
            <!-- TÍTULO: CONDICIONES -->
            <?php include 'traer_condiciones.php'; ?>

            <!-- TÍTULO: REQUISITOS -->
            <?php include 'traer_requisitos.php'; ?>

            <!-- TÍTULO: OBLIGACIONES DEL CLIENTE -->
            <?php include 'obligaciones_cliente.php'; ?>
            
            <!-- Botón para enviar el formulario y generar la cotización -->
            <div>
                <!-- TÍTULO: MENSAJE DE DESPEDIDA -->            
                <?php include 'mensaje_despedida.php'; ?>            
            </div>

            <!-- TÍTULO: DATOS BANCARIOS -->
            <?php include 'traer_datos_bancarios.php'; ?>

            <!-- TÍTULO: FIRMA -->
            <?php include 'firma.php'; ?>
            
            <!-- TÍTULO: ENLAZA NUEVAMENTE EL ARCHIVO JAVASCRIPT PARA MANEJAR LA LÓGICA DEL FORMULARIO DE COTIZACIÓN -->       
            <script src="../../js/nueva_cotizacion/nueva_cotizacion.js"></script> 
            <script src="../../js/nueva_cotizacion/cuadro_rojo_cotizacion.js"></script> 

            <button type="submit" class="submit">Guardar cotizacion</button> 
            <!-- Título: Botón para Guardar Cotización -->
        </form> <!-- Cierra el formulario -->
    </div> <!-- Cierra el contenedor principal -->
</body>
</html>




<!-- ---------------------
-- INICIO CIERRE CONEXION BD --
     --------------------- -->
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Redirigir a la página de visualización de la cotización usando un formulario oculto
    echo '
    <form id="redireccionar" method="GET" action="http://localhost/programa_cotizacion/php/ver_cotizacion/ver.php">
        <input type="hidden" name="id" value="' . $id_cotizacion . '">
    </form>
    <script>
        document.getElementById("redireccionar").submit();
    </script>';
}

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