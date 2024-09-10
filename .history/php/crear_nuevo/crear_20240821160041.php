<?php
include '../../db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $proyecto_nombre = $conn->real_escape_string($_POST['proyecto_nombre']);
    $codigo_prov = $conn->real_escape_string($_POST['codigo_prov']);
    $area_trabajo = $conn->real_escape_string($_POST['area_trabajo']);
    $riesgo = $conn->real_escape_string($_POST['riesgo']);
    
    $cliente_nombre = $conn->real_escape_string($_POST['cliente_nombre']);
    $cliente_rut = $conn->real_escape_string($_POST['cliente_rut']);
    $cliente_empresa = $conn->real_escape_string($_POST['cliente_empresa']);
    $cliente_direccion = $conn->real_escape_string($_POST['cliente_direccion']);
    $cliente_fono = $conn->real_escape_string($_POST['cliente_fono']);
    $cliente_email = $conn->real_escape_string($_POST['cliente_email']);

    $vendedor_nombre = $conn->real_escape_string($_POST['vendedor_nombre']);
    $vendedor_email = $conn->real_escape_string($_POST['vendedor_email']);
    $vendedor_fono = $conn->real_escape_string($_POST['vendedor_fono']);

    $fecha_cotizacion = $conn->real_escape_string($_POST['fecha_cotizacion']);
    $validez_cotizacion = $conn->real_escape_string($_POST['validez_cotizacion']);

    $cantidad = intval($_POST['cantidad']);
    $descripcion_servicio = $conn->real_escape_string($_POST['descripcion_servicio']);
    $precio_unitario = floatval($_POST['precio_unitario']);
    $total_servicio = $cantidad * $precio_unitario;

    $tipo_cliente = $conn->real_escape_string($_POST['tipo_cliente']);
    $dias_compra = intval($_POST['dias_compra']);
    $dias_trabajo = intval($_POST['dias_trabajo']);
    $trabajadores = intval($_POST['trabajadores']);
    $horario = $conn->real_escape_string($_POST['horario']);
    $colacion = $conn->real_escape_string($_POST['colacion']);
    $entrega = $conn->real_escape_string($_POST['entrega']);
    $cargo = $conn->real_escape_string($_POST['cargo']);
    $giro = $conn->real_escape_string($_POST['giro']);
    $comuna = $conn->real_escape_string($_POST['comuna']);
    $ciudad = $conn->real_escape_string($_POST['ciudad']);
    
    $conn->begin_transaction();

    try {
        $sql_cliente = "INSERT INTO Clientes (nombre, rut, empresa, direccion, telefono, email) 
                        VALUES ('$cliente_nombre', '$cliente_rut', '$cliente_empresa', '$cliente_direccion', '$cliente_fono', '$cliente_email')";
        $conn->query($sql_cliente);
        $cliente_id = $conn->insert_id;

        $sql_proyecto = "INSERT INTO Proyectos (nombre, codigo_prov, area_trabajo, riesgo) 
                         VALUES ('$proyecto_nombre', '$codigo_prov', '$area_trabajo', '$riesgo')";
        $conn->query($sql_proyecto);
        $proyecto_id = $conn->insert_id;

        $sql_vendedor = "INSERT INTO Vendedores (nombre, email, telefono) 
                         VALUES ('$vendedor_nombre', '$vendedor_email', '$vendedor_fono')";
        $conn->query($sql_vendedor);
        $vendedor_id = $conn->insert_id;

        $sql_cotizacion = "INSERT INTO Cotizaciones (fecha, validez, total, cliente_id, proyecto_id, vendedor_id) 
                           VALUES ('$fecha_cotizacion', '$validez_cotizacion', '$total_servicio', '$cliente_id', '$proyecto_id', '$vendedor_id')";
        $conn->query($sql_cotizacion);
        $cotizacion_id = $conn->insert_id;

        $sql_detalle_servicio = "INSERT INTO ItemsCotizacion (cantidad, descripcion, precio_unitario, total, cotizacion_id) 
                                 VALUES ('$cantidad', '$descripcion_servicio', '$precio_unitario', '$total_servicio', '$cotizacion_id')";
        $conn->query($sql_detalle_servicio);

        $sql_info_adicional = "INSERT INTO InfoAdicional (tipo_cliente, dias_compra, dias_trabajo, trabajadores, horario, colacion, entrega, cargo, giro, comuna, ciudad, cotizacion_id) 
                               VALUES ('$tipo_cliente', '$dias_compra', '$dias_trabajo', '$trabajadores', '$horario', '$colacion', '$entrega', '$cargo', '$giro', '$comuna', '$ciudad', '$cotizacion_id')";
        $conn->query($sql_info_adicional);

        $conn->commit();

        // Redireccionar a la página de listado después de la inserción
        header("Location: ver_listado.php");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cotización</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <h1>Crear Cotización</h1>
    <form action="crear.php" method="POST">
        <h2>Datos del Proyecto</h2>
        <label for="proyecto_nombre">Nombre del Proyecto:</label>
        <input type="text" id="proyecto_nombre" name="proyecto_nombre" required><br><br>
        <label for="codigo_prov">Código Prov:</label>
        <input type="text" id="codigo_prov" name="codigo_prov" required><br><br>
        <label for="area_trabajo">Área de Trabajo:</label>
        <input type="text" id="area_trabajo" name="area_trabajo" required><br><br>
        <label for="riesgo">Riesgo:</label>
        <input type="text" id="riesgo" name="riesgo" required><br><br>

        <h2>Datos del Cliente</h2>
        <label for="cliente_nombre">Nombre del Cliente:</label>
        <input type="text" id="cliente_nombre" name="cliente_nombre" required><br><br>
        <label for="cliente_rut">RUT del Cliente:</label>
        <input type="text" id="cliente_rut" name="cliente_rut" required><br><br>
        <label for="cliente_empresa">Empresa del Cliente:</label>
        <input type="text" id="cliente_empresa" name="cliente_empresa" required><br><br>
        <label for="cliente_direccion">Dirección del Cliente:</label>
        <input type="text" id="cliente_direccion" name="cliente_direccion" required><br><br>
        <label for="cliente_fono">Teléfono del Cliente:</label>
        <input type="text" id="cliente_fono" name="cliente_fono" required><br><br>
        <label for="cliente_email">E-mail del Cliente:</label>
        <input type="email" id="cliente_email" name="cliente_email" required><br><br>

        <h2>Datos del Vendedor</h2>
        <label for="vendedor_nombre">Nombre del Vendedor:</label>
        <input type="text" id="vendedor_nombre" name="vendedor_nombre" required><br><br>
        <label for="vendedor_email">E-mail del Vendedor:</label>
        <input type="email" id="vendedor_email" name="vendedor_email" required><br><br>
        <label for="vendedor_fono">Teléfono del Vendedor:</label>
        <input type="text" id="vendedor_fono" name="vendedor_fono" required><br><br>

        <h2>Detalles del Servicio</h2>
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" required><br><br>
        <label for="descripcion_servicio">Descripción del Servicio:</label>
        <textarea id="descripcion_servicio" name="descripcion_servicio" rows="4" required></textarea><br><br>
        <label for="precio_unitario">Precio Unitario:</label>
        <input type="number" id="precio_unitario" name="precio_unitario" required><br><br>

        <h2>Información Adicional</h2>
        <label for="tipo_cliente">Tipo de Cliente:</label>
        <input type="text" id="tipo_cliente" name="tipo_cliente" required><br><br>
        <label for="dias_compra">Días de Compra:</label>
        <input type="number" id="dias_compra" name="dias_compra" required><br><br>
        <label for="dias_trabajo">Días de Trabajo:</label>
        <input type="number" id="dias_trabajo" name="dias_trabajo" required><br><br>
        <label for="trabajadores">Número de Trabajadores:</label>
        <input type="number" id="trabajadores" name="trabajadores" required><br><br>
        <label for="horario">Horario:</label>
        <input type="text" id="horario" name="horario" required><br><br>
        <label for="colacion">Colación:</label>
        <input type="text" id="colacion" name="colacion" required><br><br>
        <label for="entrega">Entrega:</label>
        <input type="text" id="entrega" name="entrega" required><br><br>
        <label for="cargo">Cargo:</label>
        <input type="text" id="cargo" name="cargo" required><br><br>
        <label for="giro">Giro:</label>
        <input type="text" id="giro" name="giro" required><br><br>
        <label for="comuna">Comuna:</label>
        <input type="text" id="comuna" name="comuna" required><br><br>
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" required><br><br>
        <label for="fecha_cotizacion">Fecha de Cotización:</label>
        <input type="date" id="fecha_cotizacion" name="fecha_cotizacion" required><br><br>
<label for="validez_cotizacion">Validez de Cotización:</label>
<input type="number" id="validez_cotizacion" name="validez_cotizacion" required><br><br>
        <input type="submit" value="Generar Cotización">
    </form>
    <ul>
        <li><a href="../../index.php">Volver Al Menu</a></li>
    </ul>
</body>
</html>
 