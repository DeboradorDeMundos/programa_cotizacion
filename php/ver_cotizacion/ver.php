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
    <!-- Título: Contenedor de botones -->
    <!-- Contenedor de botones -->
    <div class="button-contenedor">
        <!-- Título: Botón Volver -->
        <button class="button volver" onclick="window.history.back()">Volver</button>
        <!-- Título: Botón Imprimir -->
        <button class="button imprimir" onclick="imprimir()">Imprimir</button>
        <!-- Título: Botón Volver al listado -->
        <button class="button volver listado" onclick="location.href='ver_listado.php?id=<?php echo $id_empresa; ?>'">Volver al listado</button>
        <!-- Título: Botón Modificar cotización -->
        <button class="button Modificar" onclick="location.href='modificar_cotizacion.php?id=<?php echo $id_empresa; ?>'">Modificar cotización</button>
    </div>

    <!-- Título: Contenedor principal -->
    <!-- Contenedor principal -->
    <div class="contenedor">
        <!-- Título: Importar la marca de agua -->
        <!-- Importar la marca de agua -->
        <?php include 'marca_de_agua.php'; ?>

        <!-- Título: Header -->
        <?php include 'header.php'; ?>
        <!-- Título: Información del cliente -->
        <?php include 'info_cliente.php'; ?>
        <!-- Título: Detalle -->
        <?php include 'detalle.php'; ?>
        <!-- Título: Totales -->
        <?php include 'totales.php'; ?>

        <!-- Título: Tabla de totales -->
        <table class="totals">
            <tr class="son">
                <td colspan="2">
                    <strong>SON:</strong> <span id="total_final_letras"><?php echo htmlspecialchars($totales['total_final_letras']); ?></span> PESOS
                </td>
            </tr>
        </table>

        <!-- Título: Ver pagos -->
        <?php include 'ver_pago.php'; ?>

        <!-- Título: Tabla de requisitos, condiciones y obligaciones -->
        <table>
            <tr>
                <td>
                    <!-- Título: Ver requisitos -->
                    <?php include 'ver_requisitos.php'; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <!-- Título: Ver condiciones -->
                    <?php include 'ver_condiciones.php'; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <!-- Título: Ver obligaciones -->
                    <?php include 'ver_obligaciones.php'; ?>
                </td>
            </tr>
        </table>

        <!-- Título: Mensaje de despedida -->
        <div>
            <?php include 'mensaje_despedida.php'; ?>
        </div>

        <!-- Título: Bancos -->
        <?php include 'bancos.php'; ?>

        <!-- Título: Posicionar firma -->
        <?php include 'posicionar_firma.php'; ?>

    </div>

    <!-- Título: Script -->
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
