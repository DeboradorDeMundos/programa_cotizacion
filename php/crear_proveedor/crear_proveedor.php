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
    ------------------------------------- INICIO ITred Spa crear proveedor.PHP --------------------------------------
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
    <!-- Abre el elemento de cabecera que contiene metadatos y enlaces a recursos externos -->
<head> 
    <!-- Define la codificación de caracteres como UTF-8 para asegurar la correcta visualización de caracteres especiales y diversos idiomas -->
    <meta charset="UTF-8"> 
    <!-- Configura la vista en dispositivos móviles. width=device-width asegura que el ancho de la página se ajuste al ancho de la pantalla del dispositivo, y initial-scale=1.0 establece el nivel de zoom inicial -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!-- Define el título de la página que se muestra en la pestaña del navegador -->
    <title> Agregar proveedor</title> 
    <!-- Enlaza una hoja de estilo externa que se encuentra en la ruta especificada para estilizar el contenido de la página -->
    <link rel="stylesheet" href="../../css/crear_proveedor/crear_proveedor.css"> 
    <!-- Cierra el elemento de cabecera -->
    <a href="../../programa_cotizacion.php" class="boton-fijado">Volver</a>
</head> 
<!-- Abre el elemento del cuerpo de la página donde se coloca el contenido visible -->
<body> 
    
    <!-- Contenedor principal que puede ayudar a centrar y organizar el contenido en la página -->
    <div class="contenedor"> 
        
        <form id="formulario-proveedor" method="POST" action="" enctype="multipart/form-data">
        <h3>RELLENA EL FORMULARIO PARA AGREGAR UN NUEVO PROVEEDOR </h3>
        <?php include 'formulario_proveedor.php'; ?>

        <div class="contenedor"> 
        <h3>RELLENA EL FORMULARIO PARA AGREGAR LA EMPRESA DEL PROVEEDOR </h3>
        <?php include 'empresa_proveedor.php'; ?>
   
    <button type="submit" class="submit">Crear proveedor</button> 
    <!-- Cierra el formulario --> 
    <!-- Cierra el contenedor principal -->
    </div> 
    <!-- Cierra el formulario -->
    </form> 
    <!-- Cierra el contenedor principal -->
    </div> 
    <!-- Cierra el cuerpo de la pagina -->

    <div class="contenedor"> 
            <h3>Listado de proveedores</h3>
            <!-- Incluye el archivo que muestra el listado de proveedores -->
            <?php include 'mostrar_proveedor.php'; ?> 
    </div> 

</body>
<script src="../../js/crear_proveedor/crear_proveedor.js"></script> 
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
    -------------------------------------- FIN ITred Spa crear proveedor .PHP ----------------------------------------
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