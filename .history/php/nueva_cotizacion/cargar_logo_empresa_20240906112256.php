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
    ------------------------------------- INICIO ITred Spa Cargar Logo.PHP --------------------------------------
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
            $stmt_foto = $conn->prepare($sql_foto);
            $stmt_foto->bind_param("s", $upload_file);
            if ($stmt_foto->execute()) {
                echo "Foto del perfil insertada correctamente.";
                $empresa_id_foto = $conn->insert_id;
            } else {
                die("Error al insertar la foto del perfil: " . $stmt_foto->error);
            }
            $stmt_foto->close();
        } else {
            die("Error al subir la imagen.");
        }
    } else {
        echo "No se subió una imagen.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Logo de Empresa</title>
    <link rel="stylesheet" href="../../css/nueva_cotizacion/cargar_logo_empresa.css"> <!-- Llamada al archivo CSS externo -->
</head>
<body>

<div class="box-6 logo-box">
    <form action="" method="post" enctype="multipart/form-data">
        <label for="logo-upload" class="logo-container">
            <?php if (isset($row['ruta_foto']) && !empty($row['ruta_foto'])): ?>
                <img src="<?php echo htmlspecialchars($row['ruta_foto'], ENT_QUOTES, 'UTF-8'); ?>" alt="Foto de perfil" id="logo-preview" class="logo" onclick="document.getElementById('logo-upload').click();" />
            <?php else: ?>
                <span id="logo-text" onclick="document.getElementById('logo-upload').click();">Cargar Logo de Empresa</span>
            <?php endif; ?>
            <input type="file" id="logo-upload" name="logo_upload" accept="image/*" style="display:none;" onchange="previewImage(event)">
        </label>
        <button type="submit">Subir Logo</button>
    </form>
</div>

<script src="../../js/nueva_cotizacion/cargar_logo_empresa.js"></script> <!-- Llamada al archivo JS externo -->
</body>
</html>
     
     
     
     
     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Cargar Logo .PHP ----------------------------------------
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
