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
    ------------------------------------- INICIO ITred Spa Procesar Modificación .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->


<?php
// Habilitar el reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

$id_cotizacion = $_POST['numero_cotizacion'];

$validez_cotizacion = $_POST['validez_cotizacion'];
$fecha_emision = $_POST['fecha_emision'];

$empresa_rut = $_POST['empresa_rut'];
$empresa_rut_original = $_POST['rut_empresa_original'];
$empresa_nombre = $_POST['empresa_nombre'];
$empresa_area = $_POST['empresa_area'];
$empresa_direccion = $_POST['empresa_direccion'];
$empresa_telefono = $_POST['empresa_telefono'];
$empresa_email = $_POST['empresa_email'];

$proyecto_nombre = $_POST['proyecto_nombre'];
$proyecto_codigo = $_POST['proyecto_codigo'];
$proyecto_codigo_original = $_POST['proyecto_codigo_original'];
$area_trabajo = $_POST['area_trabajo'];
$tipo_trabajo = $_POST['tipo_trabajo'];
$riesgo = $_POST['riesgo'];
$dias_compra = $_POST['dias_compra'];
$dias_trabajo = $_POST['dias_trabajo'];
$trabajadores = $_POST['trabajadores'];
$horario = $_POST['horario'];
$colacion = $_POST['colacion'];
$entrega = $_POST['entrega'];

$cliente_nombre = $_POST['cliente_nombre'];
$cliente_rut = $_POST['cliente_rut'];
$cliente_rut_original = $_POST['cliente_rut_original'];
$cliente_empresa = $_POST['cliente_empresa'];
$cliente_direccion = $_POST['cliente_direccion'];
$cliente_lugar = $_POST['cliente_lugar'];
$cliente_fono = $_POST['cliente_fono'];
$cliente_email = $_POST['cliente_email'];
$cliente_cargo = $_POST['cliente_cargo'];
$cliente_giro = $_POST['cliente_giro'];
$cliente_comuna = $_POST['cliente_comuna'];
$cliente_ciudad = $_POST['cliente_ciudad'];
$cliente_tipo = $_POST['cliente_tipo'];

$enc_nombre = $_POST['enc_nombre'];
$enc_email = $_POST['enc_email'];
$enc_fono = $_POST['enc_fono'];
$enc_celular = $_POST['enc_celular'];
$enc_proyecto = $_POST['enc_proyecto'];

$vendedor_nombre = $_POST['vendedor_nombre'];
$vendedor_email = $_POST['vendedor_email'];
$vendedor_telefono = $_POST['vendedor_telefono'];
$vendedor_celular = $_POST['vendedor_celular'];



// Verificar si los datos han cambiado
$sql = "UPDATE Empresa 
        SET nombre_empresa = IFNULL(NULLIF(?, nombre_empresa), nombre_empresa),
            rut_empresa = IFNULL(NULLIF(?, rut_empresa), rut_empresa),
            area_empresa = IFNULL(NULLIF(?, area_empresa), area_empresa),
            direccion_empresa = IFNULL(NULLIF(?, direccion_empresa), direccion_empresa),
            telefono_empresa = IFNULL(NULLIF(?, telefono_empresa), telefono_empresa),
            email_empresa = IFNULL(NULLIF(?, email_empresa), email_empresa)
        WHERE rut_empresa = ?";

// Preparar la consulta
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", 
    $empresa_nombre,$empresa_rut, $empresa_area, $empresa_direccion, 
    $empresa_telefono, $empresa_email, $empresa_rut_original
);

// Ejecutar la consulta
$stmt->execute();

// Verificar la ejecución
if ($stmt->affected_rows > 0) {
    echo "Datos actualizados correctamente.";
} else {
    echo "No se realizaron cambios.";
}
$stmt->close();

//actualizar el cliente

$sql_update = "UPDATE Clientes 
               SET rut_cliente = IFNULL(NULLIF(?, rut_cliente), rut_cliente),
                   nombre_cliente = IFNULL(NULLIF(?, nombre_cliente), nombre_cliente),
                   empresa_cliente = IFNULL(NULLIF(?, empresa_cliente), empresa_cliente),
                   direccion_cliente = IFNULL(NULLIF(?, direccion_cliente), direccion_cliente),
                   lugar_cliente = IFNULL(NULLIF(?, lugar_cliente), lugar_cliente),
                   telefono_cliente = IFNULL(NULLIF(?, telefono_cliente), telefono_cliente),
                   email_cliente = IFNULL(NULLIF(?, email_cliente), email_cliente),
                   cargo_cliente = IFNULL(NULLIF(?, cargo_cliente), cargo_cliente),
                   giro_cliente = IFNULL(NULLIF(?, giro_cliente), giro_cliente),
                   comuna_cliente = IFNULL(NULLIF(?, comuna_cliente), comuna_cliente),
                   ciudad_cliente = IFNULL(NULLIF(?, ciudad_cliente), ciudad_cliente),
                   tipo_cliente = IFNULL(NULLIF(?, tipo_cliente), tipo_cliente)
               WHERE rut_cliente = ?";

// Preparar la consulta
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("sssssssssssss", 
    $cliente_rut, $cliente_nombre, $cliente_empresa, $cliente_direccion, 
    $cliente_lugar, $cliente_fono, $cliente_email, $cliente_cargo, 
    $cliente_giro, $cliente_comuna, $cliente_ciudad, $cliente_tipo, $cliente_rut_original
);

// Ejecutar la consulta
$stmt_update->execute();

// Verificar la ejecución
if ($stmt_update->affected_rows > 0) {
    echo "Datos del cliente actualizados correctamente.";
} else {
    echo "No se realizaron cambios.";
}
$stmt_update->close();

// Obtener el id_proyecto asociado con el id_cotizacion
$sql_get_id_proyecto = "SELECT id_proyecto FROM Cotizaciones WHERE numero_cotizacion = ?";
$stmt_get_id_proyecto = $conn->prepare($sql_get_id_proyecto);
$stmt_get_id_proyecto->bind_param("i", $id_cotizacion);
$stmt_get_id_proyecto->execute();
$result_get_id_proyecto = $stmt_get_id_proyecto->get_result();

if ($result_get_id_proyecto->num_rows > 0) {
    $row = $result_get_id_proyecto->fetch_assoc();
    $id_proyecto = $row['id_proyecto'];
} else {
    echo "No se encontró el proyecto asociado con la cotización proporcionada.";
    exit();
}
$stmt_get_id_proyecto->close();

// Proceder con la actualización del proyecto
$sql_update = "UPDATE Proyectos 
               SET nombre_proyecto = IFNULL(NULLIF(?, nombre_proyecto), nombre_proyecto),
                   codigo_proyecto = IFNULL(NULLIF(?, codigo_proyecto), codigo_proyecto),
                   tipo_trabajo = IFNULL(NULLIF(?, tipo_trabajo), tipo_trabajo),
                   area_trabajo = IFNULL(NULLIF(?, area_trabajo), area_trabajo),
                   riesgo_proyecto = IFNULL(NULLIF(?, riesgo_proyecto), riesgo_proyecto)
               WHERE id_proyecto = ?";

// Preparar la consulta
$stmt_update_proyecto = $conn->prepare($sql_update);
$stmt_update_proyecto->bind_param("ssssii", 
    $proyecto_nombre, $proyecto_codigo, $tipo_trabajo, $area_trabajo, $riesgo, $id_proyecto
);

// Ejecutar la consulta
$stmt_update_proyecto->execute();

// Verificar la ejecución
if ($stmt_update_proyecto->affected_rows > 0) {
    echo "Datos del proyecto actualizados correctamente.";
} else {
    echo "No se realizaron cambios.";
}

$stmt_update_proyecto->close();

// Obtener el id_encargado asociado con el id_cotizacion
$sql_get_id_encargado = "SELECT id_encargado FROM Cotizaciones WHERE numero_cotizacion = ?";
$stmt_get_id_encargado = $conn->prepare($sql_get_id_proyecto);
$stmt_get_id_encargado->bind_param("i", $id_cotizacion);
$stmt_get_id_encargado->execute();
$result_get_id_encargado = $stmt_get_id_encargado->get_result();

if ($result_get_id_encargado->num_rows > 0) {
    $row = $result_get_id_encargado->fetch_assoc();
    $id_encargado = $row['id_proyecto'];
} else {
    echo "No se encontró el proyecto asociado con la cotización proporcionada.";
    exit();
}
$stmt_get_id_encargado->close();

// Actualizar Encargado
$sql_update_encargado = "UPDATE Encargados 
                         SET nombre_encargado = IFNULL(NULLIF(?, nombre_encargado), nombre_encargado),
                             email_encargado = IFNULL(NULLIF(?, email_encargado), email_encargado),
                             fono_encargado = IFNULL(NULLIF(?, fono_encargado), fono_encargado),
                             celular_encargado = IFNULL(NULLIF(?, celular_encargado), celular_encargado)
                         WHERE id_encargado = ?";

// Preparar la consulta
$stmt_update_encargado = $conn->prepare($sql_update_encargado);
$stmt_update_encargado->bind_param("sssii", 
    $enc_nombre, $enc_email, $enc_fono, $enc_celular, $id_encargado
);

// Ejecutar la consulta
$stmt_update_encargado->execute();

// Verificar la ejecución
if ($stmt_update_encargado->affected_rows > 0) {
    echo "Datos del encargado actualizados correctamente.";
} else {
    echo "No se realizaron cambios en el encargado.";
}

// Cerrar la conexión
$stmt_update_encargado->close();

// Obtener el id_vendedora sociado con el id_cotizacion
$sql_get_id_vendedor = "SELECT id_vendedor FROM Cotizaciones WHERE numero_cotizacion = ?";
$stmt_get_id_vendedor = $conn->prepare($sql_get_id_vendedor);
$stmt_get_id_vendedor->bind_param("i", $id_cotizacion);
$stmt_get_id_vendedor->execute();
$result_get_id_vendedor = $stmt_get_id_vendedor->get_result();

if ($result_get_id_vendedor->num_rows > 0) {
    $row = $result_get_id_vendedor->fetch_assoc();
    $id_vendedor = $row['id_vendedor'];
} else {
    echo "No se encontró el vendedor asociado con la cotización proporcionada.";
    exit();
}
$stmt_get_id_vendedor->close();

// Actualizar Vendedor
$sql_update_vendedor = "UPDATE Vendedores 
                        SET nombre_vendedor = IFNULL(NULLIF(?, nombre_vendedor), nombre_vendedor),
                            email_vendedor = IFNULL(NULLIF(?, email_vendedor), email_vendedor),
                            fono_vendedor = IFNULL(NULLIF(?, fono_vendedor), fono_vendedor),
                            celular_vendedor = IFNULL(NULLIF(?, celular_vendedor), celular_vendedor)
                        WHERE id_vendedor = ?";

// Preparar la consulta
$stmt_update_vendedor = $conn->prepare($sql_update_vendedor);
$stmt_update_vendedor->bind_param("sssii", 
    $vendedor_nombre, $vendedor_email, $vendedor_telefono, $vendedor_celular, $id_vendedor
);

// Ejecutar la consulta
$stmt_update_vendedor->execute();

// Verificar la ejecución
if ($stmt_update_vendedor->affected_rows > 0) {
    echo "Datos del vendedor actualizados correctamente.";
} else {
    echo "No se realizaron cambios en el vendedor.";
}

// Cerrar la conexión
$stmt_update_vendedor->close();

// Cerrar la conexión


$conn->close();

?>

