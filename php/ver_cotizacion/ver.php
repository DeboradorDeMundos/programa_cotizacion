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
    ------------------------------------- INICIO ITred Spa Ver .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

<?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');
?>

<!-- ------------------------
     -- FINAL CONEXION BD --
     ------------------------ -->
     
     <?php

if (isset($_GET['id_empresa']) && is_numeric($_GET['id_empresa'])) {
    $id_empresa = (int) $_GET['id_empresa'];
    // Ejecutar consulta SQL con el ID recibido
} else {
    die("Error: ID de empresa no válida.");
}



if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_cotizacion = (int) $_GET['id'];
    // Ejecutar consulta SQL con el ID recibido
} else {
    die("Error: ID de cotización no válida.");
}


?>




     <html>
<head>
    <link rel="stylesheet" href="../../css/ver_cotizacion/ver.css">

</head>
<body>
    <!-- TÍTULO: CONTENEDOR DE BOTONES -->
    <!-- Contenedor de botones -->
    <div class="button-contenedor">
        <!-- TÍTULO: BOTÓN VOLVER -->
        <button class="button volver" onclick="window.history.back()">Volver</button>
        <!-- TÍTULO: BOTÓN IMPRIMIR -->
        <button class="button imprimir" onclick="imprimir()">Imprimir</button>
        <!-- TÍTULO: BOTÓN VOLVER AL LISTADO -->
        <button class="button volver listado" onclick="location.href='ver_listado.php?id=<?php echo $id_empresa; ?>'">Volver al listado</button>
        <!-- TÍTULO: BOTÓN MODIFICAR COTIZACIÓN -->
        <button class="button Modificar" onclick="location.href='modificar_cotizacion.php?id=<?php echo $id_empresa; ?>'">Modificar cotización</button>
    </div>

    <!-- TÍTULO: CONTENEDOR PRINCIPAL -->
    <!-- Contenedor principal -->
    <div class="contenedor">
        <!-- TÍTULO: IMPORTAR LA MARCA DE AGUA -->
        <!-- Importar la marca de agua -->
        <?php include 'marca_de_agua.php'; ?>

        <!-- TÍTULO: HEADER -->
        <?php include 'header.php'; ?>
        <!-- TÍTULO: INFORMACIÓN DEL CLIENTE -->
        <?php include 'info_cliente.php'; ?>
        <!-- TÍTULO: DETALLE -->
        <?php include 'detalle.php'; ?>
        <!-- TÍTULO: TOTALES -->
        <?php include 'totales.php'; ?>

        <!-- TÍTULO: TABLA DE TOTALES -->
        <table class="totals">
            <tr class="son">
                <td colspan="2">
                    <strong>SON:</strong> <span id="total_final_letras"><?php echo htmlspecialchars($totales['total_final_letras']); ?></span> PESOS
                </td>
            </tr>
        </table>

        <!-- TÍTULO: VER PAGOS -->
        <?php include 'ver_pago.php'; ?>

        <!-- TÍTULO: TABLA DE REQUISITOS, CONDICIONES Y OBLIGACIONES -->
        <table>
            <tr>
                <td>
                    <!-- TÍTULO: VER REQUISITOS -->
                    <?php include 'ver_requisitos.php'; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <!-- TÍTULO: VER CONDICIONES -->
                    <?php include 'ver_condiciones.php'; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <!-- TÍTULO: VER OBLIGACIONES -->
                    <?php include 'ver_obligaciones.php'; ?>
                </td>
            </tr>
        </table>

        <!-- TÍTULO: MENSAJE DE DESPEDIDA -->
        <div>
            <?php include 'mensaje_despedida.php'; ?>
        </div>

        <!-- TÍTULO: BANCOS -->
        <?php include 'bancos.php'; ?>

        <!-- TÍTULO: POSICIONAR FIRMA -->
        <?php include 'posicionar_firma.php'; ?>

    </div>

    <!-- TÍTULO: SCRIPT -->
    <script src="../../js/ver_cotizacion/ver.js"></script>
</body>
</html>

<?php 
// Cerrar la conexión principal al final
$mysqli->close();
?>
<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa  Ver .PHP -----------------------------------
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
