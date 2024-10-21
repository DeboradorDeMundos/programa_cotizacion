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
    ------------------------------------- INICIO ITred Spa Cuadro Rojo.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->


<!-- Enlaza una hoja de estilo externa para el cuadro rojo -->
<link rel="stylesheet" href="../../css/crear_empresa/cuadro_rojo.css">

<!-- Título: Caja de datos de cotización -->
<div class="box-6 data-box data-box-red"> 
    <!-- Título: RUT de la Empresa -->
    <!-- Etiqueta para el campo de entrada del RUT de la empresa -->
    <label for="empresa_rut">RUT de la Empresa:</label> 
    <!-- Campo de texto para ingresar el RUT de la empresa. El atributo "required" hace que el campo sea obligatorio -->
    <input type="text" id="empresa_rut" name="empresa_rut" placeholder="Ej: 12.345.678-9" required oninput="formatoRut(this)"> 
    
    <!-- Título: Número de Cotización -->
    <!-- Etiqueta para el campo de entrada del número de cotización -->
    <label for="numero_cotizacion">Número de Cotización:</label> 
    <!-- Campo de texto para ingresar el número de cotización. También es obligatorio -->
    <input type="number" id="numero_cotizacion" name="numero_cotizacion" min="1" required placeholder="30"> 
    
    <!-- Título: Validez de la Cotización -->
    <!-- Etiqueta para el campo de entrada de la validez de la cotización -->
    <label for="validez_cotizacion">Validez de la Cotización:</label> 
    <!-- Campo de número para ingresar la validez de la cotización en días. El atributo "required" asegura que no se deje vacío -->
    <input type="number" id="validez_cotizacion" name="validez_cotizacion" required min="1" placeholder="30"> 
</div>



<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Cuadro Rojo .PHP ----------------------------------------
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
