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
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title> Agregar proveedor</title> 
    <link rel="stylesheet" href="../../css/crear_proveedor/crear_proveedor.css"> 
    <a href="../../programa_cotizacion.php" class="boton-fijado">Volver</a>
</head> 

<body> 
<div class='contenedor-principal'>

    <div class="contenedor">  
        <form id="formulario-proveedor" method="POST" action="" enctype="multipart/form-data">
            <!-- TÍTULO PARA EL FORMULARIO DE NUEVO PROVEEDOR -->
                <h3>RELLENA EL FORMULARIO PARA AGREGAR UN NUEVO PROVEEDOR</h3>
                <?php include 'formulario_proveedor.php'; ?>
    
            <div class="contenedor"> 
                <!-- TÍTULO PARA EL FORMULARIO DE LA EMPRESA DEL PROVEEDOR -->
                    <h3>RELLENA EL FORMULARIO PARA AGREGAR LA EMPRESA DEL PROVEEDOR</h3>
                    <?php include 'empresa_proveedor.php'; ?>
            </div> 

            <!-- Botón de submit debe estar dentro del formulario -->
            <button type="submit" class="submit">Crear proveedor</button> 
        </form> 
    </div> 

    <div class="contenedor"> 
        <!-- TÍTULO PARA EL LISTADO DE PROVEEDORES -->
            <h3>Listado de proveedores</h3>
            <!-- Incluye el archivo que muestra el listado de proveedores -->
            <?php include 'mostrar_proveedor.php'; ?> 
    </div> 

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
