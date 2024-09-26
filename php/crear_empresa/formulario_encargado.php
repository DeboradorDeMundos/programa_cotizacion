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
    ------------------------------------- INICIO ITred Spa Formulario encargado .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
    <link rel="stylesheet" href="../../css/crear_encargado/formulario_encargado.css">
<div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
    <div class="box-12 data-box"> <!-- Crea una caja para ingresar datos, ocupando las 12 columnas disponibles en el diseño. Esta caja contiene varios campos de entrada de datos -->

        <label for="encargado_rut">RUT del Encargado:</label>
        <input type="text" id="encargado_rut" name="encargado_rut" required minlength="3" maxlength="20" 
            pattern="^[0-9]+[-kK0-9]{1}$" 
            title="Por favor, ingrese un RUT válido."
            placeholder="Ejemplo: 12345678-9"
            oninput="formatRut(this)">

        <label for="encargado_nombre">Nombre del Encargado:</label>
        <input type="text" id="encargado_nombre" name="encargado_nombre" required minlength="3" maxlength="255" 
            pattern="^[A-Za-zÀ-ÿ\s.-]+$" 
            title="Por favor, ingrese solo letras y espacios."
            placeholder="Ejemplo: Juan Pérez">

        <label for="encargado_email">Email del Encargado:</label>
        <input type="email" id="encargado_email" name="encargado_email" 
            placeholder="ejemplo@empresa.com" 
            maxlength="255" 
            required 
            title="Ingresa un correo electrónico válido, como ejemplo@empresa.com" 
            onblur="completeEmail(this)">

        <label for="encargado_fono">Teléfono del Encargado:</label>
        <input type="text" id="encargado_fono" name="encargado_fono" 
            placeholder="+56 9 1234 1234" 
            maxlength="11" 
            required 
            pattern="^\+\d{2}\s\d{1}\s\d{4}\s\d{4}$" 
            title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
            oninput="formatPhoneNumber(this)">

        <label for="encargado_celular">Celular del Encargado:</label>
        <input type="text" id="encargado_celular" name="encargado_celular" 
            placeholder="+56 9 1234 1234" 
            maxlength="11" 
            required 
            pattern="^\+\d{2}\s\d{1}\s\d{4}\s\d{4}$" 
            title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
            oninput="formatPhoneNumber(this)">

        <input type="hidden" name="id_empresa" value="<?php echo $id_empresa; ?>"> <!-- Agregar el ID de la empresa aquí -->
        
    </div> <!-- Cierra la caja de datos -->
</div> <!-- Cierra la fila -->
<script src="../../js/crear_encargado/formulario_encargado.js"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mensaje = ""; // Inicializa el mensaje

    if (isset($_POST['encargado_nombre'])) {
        // Obtener datos del formulario de encargado
        $rut_encargado = isset($_POST['encargado_rut']) ? trim($_POST['encargado_rut']) : null;
        $nombre_encargado = isset($_POST['encargado_nombre']) ? trim($_POST['encargado_nombre']) : null;
        $email_encargado = isset($_POST['encargado_email']) ? trim($_POST['encargado_email']) : null;
        $fono_encargado = isset($_POST['encargado_fono']) ? trim($_POST['encargado_fono']) : null;
        $celular_encargado = isset($_POST['encargado_celular']) ? trim($_POST['encargado_celular']) : null;

        // Inserta el encargado incluyendo el id de la empresa
        $sql_encargado = "INSERT INTO E_Encargados (rut_encargado, nombre_encargado, email_encargado, fono_encargado, celular_encargado, id_empresa)
                          VALUES ('$rut_encargado', '$nombre_encargado', '$email_encargado', '$fono_encargado', '$celular_encargado', $id_empresa)";
        
        if ($mysqli->query($sql_encargado) === TRUE) {
            $mensaje = "Encargado creado correctamente.";
        } else {
            $mensaje = "Error al insertar el encargado: " . $mysqli->error;
        }
    } else {
        $mensaje = "Error: No se envió el nombre del encargado.";
    }
}
?>
<!-- ----------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Formulario encargado  .PHP ----------------------------------------
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
