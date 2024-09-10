<?php
// Procesar la cotización

// Configurar el servidor MySQL y la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itredspa_bd";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoger datos del formulario
$numero_cotizacion = $_POST['numero_cotizacion'];
$fecha_emision = $_POST['fecha_cotizacion'];
$fecha_validez = date('Y-m-d', strtotime("+{$_POST['validez_cotizacion']} days"));
$dias_compra = $_POST['dias_compra'];
$dias_trabajo = $_POST['dias_trabajo'];
$trabajadores = $_POST['trabajadores'];
$horario = $_POST['horario'];
$colacion = $_POST['colacion'];
$entrega = $_POST['entrega'];
$cliente_rut = $_POST['cliente_rut'];
$proyecto_nombre = $_POST['proyecto_nombre'];
$codigo_prov = $_POST['codigo_prov'];
$area_trabajo = $_POST['area_trabajo'];
$riesgo = $_POST['riesgo'];
$descripcion_servicio = $_POST['descripcion_servicio'];
$cantidad = $_POST['cantidad'];
$precio_unitario = $_POST['precio_unitario'];

// Obtener IDs del cliente, proyecto y empresa
// Aquí se asume que las funciones de búsqueda son implementadas correctamente

$cliente_id = obtenerClienteId($conn, $cliente_rut);
$proyecto_id = obtenerProyectoId($conn, $codigo_prov);
$empresa_id = obtenerEmpresaId($conn); // Función para obtener el ID de la empresa

if ($cliente_id && $proyecto_id && $empresa_id) {
    // Insertar datos en la tabla Cotizaciones
    $sql = "INSERT INTO Cotizaciones (numero_cotizacion, fecha_emision, fecha_validez, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega, id_cliente, id_proyecto, id_empresa) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiiiiiiii", $numero_cotizacion, $fecha_emision, $fecha_validez, $dias_compra, $dias_trabajo, $trabajadores, $horario, $colacion, $entrega, $cliente_id, $proyecto_id, $empresa_id);
    
    if ($stmt->execute()) {
        $cotizacion_id = $stmt->insert_id;
        
        // Insertar datos en la tabla Items_Cotizacion
        $total = $cantidad * $precio_unitario;
        $sql_item = "INSERT INTO Items_Cotizacion (id_cotizacion, descripcion, cantidad, precio_unitario, total) 
                     VALUES (?, ?, ?, ?, ?)";
        
        $stmt_item = $conn->prepare($sql_item);
        $stmt_item->bind_param("isidd", $cotizacion_id, $descripcion_servicio, $cantidad, $precio_unitario, $total);
        
        if ($stmt_item->execute()) {
            echo "Cotización generada exitosamente.";
        } else {
            echo "Error al insertar el ítem: " . $stmt_item->error;
        }
    } else {
        echo "Error al insertar la cotización: " . $stmt->error;
    }
    
    $stmt->close();
    $stmt_item->close();
} else {
    echo "Error: Cliente, proyecto o empresa no encontrados.";
}

$conn->close();

// Función para obtener el ID del cliente por RUT
function obtenerClienteId($conn, $rut) {
    $sql = "SELECT id_cliente FROM Clientes WHERE rut = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $rut);
    $stmt->execute();
    $stmt->bind_result($id_cliente);
    $stmt->fetch();
    $stmt->close();
    return $id_cliente;
}

// Función para obtener el ID del proyecto por código
function obtenerProyectoId($conn, $codigo) {
    $sql = "SELECT id_proyecto FROM Proyectos WHERE codigo_proyecto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $stmt->bind_result($id_proyecto);
    $stmt->fetch();
    $stmt->close();
    return $id_proyecto;
}

// Función para obtener el ID de la empresa (suponiendo que hay solo una empresa)
function obtenerEmpresaId($conn) {
    $sql = "SELECT id_empresa FROM Empresa LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['id_empresa'];
    }
    return null;
}
?>
