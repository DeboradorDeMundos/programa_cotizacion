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
    ------------------------------------- INICIO ITred Spa Cuadro rojo cotizacion.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
    <body onload="calcularFechaValidez();"> <!-- Ejecuta la función calcularFechaValidez al cargar la página -->
    <link rel="stylesheet" href="../../css/nueva_cotizacion/cuadro_rojo_cotizacion.css"> <!-- Enlaza el archivo CSS para estilizar el cuadro de cotización -->

    <!-- Crea una caja para ingresar datos, ocupando otras 6 columnas. Se aplica una clase adicional para estilo -->
    <fieldset class="box-6 cuadro-datos cuadro-datos-rojo"> 
        <legend>Detalle Cotización</legend> <!-- Título del campo de datos -->

        <!-- Etiqueta para el campo de entrada del RUT de la empresa -->
        <label for="empresa_rut">RUT de la Empresa:</label> 
        <!-- Campo de texto para ingresar el RUT de la empresa. El atributo "required" hace que el campo sea obligatorio -->
        <input type="text" id="empresa_rut" name="empresa_rut" 
            minlength="7" maxlength="12" 
            required oninput="FormatearRut(this)" 
            value="<?php echo htmlspecialchars($row['EmpresaRUT']); ?>"> 
        
        <!-- Etiqueta para el campo de entrada del número de cotización -->
        <label for="numero_cotizacion">Número de Cotización:</label> 
        <!-- Campo de texto para ingresar el número de cotización. También es obligatorio -->
        <input type="number" id="numero-cotizacion" name="numero_cotizacion" required min="1" placeholder="30" value="<?php echo htmlspecialchars($numero_cotizacion); ?>"> 
        
        <!-- Etiqueta para el campo de entrada de la validez de la cotización -->
        <label for="dias_validez">Días de Validez:</label> 
        <!-- Campo para ingresar los días de validez de la cotización. Solo lectura -->
        <input type="number" id="dias_validez" name="dias_validez" required min="1" placeholder="30" value="<?php echo htmlspecialchars($dias_validez); ?>" readonly> 
        
        <!-- Etiqueta para el campo de entrada de la fecha de validez -->
        <label for="fecha_validez">Fecha de Validez:</label> 
        <!-- Campo para seleccionar la fecha de validez de la cotización. Solo lectura -->
        <input type="date" id="fecha_validez" name="fecha_validez" readonly> 
    </fieldset>   
</body>

<!-- Enlaza el archivo JavaScript para manejar la lógica del formulario de cotización -->
<script src="../../js/nueva_cotizacion/cuadro_rojo_cotizacion.js"></script> 


<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Cuadro rojo cotizacion.PHP ----------------------------------------
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
