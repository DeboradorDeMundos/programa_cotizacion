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
            
                <label for="fecha_emision">Fecha de Emisión:</label> <!-- Etiqueta para el campo de entrada de la fecha de emisión -->
                    <input type="date" id="fecha_emision" name="fecha_emision" required> <!-- Campo de fecha para seleccionar la fecha de emisión. Es obligatorio -->
                            
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
            <!-- Sección para Condiciones Generales -->

            <?php include 'condiciones_generales.php'; ?>

            <!-- Sección para Requisitos Básicos -->
             
            <?php include 'requisitos_basicos.php'; ?>


            
            <button type="submit" class="submit">Crear cotizacion</button> <!-- Botón para enviar el formulario y generar la cotización -->
            </form> <!-- Cierra el formulario -->
            </div> <!-- Cierra el contenedor principal -->
            </div> <!-- Cierra el contenedor principal -->

            <?php include 'traer_condiciones.php'; ?>

            <?php include 'traer_datos_bancarios.php'; ?>

            <div class="container">
            <div class="section">
                <h2 class="title">Requisitos y Necesidades Básicas</h2>
                <p>
                Requisitos y Necesidades Básicas, que debe cumplir el cliente, con los trabajadores de Itred SPA. Mediante nuestra estancia en su empresa, oficina, galpón, casa particular, departamento particular u otras instalaciones
                </p>
                <ul class="list">
                <li>Lugar de trabajo libre de objetos, que se puedan romper, dañar o estorbar, para realizar el trabajo En el lugar de trabajo, no puede haber niños, adultos o adultos mayores, que se puedan accidentar o entorpecer el trabajo</li>
                <li>Baño apto y digno, para que utilicen los trabajadores</li>
                <li>Lugar seguro, donde guardar ropa y herramientas grandes, que se utilizaran mediante nuestra estancia</li>
                <li>Lugar donde comer y guardar su comida</li>
                <li>Ideal si se les permite refrigerar y calentar su comida (no es obligación)</li>
                <li>El trabajador debe tener acceso a agua, para beber, aseo personal y trabajar, de forma digna</li>
                </ul>
                <button>Agregar Nuevo Requisito</button>
            </div>

            <div class="section">
                <h2 class="title">Obligaciones del Cliente</h2>
                <p>
                Si el cliente, no puede cumplir con alguno de los requisitos antes mencionados, por favor, comunicar al momento de aceptar el presupuesto, para dar solución, antes de comenzar los trabajos y de ser necesario agregar los gastos extras y recalcular el presupuesto
                </p>
            </div>
            </div>

            <p>SIN OTRO PARTICULAR, Y ESPERANDO QUE LA PRESENTE OFERTA SEA DE SU INTERÉS, SE DESPIDE ATENTAMENTE</p> <!-- Mensaje de despedida en la oferta -->
            <p>BARNER PATRICIO PIÑA JARA</p> <!-- Nombre del remitente -->
            <p>JEFE DE PROYECTO TECNOLOGIA Y CONSTRUCCION</p> <!-- Cargo del remitente -->
            <p>ITRED SPA.</p> <!-- Nombre de la empresa del remitente -->
<script src="../../js/nueva_cotizacion/nueva_cotizacion.js"></script> <!-- Enlaza nuevamente el archivo JavaScript para manejar la lógica del formulario de cotización -->
<script src="../../js/crear_empresa/upload_logo.js"></script>
<script src="../../js/nueva_cotizacion/cargar_logo_empresa.js"></script> 

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