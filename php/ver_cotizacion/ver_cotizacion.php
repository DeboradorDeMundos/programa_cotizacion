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
    // Paso 1: Obtener los IDs de los títulos relacionados con la cotización
    $sql_titulo = "SELECT id_titulo FROM C_Titulos WHERE id_cotizacion = ?";
    $stmt_titulo = $conn->prepare($sql_titulo);
    $stmt_titulo->bind_param("i", $id_cotizacion);
    $stmt_titulo->execute();
    $result_titulo = $stmt_titulo->get_result();

    if ($result_titulo->num_rows > 0) {
        $titulo_ids = [];
        while ($row_titulo = $result_titulo->fetch_assoc()) {
            $titulo_ids[] = $row_titulo['id_titulo'];
        }
        $stmt_titulo->close();

        // Convertir el array de IDs a una lista separada por comas
        $titulo_ids_list = implode(',', $titulo_ids);

        // Paso 2: Obtener los datos de la cotización y relaciones
        $sql_cotizacion = "SELECT 
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
            ob.descripcion AS obligaciones,
            ctot.sub_total,
            ctot.total_iva,
            ctot.total_final
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
            LEFT JOIN C_totales ctot ON ctot.id_cotizacion = ct.id_cotizacion 
        WHERE 
            ct.id_cotizacion = ?";
        
        $stmt_cotizacion = $conn->prepare($sql_cotizacion);
        $stmt_cotizacion->bind_param("i", $id_cotizacion);
        $stmt_cotizacion->execute();
        $result_cotizacion = $stmt_cotizacion->get_result();

        // Inicializar variables
        $subtotal = $iva = $total_final = 0;

        if ($result_cotizacion->num_rows > 0) {
            while ($row_cotizacion = $result_cotizacion->fetch_assoc()) {
                // Almacenar los datos en variables para mostrarlos más tarde
                $numero_cotizacion = $row_cotizacion['numero_cotizacion'];
                $fecha_emision = $row_cotizacion['fecha_emision'];
                $fecha_validez = $row_cotizacion['fecha_validez'];
                
                // Detalles del cliente
                $nombre_cliente = $row_cotizacion['nombre_cliente'];
                $rut_cliente = $row_cotizacion['rut_cliente'];
                $direccion_cliente = $row_cotizacion['direccion_cliente'];
                $telefono_cliente = $row_cotizacion['telefono_cliente'];
                $email_cliente = $row_cotizacion['email_cliente'];
                $giro_cliente = $row_cotizacion['giro_cliente'];
                $comuna_cliente = $row_cotizacion['comuna_cliente'];
                $ciudad_cliente = $row_cotizacion['ciudad_cliente'];
                
                // Detalles de la empresa
                $nombre_empresa = $row_cotizacion['nombre_empresa'];
                $rut_empresa = $row_cotizacion['rut_empresa'];
                $direccion_empresa = $row_cotizacion['direccion_empresa'];
                $telefono_empresa = $row_cotizacion['telefono_empresa'];
                $email_empresa = $row_cotizacion['email_empresa'];
                $area_empresa = $row_cotizacion['area_empresa'];
                
                // Detalles del proyecto
                $nombre_proyecto = $row_cotizacion['nombre_proyecto'];
                $codigo_proyecto = $row_cotizacion['codigo_proyecto'];
                $tipo_trabajo = $row_cotizacion['tipo_trabajo'];
                $area_trabajo = $row_cotizacion['area_trabajo'];
                $riesgo_proyecto = $row_cotizacion['riesgo_proyecto'];
                
                // Detalles del encargado
                $nombre_encargado = $row_cotizacion['nombre_encargado'];
                $email_encargado = $row_cotizacion['email_encargado'];
                $fono_encargado = $row_cotizacion['fono_encargado'];
                $celular_encargado = $row_cotizacion['celular_encargado'];
                
                // Detalles del vendedor
                $nombre_vendedor = $row_cotizacion['nombre_vendedor'];
                $email_vendedor = $row_cotizacion['email_vendedor'];
                $fono_vendedor = $row_cotizacion['fono_vendedor'];
                $celular_vendedor = $row_cotizacion['celular_vendedor'];

                // Totales (Asegurarse de que existan)
                $subtotal = $row_cotizacion['sub_total'] ?? 0;
                $iva = $row_cotizacion['total_iva'] ?? 0;
                $total_final = $row_cotizacion['total_final'] ?? 0;
            }
        } else {
            echo "No se encontró la cotización.";
        }

        $stmt_cotizacion->close();

        // Paso 3: Obtener los detalles de los productos usando los IDs de los títulos
        $sql_productos = "SELECT nombre_producto, cantidad, precio_unitario, total 
                          FROM C_Detalles 
                          WHERE id_titulo IN ($titulo_ids_list)";

        $stmt_productos = $conn->prepare($sql_productos);
        $stmt_productos->execute();
        $result_productos = $stmt_productos->get_result();

        // Inicializar el array de productos
        $productos = [];

        while ($row_producto = $result_productos->fetch_assoc()) {
            $productos[] = array(
                'nombre_producto' => $row_producto['nombre_producto'] ?? 'No disponible',
                'cantidad' => $row_producto['cantidad'] ?? 0,
                'precio_unitario' => $row_producto['precio_unitario'] ?? 0,
                'total' => $row_producto['total'] ?? 0
            );
        }

        $stmt_productos->close();
    } else {
        echo "No se encontraron títulos para la cotización.";
    }
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
        .cotizacion-contenedor { width: 800px; margin: 20px auto; background-color: #ffffff; padding: 20px; border: 1px solid #cccccc; }
        header { display: flex; justify-content: space-between; align-items: center; }
        .header-left { font-size: 14px; }
        .header-left h2 { font-size: 28px; color: #007bff; margin: 0; }
        .header-right .logo { width: 150px; }
        .section { margin-top: 20px; }
        h3 { font-size: 14px; color: #007bff; margin-bottom: 5px; }
        .info { padding: 10px 0; }
        .section-contenedor { display: flex; flex-wrap: wrap; gap: 20px; }
        .section-contenedor .section { flex: 1 1 calc(50% - 20px); box-sizing: border-box; }
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
    <div class="cotizacion-contenedor">
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
        <div class="section-contenedor">
            <!-- Detalles de la Empresa -->

            <?php include 'detalles_empresa.php'; ?>

            <!-- Detalles del Proyecto -->
             <?php include 'detalles_proyecto.php'; ?>

            <!-- Detalles del Cliente -->
             <?php include 'detalle_cliente.php'; ?>


            <!-- Detalles del Encargado -->
             <?php include 'detalle_encargado.php'; ?>

            <!-- Detalles del Vendedor -->
             <?php include 'detalle_vendedor.php'; ?>

        </div>

        <!-- Productos -->
        <?php include 'detalle_productos.php'; ?>

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