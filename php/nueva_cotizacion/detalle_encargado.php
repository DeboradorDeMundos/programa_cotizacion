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
    ------------------------------------- INICIO ITred Spa Detalle encargado.PHP --------------------------------------
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

<fieldset class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
    <legend>Detalle encargado</legend>
    <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
        <div class="form-group-inline">
            <div class="form-group">
                <label for="encargado_rut">RUT: </label> <!-- Etiqueta para el campo de entrada del RUT del cliente -->
                <input type="text" id="encargado-rut" name="encargado_rut" 
                    minlength="7" maxlength="12" 
                    placeholder="x.xxx.xxx-x"
                    required oninput="formatRut(this)"> <!-- Campo de texto para ingresar el RUT del cliente. También es obligatorio -->
            </div>
            <div class="form-group">
                <label for="enc_nombre">Nombre:</label> <!-- Etiqueta para el campo de entrada del nombre del encargado -->
                <input type="text" id="enc_nombre" name="enc_nombre"> <!-- Campo de texto para ingresar el nombre del encargado. Este campo no es obligatorio -->
            </div>
        </div>
    
       
        <div class="form-group">
            <label for="enc_email">Email:</label> <!-- Etiqueta para el campo de entrada del email del encargado -->
            <input type="email" id="enc_email" name="enc_email"> <!-- Campo de correo electrónico para ingresar el email del encargado. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        </div>
        <div class="form-group">
        <label for="enc_fono">Teléfono:</label> <!-- Etiqueta para el campo de entrada del teléfono del encargado -->
        <input type="text" id="enc_fono" name="enc_fono" pattern="\+?\d{7,15}" placeholder="+1234567890"> <!-- Campo de texto para ingresar el teléfono del encargado. Este campo no es obligatorio -->
        </div>
    </div>
    <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
        <div class="form-group">
            <label for="enc_celular">Celular:</label> <!-- Etiqueta para el campo de entrada del celular del encargado -->
            <input type="text" id="enc_celular" name="enc_celular" pattern="\+?\d{7,15}" placeholder="+1234567890"> <!-- Campo de texto para ingresar el número de celular del encargado. Este campo no es obligatorio -->
        </div>
        <div class="form-group">
            <label for="enc_proyecto">Proyecto Asignado:</label> <!-- Etiqueta para el campo de entrada del proyecto asignado al encargado -->
            <input type="text" id="enc_proyecto" name="enc_proyecto"> <!-- Campo de texto para ingresar el nombre del proyecto asignado al encargado. No es obligatorio -->
        </div>
    </div>
</fieldset> <!-- Cierra la fila -->

     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Detalle encargado.PHP ----------------------------------------
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
