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
    ------------------------------------- INICIO ITred Spa Traer datos bancarios.PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
<?php
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

    if ($stmt_cuenta = $mysqli->prepare($sql_cuenta)) {
        $stmt_cuenta->bind_param("i", $id);
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
?>
<!-- Título: Sección de transferencias bancarias -->
<h2 style="text-align: center;">TRANSFERENCIAS A:</h2> <!-- Título para la sección de transferencias bancarias -->
<!-- Título: Tabla para información bancaria -->
<table style="margin: 0 auto; border-collapse: collapse;"> <!-- Crea una tabla para mostrar la información bancaria para transferencias -->
    <!-- Título: Encabezado de la tabla -->
    <tr>
        <?php if (!empty($bancos)): ?>
            <?php foreach ($bancos as $banco): ?>
                <!-- Título: Columna de tipo de cuenta -->
                <th style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    <?php echo htmlspecialchars($banco['TipoCuentaDescripcion']); ?>
                </th>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Título: Mensaje cuando no hay información bancaria -->
            <th colspan="3" style="text-align: center; border: 1px solid #ddd; padding: 8px;">No hay información bancaria disponible.</th>
        <?php endif; ?>
    </tr>
    <?php if (!empty($bancos)): ?>
        <!-- Título: Filas con información de los bancos -->
        <tr>
            <?php foreach ($bancos as $banco): ?>
                <!-- Título: Celda de banco -->
                <td style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    BANCO: <?php echo htmlspecialchars($banco['BancoNombre']); ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($bancos as $banco): ?>
                <!-- Título: Celda de tipo de cuenta -->
                <td style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    TIPO CUENTA: <?php echo htmlspecialchars($banco['TipoCuentaDescripcion']); ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($bancos as $banco): ?>
                <!-- Título: Celda de número de cuenta -->
                <td style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    NUMERO CUENTA: <?php echo htmlspecialchars($banco['CuentaNumeroCuenta']); ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($bancos as $banco): ?>
                <!-- Título: Celda de nombre del titular -->
                <td style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    NOMBRE: <?php echo htmlspecialchars($banco['CuentaNombreTitular']); ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($bancos as $banco): ?>
                <!-- Título: Celda de RUT del titular -->
                <td style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    RUT: <?php echo htmlspecialchars($banco['CuentaRutTitular']); ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($bancos as $banco): ?>
                <!-- Título: Celda de e-mail del banco -->
                <td style="text-align: center; border: 1px solid #ddd; padding: 8px;">
                    E-MAIL: <?php echo htmlspecialchars($banco['CuentaEmailBanco']); ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endif; ?>
</table>

<script src="../../js/ver_cotizacion/traer_datos_bancarios.js"></script> 

     <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Traer datos bancarios.PHP ----------------------------------------
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
