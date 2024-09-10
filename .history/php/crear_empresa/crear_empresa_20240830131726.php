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
    ------------------------------------- INICIO ITred Spa Menú básico .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

    <!DOCTYPE html>
<html lang="es">
<head> <!-- Abre el elemento de cabecera que contiene metadatos y enlaces a recursos externos -->
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres como UTF-8 para asegurar la correcta visualización de caracteres especiales y diversos idiomas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista en dispositivos móviles. width=device-width asegura que el ancho de la página se ajuste al ancho de la pantalla del dispositivo, y initial-scale=1.0 establece el nivel de zoom inicial -->
    <title>Formulario de Cotización</title> <!-- Define el título de la página que se muestra en la pestaña del navegador -->
    <link rel="stylesheet" href="../../css/crear_empresa/crear_empresa.css"> <!-- Enlaza una hoja de estilo externa que se encuentra en la ruta especificada para estilizar el contenido de la página -->
</head> <!-- Cierra el elemento de cabecera -->
<body> <!-- Abre el elemento del cuerpo de la página donde se coloca el contenido visible -->
    <div class="container"> <!-- Contenedor principal que puede ayudar a centrar y organizar el contenido en la página -->
        <form id="cotizacion-form" method="POST" action="procesar_creacion_empresa.php" enctype="multipart/form-data">
            <!-- Formulario con ID "cotizacion-form". Usa el método POST para enviar los datos al servidor. El atributo "action" define el archivo al que se enviarán los datos. "enctype" especifica que el formulario puede enviar archivos -->
            
            <!-- Fila 1 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                
                <div class="box-6 logo-box"> <!-- Crea una caja para el logo o foto de perfil, ocupando 6 de las 12 columnas disponibles en el diseño -->
                    <!-- Imagen del logo o foto de perfil -->
                    <label for="logo-upload" class="logo-container"> <!-- Etiqueta para el campo de carga de imagen. El atributo "for" enlaza con el input de archivo -->
                        <img src="http://localhost/programa_cotizacion/imagenes/crear_empresa/generic-logo.png" alt="tamaño recomendado: 100x100 pixeles" class="logo" id="logo-preview"> <!-- Muestra una imagen previa del logo con un texto alternativo en caso de que no se cargue la imagen -->
                        <button type="file" id="logo-upload" name="logo_upload" accept="image/*" style="display:none;"></button > <!-- Campo oculto para cargar el archivo del logo. Acepta solo archivos de imagen -->
                        
                        <button for="logo-upload" type="file" id ="logo-upload" name="logo_upload" accept="image/*" style="display:block;">Sube tu Logo Empresarial tamaño recomendado: 800x200 pixeles</button > <!-- Texto que aparece junto a la imagen para instruir al usuario a cargar el logo -->
                    </label>
                    <button for="logo-upload" type="file" id ="logo-upload" name="logo_upload" accept="image/*" style="display:block;">Sube tu Logo Empresarial tamaño recomendado: 800x200 pixeles</button > <!-- Texto que aparece junto a la imagen para instruir al usuario a cargar el logo -->
                </div>
                
                <div class="box-6 data-box data-box-red"> <!-- Crea una caja para ingresar datos, ocupando otras 6 columnas. Se aplica una clase adicional para estilo -->
                    <label for="empresa_rut">RUT de la Empresa:</label> <!-- Etiqueta para el campo de entrada del RUT de la empresa -->
                    <input type="text" id="empresa_rut" name="empresa_rut" required oninput="formatRut(this)"> <!-- Campo de texto para ingresar el RUT de la empresa. El atributo "required" hace que el campo sea obligatorio -->
                    <label for="numero_cotizacion">Número de Cotización:</label> <!-- Etiqueta para el campo de entrada del número de cotización -->
                    <input type="text" id="numero_cotizacion" name="numero_cotizacion" required pattern="\d+" required placeholder="1234567890"> <!-- Campo de texto para ingresar el número de cotización. También es obligatorio -->
                    
                    <label for="validez_cotizacion">Validez de la Cotización:</label> <!-- Etiqueta para el campo de entrada de la validez de la cotización -->
                    <input type="number" id="validez_cotizacion" name="validez_cotizacion" required min="1" required placeholder="30" > <!-- Campo de número para ingresar la validez de la cotización en días. El atributo "required" asegura que no se deje vacío -->
                    
                    <label for="fecha_emision">Fecha de Emisión:</label> <!-- Etiqueta para el campo de entrada de la fecha de emisión -->
                    <input type="date" id="fecha_emision" name="fecha_emision" required> <!-- Campo de fecha para seleccionar la fecha de emisión. Es obligatorio -->
             </div>
                
            </div> <!-- Cierra la fila -->

            <!-- Fila 2 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <div class="box-12 data-box"> <!-- Crea una caja para ingresar datos, ocupando las 12 columnas disponibles en el diseño. Esta caja contiene varios campos de entrada de datos -->
        
                    <label for="empresa_nombre">Nombre de la Empresa:</label> <!-- Etiqueta para el campo de entrada del nombre de la empresa -->
                    <input type="text" id="empresa_nombre" name="empresa_nombre" required> <!-- Campo de texto para ingresar el nombre de la empresa. El atributo "required" hace que el campo sea obligatorio -->
        
                    <label for="empresa_area">Área de la Empresa:</label> <!-- Etiqueta para el campo de entrada del área de la empresa -->
                    <input type="text" id="empresa_area" name="empresa_area"> <!-- Campo de texto para ingresar el área de la empresa. Este campo no es obligatorio -->
        
                    <label for="empresa_direccion">Dirección de la Empresa:</label> <!-- Etiqueta para el campo de entrada de la dirección de la empresa -->
                    <input type="text" id="empresa_direccion" name="empresa_direccion"> <!-- Campo de texto para ingresar la dirección de la empresa. Este campo no es obligatorio -->
        
                    <label for="empresa_telefono">Teléfono de la Empresa:</label> <!-- Etiqueta para el campo de entrada del teléfono de la empresa -->
                    <input type="text" id="empresa_telefono" name="empresa_telefono" pattern="\+?\d{7,15}" placeholder="+1234567890"> <!-- Campo de texto para ingresar el teléfono de la empresa. Este campo no es obligatorio -->
        
                    <label for="empresa_email">Email de la Empresa:</label> <!-- Etiqueta para el campo de entrada del email de la empresa -->
                    <input type="email" id="empresa_email" name="empresa_email"> <!-- Campo de correo electrónico para ingresar el email de la empresa. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        
                </div> <!-- Cierra la caja de datos -->
            </div> <!-- Cierra la fila -->
    
            <!-- Fila para cuentas bancarias -->
            <div class="row">
                <div class="box-12 data-box bank-account-container">
                    <h2>Agrega tu cuenta bancaria:</h2>
                    <div id="bank-accounts">
                        <!-- Campos de cuentas bancarias -->
                        <div class="bank-account">
                          
                            <label for="nombre-cuenta">Nombre titular:</label>
                            <input type="text" id="nombre-cuenta" name="nombre_cuenta" required>

                            <label for="rut-banco">Rut titular:</label>
                            <input type="text" id="rut-banco" name="rut_banco" required>

                            <label for="nombre-encargado">Celular:</label>
                            <input type="number" id="celular" name="celular" required>

                            <label for="email-banco">Email:</label>
                            <input type="email" id="email-banco" name="email_banco" required>

                            <label for="id-banco">Banco:</label>
                            <select id="id-banco" name="id_banco" required>
                                <!-- Opciones se llenarán con los datos de la tabla Bancos -->
                            </select>

                            <label for="id-tipocuenta">Tipo de Cuenta:</label>
                            <select id="id-tipocuenta" name="id_tipocuenta" required>
                                <!-- Opciones se llenarán con los datos de la tabla Tipo_Cuenta -->
                            </select>
                        
                            <label for="numero-cuenta">Número de Cuenta:</label>
                            <input type="text" id="numero-cuenta" name="numero_cuenta" required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit">Crear empresa</button> <!-- Botón para enviar el formulario y generar la cotización -->
            </form> <!-- Cierra el formulario -->
            </div> <!-- Cierra el contenedor principal -->

          
        </form> <!-- Cierra el formulario -->
            </div> <!-- Cierra el contenedor principal -->

            <table> <!-- Crea una tabla para mostrar las condiciones generales de la cotización -->
                <tr>
                    <th style="background-color:lightgray">CONDICIONES GENERALES</th> <!-- Encabezado de columna con estilo de fondo gris claro -->
                </tr>
                <tr>
                    <td>1.- VALORES EXPRESADOS SERAN FACTURADOS EN MONEDA NACIONAL.</td> <!-- Fila de datos con la primera condición general -->
                </tr>
                <tr>
                    <td>2.- VALORES SUJETOS A VARIACION, DEBIDO A QUE LOS EQUIPOS, MATERIALES Y HERRAMIENTAS SON CALCULADOS CON EL VALOR DOLAR DIA</td> <!-- Segunda condición general -->
                </tr>
                <tr>
                    <td>3.- LAS INSTALACIONES NO INCLUYEN EQUIPOS, MATERIALES, FERRETERIA U OTRO TIPO DE HERRAMIENTAS QUE SE REQUIERAN PARA EL TRABAJO, QUE NO SE ENCUENTRE DETALLADO DENTRO DE ESTA COTIZACION.</td> <!-- Tercera condición general -->
                </tr>
                <tr>
                    <td>4.- GARANTIA 6 MESES, DESDE EL DIA DE LA ENTREGA, LA QUE CADUCA AUTOMATICAMENTE, EN CASO DE NO CUMPLIR LOS PAGOS, EN LAS FECHAS ACORDADAS</td> <!-- Cuarta condición general -->
                </tr>
                <tr>
                    <td>5.- GARANTIA 6 MESES, DESDE EL DIA DE LA ENTREGA, LA QUE CADUCA AUTOMATICAMENTE, EN CASO DE HABER MANIPULACION O INTERVENCION DE TERCEROS</td> <!-- Quinta condición general -->
                </tr>
                <tr>
                    <td>6.- SI ALGUN TRABAJO, MATERIAL, PRODUCTO, EQUIPO, FERRETERIA O MANO DE OBRA, QUE NO SE ENCUENTRE EN ESTA COTIZACION, SE DEBERA COTIZAR Y AGREGAR EL VALOR A LA COTIZACION</td> <!-- Sexta condición general -->
                </tr>
                <tr>
                    <td>7.- LUGAR DE TRABAJO LIBRE DE OBJETOS, QUE SE PUEDAN, ROMPER, DAÑAR O ENTORPECER EL TRABAJO, DE LO CONTRARIO, SE DEBERA COTIZAR Y AGREGAR EL MOVIMIENTO DE OBJETOS A LA COTIZACION</td> <!-- Séptima condición general -->
                </tr>
                <tr>
                    <td>8.- EL CLIENTE DEBE INDICAR EL HORARIO DE ENTRADA Y DE SALIDA, CONTEMPLANDO QUE NUESTRO HORARIO DE TRABAJO ES DE LUNES A VIERNES DE 9:00 AM A 18:30HRS</td> <!-- Octava condición general -->
                </tr>
                <tr>
                    <td>9.- LOS DIAS DE TRABAJO, SON COTIZADOS DE LUNES A VIERNES DE 9:30AM A 18:30HRS., CON 1HR. DE COLACION, SI EL CLIENTE PRESENTA ALGUN PROBLEMA DE HORARIO O URGENCIAS, DEBERA DAR AVISO ANTES DE COMENZAR EL PROYECTO, PARA AGREGAR HORAS EXTRAS, VIATICOS Y TODO LO QUE CORRESPONDE PARA CUMPLIR CON LA URGENCIA DEL CLIENTE, YA SEA TRABAJO DESPUES DE LA HORA LABORAL, FIN DE SEMANA O FESTIVOS</td> <!-- Novena condición general -->
                </tr>
                <tr>
                    <td>10.- EL CLIENTE DEBE INDICAR LOS HORARIOS, EN LOS CUALES, SE PERMITE HACER RUIDOS FUERTES O INTERVENIR ENTRADAS, PASILLOS, CON MESONES, ESCALERAS, HERRAMIENTAS, ENTRE OTROS, ESTO ES MUY IMPORTANTE, PORQUE SI LOS HORARIOS SON MUY COMPLICADOS O REDUCIDOS, SE DEBERA RECALCULAR EL PRESUPUESTO</td> <!-- Décima condición general -->
                </tr>
            </table>

            <h2>TRANSFERENCIAS A:</h2> <!-- Título para la sección de transferencias bancarias -->
            <table> <!-- Crea una tabla para mostrar la información bancaria para transferencias -->
                <tr>
                    <th>CHEQUERA ELECTRONICA ITRED SPA</th> <!-- Encabezado de columna para chequera electrónica -->
                    <th>CUENTA CORRIENTE PERSONAL</th> <!-- Encabezado de columna para cuenta corriente personal -->
                    <th>CUENTA RUT PERSONAL</th> <!-- Encabezado de columna para cuenta RUT personal -->
                </tr>
                <tr>
                    <td>BANCO: Banco Estado</td> <!-- Información del banco para la chequera electrónica -->
                    <td>BANCO: Santander</td> <!-- Información del banco para la cuenta corriente personal -->
                    <td>BANCO: Banco Estado</td> <!-- Información del banco para la cuenta RUT personal -->
                </tr>
                <tr>
                    <td>TIPO CUENTA: Chequera electronica</td> <!-- Tipo de cuenta para la chequera electrónica -->
                    <td>TIPO CUENTA: Cuenta corriente</td> <!-- Tipo de cuenta para la cuenta corriente personal -->
                    <td>TIPO CUENTA: Cuenta RUT</td> <!-- Tipo de cuenta para la cuenta RUT personal -->
                </tr>
                <tr>
                    <td>NUMERO CUENTA: 902-7-053409-0</td> <!-- Número de cuenta para la chequera electrónica -->
                    <td>NUMERO CUENTA: 0-000-77-51325-6</td> <!-- Número de cuenta para la cuenta corriente personal -->
                    <td>NUMERO CUENTA: 15457398</td> <!-- Número de cuenta para la cuenta RUT personal -->
                </tr>
                <tr>
                    <td>NOMBRE: ITRED SPA</td> <!-- Nombre de la empresa para la chequera electrónica -->
                    <td>NOMBRE: Barner Piña Jara</td> <!-- Nombre del titular de la cuenta corriente personal -->
                    <td>NOMBRE: Barner Piña Jara</td> <!-- Nombre del titular de la cuenta RUT personal -->
                </tr>
                <tr>
                    <td>RUT: 77.243.277-1</td> <!-- RUT de la empresa para la chequera electrónica -->
                    <td>RUT: 15.457.398-4</td> <!-- RUT del titular de la cuenta corriente personal -->
                    <td>RUT: 15.457.398-4</td> <!-- RUT del titular de la cuenta RUT personal -->
                </tr>
                <tr>
                    <td>E-MAIL: barnerp1@gmail.com</td> <!-- Correo electrónico para la chequera electrónica -->
                    <td>E-MAIL: barnerp1@gmail.com</td> <!-- Correo electrónico para la cuenta corriente personal -->
                    <td>E-MAIL: barnerp1@gmail.com</td> <!-- Correo electrónico para la cuenta RUT personal -->
                </tr>
            </table>

            <p>SIN OTRO PARTICULAR, Y ESPERANDO QUE LA PRESENTE OFERTA SEA DE SU INTERÉS, SE DESPIDE ATENTAMENTE</p> <!-- Mensaje de despedida en la oferta -->
            <p>BARNER PATRICIO PIÑA JARA</p> <!-- Nombre del remitente -->
            <p>JEFE DE PROYECTO TECNOLOGIA Y CONSTRUCCION</p> <!-- Cargo del remitente -->
            <p>ITRED SPA.</p> <!-- Nombre de la empresa del remitente -->

<script src="../../js/crear_empresa/actualizar_logo.js"></script>
<script src="../../js/nueva_cotizacion/loadBancos.js"></script> 
<script src="../../js/nueva_cotizacion/loadTipoCuenta.js"></script> 
<script src="../../js/nueva_cotizacion/agregar_banco.js"></script> 
<script src="../../js/crear_empresa/crear_empresa.js"></script> 
<!-- Enlaza un archivo JavaScript externo para actualizar el logo o realizar otras actualizaciones -->
</body>
</html>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Formulario Cotizacion .PHP -----------------------------------
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