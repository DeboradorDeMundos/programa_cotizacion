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
    ------------------------------------- INICIO ITred Spa Upload Logo.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
    


<link rel="stylesheet" href="../../css/crear_empresa/upload_logo.css">

<h3>EJEMPLO: </h3>
<div class="box-6 caja-logo"> 
    <!-- TÍTULO: CREA UNA CAJA PARA EL LOGO O FOTO DE PERFIL, OCUPANDO 6 DE LAS 12 COLUMNAS DISPONIBLES EN EL DISEÑO -->
        <!-- Crea una caja para el logo o foto de perfil, ocupando 6 de las 12 columnas disponibles en el diseño -->
        <label for="subir-logo" class="contenedor-logo"> 
            <!-- TÍTULO: ETIQUETA PARA EL CAMPO DE CARGA DE IMAGEN. EL ATRIBUTO "FOR" ENLAZA CON EL INPUT DE ARCHIVO -->
                <!-- Etiqueta para el campo de carga de imagen. El atributo "for" enlaza con el input de archivo -->
                <img src="http://localhost/programa_cotizacion/imagenes/crear_empresa/generic-logo.png" alt="tamaño recomendado: 800x200 pixeles" class="logo" id="Previsualizar-logo"> 
            <!-- TÍTULO: MUESTRA UNA IMAGEN PREVIA DEL LOGO CON UN TEXTO ALTERNATIVO EN CASO DE QUE NO SE CARGUE LA IMAGEN -->
                <!-- Muestra una imagen previa del logo con un texto alternativo en caso de que no se cargue la imagen -->
                <input type="file" id="subir-logo" name="logo_upload" accept="image/*" required style="display:none;"> 
            <!-- TÍTULO: CAMPO OCULTO PARA CARGAR EL ARCHIVO DEL LOGO. ACEPTA SOLO ARCHIVOS DE IMAGEN -->
                <!-- Campo oculto para cargar el archivo del logo. Acepta solo archivos de imagen -->
                <button for="subir-logo" class="logo" type="file" id ="subir-logo" name="logo_upload" accept="image/*" style="display:block;">Sube tu Logo Empresarial tamaño recomendado: 800x200 pixeles formato: png</button>
            <!-- TÍTULO: TEXTO QUE APARECE JUNTO A LA IMAGEN PARA INSTRUIR AL USUARIO A CARGAR EL LOGO -->
                <!-- Texto que aparece junto a la imagen para instruir al usuario a cargar el logo -->  
        </label>
        <div id="mensaje-logo" class="message" style="color: red; display: none;">Ingresa tu logo para continuar</div> 
        <!-- TÍTULO: MENSAJE QUE INDICA QUE SE DEBE INGRESAR EL LOGO PARA CONTINUAR -->
            <!-- Mensaje que indica que se debe ingresar el logo para continuar -->
</div>

<script src="../../js/crear_empresa/upload_logo.js"></script>



<?php
// Verificar si el archivo fue subido sin errores
if (isset($_FILES['logo_upload']) && $_FILES['logo_upload']['error'] == UPLOAD_ERR_OK) {
    $upload_dir = '../../imagenes/crear_empresa/logo/';
    $tmp_name = $_FILES['logo_upload']['tmp_name'];
    $name = basename($_FILES['logo_upload']['name']);

    // Validar el tipo de archivo
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['logo_upload']['type'], $allowed_types)) {
        die("Error: Tipo de archivo no permitido.");
    }

    $upload_file = $upload_dir . $name;

    // Mover el archivo cargado al directorio de destino
    if (move_uploaded_file($tmp_name, $upload_file)) {
        echo "Imagen subida correctamente.";

        // Conectar a la base de datos
        $mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');
        if ($mysqli->connect_error) {
            die("Error de conexión: " . $mysqli->connect_error);
        }

        // Insertar la ruta de la foto en la tabla e_fotosPerfil
        $sql_foto = "INSERT INTO fp_fotosPerfil (ruta_foto) VALUES (?)";
        $stmt_foto = $mysqli->prepare($sql_foto);
        $stmt_foto->bind_param("s", $upload_file);
        if ($stmt_foto->execute()) {
            // Obtener el ID de la foto insertada
            $id_foto = $stmt_foto->insert_id;
            echo "Foto del perfil insertada correctamente. ID: " . $id_foto;

            // Aquí puedes guardar la ID en un campo oculto en el formulario de la empresa
            echo '<input type="hidden" name="id_foto" value="' . $id_foto . '">';
        } else {
            die("Error al insertar la foto del perfil: " . $stmt_foto->error);
        }
        $stmt_foto->close();
    } else {
        die("Error al subir la imagen.");
    }
}
?>



<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Upload_Logo .PHP ----------------------------------------
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
