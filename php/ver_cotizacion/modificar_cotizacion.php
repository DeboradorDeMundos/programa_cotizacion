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
    ------------------------------------- INICIO ITred Spa Modificar cotizacion .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd');
?>
<!-- ---------------------
// FIN CONEXION BD --
// --------------------- -->

<?php
// Obtener el ID de la cotización desde la URL
$id_cotizacion = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_cotizacion > 0) {
    // Preparar la consulta para obtener los detalles de la cotización
    $sql_cotizacion = "SELECT 
        c.numero_cotizacion AS NumeroCotizacion,
        c.id_empresa AS EmpresaID,
        c.fecha_validez AS FechaValidez,
        e.rut_empresa AS EmpresaRUT,
        e.nombre_empresa AS EmpresaNombre,
        e.area_empresa AS EmpresaArea,
        e.direccion_empresa AS EmpresaDireccion,
        e.telefono_empresa AS EmpresaTelefono,
        e.email_empresa AS EmpresaEmail,
        f.ruta_foto
    FROM C_Cotizaciones c
    LEFT JOIN e_empresa e ON c.id_empresa = e.id_empresa
    LEFT JOIN e_FotosPerfil f ON f.id_foto = e.id_foto
    WHERE c.id_cotizacion = ?";

    if ($stmt_cotizacion = $mysqli->prepare($sql_cotizacion)) {
        $stmt_cotizacion->bind_param("i", $id_cotizacion);
        $stmt_cotizacion->execute();
        $result_cotizacion = $stmt_cotizacion->get_result();

        if ($result_cotizacion->num_rows == 1) {
            $row = $result_cotizacion->fetch_assoc();
            $id_empresa = $row['EmpresaID'];
            $fecha_validez = $row['FechaValidez'];
            
            // Obtener los detalles de las cuentas bancarias
            $sql_cuenta = "SELECT 
                cb.id_cuenta AS CuentaID,
                cb.rut_titular AS CuentaRutTitular,
                cb.nombre_titular AS CuentaNombreTitular,
                cb.numero_cuenta AS CuentaNumeroCuenta,
                cb.celular AS CuentaCelular,
                cb.email_banco AS CuentaEmailBanco,
                t.tipocuenta AS TipoCuentaDescripcion,
                b.nombre_banco AS BancoNombre
            FROM E_Cuenta_Bancaria cb
            LEFT JOIN E_Tipo_Cuenta t ON cb.id_tipocuenta = t.id_tipocuenta
            LEFT JOIN E_Bancos b ON cb.id_banco = b.id_banco
            WHERE cb.id_empresa = ?";

            if ($stmt_cuenta = $mysqli->prepare($sql_cuenta)) {
                $stmt_cuenta->bind_param("i", $id_empresa);
                $stmt_cuenta->execute();
                $result_cuenta = $stmt_cuenta->get_result();

                $bancos = [];
                while ($banco = $result_cuenta->fetch_assoc()) {
                    $bancos[] = $banco;
                }

                $stmt_cuenta->close();
            } else {
                echo "<p>Error al preparar la consulta de cuenta bancaria: " . $mysqli->error . "</p>";
            }

            // Consultar los detalles de los pagos
            $query_pagos = "SELECT numero_pago, descripcion, porcentaje_pago, monto_pago, fecha_pago FROM C_pago WHERE id_cotizacion = ?";
            if ($stmt_pagos = $mysqli->prepare($query_pagos)) {
                $stmt_pagos->bind_param('i', $id_cotizacion);
                $stmt_pagos->execute();
                $result_pagos = $stmt_pagos->get_result();
                $pagos = $result_pagos->fetch_all(MYSQLI_ASSOC);
                $stmt_pagos->close();
            } else {
                echo "<p>Error al preparar la consulta de pagos: " . $mysqli->error . "</p>";
            }
        } else {
            echo "<p>No se encontró la cotización con el ID proporcionado.</p>";
        }

        $stmt_cotizacion->close();
    } else {
        echo "<p>Error al preparar la consulta de cotización: " . $mysqli->error . "</p>";
    }
} else {
    echo "<p>ID de cotización inválido.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Cotización</title>
    <link rel="stylesheet" href="../../css/ver_cotizacion/modificar_cotizacion.css">
</head>
<body>
    <?php echo isset($mensaje) ? $mensaje : ''; ?>
    
    <?php if (isset($row)): ?>
    <form method="POST" action="procesar_modificacion.php" enctype="multipart/form-data">
        <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
            <?php include 'cargar_logo_empresa.php'; ?>

            <?php include 'cuadro_rojo_cotizacion.php'; ?>

            <fieldset class="box-6 data-box"> 
                <label for="fecha_emision">Fecha de Emisión:</label> <!-- Etiqueta para el campo de entrada de la fecha de emisión -->
                <input type="date" id="fecha_emision" name="fecha_emision" required> <!-- Campo de fecha para seleccionar la fecha de emisión. Es obligatorio --> 
            </fieldset>
        </div> <!-- Cierra la fila -->

        <!-- Fila 2 -->
        <?php include 'datos_empresa.php'; ?>

        <!-- Fila 3 -->
        <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
            <?php include 'traer_proyecto.php'; ?>
        </div> <!-- Cierra la fila -->

        <!-- Fila 4 -->
         <?php include 'traer_cliente.php'; ?>

        <!-- Fila 5 -->
         <?php include 'traer_encargado.php'; ?>

        <!-- Fila 6 -->
         <?php include 'traer_vendedor.php'; ?>

            
        <!-- sección para Detalle de Cotización -->
         <?php include 'traer_detalle.php'; ?>

        <!-- Sección para los cálculos finales -->
         <?php include 'traer_totales.php'; ?>

         <?php include 'observaciones.php'; ?>

         <?php include 'traer_pago.php'; ?>

         <button type="submit" class="submit">Guardar cambios</button> <!-- Botón para enviar el formulario y generar la cotización -->
        
        </form> <!-- Cierra el formulario -->
        </div> <!-- Cierra el contenedor principal -->
        <?php include 'traer_condiciones.php'; ?>

        <?php include 'traer_requisitos.php'; ?>

        <?php include 'obligaciones_cliente.php'; ?>

        <?php include 'traer_datos_bancarios.php'; ?>

        <table>
        <tr>
            
            <td>
                <?php include 'posicionar_firma.php'; ?>

            </td>
        </tr>
        </table>
    <?php endif; ?>

    <ul>
        <li><a href="../ver_cotizacion/ver_cotizacion.php?id=<?php echo $id; ?>">Ver Cotización</a></li>
        <li><a href="../ver_listado/ver_listado.php">Volver al Listado</a></li>
    </ul>
          
    <script src="../../js/nueva_cotizacion/nueva_cotizacion.js"></script> <!-- Enlaza nuevamente el archivo JavaScript para manejar la lógica del formulario de cotización -->
    <script src="../../js/crear_empresa/upload_logo.js"></script>
    <script src="../../js/nueva_cotizacion/cargar_logo_empresa.js"></script> 
    <script src="../../js/nueva_cotizacion/cuadro_rojo_cotizacion.js"></script> 
    <script src="../../js/nueva_cotizacion/pago.js"></script> 


</body>
</html>


<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Modificar Cotizacion .PHP ----------------------------------------
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
