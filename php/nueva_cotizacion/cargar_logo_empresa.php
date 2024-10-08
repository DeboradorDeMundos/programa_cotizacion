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
    ------------------------------------- INICIO ITred Spa Cargar Logo.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->


     

<link rel="stylesheet" href="../../css/nueva_cotizacion/cargar_logo_empresa.css">
<div class="box-6 logo-box">
<?php
// Procesar la subida de la imagen cuando se envía el formulario
$upload_dir = '../../imagenes/cotizacion/'; // Ruta relativa desde el archivo PHP
$empresa_id_foto = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['logo_upload']) && $_FILES['logo_upload']['error'] == UPLOAD_ERR_OK) {
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

            // Insertar la ruta de la foto en la tabla FotosPerfil
            $sql_foto = "INSERT INTO C_FotosPerfil (ruta_foto) VALUES (?)";
            $stmt_foto = $mysqli->prepare($sql_foto);
            $stmt_foto->bind_param("s", $upload_file);
            if ($stmt_foto->execute()) {
                echo "Foto del perfil insertada correctamente.";
                $empresa_id_foto = $mysqli->insert_id;
            } else {
                die("Error al insertar la foto del perfil: " . $stmt_foto->error);
            }
            $stmt_foto->close();
        } else {
            die(".");
        }
    } else {
        echo ".";
    }
}
?>
    <label for="logo-upload" class="logo-contenedor">
        <?php if (isset($row['ruta_foto']) && !empty($row['ruta_foto'])): ?>
            <img src="<?php echo htmlspecialchars($row['ruta_foto'], ENT_QUOTES, 'UTF-8'); ?>" alt="Foto de perfil" id="logo-preview" class="logo" onclick="document.getElementById('logo-upload').click();" />
        <?php else: ?>
            <span id="logo-text" onclick="document.getElementById('logo-upload').click();">Cargar Logo de Empresa</span>
        <?php endif; ?>
        <input type="file" id="logo-upload" name="logo_upload" accept="image/*" style="display:none;" onchange="previewImage(event)">
    </label>
</div>




     
     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Cargar Logo .PHP ----------------------------------------
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
