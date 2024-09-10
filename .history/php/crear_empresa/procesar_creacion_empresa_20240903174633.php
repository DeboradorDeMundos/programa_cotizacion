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
        ------------------------------------- INICIO ITred Spa Procesar Creacion Empresa .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

    <?php
    // Habilitar el reporte de errores
    error_reporting(E_ALL);
    ini_set('display_errors', 1);


    // Crear la conexión
    $conn = new mysqli('localhost','root','','itredspa_bd');

    // Recibir datos del formulario
    $empresa_rut = $_POST['empresa_rut'];
    $empresa_nombre = $_POST['empresa_nombre'];
    $empresa_area = $_POST['empresa_area'];
    $empresa_direccion = $_POST['empresa_direccion'];
    $empresa_telefono = $_POST['empresa_telefono'];
    $empresa_email = $_POST['empresa_email'];
    $nombre_titular = $_POST['nombre_titular'];
    $id_banco = $_POST['id_banco'];
    $id_tipocuenta = $_POST['id_tipocuenta'];
    $numero_cuenta = $_POST['numero_cuenta'];
    $celular = $_POST['celular'];
    $rut_titular = $_POST['rut_titular'];
    $email_banco = $_POST['email_banco'];
    $fecha_creacion = $_POST['fecha_creacion'];

    // Recibir datos adicionales del formulario para la cotización
    $numero_cotizacion = $_POST['numero_cotizacion'];
    $validez_cotizacion = $_POST['validez_cotizacion'];


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
            $stmt_foto = $conn->prepare($sql_foto);
            $stmt_foto->bind_param("s", $upload_file);
            if ($stmt_foto->execute()) {
                echo "Foto del perfil insertada correctamente.";
                
                // Obtener el ID de la foto recién insertada
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


    // Insertar o actualizar la empresa
    $sql = "INSERT INTO e_empresa (rut_empresa, id_foto, nombre_empresa, area_empresa, direccion_empresa, telefono_empresa, email_empresa, fecha_creacion)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE nombre_empresa=VALUES(nombre_empresa), area_empresa=VALUES(area_empresa), direccion_empresa=VALUES(direccion_empresa), telefono_empresa=VALUES(telefono_empresa), email_empresa=VALUES(email_empresa), fecha_creacion=VALUES(fecha_creacion)";
    $stmt = $conn->prepare($sql);
        if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }   
    $stmt->bind_param("sissssss", $empresa_rut, $empresa_id_foto, $empresa_nombre, $empresa_area, $empresa_direccion, $empresa_telefono, $empresa_email, $fecha_creacion);

    $stmt->execute();
    if ($stmt->error) {
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }

    // Obtener el ID de la empresa después de la inserción/actualización
    $id_empresa = $conn->insert_id;
    echo "Empresa insertada/actualizada. ID: $id_empresa<br>";

    // Insertar datos en la tabla Cuenta_Bancaria
    $sql = "INSERT INTO e_cuenta_Bancaria (nombre_titular, rut_titular, id_banco, id_tipocuenta, numero_cuenta, celular,  email_banco, id_empresa)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("siissssi", $nombre_titular, $rut_titular, $id_banco, $id_tipocuenta, $numero_cuenta, $celular,  $email_banco, $id_empresa);
    $stmt->execute();
    if ($stmt->error) {
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }

    $id_cuenta = $conn->insert_id;
    echo "Cuenta bancaria insertada. ID: $id_cuenta<br>";

    // Obtener el último número de cotización para la empresa específica
    $sql_last_cot = "SELECT numero_cotizacion FROM c_cotizaciones WHERE id_empresa = ? ORDER BY id_cotizacion DESC LIMIT 1";
    $stmt_last_cot = $conn->prepare($sql_last_cot);
    $stmt_last_cot->bind_param("i", $id_empresa);
    $stmt_last_cot->execute();
    $stmt_last_cot->bind_result($last_num_cotizacion);
    $stmt_last_cot->fetch();
    $stmt_last_cot->close();

    if ($last_num_cotizacion) {
        $numero_cotizacion = (int)$last_num_cotizacion + 1; // Incrementa para mantener el correlativo dentro de la empresa
    } else {
        $numero_cotizacion = $numero_cotizacion; // Si no hay registros, empieza desde 1
    }

    // Insertar la cotización inicial en la base de datos con solo los campos básicos
    $sql_cotizacion = "INSERT INTO c_cotizaciones (
        numero_cotizacion, fecha_emision, fecha_validez, id_cliente, id_proyecto, id_empresa, id_vendedor, 
        id_encargado, 
    ) VALUES (?, NULL, NULL, NULL, NULL, ?, NULL, NULL)"; // Los campos que no tienes aún pueden ser NULL

    $stmt_cotizacion = $conn->prepare($sql_cotizacion);
    if ($stmt_cotizacion === false) {
        die("Error en la preparación de la consulta de cotización: " . $conn->error);
    }

    $stmt_cotizacion->bind_param("si", 
        $numero_cotizacion,$id_empresa,
    );

    $stmt_cotizacion->execute();
    if ($stmt_cotizacion->error) {
        die("Error en la ejecución de la consulta de cotización: " . $stmt_cotizacion->error);
    }

    echo "Cotización creada correctamente con el ID: " . $conn->insert_id . "<br>";

    // Cierra la declaración de cotización
    $stmt_cotizacion->close();
    $conn->close();

    // Redirigir a una página de éxito
    header('Location: ../../programa_cotizacion.php'); // Cambia 'exito.php' por la página a la que quieras redirigir
    exit();
    ?>

    <!-- ------------------------------------------------------------------------------------------------------------
        -------------------------------------- FIN ITred Spa Procesar Creacion Empresa .PHP -----------------------------------
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