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
    ------------------------------------- INICIO ITred Spa Upload Logo.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
<?php
 // Definir la ruta de subida de archivos
 $upload_dir = '../../imagenes/programa_cotizacion/'; // Ruta relativa desde el archivo PHP

 // Inicializar la variable para el ID de la foto
 $empresa_id_foto = null;

 // Verificar si el archivo fue subido sin errores
 if (isset($_FILES['logo_upload']) && $_FILES['logo_upload']['error'] == UPLOAD_ERR_OK) {
     $tmp_name = $_FILES['logo_upload']['tmp_name'];
     $name = basename($_FILES['logo_upload']['name']);

     // Validar el tipo de archivo
     $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
     if (!in_array($_FILES['logo_upload']['type'], $allowed_types)) {
         die("Error: Tipo de archivo no permitido.");
     }

     $upload_file = $upload_dir . $name;

     // Mover el archivo cargado al direcrut_bancotorio de destino
     if (move_uploaded_file($tmp_name, $upload_file)) {
         echo "Imagen subida correctamente.";

         // Insertar la ruta de la foto en la tabla FotosPerfil
         $sql_foto = "INSERT INTO e_fotosPerfil (ruta_foto) VALUES (?)";
         $stmt_foto = $mysqli->prepare($sql_foto);
         $stmt_foto->bind_param("s", $upload_file);
         if ($stmt_foto->execute()) {
             echo "Foto del perfil insertada correctamente.";
             
             // Obtener el ID de la foto recién insertada
             $empresa_id_foto = $mysqli->insert_id;
         } else {
             die("Error al insertar la foto del perfil: " . $stmt_foto->error);
         }
         $stmt_foto->close();
     } else {
         die("Error al subir la imagen.");
     }
 } 
 
?>
<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->



<!-- falta php de esto -->


<h3>EJEMPLO: </h3>
<div class="box-6 logo-box"> <!-- Crea una caja para el logo o foto de perfil, ocupando 6 de las 12 columnas disponibles en el diseño -->
    <!-- Imagen del logo o foto de perfil -->
    <label for="logo-upload" class="logo-container"> <!-- Etiqueta para el campo de carga de imagen. El atributo "for" enlaza con el input de archivo -->
        <img src="http://localhost/programa_cotizacion/imagenes/crear_empresa/generic-logo.png" alt="tamaño recomendado: 100x100 pixeles" class="logo" id="logo-preview"> <!-- Muestra una imagen previa del logo con un texto alternativo en caso de que no se cargue la imagen -->
        <input type="file" id="logo-upload" name="logo_upload" accept="image/*" style="display:none;"> <!-- Campo oculto para cargar el archivo del logo. Acepta solo archivos de imagen -->
        <button for="logo-upload" class="logo" type="file" id ="logo-upload" name="logo_upload" accept="image/*" style="display:block;">Sube tu Logo Empresarial tamaño recomendado: 800x200 pixeles formato: png</button > <!-- Texto que aparece junto a la imagen para instruir al usuario a cargar el logo -->  
    </label>
</div>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Upload_Logo .PHP ----------------------------------------
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
