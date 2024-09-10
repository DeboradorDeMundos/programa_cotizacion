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
               
                
                <fieldset class="box-6 data-box data-box-red"> <!-- Crea una caja para ingresar datos, ocupando otras 6 columnas. Se aplica una clase adicional para estilo -->
                    <legend>Detalle Cotización</legend>
                    <label for="empresa_rut">RUT de la Empresa:</label> <!-- Etiqueta para el campo de entrada del RUT de la empresa -->
                    <input type="text" id="empresa_rut" name="empresa_rut" 
                        minlength="7" maxlength="12" 
                        required oninput="formatRut(this)" 
                        value="<?php echo htmlspecialchars($row['EmpresaRUT']); ?>"> <!-- Campo de texto para ingresar el RUT de la empresa. El atributo "required" hace que el campo sea obligatorio -->
                    
                    <label for="numero_cotizacion">Número de Cotización:</label> <!-- Etiqueta para el campo de entrada del número de cotización -->
                    <input type="text" id="numero_cotizacion" name="numero_cotizacion" required pattern="\d+" value="<?php echo htmlspecialchars($numero_cotizacion); ?>"> <!-- Campo de correo electrónico para ingresar el email de la empresa. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
                     <!-- Campo de texto para ingresar el número de cotización. También es obligatorio -->
                    
                    <label for="validez_cotizacion">dias Validez</label> <!-- Etiqueta para el campo de entrada de la validez de la cotización -->
                    <input type="number" id="validez_cotizacion" name="validez_cotizacion" required min="1" required placeholder="30" > <!-- Campo de número para ingresar la validez de la cotización en días. El atributo "required" asegura que no se deje vacío -->
                    
                    <label for="fecha_emision">Fecha de Emisión:</label> <!-- Etiqueta para el campo de entrada de la fecha de emisión -->
                    <input type="date" id="fecha_emision" name="fecha_emision" required> <!-- Campo de fecha para seleccionar la fecha de emisión. Es obligatorio -->

                    <label for="fecha_validez">Fecha de Validez:</label>
                    <input type="date" id="fecha_validez" name="fecha_validez" readonly> <!-- Campo de fecha de validez -->
                    </div>
                </fieldset>
            

            <!-- Fila 2 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <fieldset class="box-12 data-box"> <!-- Crea una caja para ingresar datos, ocupando las 12 columnas disponibles en el diseño. Esta caja contiene varios campos de entrada de datos -->
                    <legend>Detalle empresa</legend>

                    <input type="text" id="empresa-id" name="empresa_id" value="<?php echo htmlspecialchars($id); ?>" hidden> <!-- Campo de texto para ingresar el nombre de la empresa. El atributo "required" hace que el campo sea obligatorio -->
                    
                    <div class="form-group">
                        <label for="empresa_nombre">Nombre</label> <!-- Etiqueta para el campo de entrada del nombre de la empresa -->
                        <input type="text" id="empresa_nombre" name="empresa_nombre" value="<?php echo htmlspecialchars($row['EmpresaNombre']); ?>"> <!-- Campo de texto para ingresar el nombre de la empresa. El atributo "required" hace que el campo sea obligatorio -->
                    </div>

                    <div class="form-group">
                        <label for="empresa_area">Área</label> <!-- Etiqueta para el campo de entrada del área de la empresa -->
                        <input type="text" id="empresa_area" name="empresa_area" value="<?php echo htmlspecialchars($row['EmpresaArea']); ?>"> <!-- Campo de texto para ingresar el área de la empresa. Este campo no es obligatorio -->
                    </div>
                    <div class="form-group">
                        <label for="empresa_direccion">Dirección</label> <!-- Etiqueta para el campo de entrada de la dirección de la empresa -->
                        <input type="text" id="empresa_direccion" name="empresa_direccion" value="<?php echo htmlspecialchars($row['EmpresaDireccion']); ?>"> <!-- Campo de texto para ingresar la dirección de la empresa. Este campo no es obligatorio -->
                    </div>
                    <div class="form-group">
                        <label for="empresa_telefono">Teléfono</label> <!-- Etiqueta para el campo de entrada del teléfono de la empresa -->
                        <input type="text" id="empresa_telefono" name="empresa_telefono" pattern="\+?\d{7,15}" placeholder="+1234567890" value="<?php echo htmlspecialchars($row['EmpresaTelefono']); ?>"> <!-- Campo de texto para ingresar el teléfono de la empresa. Este campo no es obligatorio -->
                    </div>
                    <div class="form-group">
                        <label for="empresa_email">Email</label> <!-- Etiqueta para el campo de entrada del email de la empresa -->
                        <input type="email" id="empresa_email" name="empresa_email" value="<?php echo htmlspecialchars($row['EmpresaEmail']); ?>"> <!-- Campo de correo electrónico para ingresar el email de la empresa. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
                    </div>
                </fieldset> <!-- Cierra la caja de datos -->
            </div> <!-- Cierra la fila -->

            <!-- Fila 3 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <fieldset class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
                    <legend>Detalle proyecto</legend>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="proyecto_nombre">Nombre</label> <!-- Etiqueta para el campo de entrada del nombre del proyecto -->
                            <input type="text" id="proyecto_nombre" name="proyecto_nombre" placeholder="proyecto" required> <!-- Campo de texto para ingresar el nombre del proyecto. El atributo "required" hace que el campo sea obligatorio -->
                        </div>
                        <div class="form-group">
                            <label for="proyecto_codigo">Código</label> <!-- Etiqueta para el campo de entrada del código del proyecto -->
                            <input type="text" id="proyecto_codigo" name="proyecto_codigo" placeholder="1234" required> <!-- Campo de texto para ingresar el código del proyecto. También es obligatorio -->
                        </div>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="area_trabajo">Área de Trabajo:</label> <!-- Etiqueta para el campo de entrada del área de trabajo -->
                            <input type="text" id="area_trabajo" name="area_trabajo" placeholder="tecnologia" required> <!-- Campo de texto para ingresar el área de trabajo. Este campo es obligatorio -->
                        </div>
                        <div class="form-group">
                            <label for="tipo_trabajo">Tipo de Trabajo:</label> <!-- Etiqueta para el campo de entrada del tipo de trabajo -->
                            <input type="text" id="tipo_trabajo" name="tipo_trabajo" placeholder="instalacion" required> <!-- Campo de texto para ingresar el tipo de trabajo. También es obligatorio -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="riesgo">Riesgo:</label> <!-- Etiqueta para el campo de entrada del riesgo asociado al proyecto -->
                        <input type="text" id="riesgo" name="riesgo" placeholder="nivel de riesgo" required> <!-- Campo de texto para ingresar el nivel o tipo de riesgo. Este campo es obligatorio -->
                    </div>
                </fieldset>
                <fieldset class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
                    <legend>Detalle</legend>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="dias_compra">Días de Compra:</label> <!-- Etiqueta para el campo de entrada de los días de compra -->
                            <input type="number" id="dias_compra" name="dias_compra" placeholder="ingrese N° de dias"> <!-- Campo de número para ingresar la cantidad de días de compra. Este campo no es obligatorio -->
                        </div>
                        <div class="form-group">
                            <label for="dias_trabajo">Días de Trabajo:</label> <!-- Etiqueta para el campo de entrada de los días de trabajo -->
                            <input type="number" id="dias_trabajo" name="dias_trabajo" placeholder="ingrese N° de dias"> <!-- Campo de número para ingresar la cantidad de días de trabajo. No es obligatorio -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="trabajadores">Número de Trabajadores:</label> <!-- Etiqueta para el campo de entrada del número de trabajadores -->
                        <input type="number" id="trabajadores" name="trabajadores" placeholder="N° trabajadores"> <!-- Campo de número para ingresar la cantidad de trabajadores. Este campo no es obligatorio -->
                    </div>

                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="horario">Horario:</label> <!-- Etiqueta para el campo de entrada del horario -->
                            <input type="text" id="horario" name="horario" placeholder="horadia desde hasta"> <!-- Campo de texto para ingresar el horario. Este campo no es obligatorio -->
                        </div>
                        <div class="form-group">
                            <label for="colacion">Colación:</label> <!-- Etiqueta para el campo de entrada de colación -->
                            <input type="text" id="colacion" name="colacion" placeholder="Si/No"> <!-- Campo de texto para ingresar la información sobre la colación. No es obligatorio -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="entrega">Entrega:</label> <!-- Etiqueta para el campo de entrada de la entrega -->
                        <input type="text" id="entrega" name="entrega" placeholder="Dia entrega"> <!-- Campo de texto para ingresar detalles sobre la entrega. Este campo no es obligatorio -->
                    </div>
                </fieldset>
            </div> <!-- Cierra la fila -->

            <!-- Fila 4 -->
            <fieldset class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <legend>Detalle cliente</legend>
                <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
                    <div class="form-group-inline">
                                                <div class="form-group">
                            <label for="cliente_rut">RUT: </label> <!-- Etiqueta para el campo de entrada del RUT del cliente -->
                            <input type="text" id="cliente_rut" name="cliente_rut" 
                                minlength="7" maxlength="12" 
                                placeholder="x.xxx.xxx-x"
                                required oninput="formatRut(this)"> <!-- Campo de texto para ingresar el RUT del cliente. También es obligatorio -->
                        </div>
                        <div class="form-group">
                            <label for="cliente_nombre">Nombre:</label> <!-- Etiqueta para el campo de entrada del nombre del cliente -->
                            <input type="text" id="cliente_nombre" name="cliente_nombre" placeholder="nombre cliente" required> <!-- Campo de texto para ingresar el nombre del cliente. El atributo "required" hace que el campo sea obligatorio -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cliente_empresa">Empresa:</label> <!-- Etiqueta para el campo de entrada de la empresa del cliente -->
                        <input type="text" id="cliente_empresa" name="cliente_empresa" placeholder="cliente empresa"> <!-- Campo de texto para ingresar el nombre de la empresa del cliente. Este campo no es obligatorio -->
                    </div>

                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="cliente_direccion">Dirección:</label> <!-- Etiqueta para el campo de entrada de la dirección del cliente -->
                            <input type="text" id="cliente_direccion" name="cliente_direccion" placeholder="pasaje x #1234"> <!-- Campo de texto para ingresar la dirección del cliente. No es obligatorio -->
                        </div>
                        <div class="form-group">
                            <label for="cliente_lugar">Lugar:</label> <!-- Etiqueta para el campo de entrada del lugar del cliente -->
                            <input type="text" id="cliente_lugar" name="cliente_lugar" placeholder="casa/Oficina"> <!-- Campo de texto para ingresar el lugar del cliente. Este campo no es obligatorio -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cliente_fono">Teléfono:</label> <!-- Etiqueta para el campo de entrada del teléfono del cliente -->
                        <input type="text" id="cliente_fono" name="cliente_fono" pattern="\+?\d{7,15}" placeholder="+1234567890"> <!-- Campo de texto para ingresar el teléfono del cliente. Este campo no es obligatorio -->
                    </div>
                </div>
                <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
                    
                    <div class="form-group">
                        <label for="cliente_email">Email:</label> <!-- Etiqueta para el campo de entrada del email del cliente -->
                        <input type="email" id="cliente_email" name="cliente_email" placeholder="cliente@gmail.com"> <!-- Campo de correo electrónico para ingresar el email del cliente. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
                    </div>

                    <div class="form-group">
                        <label for="cliente_cargo">Cargo:</label> <!-- Etiqueta para el campo de entrada del cargo del cliente -->
                        <input type="text" id="cliente_cargo" name="cliente_cargo" placeholder="cargo cliente"> <!-- Campo de texto para ingresar el cargo del cliente. Este campo no es obligatorio -->
                    </div>
        
                    <div class="form-group">
                        <label for="cliente_giro">Giro:</label> <!-- Etiqueta para el campo de entrada del giro del cliente -->
                        <input type="text" id="cliente_giro" name="cliente_giro" placeholder="giro cliente"> <!-- Campo de texto para ingresar el giro o sector del cliente. No es obligatorio -->
                    </div>

                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="cliente_comuna">Comuna:</label> <!-- Etiqueta para el campo de entrada de la comuna del cliente -->
                            <input type="text" id="cliente_comuna" name="cliente_comuna" placeholder="comuna"> <!-- Campo de texto para ingresar la comuna del cliente. Este campo no es obligatorio -->
                        </div>
                        <div class="form-group">
                            <label for="cliente_ciudad">Ciudad:</label> <!-- Etiqueta para el campo de entrada de la ciudad del cliente -->
                            <input type="text" id="cliente_ciudad" name="cliente_ciudad" placeholder="ciudad"> <!-- Campo de texto para ingresar la ciudad del cliente. No es obligatorio -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cliente_tipo">Tipo:</label> <!-- Etiqueta para el campo de entrada del tipo de cliente -->
                        <input type="text" id="cliente_tipo" name="cliente_tipo" placeholder="tipo cliente"> <!-- Campo de texto para ingresar el tipo de cliente. Este campo no es obligatorio -->
                    </div>
                </div>
            </fieldset> <!-- Cierra la fila -->

            <!-- Fila 5 -->
            <fieldset class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <legend>Detalle encargado</legend>
                <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
                    <div class="form-group">
                        <label for="enc_nombre">Nombre:</label> <!-- Etiqueta para el campo de entrada del nombre del encargado -->
                        <input type="text" id="enc_nombre" name="enc_nombre"> <!-- Campo de texto para ingresar el nombre del encargado. Este campo no es obligatorio -->
                    </div>
                    <div class="form-group">
                        <label for="enc_email">Email:</label> <!-- Etiqueta para el campo de entrada del email del encargado -->
                        <input type="email" id="enc_email" name="enc_email"> <!-- Campo de correo electrónico para ingresar el email del encargado. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
                    </div>
                    <div class="form-group">
                    <label for="enc_fono">Teléfono:</label> <!-- Etiqueta para el campo de entrada del teléfono del encargado -->
                    <input type="text" id="enc_fono" name="enc_fono" pattern="\+?\d{7,15}" placeholder="+1234567890"> <!-- Campo de texto para ingresar el teléfono del encargado. Este campo no es obligatorio -->
                    </div>
                </div>
                <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
                    <div class="form-group">
                        <label for="enc_celular">Celular:</label> <!-- Etiqueta para el campo de entrada del celular del encargado -->
                        <input type="text" id="enc_celular" name="enc_celular" pattern="\+?\d{7,15}" placeholder="+1234567890"> <!-- Campo de texto para ingresar el número de celular del encargado. Este campo no es obligatorio -->
                    </div>
                    <div class="form-group">
                        <label for="enc_proyecto">Proyecto Asignado:</label> <!-- Etiqueta para el campo de entrada del proyecto asignado al encargado -->
                        <input type="text" id="enc_proyecto" name="enc_proyecto"> <!-- Campo de texto para ingresar el nombre del proyecto asignado al encargado. No es obligatorio -->
                    </div>
                </div>
            </fieldset> <!-- Cierra la fila -->

            <!-- Fila 6 -->
            <fieldset class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <legend>Detalle vendedor</legend>
                <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
                    <div class="form-group">
                        <label for="vendedor_nombre">Nombre:</label><!-- Etiqueta para el campo de entrada del nombre del vendedor -->
                        <input type="text" id="vendedor_nombre" name="vendedor_nombre" required><!-- Campo de texto para ingresar el nombre del vendedor. El atributo "required" hace que el campo sea obligatorio -->
                    </div>
                    <div class="form-group">
                        <label for="vendedor_email">Email:</label> <!-- Etiqueta para el campo de entrada del email del vendedor -->
                        <input type="email" id="vendedor_email" name="vendedor_email" required> <!-- Campo de correo electrónico para ingresar el email del vendedor. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico. También es obligatorio -->
                    </div>
                </div>
                <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
                    <div class="form-group">
                        <label for="vendedor_telefono">Teléfono:</label> <!-- Etiqueta para el campo de entrada del teléfono del vendedor -->
                        <input type="text" id="vendedor_telefono" name="vendedor_telefono"> <!-- Campo de texto para ingresar el teléfono del vendedor. Este campo no es obligatorio -->
                    </div>
                    <div class="form-group">
                    <label for="vendedor_celular">Celular:</label> <!-- Etiqueta para el campo de entrada del celular del vendedor -->
                    <input type="text" id="vendedor_celular" name="vendedor_celular"> <!-- Campo de texto para ingresar el número de celular del vendedor. Este campo no es obligatorio -->
                    </div>
                </div>
            </fieldset> <!-- Cierra la fila -->

            
            <!-- sección para Detalle de Cotización -->
            <fieldset>
                <legend>Detalle de la Cotización</legend>
                <div id="detalle-container">
                    <div class="detalle-section">
                        <!-- Aquí se agregarán las secciones dinámicamente -->
                    </div>

                    <div class="fixed-button-container">
                        <button type="button" onclick="addDetailSection()">Agregar un nuevo título</button>
                    </div>
                </div>
            </fieldset>
            <!-- Sección para los cálculos finales -->


            
            <div class="form-container">
                <div class="form-group-2">
                    <label for="subTotal">Sub Total</label>
                    <input type="number" id="sub_total" name="sub_total" step="1" min="0" readonly>
                </div>

                <div class="form-group-inline-2">
                    <div class="form-group-2">
                        <label for="descuentoGlobal">Descuento</label>
                        <input type="number" id="descuento_global_porcentaje" name="descuento_global_porcentaje" step="1" min="1" max="100" value="0" oninput="calculateTotals()">
                        <span>%</span>
                    </div>
                    <div class="form-group-2">
                        <label for="monto">Monto</label>
                        <input type="number" id="descuento_global_monto" name="descuento_global_monto" step="1" min="0" readonly>
                    </div>
                </div>

                <div class="form-group-2">
                    <label for="montoNeto">Monto Neto</label>
                    <input type="number" id="monto_neto" name="monto_neto" step="1" min="0" readonly>
                </div>

                <div class="form-group-inline-2">
                    <div class="form-group-2">
                        <label for="iva">IVA</label>
                        <input type="number" id="iva_porcentaje" name="iva_porcentaje" step="0.01" min="0" max="100" value="19" readonly>
                        <span>%</span>
                    </div>
                    <div class="form-group-2">
                        <label for="totalIva">Total IVA</label>
                        <input type="number" id="total_iva" name="total_iva" step="0.01" min="0" readonly>
                    </div>
                </div>
                <div class="form-group-2">
                    <label for="total_final">Total final</label>
                    <input type="number" id="total_final" name="total_final" step="1" min="0" readonly>
                </div>
                
            </div>
            <br>
            <fieldset>
                <legend>Adelanto</legend>
                <table class="detalle-table">
                    <thead>
                        <tr>
                            <th>DESCRIPCIÓN</th>
                            <th>Porcentaje Adelanto: %</th>
                            <th>Monto adelanto</th>
                            <th>Fecha adelanto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" onclick="toggleDescription(this)"></td>
                            <td><input type="number" id="porcentaje_adelanto" name="porcentaje_adelanto" min="0" max="100" required oninput="calculateAdelanto()"></td>
                            <td><input type="number" id="monto_adelanto" name="monto_adelanto" min="0" required readonly></td>
                            <td><input type="date" id="fecha_adelanto" name="fecha_adelanto" required></td>
                        </tr>
                        <tr class="descripcion-row" style="display: none;">
                            <td colspan="4">
                                <textarea name="adelanto_descripcion"  id="adelanto_descripcion" placeholder="Ingrese detalles adicionales sobre las condiciones generales"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
            <br>
            <!-- Sección para Condiciones Generales -->
            <div id="condiciones-generales" class="data-box">
                <h3>Condiciones Generales</h3>
                <div class="field">
                    <label for="descripcion_condiciones">Descripción:</label>
                    <input type="text" id="descripcion_condiciones" name="descripcion_condiciones[]" placeholder="Descripción de la condición" required>
                    <input type="checkbox" id="estado_condiciones" name="estado_condiciones[]">
                </div>
            </div>

            <!-- Sección para Requisitos Básicos -->
            <div id="requisitos-basicos" class="data-box">
                <h3>Requisitos Básicos</h3>
                <div class="field">
                    <label for="primer_titulo_1">Primer Título:</label>
                    <input type="text" id="primer_titulo_1" name="primer_titulo[]" placeholder="Primer Título" required>
                </div>
                <div class="field">
                    <label for="descripcion_condiciones_1">Descripción:</label>
                    <input type="text" id="descripcion_requisitos" name="descripcion_requisitos[]" placeholder="Descripción de la condición" required>
                </div>
                <div class="field">
                    <label for="ultimo_titulo_1">Último Título:</label>
                    <input type="text" id="ultimo_titulo_1" name="ultimo_titulo[]" placeholder="Último Título" required>
                </div>
                <!-- Puedes duplicar el bloque anterior para más requisitos básicos -->
            </div>


            
            <button type="submit" class="submit">Crear cotizacion</button> <!-- Botón para enviar el formulario y generar la cotización -->
            </form> <!-- Cierra el formulario -->
            </div> <!-- Cierra el contenedor principal -->
            </div> <!-- Cierra el contenedor principal -->

            <table>
                <tr>
                    <th style="background-color:lightgray">CONDICIONES GENERALES</th>
                </tr>
                <?php if (!empty($requisitos)): ?>
                    <?php foreach ($requisitos as $requisito): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($requisito['indice']) . '.- ' . htmlspecialchars($requisito['descripcion_condiciones']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td>No hay condiciones generales disponibles.</td>
                    </tr>
                <?php endif; ?>
            </table>

            <h2>TRANSFERENCIAS A:</h2> <!-- Título para la sección de transferencias bancarias -->
            <table> <!-- Crea una tabla para mostrar la información bancaria para transferencias -->
            <tr>
                <?php if (!empty($bancos)): ?>
                    <?php foreach ($bancos as $banco): ?>
                        <th><?php echo htmlspecialchars($banco['TipoCuentaDescripcion']); ?></th>
                    <?php endforeach; ?>
                <?php else: ?>
                    <th colspan="3">No hay información bancaria disponible.</th>
                <?php endif; ?>
            </tr>
            <?php if (!empty($bancos)): ?>
                <tr>
                    <?php foreach ($bancos as $banco): ?>
                        <td>BANCO: <?php echo htmlspecialchars($banco['BancoNombre']); ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <?php foreach ($bancos as $banco): ?>
                        <td>TIPO CUENTA: <?php echo htmlspecialchars($banco['TipoCuentaDescripcion']); ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <?php foreach ($bancos as $banco): ?>
                        <td>NUMERO CUENTA: <?php echo htmlspecialchars($banco['CuentaNumeroCuenta']); ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <?php foreach ($bancos as $banco): ?>
                        <td>NOMBRE: <?php echo htmlspecialchars($banco['CuentaNombreTitular']); ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <?php foreach ($bancos as $banco): ?>
                        <td>RUT: <?php echo htmlspecialchars($banco['CuentaRutTitular']); ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <?php foreach ($bancos as $banco): ?>
                        <td>E-MAIL: <?php echo htmlspecialchars($banco['CuentaEmailBanco']); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endif; ?>
            </table>
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
<script src="../../js/crear_empresa/actualizar_logo.js"></script>
<script src="../../js/nueva_cotizacion/upload_logo.js"></script> 
<!-- Enlaza un archivo JavaScript externo para actualizar el logo o realizar otras actualizaciones -->
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