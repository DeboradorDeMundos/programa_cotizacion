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
    ------------------------------------- INICIO ITred Spa Cuadro rojo cotizacion.PHP --------------------------------------
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

<fieldset class="box-6 data-box data-box-red">
    <legend>Detalle Cotización</legend>
    
    <label for="empresa_rut">RUT de la Empresa:</label>
    <input type="text" id="empresa_rut" name="empresa_rut" 
        minlength="7" maxlength="12" 
        required oninput="formatRut(this)" 
        value="<?php echo htmlspecialchars($row['EmpresaRUT']); ?>">

    <label for="numero_cotizacion">Número de Cotización:</label>
    <input type="text" id="numero_cotizacion" name="numero_cotizacion" required pattern="\d+" value="<?php echo htmlspecialchars($numero_cotizacion); ?>">

    <label for="dias_validez">días Validez</label>
    <input type="number" id="dias_validez" name="dias_validez" required min="1" placeholder="30" value="<?php echo htmlspecialchars($dias_validez); ?>" readonly onchange="calcularFechaValidez()">
    
    <label for="fecha_validez">Fecha de Validez:</label>
    <input type="date" id="fecha_validez" name="fecha_validez" readonly>
</fieldset>

<!-- Incluir el archivo JavaScript -->
<script src="../../js/nueva_cotizacion/nueva_cotizacion.js"></script>


     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Cuadro rojo cotizacion.PHP ----------------------------------------
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
