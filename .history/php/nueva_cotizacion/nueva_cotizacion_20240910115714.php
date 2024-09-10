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

        if ($stmt_empresa = $mysqli->prepare($sql_empresa)) {
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



                // Aquí va la consulta para obtener "dias_validez"
                $sql_validez = "SELECT dias_validez FROM E_Empresa WHERE id_empresa = ? ";
                if ($stmt_validez = $mysqli->prepare($sql_validez)) {
                    $stmt_validez->bind_param("i", $id);
                    $stmt_validez->execute();
                    $stmt_validez->bind_result($dias_validez);
                    $stmt_validez->fetch();
                    $stmt_validez->close();
                } else {
                    echo "<p>Error al preparar la consulta de días de validez: " . $mysqli->error . "</p>";
                }




                // Consulta para obtener los requisitos básicos
                $query_requisitos = "SELECT indice, descripcion_condiciones FROM E_Requisitos_Basicos WHERE id_empresa = ?";
                if ($stmt_req = $mysqli->prepare($query_requisitos)) {
                    $stmt_req->bind_param('i', $id);
                    $stmt_req->execute();
                    $result_req = $stmt_req->get_result();
                    $requisitos = $result_req->fetch_all(MYSQLI_ASSOC);
                    $stmt_req->close();
                } else {
                    echo "<p>Error al preparar la consulta de requisitos: " . $mysqli->error . "</p>";
                }

                // Consulta para obtener las condiciones generales
                $query_condiciones = "SELECT id_condiciones, descripcion_condiciones FROM C_Condiciones_Generales WHERE id_empresa = ?";
                if ($stmt_cond = $mysqli->prepare($query_condiciones)) {
                    $stmt_cond->bind_param('i', $id);
                    $stmt_cond->execute();
                    $result_cond = $stmt_cond->get_result();
                    $condiciones = $result_cond->fetch_all(MYSQLI_ASSOC);
                    $stmt_cond->close();
                } else {
                    echo "<p>Error al preparar la consulta de condiciones generales: " . $mysqli->error . "</p>";
                }
                
                // Obtener el número de cotización más alto para la empresa específica
                $sql_last_cot = "SELECT numero_cotizacion FROM C_Cotizaciones WHERE id_empresa = ? ORDER BY numero_cotizacion DESC LIMIT 1";
                if ($stmt_last_cot = $mysqli->prepare($sql_last_cot)) {
                    $stmt_last_cot->bind_param("i", $id);
                    $stmt_last_cot->execute();
                    $stmt_last_cot->bind_result($last_num_cotizacion);
                    $stmt_last_cot->fetch();
                    $stmt_last_cot->close();
                    $numero_cotizacion = ($last_num_cotizacion) ? (int)$last_num_cotizacion + 1 : 1;
                } else {
                    echo "<p>Error al preparar la consulta de cotización: " . $mysqli->error . "</p>";
                }
            } else {
                echo "<p>No se encontró la empresa con el ID proporcionado.</p>";
            }

            $stmt_empresa->close();
        } else {
            echo "<p>Error al preparar la consulta de empresa: " . $mysqli->error . "</p>";
        }
    } else {
        echo "<p>ID inválido.</p>";
    }

    //<!-- ---------------------
    //-- INICIO CIERRE CONEXION BD --
    //     --------------------- -->

        $mysqli->close();

    //<!-- ---------------------
    //     -- FIN CIERRE CONEXION BD --
    //     --------------------- -->
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
            <form id="cotizacion-form" method="POST" action="procesar_cotizacion.php" enctype="multipart/form-data">
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

                    <?php include 'detalle_cotizacion.php'; ?>
                </div> <!-- Cierra la fila -->

                <!-- Fila 4 -->
                <?php include 'detalle_cliente.php'; ?>

                <!-- Fila 5 -->
                <?php include 'detalle_encargado.php'; ?>

                <!-- Fila 6 -->
                <?php include 'detalle_vendedor.php'; ?>

                
                <!-- sección para Detalle de Cotización -->
                <?php include 'detalle.php'; ?>
                
                <!-- Sección para los cálculos finales -->

                <?php include 'detalle_total.php'; ?>

                <br>

                <?php include 'adelanto.php'; ?>

                <br>

                
                <button type="submit" class="submit">Crear cotizacion</button> <!-- Botón para enviar el formulario y generar la cotización -->
                </form> <!-- Cierra el formulario -->
                </div> <!-- Cierra el contenedor principal -->
                </div> <!-- Cierra el contenedor principal -->

                <?php include 'traer_condiciones.php'; ?>

                <?php include 'traer_requisitos.php'; ?>

                <?php include 'traer_datos_bancarios.php'; ?>

                <div class="container">
            


                <p>AQUI VIENE LA FIRMA</p>
                <p>SIN OTRO PARTICULAR, Y ESPERANDO QUE LA PRESENTE OFERTA SEA DE SU INTERÉS, SE DESPIDE ATENTAMENTE</p> <!-- Mensaje de despedida en la oferta -->
                <p>BARNER PATRICIO PIÑA JARA</p> <!-- Nombre del remitente -->
                <p>JEFE DE PROYECTO TECNOLOGIA Y CONSTRUCCION</p> <!-- Cargo del remitente -->
                <p>ITRED SPA.</p> <!-- Nombre de la empresa del remitente -->
    <script src="../../js/nueva_cotizacion/nueva_cotizacion.js"></script> <!-- Enlaza nuevamente el archivo JavaScript para manejar la lógica del formulario de cotización -->
    <script src="../../js/crear_empresa/upload_logo.js"></script>
    <script src="../../js/nueva_cotizacion/cargar_logo_empresa.js"></script> 
    <script src="../../js/nueva_cotizacion/cuadro_rojo_cotizacion.js"></script> 
    <script src="../../js/nueva_cotizacion/detalle.js"></script> 
    </body>
    </html>




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