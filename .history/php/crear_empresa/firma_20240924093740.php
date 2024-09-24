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
    ------------------------------------- INICIO ITred Spa Firma .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/crear_empresa/firma.css">
    <title>Firma</title>
</head>
<body>
    <div class="signature-container">
        <h1>Selecciona una opción de firma</h1>
        <h3>¡Crea una firma automática, manual o sube tu propia firma digital!</h3>

        <!-- Opción de Firma Automática -->
        <div class="option">
            <input type="radio" id="auto-signature" name="signature-option" value="automatic">
            <label for="auto-signature">Firma Automática</label>
            <div id="auto-signature-display" class="signature-display" style="display: none;"></div>
        </div>

        <!-- Opción de Firma Manual -->
        <div class="option">
    <input type="radio" id="manual-signature" name="signature-option" value="manual">
    <label for="manual-signature">Firma Manual</label>
    <div id="manual-signatures" class="signature-display" style="display: none;">
        <div class="signature-row">
            <input type="text" name="titulo_firma" placeholder="titulo de la firma">
            <input type="text" name="nombre_encargado_firma" placeholder="Nombre del Encargado">
            <input type="text" name="cargo_encargado_firma" placeholder="Cargo del Encargado">
            <input type="text" name="telefono_encargado_firma" placeholder="Teléfono del Encargado">
            <input type="text" name="nombre_empresa_firma" placeholder="Nombre de la Empresa">
            <input type="text" name="area_empresa_firma" placeholder="Área de la Empresa">
            <input type="text" name="telefono_empresa_firma" placeholder="Teléfono de la Empresa">
            <input type="email" name="email_firma" placeholder="Email">
            <input type="text" name="direccion_firma" placeholder="Dirección">
            <input type="text" name="rut_firma" placeholder="RUT">
            </div>
    </div>
    </div>

        <!-- Opción de Firma Digital (Subida de Imagen) -->
        <div class="option">
            <input type="radio" id="image-signature" name="signature-option" value="image">
            <label for="image-signature">Firma Digital</label>
            <input type="file" id="signature-image" name="signature-image" accept="image/png" style="display: none;">
            <!-- Previsualización de la imagen de la firma -->
            <img id="signature-preview" src="" alt="Previsualización de firma" style="display: none;">
        </div>

    </div>

    <script src="../../js/crear_empresa/firma.js"></script>
</body>
</html>



<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesar campos de la empresa
    $empresa_nombre = $_POST['empresa_nombre'];
    $empresa_area = $_POST['empresa_area'];
    $empresa_telefono = $_POST['empresa_telefono'];
    $empresa_email = $_POST['empresa_email'];
    $empresa_direccion = $_POST['empresa_direccion'];
    $empresa_rut = $_POST['empresa_rut'];

    // Subir archivo de firma digital (si existe)
    if (isset($_FILES['firma_digital']) && $_FILES['firma_digital']['error'] === UPLOAD_ERR_OK) {
        $firma_digital = file_get_contents($_FILES['firma_digital']['tmp_name']);
    } else {
        $firma_digital = null;
    }

    // Verificar qué opción de firma se seleccionó
    $firma_opcion = $_POST['signature-option'];

    if ($firma_opcion === 'automatic') {
        // Insertar firma automática con datos predefinidos
        $titulo_firma = "SIN OTRO PARTICULAR, Y ESPERANDO QUE LA PRESENTE OFERTA SEA DE SU INTERÉS, SE DESPIDE ATENTAMENTE:";
        $nombre_encargado = ""; // Dejar vacío si no hay encargado
        $cargo_encargado = "";  // Dejar vacío si no hay cargo
        $telefono_encargado_firma = "999999999";
        $firma_digital = "";
        $stmt = $mysqli->prepare("INSERT INTO E_Firmas (
          id_empresa,
          titulo_firma,
          nombre_encargado_firma,
          cargo_encargado_firma, 
          telefono_encargado_firma, 
          nombre_empresa_firma, 
          area_empresa_firma, 
          telefono_empresa_firma, 
          firma_digital, 
          email_firma, 
          direccion_firma, 
          rut_firma) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $mysqli->error);
        }

        $stmt->bind_param("isssssssssss", 
        $id_empresa, 
        $titulo_firma, 
        $nombre_encargado, 
        $cargo_encargado, 
        $telefono_encargado_firma, 
        $empresa_nombre, 
        $empresa_area, 
        $empresa_telefono, 
        $firma_digital, 
        $empresa_email, 
        $empresa_direccion, 
        $empresa_rut);
        $stmt->execute();
        
    } elseif ($firma_opcion === 'manual') {
        // Insertar firma manual con datos del formulario
        $titulo_firma = $_POST['titulo_firma'];
        $nombre_encargado = $_POST['nombre_encargado_firma'];
        $cargo_encargado = $_POST['cargo_encargado_firma'];
        $telefono_encargado_firma = $_POST['telefono_encargado_firma'];
        $nombre_empresa = $_POST['nombre_empresa_firma'];
        $area_empresa = $_POST['area_empresa_firma'];
        $telefono_empresa = $_POST['telefono_empresa_firma'];
        $email_firma = $_POST['email_firma'];
        $direccion_firma = $_POST['direccion_firma'];
        $rut_firma = $_POST['rut_firma'];
        $firma_digital = "";

        $stmt = $mysqli->prepare("INSERT INTO E_Firmas (
        id_empresa,
        titulo_firma, 
        nombre_encargado_firma,
        cargo_encargado_firma, 
        telefono_encargado_firma, 
        nombre_empresa_firma, 
        area_empresa_firma, 
        telefono_empresa_firma, 
        firma_digital, 
        email_firma,
        direccion_firma, 
        rut_firma) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $mysqli->error);
        }

        $stmt->bind_param("isssssssssss", 
        $id_empresa,
        $titulo_firma,
        $nombre_encargado,
        $cargo_encargado,
        $telefono_encargado_firma,
        $nombre_empresa,
        $area_empresa, 
        $telefono_empresa, 
        $firma_digital,
        $email_firma,
        $direccion_firma, 
        $rut_firma);
        $stmt->execute();

    } elseif ($firma_opcion === 'image') {
        // Solo subir firma digital
        $stmt = $mysqli->prepare("INSERT INTO E_Firmas (id_empresa, titulo_firma, nombre_encargado_firma, cargo_encargado_firma, telefono_encargado_firma, nombre_empresa_firma, area_empresa_firma, telefono_empresa_firma, firma_digital, email_firma, direccion_firma, rut_firma) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $mysqli->error);
        }

        $titulo_firma = ""; // O puedes establecerlo a un valor predeterminado
        $nombre_encargado = ""; 
        $cargo_encargado = "";  
        $telefono_encargado_firma = "";

        $stmt->bind_param("isssssssssss", $id_empresa, $titulo_firma, $nombre_encargado, $cargo_encargado, $telefono_encargado_firma, $empresa_nombre, $empresa_area, $empresa_telefono, $firma_digital, $empresa_email, $empresa_direccion, $empresa_rut);
        $stmt->execute();
    }

    $stmt->close();
    

    echo "Firma guardada con éxito.";
}
?>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Firma  .PHP ----------------------------------------
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
