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
    ------------------------------------- INICIO ITred Spa Detalle proyecto.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->
     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd');


     $mysqli->close();
?>
<!-- ---------------------
     -- FIN CIERRE CONEXION BD --
     --------------------- -->


<fieldset class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
    <legend>Detalle proyecto</legend>
    <div class="form-group-inline">
        <div class="form-group">
            <label for="proyecto_nombre">Nombre</label> <!-- Etiqueta para el campo de entrada del nombre del proyecto -->
            <input type="text" id="proyecto_nombre" name="proyecto_nombre" placeholder="proyecto" required> <!-- Campo de texto para ingresar el nombre del proyecto. El atributo "required" hace que el campo sea obligatorio -->
        </div>
        <div class="form-group">
            <label for="proyecto_codigo">Código</label> <!-- Etiqueta para el campo de entrada del código del proyecto -->
            <input type="text" id="proyecto_codigo" name="proyecto_codigo" placeholder="1234" required> <!-- Campo de texto para ingresar el código del proyecto. También es obligatorio -->
        </div>
    </div>
    <div class="form-group-inline">
        <div class="form-group">
            <label for="area_trabajo">Área de Trabajo:</label> <!-- Etiqueta para el campo de entrada del área de trabajo -->
            <input type="text" id="area_trabajo" name="area_trabajo" placeholder="tecnologia" required> <!-- Campo de texto para ingresar el área de trabajo. Este campo es obligatorio -->
        </div>
        <div class="form-group">
            <label for="tipo_trabajo">Tipo de Trabajo:</label> <!-- Etiqueta para el campo de entrada del tipo de trabajo -->
            <input type="text" id="tipo_trabajo" name="tipo_trabajo" placeholder="instalacion" required> <!-- Campo de texto para ingresar el tipo de trabajo. También es obligatorio -->
        </div>
    </div>

    <div class="form-group">
        <label for="riesgo">Riesgo:</label> <!-- Etiqueta para el campo de entrada del riesgo asociado al proyecto -->
        <input type="text" id="riesgo" name="riesgo" placeholder="nivel de riesgo" required> <!-- Campo de texto para ingresar el nivel o tipo de riesgo. Este campo es obligatorio -->
    </div>
</fieldset>




     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Detalle proyecto.PHP ----------------------------------------
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
