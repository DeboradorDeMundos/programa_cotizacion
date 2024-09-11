<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'ITredSpa_bd');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID de la cotización desde la URL
$id_cotizacion = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Validar si el ID es válido
if ($id_cotizacion > 0) {
    // Consulta para obtener los datos de la cotización y relaciones
    $sql = "SELECT 
    e.rut_empresa,
    e.nombre_empresa,
    e.area_empresa,
    e.direccion_empresa,
    e.telefono_empresa,
    e.email_empresa,
    e.fecha_creacion,
    e.dias_validez,
    p.nombre_proyecto,
    p.codigo_proyecto,
    p.tipo_trabajo,
    p.area_trabajo,
    p.riesgo_proyecto,
    p.dias_compra,
    p.dias_trabajo,
    p.trabajadores,
    p.horario,
    p.colacion,
    p.entrega,
    c.rut_cliente,
    c.nombre_cliente,
    c.empresa_cliente,
    c.direccion_cliente,
    c.lugar_cliente,
    c.telefono_cliente,
    c.email_cliente,
    c.cargo_cliente,
    c.giro_cliente,
    c.comuna_cliente,
    c.ciudad_cliente,
    c.tipo_cliente,
    en.rut_encargado,
    en.nombre_encargado,
    en.email_encargado,
    en.fono_encargado,
    en.celular_encargado,
    cv.rut_vendedor,
    cv.nombre_vendedor,
    cv.email_vendedor,
    cv.fono_vendedor,
    cv.celular_vendedor,
    ct.numero_cotizacion,
    ct.fecha_emision,
    ct.fecha_validez,
    cb.rut_titular,
    cb.nombre_titular,
    b.nombre_banco,
    tc.tipocuenta,
    cb.numero_cuenta,
    cb.celular AS cuenta_celular,
    cb.email_banco,
    cg.descripcion_condiciones,
    rb.descripcion_condiciones AS requisitos,
    ob.descripcion AS obligaciones
FROM 
    C_Cotizaciones ct
    JOIN E_Empresa e ON ct.id_empresa = e.id_empresa
    JOIN C_Proyectos p ON ct.id_proyecto = p.id_proyecto
    JOIN C_Clientes c ON ct.id_cliente = c.id_cliente
    JOIN C_Encargados en ON ct.id_encargado = en.id_encargado
    JOIN C_Vendedores cv ON ct.id_vendedor = cv.id_vendedor
    LEFT JOIN E_Cuenta_Bancaria cb ON e.id_empresa = cb.id_empresa
    LEFT JOIN E_Bancos b ON cb.id_banco = b.id_banco
    LEFT JOIN E_Tipo_Cuenta tc ON cb.id_tipocuenta = tc.id_tipocuenta
    LEFT JOIN C_Condiciones_Generales cg ON e.id_empresa = cg.id_empresa
    LEFT JOIN E_Requisitos_Basicos rb ON e.id_empresa = rb.id_empresa
    LEFT JOIN E_obligaciones_cliente ob ON e.id_empresa = ob.id_empresa
WHERE 
    ct.id_cotizacion = ?;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_cotizacion);
    $stmt->execute();
    $result = $stmt->get_result();

    // Inicializar variables
    $productos = [];
    $subtotal = $iva = $total_final = 0;

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Almacenar los datos en variables para mostrarlos más tarde
            $numero_cotizacion = $row['numero_cotizacion'];
            $fecha_emision = $row['fecha_emision'];
            $fecha_validez = $row['fecha_validez'];
            
            // Detalles del cliente
            $nombre_cliente = $row['nombre_cliente'];
            $rut_cliente = $row['rut_cliente'];
            $direccion_cliente = $row['direccion_cliente'];
            $telefono_cliente = $row['telefono_cliente'];
            $email_cliente = $row['email_cliente'];
            $giro_cliente = $row['giro_cliente'];
            $comuna_cliente = $row['comuna_cliente'];
            $ciudad_cliente = $row['ciudad_cliente'];
            
            // Detalles de la empresa
            $nombre_empresa = $row['nombre_empresa'];
            $rut_empresa = $row['rut_empresa'];
            $direccion_empresa = $row['direccion_empresa'];
            $telefono_empresa = $row['telefono_empresa'];
            $email_empresa = $row['email_empresa'];
            $area_empresa = $row['area_empresa'];
            
            // Detalles del proyecto
            $nombre_proyecto = $row['nombre_proyecto'];
            $codigo_proyecto = $row['codigo_proyecto'];
            $tipo_trabajo = $row['tipo_trabajo'];
            $area_trabajo = $row['area_trabajo'];
            $riesgo_proyecto = $row['riesgo_proyecto'];
            
            // Detalles del encargado
            $nombre_encargado = $row['nombre_encargado'];
            $email_encargado = $row['email_encargado'];
            $fono_encargado = $row['fono_encargado'];
            $celular_encargado = $row['celular_encargado'];
            
            // Detalles del vendedor
            $nombre_vendedor = $row['nombre_vendedor'];
            $email_vendedor = $row['email_vendedor'];
            $fono_vendedor = $row['fono_vendedor'];
            $celular_vendedor = $row['celular_vendedor'];

            // Manejar productos
            $productos[] = array(
                'nombre_producto' => $row['nombre_producto'] ?? 'No disponible',
                'cantidad' => $row['cantidad'] ?? 0,
                'precio_unitario' => $row['precio_unitario'] ?? 0,
                'total' => $row['total'] ?? 0
            );

            // Totales (Asegurarse de que existan)
            $subtotal = $row['sub_total'] ?? 0;
            $iva = $row['iva_valor'] ?? 0;
            $total_final = $row['total_final'] ?? 0;
        }
    } else {
        echo "No se encontró la cotización.";
    }

    $stmt->close();
} else {
    echo "ID de cotización no válido.";
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización</title>
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .cotizacion-container { width: 800px; margin: 20px auto; background-color: #ffffff; padding: 20px; border: 1px solid #cccccc; }
        header { display: flex; justify-content: space-between; align-items: center; }
        .header-left { font-size: 14px; }
        .header-left h2 { font-size: 28px; color: #007bff; margin: 0; }
        .header-right .logo { width: 150px; }
        .section { margin-top: 20px; }
        h3 { font-size: 14px; color: #007bff; margin-bottom: 5px; }
        .info { padding: 10px 0; }
        .section-container { display: flex; flex-wrap: wrap; gap: 20px; }
        .section-container .section { flex: 1 1 calc(50% - 20px); box-sizing: border-box; }
        .tabla-productos { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .tabla-productos th, .tabla-productos td { padding: 10px; border: 1px solid #dddddd; text-align: left; }
        .tabla-productos th { background-color: #007bff; color: #ffffff; }
        .resumen-precio { width: 300px; float: right; margin-top: 20px; }
        .resumen-precio table { width: 100%; border-collapse: collapse; }
        .resumen-precio td { padding: 10px; border: 1px solid #dddddd; }
        .metodo-pago { margin-top: 40px; }
        .firmas { display: flex; justify-content: space-between; margin-top: 40px; }
        .firma { width: 45%; text-align: center; }
        .firma hr { border: none; border-top: 1px solid #000000; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="cotizacion-container">
        <header>
            <div class="header-left">
                <h2>COTIZACIÓN</h2>
                <p>No. <?php echo $numero_cotizacion; ?></p>
                <p>Fecha de emisión: <?php echo $fecha_emision; ?></p>
                <p>Fecha de validez: <?php echo $fecha_validez; ?></p>
            </div>
            <div class="header-right">
                <img src="logo.png" alt="Logo Empresa" class="logo">
            </div>
        </header>

        <!-- Sección de Detalles -->
        <div class="section-container">
            <!-- Detalles de la Empresa -->
            <div class="section">
                <h3>DETALLES DE LA EMPRESA</h3>
                <div class="info">
                    <p><strong>Empresa:</strong> <?php echo $nombre_empresa; ?></p>
                    <p><strong>RUT:</strong> <?php echo $rut_empresa; ?></p>
                    <p><strong>Dirección:</strong> <?php echo $direccion_empresa; ?></p>
                    <p><strong>Teléfono:</strong> <?php echo $telefono_empresa; ?></p>
                    <p><strong>Email:</strong> <?php echo $email_empresa; ?></p>
                    <p><strong>Área:</strong> <?php echo $area_empresa; ?></p>
                </div>
            </div>

            <!-- Detalles del Proyecto -->
            <div class="section">
                <h3>DETALLES DEL PROYECTO</h3>
                <div class="info">
                    <p><strong>Nombre:</strong> <?php echo $nombre_proyecto; ?></p>
                    <p><strong>Código:</strong> <?php echo $codigo_proyecto; ?></p>
                    <p><strong>Tipo de trabajo:</strong> <?php echo $tipo_trabajo; ?></p>
                    <p><strong>Área de trabajo:</strong> <?php echo $area_trabajo; ?></p>
                    <p><strong>Riesgo:</strong> <?php echo $riesgo_proyecto; ?></p>
                </div>
            </div>

            <!-- Detalles del Cliente -->
            <div class="section">
                <h3>DETALLES DEL CLIENTE</h3>
                <div class="info">
                    <p><strong>Nombre:</strong> <?php echo $nombre_cliente; ?></p>
                    <p><strong>RUT:</strong> <?php echo $rut_cliente; ?></p>
                    <p><strong>Dirección:</strong> <?php echo $direccion_cliente; ?></p>
                    <p><strong>Teléfono:</strong> <?php echo $telefono_cliente; ?></p>
                    <p><strong>Email:</strong> <?php echo $email_cliente; ?></p>
                    <p><strong>Giro:</strong> <?php echo $giro_cliente; ?></p>
                    <p><strong>Comuna:</strong> <?php echo $comuna_cliente; ?></p>
                    <p><strong>Ciudad:</strong> <?php echo $ciudad_cliente; ?></p>
                </div>
            </div>
        </div>

        <!-- Detalles del Encargado -->
        <div class="section">
            <h3>DETALLES DEL ENCARGADO</h3>
            <div class="info">
                <p><strong>Nombre:</strong> <?php echo $nombre_encargado; ?></p>
                <p><strong>Email:</strong> <?php echo $email_encargado; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $fono_encargado; ?></p>
                <p><strong>Celular:</strong> <?php echo $celular_encargado; ?></p>
            </div>
        </div>

        <!-- Detalles del Vendedor -->
        <div class="section">
            <h3>DETALLES DEL VENDEDOR</h3>
            <div class="info">
                <p><strong>Nombre:</strong> <?php echo $nombre_vendedor; ?></p>
                <p><strong>Email:</strong> <?php echo $email_vendedor; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $fono_vendedor; ?></p>
                <p><strong>Celular:</strong> <?php echo $celular_vendedor; ?></p>
            </div>
        </div>

        <!-- Productos -->
        <div class="section">
            <h3>PRODUCTOS</h3>
            <table class="tabla-productos">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($productos)): ?>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?php echo $producto['nombre_producto']; ?></td>
                                <td><?php echo $producto['cantidad']; ?></td>
                                <td><?php echo $producto['precio_unitario']; ?></td>
                                <td><?php echo $producto['total']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No se encontraron productos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Totales -->
        <div class="resumen-precio">
            <table>
                <tr>
                    <td><strong>Subtotal</strong></td>
                    <td><?php echo $subtotal; ?></td>
                </tr>
                <tr>
                    <td><strong>IVA</strong></td>
                    <td><?php echo $iva; ?></td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><?php echo $total_final; ?></td>
                </tr>
            </table>
        </div>

        <!-- Método de Pago -->
        <div class="section metodo-pago">
            <h3>MÉTODO DE PAGO</h3>
            <p>Se aceptan los siguientes métodos de pago: [Inserta detalles del método de pago aquí]</p>
        </div>

        <!-- Requisitos, Obligaciones y Condiciones Generales -->
        <?php if (!empty($requisitos)): ?>
            <div class="section">
                <h3>REQUISITOS</h3>
                <p><?php echo $requisitos; ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($obligaciones)): ?>
            <div class="section">
                <h3>OBLIGACIONES</h3>
                <p><?php echo $obligaciones; ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($descripcion_condiciones)): ?>
            <div class="section">
                <h3>CONDICIONES GENERALES</h3>
                <p><?php echo $descripcion_condiciones; ?></p>
            </div>
        <?php endif; ?>

        <!-- Firmas -->
        <div class="firmas">
            <div class="firma">
                <p>Firma Cliente</p>
                <hr>
            </div>
            <div class="firma">
                <p>Firma Empresa</p>
                <hr>
            </div>
        </div>
    </div>
</body>
</html>