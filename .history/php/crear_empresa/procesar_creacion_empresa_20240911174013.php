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
    ------------------------------------- INICIO ITred Spa Procesar creacion empresa .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

<?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');
?>
<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->

<?php

    $nombre_titular = $_POST['nombre_cuenta'];
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
    } else {
        echo "No se subió una imagen.";
    }


    // Insertar o actualizar la empresa
    $sql = "INSERT INTO e_empresa (rut_empresa, id_foto, nombre_empresa, area_empresa, direccion_empresa, telefono_empresa, email_empresa, fecha_creacion, dias_validez)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)
            ON DUPLICATE KEY UPDATE nombre_empresa=VALUES(nombre_empresa), area_empresa=VALUES(area_empresa), direccion_empresa=VALUES(direccion_empresa), telefono_empresa=VALUES(telefono_empresa), email_empresa=VALUES(email_empresa), fecha_creacion=VALUES(fecha_creacion), dias_validez=VALUES(dias_validez)";
    $stmt = $mysqli->prepare($sql);
        if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $mysqli->error);
    }   
    $stmt->bind_param("sissssssi", $empresa_rut, $empresa_id_foto, $empresa_nombre, $empresa_area, $empresa_direccion, $empresa_telefono, $empresa_email, $fecha_creacion, $validez_cotizacion);

    $stmt->execute();
    if ($stmt->error) {
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }

    // Obtener el ID de la empresa después de la inserción/actualización
    $id_empresa = $mysqli->insert_id;
    echo "Empresa insertada/actualizada. ID: $id_empresa<br>";

    $input = isset($_POST['cuentas_bancarias']) ? $_POST['cuentas_bancarias'] : '';

// Obtener los datos del formulario
$cuentasString = isset($_POST['cuentas_bancarias']) ? $_POST['cuentas_bancarias'] : '';
$condicionesString = isset($_POST['condiciones']) ? $_POST['condiciones'] : '';
$requisitosString = isset($_POST['requisitos']) ? $_POST['requisitos'] : '';
$obligacionesString = isset($_POST['obligaciones']) ? $_POST['obligaciones'] : '';

// Función para obtener el ID de un banco basado en el nombre
function getIdBanco($mysqli, $nombreBanco) {
    $stmt = $mysqli->prepare("SELECT id_banco FROM e_bancos WHERE nombre_banco = ?");
    $stmt->bind_param("s", $nombreBanco);
    $stmt->execute();
    $stmt->bind_result($id_banco);
    $stmt->fetch();
    $stmt->close();
    return $id_banco;
}

// Función para obtener el ID de un tipo de cuenta basado en el nombre
function getIdTipoCuenta($mysqli, $nombreTipoCuenta) {
    $stmt = $mysqli->prepare("SELECT id_tipocuenta FROM e_tipo_cuenta WHERE tipocuenta = ?");
    $stmt->bind_param("s", $nombreTipoCuenta);
    $stmt->execute();
    $stmt->bind_result($id_tipocuenta);
    $stmt->fetch();
    $stmt->close();
    return $id_tipocuenta;
}

// Procesar cuentas bancarias
$cuentasArray = explode('|', $cuentasString);
foreach ($cuentasArray as $cuenta) {
    $datosCuenta = explode(',', $cuenta);
    if (count($datosCuenta) == 7) {
        $nombre_titular = $datosCuenta[0];
        $rut_titular = $datosCuenta[1];
        $id_banco = getIdBanco($mysqli, $datosCuenta[4]);
        $id_tipocuenta = getIdTipoCuenta($mysqli, $datosCuenta[5]);
        $numero_cuenta = $datosCuenta[6];
        $celular = $datosCuenta[2];
        $email_banco = $datosCuenta[3];

        $sql = "INSERT INTO e_cuenta_Bancaria (nombre_titular, rut_titular, id_banco, id_tipocuenta, numero_cuenta, celular, email_banco, id_empresa)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $mysqli->error);
        }

        $stmt->bind_param("ssiisssi", $nombre_titular, $rut_titular, $id_banco, $id_tipocuenta, $numero_cuenta, $celular, $email_banco, $id_empresa);

        if (!$stmt->execute()) {
            echo "Error en la ejecución de la consulta: " . $stmt->error . "<br>";
        } else {
            $id_cuenta = $stmt->insert_id;
            echo "Cuenta bancaria insertada. ID: $id_cuenta<br>";
        }
        $stmt->close();
    }
}

// Procesar condiciones generales
$condicionesArray = explode('|', $condicionesString);
if (!empty($condicionesArray)) {
    $stmt = $mysqli->prepare("INSERT INTO C_Condiciones_Generales (id_empresa, descripcion_condiciones) VALUES (?, ?)");

    if (!$stmt) {
        die("Error al preparar la consulta: " . $mysqli->error);
    }

    foreach ($condicionesArray as $condicion) {
        $stmt->bind_param("is", $id_empresa, $condicion);
        if (!$stmt->execute()) {
            echo "Error al insertar condición: " . $stmt->error;
        }
    }
    $stmt->close();
} else {
    echo "No hay condiciones para insertar.";
}

// Procesar requisitos básicos
$requisitosArray = explode('|', $requisitosString);
if (!empty($requisitosArray)) {
    $stmt = $mysqli->prepare("INSERT INTO E_Requisitos_Basicos (indice, descripcion_condiciones, id_empresa) VALUES (?, ?, ?)");

    if (!$stmt) {
        die("Error al preparar la consulta: " . $mysqli->error);
    }

    foreach ($requisitosArray as $index => $requisito) {
        $indice = $index + 1;
        $stmt->bind_param("isi", $indice, $requisito, $id_empresa);
        if (!$stmt->execute()) {
            echo "Error al insertar requisito: " . $stmt->error;
        }
    }
    $stmt->close();
} else {
    echo "No hay requisitos para insertar.";
}

// Procesar obligaciones del cliente
$obligacionesArray = explode('|', $obligacionesString);
if (!empty($obligacionesArray)) {
    $stmt = $mysqli->prepare("INSERT INTO e_obligaciones_cliente (indice, descripcion, id_empresa) VALUES (?, ?, ?)");

    if (!$stmt) {
        die("Error al preparar la consulta: " . $mysqli->error);
    }

    foreach ($obligacionesArray as $index => $obligacion) {
        $indice = $index + 1;
        $descripcion = $obligacion;
        $stmt->bind_param("isi", $indice, $descripcion, $id_empresa);
        if (!$stmt->execute()) {
            echo "Error al insertar obligación: " . $stmt->error;
        }
    }
    $stmt->close();
} else {
    echo "No hay obligaciones para insertar.";
}
      

    // Obtener el último número de cotización para la empresa específica
    $sql_last_cot = "SELECT numero_cotizacion FROM c_cotizaciones WHERE id_empresa = ? ORDER BY id_cotizacion DESC LIMIT 1";
    $stmt_last_cot = $mysqli->prepare($sql_last_cot);
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
        numero_cotizacion, fecha_emision , fecha_validez, id_cliente, id_proyecto, id_empresa, id_vendedor, 
        id_encargado
    ) VALUES (?, NULL ,NULL, NULL, NULL, ?, NULL, NULL)"; // Los campos que no tienes aún pueden ser NULL

    $stmt_cotizacion = $mysqli->prepare($sql_cotizacion);
    if ($stmt_cotizacion === false) {
        die("Error en la preparación de la consulta de cotización: " . $mysqli->error);
    }

    $stmt_cotizacion->bind_param("si", 
        $numero_cotizacion,
        $id_empresa
        
    );

    $stmt_cotizacion->execute();
    if ($stmt_cotizacion->error) {
        die("Error en la ejecución de la consulta de cotización: " . $stmt_cotizacion->error);
    }

    echo "Cotización creada correctamente con el ID: " . $mysqli->insert_id . "<br>";



    // Cierra la declaración de cotización
    $stmt_cotizacion->close();




    // Redirigir a una página de éxito
    header('Location: ../../programa_cotizacion.php'); // Cambia 'exito.php' por la página a la que quieras redirigir
    exit();
?>

<!-- ---------------------
-- INICIO CIERRE CONEXION BD --
     --------------------- -->
<?php
     $mysqli->close();
?>
<!-- ---------------------
     -- FIN CIERRE CONEXION BD --
     --------------------- -->

<!-- ------------------------------------------------------------------------------------------------------------
-------------------------------------- FIN ITred Spa Procesar Creacion Empresa .PHP -----------------------------------
------------------------------------------------------------------------------------------------------------- -->

<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa
BPPJ
-->