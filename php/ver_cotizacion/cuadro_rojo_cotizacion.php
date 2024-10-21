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
    
    <link rel="stylesheet" href="../../css/ver_cotizacion/cuadro_rojo_cotizacion.css"> <!-- Enlaza el archivo CSS para estilizar el cuadro de cotización -->
    <body onload="calcularFechaValidez();"> <!-- Título: Ejecución de Función al Cargar Página -->
    <!-- Título: Sección de Datos de Cotización -->
    <fieldset class="box-6 cuadro-datos cuadro-datos-rojo"> 
        <legend>Detalle Cotización</legend> <!-- Título: Título del Campo de Datos -->

        <!-- Título: Etiqueta para el Campo RUT de la Empresa -->
        <label for="empresa_rut">RUT de la Empresa:</label> 
        <!-- Título: Campo de Entrada para el RUT de la Empresa -->
        <!-- Campo de texto para ingresar el RUT de la empresa. El atributo "required" hace que el campo sea obligatorio -->
        <input type="text" id="empresa_rut" name="empresa_rut" 
        minlength="7" maxlength="12" 
        title="El RUT debe contener entre 7 y 12 caracteres numéricos o 'K'." 
        required oninput="FormatearRut(this)" 
        value="<?php echo htmlspecialchars($items['EmpresaRUT']); ?>"> 
        
        <!-- Título: Etiqueta para el Campo Número de Cotización -->
        <label for="numero_cotizacion">Número de Cotización:</label> 
        <!-- Título: Campo de Entrada para el Número de Cotización -->
        <!-- Campo de texto para ingresar el número de cotización. También es obligatorio -->
        <input type="number" id="numero-cotizacion" name="numero_cotizacion" required min="1" placeholder="30" value="<?php echo htmlspecialchars($numero_cotizacion); ?>"> 
        
        <!-- Título: Etiqueta para el Campo Días de Validez -->
        <label for="dias_validez">Días de Validez:</label> 
        <!-- Título: Campo de Entrada para Días de Validez -->
        <!-- Campo para ingresar los días de validez de la cotización. Solo lectura -->
        <input type="number" id="dias_validez" name="dias_validez" required min="1" placeholder="30" value="<?php echo htmlspecialchars($dias_validez); ?>" readonly> 
        
        <!-- Título: Etiqueta para el Campo Fecha de Validez -->
        <label for="fecha_validez">Fecha de Validez:</label> 
        <!-- Título: Campo de Selección de Fecha de Validez -->
        <!-- Campo para seleccionar la fecha de validez de la cotización. Solo lectura -->
        <input type="date" id="fecha_validez" name="fecha_validez" readonly> 
    </fieldset>   
</body>

<!-- Enlaza el archivo JavaScript para manejar la lógica del formulario de cotización -->



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
