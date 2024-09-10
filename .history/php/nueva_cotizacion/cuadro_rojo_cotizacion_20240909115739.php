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

<fieldset class="box-6 data-box data-box-red"> <!-- Crea una caja para ingresar datos, ocupando otras 6 columnas. Se aplica una clase adicional para estilo -->
    <legend>Detalle Cotización</legend>
    <label for="empresa_rut">RUT de la Empresa:</label> <!-- Etiqueta para el campo de entrada del RUT de la empresa -->
    <input type="text" id="empresa_rut" name="empresa_rut" 
        minlength="7" maxlength="12" 
        required oninput="formatRut(this)" 
        value="<?php echo htmlspecialchars($row['EmpresaRUT']); ?>"> <!-- Campo de texto para ingresar el RUT de la empresa. El atributo "required" hace que el campo sea obligatorio -->
    
    <label for="numero_cotizacion">Número de Cotización:</label> <!-- Etiqueta para el campo de entrada del número de cotización -->
    <input type="text" id="numero_cotizacion" name="numero_cotizacion" required pattern="\d+" value="<?php echo htmlspecialchars($numero_cotizacion); ?>"> <!-- Campo de correo electrónico para ingresar el email de la empresa. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        <!-- Campo de texto para ingresar el número de cotización. También es obligatorio -->
    
    <label for="dias_validez">dias Validez</label> <!-- Etiqueta para el campo de entrada de la validez de la cotización -->
    <input type="number" id="dias_validez" name="dias_validez" required min="1" required placeholder="30" value="<?php echo htmlspecialchars($dias_validez); ?>" readonly>
    
    <label for="fecha_validez">Fecha de Validez:</label>
    <input type="date" id="fecha_validez" name="fecha_validez" readonly> <!-- Campo de fecha de validez -->
    </div>
</fieldset>/

<script>
    // Supongamos que la fecha de emisión es la fecha actual
    let fechaEmision = new Date();
    
    // Obtenemos el valor del campo de días de validez
    let diasValidezInput = document.getElementById('dias_validez').value;
    let diasValidez = parseInt(diasValidezInput);
    
    // Calculamos la fecha de validez sumando los días de validez a la fecha de emisión
    fechaEmision.setDate(fechaEmision.getDate() + diasValidez);
    
    // Formateamos la fecha de validez al formato yyyy-mm-dd para que coincida con el campo de tipo "date"
    let anio = fechaEmision.getFullYear();
    let mes = ('0' + (fechaEmision.getMonth() + 1)).slice(-2); // Añadimos 1 porque los meses en JS van de 0 a 11
    let dia = ('0' + fechaEmision.getDate()).slice(-2);
    let fechaValidez = `${anio}-${mes}-${dia}`;
    
    // Asignamos la fecha calculada al campo de fecha de validez
    document.getElementById('fecha_validez').value = fechaValidez;
</script>


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
