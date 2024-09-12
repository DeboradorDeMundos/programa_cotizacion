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

     
     <body onload="calcularFechaValidez();">
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
  
</fieldset>   
</body>

<script src="../../js/nueva_cotizacion/cuadro_rojo_cotizacion.js"></script> <!-- Enlaza nuevamente el archivo JavaScript para manejar la lógica del formulario de cotización -->
 

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario cotización
    $numero_cotizacion = isset($_POST['numero_cotizacion']) ? trim($_POST['numero_cotizacion']) : null;
    $fecha_validez = isset($_POST['fecha_validez']) ? trim($_POST['fecha_validez']) : null;
    $fecha_emision = isset($_POST['fecha_emision']) ? trim($_POST['fecha_emision']) : null;
    $id_cliente = isset($_POST['id_cliente']) ? intval($_POST['id_cliente']) : null;
    $id_proyecto = isset($_POST['id_proyecto']) ? intval($_POST['id_proyecto']) : null;
    $id_empresa = isset($_POST['id_empresa']) ? intval($_POST['id_empresa']) : null;
    $id_vendedor = isset($_POST['id_vendedor']) ? intval($_POST['id_vendedor']) : null;
    $id_encargado = isset($_POST['id_encargado']) ? intval($_POST['id_encargado']) : null;

    // Validar datos obligatorios
    if (is_null($numero_cotizacion) || is_null($fecha_emision) || is_null($fecha_validez) || is_null($id_cliente) || is_null($id_proyecto) || is_null($id_empresa) || is_null($id_vendedor) || is_null($id_encargado)) {
        die("Faltan datos obligatorios para la cotización.");
    }

    // Insertar en la tabla Cotizaciones
    $sql_cotizaciones = "INSERT INTO C_Cotizaciones (
        numero_cotizacion, fecha_emision, fecha_validez,
        id_cliente, id_proyecto, id_empresa, id_vendedor, id_encargado
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql_cotizaciones);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $mysqli->error);
    }

    // Asignar los parámetros correctamente
    $stmt->bind_param(
        "sssiiiii",
        $numero_cotizacion, $fecha_emision, $fecha_validez, 
        $id_cliente, $id_proyecto, $id_empresa, $id_vendedor, $id_encargado
    );

    // Ejecutar la consulta y manejar posibles errores
    if ($stmt->execute()) {
        $id_cotizacion = $stmt->insert_id;
        echo "Cotización insertada correctamente. ID: $id_cotizacion<br>";
    } else {
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }

    $stmt->close();
}
?>


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
