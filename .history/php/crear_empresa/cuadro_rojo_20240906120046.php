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
<!-- falta php de esto -->





<div class="box-6 data-box data-box-red"> <!-- Crea una caja para ingresar datos, ocupando otras 6 columnas. Se aplica una clase adicional para estilo -->
    <label for="empresa_rut">RUT de la Empresa:</label> <!-- Etiqueta para el campo de entrada del RUT de la empresa -->
    <input type="text" id="empresa_rut" name="empresa_rut" required oninput="formatRut(this)"> <!-- Campo de texto para ingresar el RUT de la empresa. El atributo "required" hace que el campo sea obligatorio -->
    <label for="numero_cotizacion">Número de Cotización:</label> <!-- Etiqueta para el campo de entrada del número de cotización -->
    <input type="text" id="numero_cotizacion" name="numero_cotizacion" required pattern="\d+" required placeholder="1234567890"> <!-- Campo de texto para ingresar el número de cotización. También es obligatorio -->
    
    <label for="validez_cotizacion">Validez de la Cotización:</label> <!-- Etiqueta para el campo de entrada de la validez de la cotización -->
    <input type="number" id="validez_cotizacion" name="validez_cotizacion" required min="1" required placeholder="30" > <!-- Campo de número para ingresar la validez de la cotización en días. El atributo "required" asegura que no se deje vacío -->
    
    <label for="fecha_creacion">Fecha de Creacion de empresa:</label> <!-- Etiqueta para el campo de entrada de la fecha de emisión -->
    <input type="date" id="fecha_creacion" name="fecha_creacion" required> <!-- Campo de fecha para seleccionar la fecha de emisión. Es obligatorio -->
</div>