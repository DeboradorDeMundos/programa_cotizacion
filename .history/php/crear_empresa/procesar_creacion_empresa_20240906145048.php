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
$conn = new mysqli('localhost', 'root', '', 'itredspa_bd');
?>
<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->

<?php

    // Recibir datos del formulario
    $empresa_rut = $_POST['empresa_rut'];
    $empresa_nombre = $_POST['empresa_nombre'];
    $empresa_area = $_POST['empresa_area'];
    $empresa_direccion = $_POST['empresa_direccion'];
    $empresa_telefono = $_POST['empresa_telefono'];
    $empresa_email = $_POST['empresa_email'];
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

    $input = isset($_POST['cuentas_bancarias']) ? $_POST['cuentas_bancarias'] : '';
    $condicionesJson = $_POST['condiciones'] ?? '[]'; 

    // Decodificar el JSON
    $data = json_decode(urldecode($input), true);
    $condiciones = json_decode($condicionesJson, true);
    
    // Verificar si la decodificación fue exitosa
    if (json_last_error() !== JSON_ERROR_NONE) {
        die("Error al decodificar el JSON: " . json_last_error_msg());
    }
    
    // Función para obtener el ID de un banco basado en el nombre
    function getIdBanco($conn, $nombreBanco) {
        $stmt = $conn->prepare("SELECT id_banco FROM e_bancos WHERE nombre_banco = ?");
        $stmt->bind_param("s", $nombreBanco);
        $stmt->execute();
        $stmt->bind_result($id_banco);
        $stmt->fetch();
        $stmt->close();
        return $id_banco;
    }
    
    // Función para obtener el ID de un tipo de cuenta basado en el nombre
    function getIdTipoCuenta($conn, $nombreTipoCuenta) {
        $stmt = $conn->prepare("SELECT id_tipocuenta FROM e_tipo_cuenta WHERE tipocuenta = ?");
        $stmt->bind_param("s", $nombreTipoCuenta);
        $stmt->execute();
        $stmt->bind_result($id_tipocuenta);
        $stmt->fetch();
        $stmt->close();
        return $id_tipocuenta;
    }
    
    // Preparar la consulta de inserción
    $sql = "INSERT INTO e_cuenta_Bancaria (nombre_titular, rut_titular, id_banco, id_tipocuenta, numero_cuenta, celular, email_banco, id_empresa)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    
    // Iterar sobre las cuentas y realizar la inserción
    foreach ($data as $account) {
        $nombre_titular = $account['nombre'];
        $rut_titular = $account['rut'];
        $id_banco = getIdBanco($conn, $account['banco']);
        $id_tipocuenta = getIdTipoCuenta($conn, $account['tipoCuenta']);
        $numero_cuenta = $account['numeroCuenta'];
        $celular = $account['celular'];
        $email_banco = $account['email'];
    
        // Enlazar parámetros
        $stmt->bind_param("ssiisssi", $nombre_titular, $rut_titular, $id_banco, $id_tipocuenta, $numero_cuenta, $celular, $email_banco, $id_empresa);
    
        // Ejecutar la consulta
        if (!$stmt->execute()) {
            echo "Error en la ejecución de la consulta: " . $stmt->error . "<br>";
        } else {
            $id_cuenta = $stmt->insert_id;
            echo "Cuenta bancaria insertada. ID: $id_cuenta<br>";
        }
    }// Cerrar el statement
    $stmt->close();
    if (!empty($condiciones) && is_array($condiciones)) {
        foreach ($condiciones as $index => $condicion) {
            // Preparar la consulta de inserción
            $stmt = $conn->prepare("INSERT INTO e_requisitos_Basicos (indice, descripcion_condiciones, id_empresa) VALUES (?, ?, ?)");
    
            if (!$stmt) {
                die("Error al preparar la consulta: " . $conn->error);
            }
            
            // El índice comienza en 1 para cada nuevo conjunto de inserciones
            $indice = $index + 1;
            
            // Vincular los parámetros
            $stmt->bind_param("isi", $indice, $condicion, $id_empresa);
            
            // Ejecutar la consulta
            if (!$stmt->execute()) {
                echo "Error al insertar datos: " . $stmt->error;
            }
        }
    
        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "No hay condiciones para insertar.";
    }
    

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
        id_encargado
    ) VALUES (?, NULL, NULL, NULL, NULL, ?, NULL, NULL)"; // Los campos que no tienes aún pueden ser NULL

    $stmt_cotizacion = $conn->prepare($sql_cotizacion);
    if ($stmt_cotizacion === false) {
        die("Error en la preparación de la consulta de cotización: " . $conn->error);
    }

    $stmt_cotizacion->bind_param("si", 
        $numero_cotizacion,$id_empresa
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
Creado, Programado y Diseñado por ITred Spa
BPPJ
-->