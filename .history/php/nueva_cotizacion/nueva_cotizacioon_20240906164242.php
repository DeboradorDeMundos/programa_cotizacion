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
    ------------------------------------- INICIO ITred Spa Agregar Banco.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

     <?php
// Establece la conexión a la base de datos de ITred Spa
$conn = new mysqli('localhost', 'root', '', 'ITredSpa_bd');
?>
<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->
        
     <?php

// Obtener el ID de la empresa desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Preparar la consulta para obtener los detalles de la empresa
    $sql_empresa = "SELECT 
        e.rut_empresa AS EmpresaRUT,
        e.nombre_empresa AS EmpresaNombre,
        e.area_empresa AS EmpresaArea,
        e.direccion_empresa AS EmpresaDireccion,
        e.telefono_empresa AS EmpresaTelefono,
        e.email_empresa AS EmpresaEmail,
        f.ruta_foto
    FROM e_empresa e
    LEFT JOIN e_FotosPerfil f ON f.id_foto = e.id_foto
    WHERE e.id_empresa = ?";

    if ($stmt_empresa = $conn->prepare($sql_empresa)) {
        $stmt_empresa->bind_param("i", $id);
        $stmt_empresa->execute();
        $result_empresa = $stmt_empresa->get_result();

        if ($result_empresa->num_rows == 1) {
            $row = $result_empresa->fetch_assoc();

            // Preparar la consulta para obtener los detalles de las cuentas bancarias
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

            if ($stmt_cuenta = $conn->prepare($sql_cuenta)) {
                $stmt_cuenta->bind_param("i", $id);
                $stmt_cuenta->execute();
                $result_cuenta = $stmt_cuenta->get_result();

                $bancos = [];
                while ($banco = $result_cuenta->fetch_assoc()) {
                    $bancos[] = $banco;
                }

                $stmt_cuenta->close();
            } else {
                echo "<p>Error al preparar la consulta de cuenta bancaria: " . $conn->error . "</p>";
            }

            // Consulta para obtener las condiciones generales de la empresa
            $query = "SELECT indice, descripcion_condiciones FROM e_requisitos_Basicos WHERE id_empresa = ?";
            if ($stmt_req = $conn->prepare($query)) {
                $stmt_req->bind_param('i', $id);
                $stmt_req->execute();
                $result_req = $stmt_req->get_result();
                $requisitos = $result_req->fetch_all(MYSQLI_ASSOC);
                $stmt_req->close();
            } else {
                echo "<p>Error al preparar la consulta de requisitos: " . $conn->error . "</p>";
            }

            // Obtener el número de cotización más alto para la empresa específica
            $sql_last_cot = "SELECT numero_cotizacion FROM C_Cotizaciones WHERE id_empresa = ? ORDER BY numero_cotizacion DESC LIMIT 1";
            if ($stmt_last_cot = $conn->prepare($sql_last_cot)) {
                $stmt_last_cot->bind_param("i", $id);
                $stmt_last_cot->execute();
                $stmt_last_cot->bind_result($last_num_cotizacion);
                $stmt_last_cot->fetch();
                $stmt_last_cot->close();

                $numero_cotizacion = ($last_num_cotizacion) ? (int)$last_num_cotizacion + 1 : 1;
            } else {
                echo "<p>Error al preparar la consulta de cotización: " . $conn->error . "</p>";
            }
        } else {
            echo "<p>No se encontró la empresa con el ID proporcionado.</p>";
        }

        $stmt_empresa->close();
    } else {
        echo "<p>Error al preparar la consulta de empresa: " . $conn->error . "</p>";
    }
} else {
    echo "<p>ID inválido.</p>";
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Cotización</title>

    <link rel="stylesheet" href="../../css/nueva_cotizacion/cargar_logo_empresa.css"> <!-- Archivo CSS del logo -->
</head>
<body>

    <!-- Incluye la sección del logo desde PHP -->
    <?php include 'cargar_logo_empresa.php'; ?>

    <!-- Resto del código HTML -->

    <form id="cotizacion-form" action="procesar_cotizacion.php" method="post">
        <!-- Campos del formulario -->

        <button type="submit" class="submit">Crear cotización</button> <!-- Botón para enviar el formulario y generar la cotización -->
    </form>

    <script src="../../js/nueva_cotizacion/nueva_cotizacion.js"></script> <!-- Archivo JS principal -->
    <script src="../../js/nueva_cotizacion/cargar_logo_empresa.js"></script> <!-- Archivo JS del logo -->
</body>
</html>


     
     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Agregar Banco .PHP ----------------------------------------
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
