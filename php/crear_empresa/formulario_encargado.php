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
    ------------------------------------- INICIO ITred Spa Formulario encargado .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
    <link rel="stylesheet" href="../../css/crear_empresa/formulario_encargado.css">

<!-- Crea una fila para organizar los elementos en una disposición horizontal -->
<div class="row" id="formulario-contenedor"> 
    <!-- Crea una caja para ingresar datos, ocupando las 12 columnas disponibles en el diseño. Esta caja contiene varios campos de entrada de datos -->
    <fieldset class="box-12 data-box formulario-encargado"> 
    <legend>Datos encargado</legend>
        <!-- Formulario para ingresar datos del encargado -->
        <label for="encargado_rut">RUT del Encargado:</label>
        <input type="text" id="encargado_rut" name="encargado_rut[]" required minlength="3" maxlength="20" 
            pattern="^[0-9]+[-kK0-9]{1}$" 
            title="Por favor, ingrese un RUT válido."
            placeholder="Ejemplo: 12345678-9"
            oninput="formatoRut(this)"
            oninput="QuitarCaracteresInvalidos(this)">

        <label for="encargado_nombre">Nombre del Encargado:</label>
        <input type="text" id="encargado_nombre" name="encargado_nombre[]" required minlength="3" maxlength="255" 
            pattern="^[A-Za-zÀ-ÿ\s.-]+$" 
            title="Por favor, ingrese solo letras y espacios."
            placeholder="Ejemplo: Juan Pérez"
            oninput="QuitarCaracteresInvalidos(this)">

        <label for="cargo_encargado">Cargo:</label> 
        <select id="cargo_encargado" name="cargo_encargado[]" required> 
            <option value="" disabled selected>Selecciona un cargo</option> 
            <option value="gerente">Gerente</option>
            <option value="director">Director</option>
            <option value="ejecutivo">Ejecutivo</option>
            <option value="supervisor">Supervisor</option>
            <!-- Agrega las demás opciones -->
        </select>

        <label for="encargado_email">Email del Encargado:</label>
        <input type="email" id="encargado_email" name="encargado_email[]" 
            placeholder="ejemplo@empresa.com" 
            maxlength="255" 
            required 
            title="Ingresa un correo electrónico válido, como ejemplo@empresa.com" 
            onblur="CompletarEmail(this)">

        <label for="encargado_fono">Teléfono del Encargado:</label>
        <input type="text" id="encargado_fono" name="encargado_fono[]" 
            placeholder="+56 9 1234 1234" 
            maxlength="11" 
            required 
            title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
            oninput="asegurarMasYDetectarPais3(this)">

        <label for="encargado_celular">Celular del Encargado:</label>
        <input type="text" id="encargado_celular" name="encargado_celular[]" 
            placeholder="+56 9 1234 1234" 
            maxlength="11" 
            required 
            title="Formato válido: +56 9 1234 1234 (código de país, seguido de número)"
            oninput="asegurarMasYDetectarPais4(this)">

        <input type="hidden" name="id_empresa" value="<?php echo $id_empresa; ?>"> 
    </fieldset>
</div>

<!-- Botón para agregar otro encargado -->
<button type="button" onclick="agregarNuevoFormulario()">Agregar otro encargado</button>


<!-- Js correspondiente a formulario_encargado -->
<script src="../../js/crear_empresa/formulario_encargado.js"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $encargados_rut = $_POST['encargado_rut'];
    $encargados_nombre = $_POST['encargado_nombre'];
    $encargados_cargo = $_POST['cargo_encargado'];
    $encargados_email = $_POST['encargado_email'];
    $encargados_fono = $_POST['encargado_fono'];
    $encargados_celular = $_POST['encargado_celular'];

    // Recorre los datos y realiza la inserción en la base de datos
    for ($i = 0; $i < count($encargados_rut); $i++) {
        $rut_encargado = $encargados_rut[$i];
        $nombre_encargado = $encargados_nombre[$i];
        $cargo_encargado = $encargados_cargo[$i];
        $email_encargado = $encargados_email[$i];
        $fono_encargado = $encargados_fono[$i];
        $celular_encargado = $encargados_celular[$i];

        // Inserta cada encargado en la base de datos
        $sql_encargado = "INSERT INTO E_Encargados (rut_encargado, nombre_encargado, cargo_encargado, email_encargado, fono_encargado, celular_encargado, id_empresa)
                          VALUES ('$rut_encargado', '$nombre_encargado', '$cargo_encargado', '$email_encargado', '$fono_encargado', '$celular_encargado', $id_empresa)";
        $mysqli->query($sql_encargado);
    }

    echo "Encargados creados correctamente.";
}
?>
<!-- ----------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Formulario encargado  .PHP ----------------------------------------
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
