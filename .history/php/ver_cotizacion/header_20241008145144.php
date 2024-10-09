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
    ------------------------------------- INICIO ITred Spa header .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');
?>
<div class="header-contenedor">
    <img alt="Company Logo" class="logo" src="<?php echo $ruta_foto; ?>"/>
    <div class="header">
        <h1><?php echo $items[0]['nombre_empresa']; ?></h1>
        <h2><?php echo $items[0]['nombre_empresa']; ?></h2>
        <div class="contact-info">
            <p>DIRECCIÓN: <?php echo $items[0]['direccion_empresa']; ?></p>
            <p>TELÉFONO: <?php echo $items[0]['telefono_empresa']; ?></p>
            <p>E-MAIL: <?php echo $items[0]['email_empresa']; ?></p>
            <p>WEB: <?php echo $items[0]['web_empresa']; ?></p>
        </div>
    </div>
    <div class="invoice-info">
        <p>R.U.T.: <?php echo $items[0]['rut_empresa']; ?></p>
        <h3>COTIZACIÓN</h3>
        <p>Nº: <?php echo $items[0]['numero_cotizacion']; ?></p>
        <p class="sii-info"> SISTEMA DE PRUEBAS</p>
    </div>
</div>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  header .PHP -----------------------------------
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
