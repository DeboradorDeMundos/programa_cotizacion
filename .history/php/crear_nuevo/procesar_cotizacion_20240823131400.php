    <?php
    // Configuración del servidor MySQL
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
    // Datos de la empresa que genera la cotización encabezado
    $empresa_rut = $_POST['empresa_rut'] ?? null;
    $empresa_nombre = $_POST['empresa_nombre'] ?? null;
    $empresa_area = $_POST['empresa_area'] ?? null;
    $empresa_direccion = $_POST['empresa_direccion'] ?? null;
    $empresa_telefono = $_POST['empresa_telefono'] ?? null;
    $empresa_email = $_POST['empresa_email'] ?? null;

    // Datos del proyecto   
    $proyecto_nombre = $_POST['proyecto_nombre'] ?? null;
    $proyecto_codigo = $_POST['proyecto_codigo'] ?? null;  
    $area_trabajo = $_POST['area_trabajo'] ?? null;
    $tipo_trabajo = $_POST['tipo_trabajo'] ?? null; 
    $proyecto_riesgo = $_POST['riesgo_proyecto'] ?? null;

    // Datos del cliente
    $cliente_nombre = $_POST['cliente_nombre'] ?? null;
    $cliente_empresa = $_POST['cliente_empresa'] ?? null;
    $cliente_rut = $_POST['cliente_rut'] ?? null;
    $cliente_direccion = $_POST['cliente_direccion'] ?? null;
    $cliente_lugar = $_POST['cliente_lugar'] ?? null;
    $cliente_fono = $_POST['cliente_fono'] ?? null;
    $cliente_email = $_POST['cliente_email'] ?? null;
    $cliente_cargo = $_POST['cliente_cargo'] ?? null;
    $cliente_giro = $_POST['cliente_giro'] ?? null;
    $cliente_comuna = $_POST['cliente_comuna'] ?? null;
    $cliente_ciudad = $_POST['cliente_ciudad'] ?? null;
    $cliente_tipo = $_POST['cliente_tipo'] ?? null;

    // Datos del encargado
    $enc_nombre = $_POST['enc_nombre'] ?? null;
    $enc_email = $_POST['enc_email'] ?? null;
    $enc_fono = $_POST['enc_fono'] ?? null;
    $enc_celular = $_POST['enc_celular'] ?? null;
    $enc_proyecto = $_POST['enc_proyecto'] ?? null;

    // Datos del vendedor
    $vendedor_nombre = $_POST['vendedor_nombre'] ?? null;
    $vendedor_email = $_POST['vendedor_email'] ?? null;
    $vendedor_fono = $_POST['vendedor_fono'] ?? null;
    $vendedor_celular = $_POST['vendedor_celular'] ?? null;

    // Datos adicionales
    $dias_compra = $_POST['dias_compra'] ?? null;
    $dias_trabajo = $_POST['dias_trabajo'] ?? null;
    $trabajadores = $_POST['trabajadores'] ?? null;
    $horario = $_POST['horario'] ?? null;
    $colacion = $_POST['colacion'] ?? null;
    $entrega = $_POST['entrega'] ?? null;
    $numero_cotizacion = $_POST['numero_cotizacion'] ?? null;
    $validez_cotizacion = (int)($_POST['validez_cotizacion'] ?? 0);
    $fecha_validez = date('Y-m-d', strtotime("+$validez_cotizacion days"));
    $fecha_emision = $_POST['fecha_emision'] ?? null;
    
    
    //


    // Validar los datos
    if (!$cliente_rut || !$cliente_nombre || !$empresa_nombre || !$proyecto_codigo) {
        die("Error: Datos requeridos faltantes.");
    }

    // Insertar nuevo cliente si no existe
    $cliente_id = obtenerClienteId($conn, $cliente_rut);
    if (!$cliente_id) {
        $sql_cliente = "INSERT INTO Clientes (nombre_cliente, empresa_cliente, rut_cliente, direccion_cliente, lugar_cliente, telefono_cliente, email_cliente, cargo_cliente, giro_cliente, comuna_cliente, ciudad_cliente, tipo_cliente) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_cliente = $conn->prepare($sql_cliente);
        $stmt_cliente->bind_param("ssssssssssss", $cliente_nombre, $cliente_empresa, $cliente_rut, $cliente_direccion, $cliente_lugar, $cliente_fono, $cliente_email, $cliente_cargo, $cliente_giro, $cliente_comuna, $cliente_ciudad, $cliente_tipo);
        if ($stmt_cliente->execute()) {
            $cliente_id = $stmt_cliente->insert_id;
        } else {
            die("Error al insertar el cliente: " . $stmt_cliente->error);
        }
        $stmt_cliente->close();
    }
    // Insertar nueva empresa si no existe
    $empresa_id = obtenerEmpresaId($conn, $empresa_rut);
    if (!$empresa_id) {
        $sql_empresa = "INSERT INTO Empresa (rut_empresa, nombre_empresa, area_empresa, direccion_empresa, telefono_empresa, email_empresa) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_empresa = $conn->prepare($sql_empresa);
        $stmt_empresa->bind_param("ssssss", $empresa_rut, $empresa_nombre, $empresa_area, $empresa_direccion, $empresa_telefono, $empresa_email);
        if ($stmt_empresa->execute()) {
            $empresa_id = $stmt_empresa->insert_id;
        } else {
            die("Error al insertar la empresa: " . $stmt_empresa->error);
        }
        $stmt_empresa->close();
    }

    
  // Insertar nuevo encargado si no existe
$encargado_id = obtenerEncargadoId($conn, $enc_email);
if (!$encargado_id) {
    $sql_encargado = "INSERT INTO Encargados (nombre_encargado, email_encargado, fono_encargado, celular_encargado) 
                      VALUES (?, ?, ?, ?)";
    $stmt_encargado = $conn->prepare($sql_encargado);
    $stmt_encargado->bind_param("ssss", $enc_nombre, $enc_email, $enc_fono, $enc_celular);
    if ($stmt_encargado->execute()) {
        $encargado_id = $stmt_encargado->insert_id;
    } else {
        die("Error al insertar el encargado: " . $stmt_encargado->error);
    }
    $stmt_encargado->close();
}

// Insertar nuevo vendedor si no existe
$vendedor_id = obtenerVendedorId($conn, $vendedor_email);
if (!$vendedor_id) {
    $sql_vendedor = "INSERT INTO Vendedores (nombre_vendedor, email_vendedor, fono_vendedor, celular_vendedor) 
                     VALUES (?, ?, ?, ?)";
    $stmt_vendedor = $conn->prepare($sql_vendedor);
    $stmt_vendedor->bind_param("ssss", $vendedor_nombre, $vendedor_email, $vendedor_fono, $vendedor_celular);
    if ($stmt_vendedor->execute()) {
        $vendedor_id = $stmt_vendedor->insert_id;
    } else {
        die("Error al insertar el vendedor: " . $stmt_vendedor->error);
    }
    $stmt_vendedor->close();
}

    // Insertar nuevo proyecto
    $sql_proyecto = "INSERT INTO Proyectos (nombre_proyecto, codigo_proyecto, tipo_trabajo, area_trabajo, riesgo_proyecto) 
                    VALUES (?, ?, ?, ?, ?)";
    $stmt_proyecto = $conn->prepare($sql_proyecto);
    $stmt_proyecto->bind_param("sssss", $proyecto_nombre, $proyecto_codigo, $tipo_trabajo, $area_trabajo, $proyecto_riesgo);
    if ($stmt_proyecto->execute()) {
        $proyecto_id = $stmt_proyecto->insert_id;
    } else {
        die("Error al insertar el proyecto: " . $stmt_proyecto->error);
    }
    $stmt_proyecto->close();

    $sql_cotizacion = "INSERT INTO Cotizaciones (numero_cotizacion, fecha_emision, fecha_validez, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega, id_cliente, id_proyecto, id_empresa, id_vendedor, id_encargado) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
    $stmt_cotizacion = $conn->prepare($sql_cotizacion);

    // Asegúrate de que el tipo de datos en bind_param coincida con los parámetros en la consulta SQL
    $stmt_cotizacion->bind_param("ssssiiiiiiiiii", $numero_cotizacion, $fecha_emision, $fecha_validez, $dias_compra, $dias_trabajo, $trabajadores, $horario, $colacion, $entrega, $cliente_id, $proyecto_id, $empresa_id, $vendedor_id, $encargado_id);


    if ($stmt_cotizacion->execute()) {
        $cotizacion_id = $stmt_cotizacion->insert_id;

        // Aquí puedes insertar ítems de cotización si es necesario
        // Por ejemplo, si tienes datos para los ítems en el formulario:
    

        echo "Cotización generada exitosamente.";
    } else {
        die("Error al insertar la cotización: " . $stmt_cotizacion->error);
    }

    $stmt_cotizacion->close();
    $conn->close();

    // Función para obtener el ID del cliente por RUT
    function obtenerClienteId($conn, $rut) {
        $sql = "SELECT id_cliente FROM Clientes WHERE rut_cliente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $rut);
        $stmt->execute();
        $stmt->bind_result($id_cliente);
        $stmt->fetch();
        $stmt->close();
        return $id_cliente;
    }

    // Función para obtener el ID de la empresa por RUT
    function obtenerEmpresaId($conn, $rut_empresa) {
        $sql = "SELECT id_empresa FROM Empresa WHERE rut_empresa = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $rut_empresa);
        $stmt->execute();
        $stmt->bind_result($id_empresa);
        $stmt->fetch();
        $stmt->close();
        return $id_empresa;
    }
    // Función para obtener el ID del encargado por email
    function obtenerEncargadoId($conn, $email_encargado) {
        $sql = "SELECT id_encargado FROM Encargados WHERE email_encargado = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email_encargado);
        $stmt->execute();
        $stmt->bind_result($id_encargado);
        $stmt->fetch();
        $stmt->close();
        return $id_encargado;
    }

    // Función para obtener el ID del vendedor por email
    function obtenerVendedorId($conn, $email_vendedor) {
        $sql = "SELECT id_vendedor FROM Vendedores WHERE email_vendedor = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email_vendedor);
        $stmt->execute();
        $stmt->bind_result($id_vendedor);
        $stmt->fetch();
        $stmt->close();
        return $id_vendedor;
    }
    ?>

