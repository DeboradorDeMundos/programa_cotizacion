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
    ------------------------------------- INICIO ITred Spa Detalle vendedor.PHP --------------------------------------
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
    <legend>Detalle vendedor</legend>
    <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
        <div class="form-group-inline">
            <div class="form-group">
                <label for="vendedor_rut">RUT: </label> <!-- Etiqueta para el campo de entrada del RUT del cliente -->
                <input type="text" id="vendedor-rut" name="vendedor_rut" 
                    minlength="7" maxlength="12" 
                    placeholder="x.xxx.xxx-x"
                    required oninput="formatRut(this)"> <!-- Campo de texto para ingresar el RUT del cliente. También es obligatorio -->
            </div>
            <div class="form-group">
                <label for="vendedor_nombre">Nombre:</label><!-- Etiqueta para el campo de entrada del nombre del vendedor -->
                <input type="text" id="vendedor_nombre" name="vendedor_nombre" required><!-- Campo de texto para ingresar el nombre del vendedor. El atributo "required" hace que el campo sea obligatorio -->
            </div>
        </div>
        
        <div class="form-group">
            <label for="vendedor_email">Email:</label> <!-- Etiqueta para el campo de entrada del email del vendedor -->
            <input type="email" id="vendedor_email" name="vendedor_email" required> <!-- Campo de correo electrónico para ingresar el email del vendedor. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico. También es obligatorio -->
        </div>
    </div>
    <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
        <div class="form-group">
            <label for="vendedor_telefono">Teléfono:</label> <!-- Etiqueta para el campo de entrada del teléfono del vendedor -->
            <input type="text" id="vendedor_telefono" name="vendedor_telefono"> <!-- Campo de texto para ingresar el teléfono del vendedor. Este campo no es obligatorio -->
        </div>
        <div class="form-group">
        <label for="vendedor_celular">Celular:</label> <!-- Etiqueta para el campo de entrada del celular del vendedor -->
        <input type="text" id="vendedor_celular" name="vendedor_celular"> <!-- Campo de texto para ingresar el número de celular del vendedor. Este campo no es obligatorio -->
        </div>
    </div>
</fieldset> <!-- Cierra la fila -->

     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Detalle vendedor.PHP ----------------------------------------
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
