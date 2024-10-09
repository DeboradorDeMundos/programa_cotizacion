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
    <div class="contenedor-firma">
        <h1>Selecciona una opción de firma</h1>
        <h3>¡Crea una firma automática, manual o sube tu propia firma digital!</h3>

        <!-- Opción de Firma Automática -->
        <div class="option">
            <input type="radio" id="auto-signature" name="opcion-firma" value="automatic">
            <label for="auto-signature">Firma Automática</label>
            <div id="auto-desplegar-firma" class="desplegar-firma" style="display: none;"></div>
        </div>

        <!-- Opción de Firma Manual -->
        <div class="option">
        <input type="radio" id="manual-signature" name="opcion-firma" value="manual">
        <label for="manual-signature">Firma Manual</label>
        <div id="firma-manual" class="desplegar-firma" style="display: none;">
            <div class="signature-row">
                <input type="text" name="titulo_firma" placeholder="titulo de la firma" oninput="QuitarCaracteresInvalidos(this)">
                <input type="text" name="nombre_encargado_firma" placeholder="Nombre del Encargado" oninput="QuitarCaracteresInvalidos(this)">
                <input type="text" name="cargo_encargado_firma" placeholder="Cargo del Encargado" oninput="QuitarCaracteresInvalidos(this)">
                <input type="text" name="telefono_encargado_firma" placeholder="Teléfono del Encargado" oninput="QuitarCaracteresInvalidos(this)">
                <input type="text" name="nombre_empresa_firma" placeholder="Nombre de la Empresa" oninput="QuitarCaracteresInvalidos(this)">
                <input type="text" name="area_empresa_firma" placeholder="Área de la Empresa" oninput="QuitarCaracteresInvalidos(this)">
                <input type="text" name="telefono_empresa_firma" placeholder="Teléfono de la Empresa" oninput="QuitarCaracteresInvalidos(this)">
                <input type="email" name="email_firma" placeholder="Email" onblur="CompletarEmail(this)">
                <input type="text" name="direccion_firma" placeholder="Dirección" oninput="QuitarCaracteresInvalidos(this)">
                <input type="text" name="rut_firma" placeholder="RUT" minlength="3" maxlength="20"           
                    pattern="^[0-9]+[-kK0-9]{1}$" 
                    title="Por favor, ingrese un RUT válido."
                    placeholder="Ejemplo: 12345678-9"
                    oninput="formatoRut(this)"
                    oninput="QuitarCaracteresInvalidos(this)">
                </div>
            </div>
        </div>

                <!-- Opción de Firma Digital (Subida de Imagen) -->
        <div class="option">
            <input type="radio" id="image-signature" name="opcion-firma" value="image">
            <label for="image-signature">Firma Imagen</label>
            <input type="file" id="firma-imagen" name="firma-imagen" accept="image/png">
            <!-- Previsualización de la imagen de la firma -->
            <img id="previsualizacion-firma" src="" alt="Previsualización de firma" style="display: none;">
        </div>

        <div class="option">
            <input type="radio" id="digital-signature" name="opcion-firma" value="digital">
            <label for="digital-signature">Firma Digital</label>
            <div id="Mensaje-Firma-Digital" class="desplegar-firma" style="display: none;">
                <p>Su firma se generará en su cotización.</p>
            </div>
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
    $firma_opcion = $_POST['opcion-firma'];

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
             // Firma digital (subida de imagen)
             if (isset($_FILES['firma-imagen']) && $_FILES['firma-imagen']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "../../imagenes/crear_empresa/firma/";
                $target_file = $target_dir . basename($_FILES["firma-imagen"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
                // Comprobar si es una imagen válida
                $check = getimagesize($_FILES["firma-imagen"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "El archivo no es una imagen.";
                    $uploadOk = 0;
                }
    
                // Limitar los formatos de imagen
                if ($imageFileType != "png") {
                    echo "Solo se permiten archivos PNG.";
                    $uploadOk = 0;
                }
    
                // Subir el archivo si todo está bien
                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["firma-imagen"]["tmp_name"], $target_file)) {
                        $firma_ruta = $target_file;
    
                        // Aquí todos los demás campos se insertan como NULL, excepto id_firma e id_empresa
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
                            rut_firma) VALUES (?, 'null', NULL, NULL, NULL, NULL, NULL, NULL, ?, NULL, NULL, NULL)");
                        
                        if ($stmt === false) {
                            die("Error en la preparación de la consulta: " . $mysqli->error);
                        }
    
                        // Insertar con los campos `id_empresa` y `firma_ruta`
                        $stmt->bind_param("is", $id_empresa, $firma_ruta);
                        $stmt->execute();
    
                        echo "Firma digital guardada con éxito.";
                    } else {
                        echo "Hubo un error al subir la imagen.";
                    }
                }
            } else {
                echo "No se ha seleccionado ninguna imagen.";
            }
        }
      
    }
?>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Firma  .PHP ----------------------------------------
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