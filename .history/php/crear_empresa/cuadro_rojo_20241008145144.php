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
    ------------------------------------- INICIO ITred Spa Cuadro Rojo.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- falta php de esto -->
<link rel="stylesheet" href="../../css/crear_empresa/cuadro_rojo.css">
<div class="box-6 data-box data-box-red"> <!-- Crea una caja para ingresar datos, ocupando otras 6 columnas. Se aplica una clase adicional para estilo -->
    <label for="empresa_rut">RUT de la Empresa:</label> <!-- Etiqueta para el campo de entrada del RUT de la empresa -->
    <input type="text" id="empresa_rut" name="empresa_rut" placeholder="Ej: 12.345.678-9" required oninput="formatoRut(this)"> <!-- Campo de texto para ingresar el RUT de la empresa. El atributo "required" hace que el campo sea obligatorio -->
    
    <label for="numero_cotizacion">Número de Cotización:</label> <!-- Etiqueta para el campo de entrada del número de cotización -->
    <input type="number" id="numero_cotizacion" name="numero_cotizacion" min="1" required placeholder="30"> <!-- Campo de texto para ingresar el número de cotización. También es obligatorio -->
    
    <label for="validez_cotizacion"> Validez de la Cotización</label> <!-- Etiqueta para el campo de entrada de la validez de la cotización -->
    <input type="number" id="validez_cotizacion" name="validez_cotizacion" required min="1" required placeholder="30" > <!-- Campo de número para ingresar la validez de la cotización en días. El atributo "required" asegura que no se deje vacío -->
   
</div>


<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Cuadro Rojo .PHP ----------------------------------------
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
