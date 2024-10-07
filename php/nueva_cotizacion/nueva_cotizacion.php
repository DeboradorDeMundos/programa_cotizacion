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
        ------------------------------------- INICIO ITred Spa Nueva cotizacion .PHP --------------------------------------
        ------------------------------------------------------------------------------------------------------------- -->

    <!-- ------------------------
        -- INICIO CONEXION BD --
        ------------------------ -->

        <?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd');
// ---------------------
// FIN CONEXION BD 
// ---------------------

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
        f.ruta_foto,
        e.id_tipo_firma AS tipo_firma
    FROM e_empresa e
    LEFT JOIN e_FotosPerfil f ON f.id_foto = e.id_foto
    WHERE e.id_empresa = ?";

    if ($stmt_empresa = $mysqli->prepare($sql_empresa)) {
        $stmt_empresa->bind_param("i", $id);
        $stmt_empresa->execute();
        $result_empresa = $stmt_empresa->get_result();

        if ($result_empresa->num_rows == 1) {
            $row = $result_empresa->fetch_assoc();

            // Almacena el tipo de firma
            $tipo_firma = $row['tipo_firma'];

            // Consulta para obtener la firma de la empresa
            $sql_firma = "
            SELECT 
                f.id_firma,
                f.id_empresa,
                f.titulo_firma, 
                f.nombre_encargado_firma, 
                f.cargo_encargado_firma, 
                f.telefono_encargado_firma,
                f.nombre_empresa_firma, 
                f.area_empresa_firma,
                f.telefono_empresa_firma, 
                f.firma_digital,
                f.email_firma, 
                f.direccion_firma, 
                f.ciudad_firma,
                f.pais_firma,
                f.rut_firma,
                f.web_firma
            FROM E_Firmas f
            WHERE f.id_empresa = ?";

            if ($stmt_firma = $mysqli->prepare($sql_firma)) {
                $stmt_firma->bind_param("i", $id);
                $stmt_firma->execute();
                $result_firma = $stmt_firma->get_result();

                if ($result_firma->num_rows == 1) {
                    $firma = $result_firma->fetch_assoc();
                } else {
                    $firma = null; // No hay firma manual
                }

                $stmt_firma->close();
            } else {
                echo "<p>Error al preparar la consulta de la firma: " . $mysqli->error . "</p>";
            }
        } else {
            echo "<p>No se encontró la empresa con el ID proporcionado.</p>";
        }

    } else {
        echo "<p>Error al preparar la consulta de empresa: " . $mysqli->error . "</p>";
    }
} else {
    echo "<p>ID inválido.</p>";
}
?>


    <!DOCTYPE html>
    <html lang="es">
    <head> <!-- Abre el elemento de cabecera que contiene metadatos y enlaces a recursos externos -->
        <meta charset="UTF-8"> <!-- Define la codificación de caracteres como UTF-8 para asegurar la correcta visualización de caracteres especiales y diversos idiomas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista en dispositivos móviles. width=device-width asegura que el ancho de la página se ajuste al ancho de la pantalla del dispositivo, y initial-scale=1.0 establece el nivel de zoom inicial -->
        <title>Formulario de Cotización</title> <!-- Define el título de la página que se muestra en la pestaña del navegador -->
        <link rel="stylesheet" href="../../css/nueva_cotizacion/nueva_cotizacion.css"> <!-- Enlaza una hoja de estilo externa que se encuentra en la ruta especificada para estilizar el contenido de la página -->
    </head> <!-- Cierra el elemento de cabecera -->
    <body> <!-- Abre el elemento del cuerpo de la página donde se coloca el contenido visible -->
        <div class="container"> <!-- Contenedor principal que puede ayudar a centrar y organizar el contenido en la página -->
            <form id="cotizacion-form" method="POST" action="" enctype="multipart/form-data">
                <!-- Formulario con ID "cotizacion-form". Usa el método POST para enviar los datos al servidor. El atributo "action" define el archivo al que se enviarán los datos. "enctype" especifica que el formulario puede enviar archivos -->
                <a href="javascript:history.back()" class="btn-fixed">Volver</a>
                <!-- Fila 1 -->
                <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                    <?php include 'cargar_logo_empresa.php'; ?>

                    <?php include 'cuadro_rojo_cotizacion.php'; ?>

                    <fieldset class="box-6 data-box"> 
                        <label for="fecha_emision">Fecha de Emisión:</label> <!-- Etiqueta para el campo de entrada de la fecha de emisión -->
                        <input type="date" id="fecha_emision" name="fecha_emision" required> <!-- Campo de fecha para seleccionar la fecha de emisión. Es obligatorio --> 
                    </fieldset>
                </div>
                <!-- Fila 2 -->
                <?php include 'datos_empresa.php'; ?>

                <!-- Fila 3 -->
                <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                    <?php include 'detalle_proyecto.php'; ?>

                    
                </div> <!-- Cierra la fila -->

                <!-- Fila 4 -->
                <?php include 'detalle_cliente.php'; ?>

                <!-- Fila 5 -->
                <?php include 'detalle_encargado.php'; ?>

                <!-- Fila 6 -->
                <?php include 'detalle_vendedor.php'; ?>

                <!-- Sección que guarda los datos de la cotizacion -->
                <?php include 'detalle_cotizacion.php'; ?>
                <!-- sección para Detalle de Cotización -->
                <?php include 'detalle.php'; ?>
                
                <!-- Sección para los cálculos finales -->
                <?php include 'detalle_total.php'; ?>
            <!-- Sección para los observaciones -->
                <?php include 'observaciones.php'; ?>
                <br>
                <!-- Sección para los Pagos -->
                <?php include 'pago.php'; ?>
                
               
                <br>
                
                <?php include 'traer_condiciones.php'; ?>

                <?php include 'traer_requisitos.php'; ?>

                <?php include 'obligaciones_cliente.php'; ?>
       
                <button type="submit" class="submit">Crear cotizacion</button> <!-- Botón para enviar el formulario y generar la cotización -->
                </form> <!-- Cierra el formulario -->
                </div> 
                </div> <!-- Cierra el contenedor principal -->



                <?php include 'traer_datos_bancarios.php'; ?>

                <div class="container">

                <?php include 'firma.php'; ?>
                
    <script src="../../js/nueva_cotizacion/nueva_cotizacion.js"></script> <!-- Enlaza nuevamente el archivo JavaScript para manejar la lógica del formulario de cotización -->
    <script src="../../js/crear_empresa/upload_logo.js"></script>
    <script src="../../js/nueva_cotizacion/cargar_logo_empresa.js"></script> 
    <script src="../../js/nueva_cotizacion/cuadro_rojo_cotizacion.js"></script> 
    <script src="../../js/nueva_cotizacion/pago.js"></script> 
    </body>
    </html>



<!-- ---------------------
-- INICIO CIERRE CONEXION BD --
     --------------------- -->
     <?php
     $mysqli->close();
?>
<!-- ---------------------
     -- FIN CIERRE CONEXION BD --
     --------------------- -->

    <!-- ------------------------------------------------------------------------------------------------------------
        -------------------------------------- FIN ITred Spa nueva cotizacion .PHP -----------------------------------
        ------------------------------------------------------------------------------------------------------------- -->

    <!--
    Sitio Web Creado por ITred Spa.
    Direccion: Guido Reni #4190
    Pedro Agui Cerda - Santiago - Chile
    contacto@itred.cl o itred.spa@gmail.com
    https://www.itred.cl
    Creado, Programado y Diseñado por ITredSpa.
    BPPJ
    -->