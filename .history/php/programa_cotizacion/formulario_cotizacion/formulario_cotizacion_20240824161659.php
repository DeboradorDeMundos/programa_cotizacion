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
    <link rel="stylesheet" href="../../css/crear_nuevo/formulario_cotizacion.css"> <!-- Enlaza una hoja de estilo externa que se encuentra en la ruta especificada para estilizar el contenido de la página -->
</head> <!-- Cierra el elemento de cabecera -->
<body> <!-- Abre el elemento del cuerpo de la página donde se coloca el contenido visible -->
    <div class="container"> <!-- Contenedor principal que puede ayudar a centrar y organizar el contenido en la página -->
        <form id="cotizacion-form" method="POST" action="procesar_cotizacion.php" enctype="multipart/form-data">
            <!-- Formulario con ID "cotizacion-form". Usa el método POST para enviar los datos al servidor. El atributo "action" define el archivo al que se enviarán los datos. "enctype" especifica que el formulario puede enviar archivos -->
            
            <!-- Fila 1 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                
                <div class="box-6 logo-box"> <!-- Crea una caja para el logo o foto de perfil, ocupando 6 de las 12 columnas disponibles en el diseño -->
                    <!-- Imagen del logo o foto de perfil -->
                    <label for="logo-upload" class="logo-container"> <!-- Etiqueta para el campo de carga de imagen. El atributo "for" enlaza con el input de archivo -->
                        <img src="http://localhost/Cotizacion_css_ITred_Spa_/imagenes/cotizacion/logo.png" alt="Logo de la Empresa" class="logo" id="logo-preview"> <!-- Muestra una imagen previa del logo con un texto alternativo en caso de que no se cargue la imagen -->
                        <input type="file" id="logo-upload" name="logo_upload" accept="image/*" style="display:none;"> <!-- Campo oculto para cargar el archivo del logo. Acepta solo archivos de imagen -->
                        <span>Cargar Logo de Empresa</span> <!-- Texto que aparece junto a la imagen para instruir al usuario a cargar el logo -->
                    </label>
                </div>
                
                <div class="box-6 data-box data-box-red"> <!-- Crea una caja para ingresar datos, ocupando otras 6 columnas. Se aplica una clase adicional para estilo -->
                    <label for="empresa_rut">RUT de la Empresa:</label> <!-- Etiqueta para el campo de entrada del RUT de la empresa -->
                    <input type="text" id="empresa_rut" name="empresa_rut" required oninput="formatRut(this)"> <!-- Campo de texto para ingresar el RUT de la empresa. El atributo "required" hace que el campo sea obligatorio -->
                    
                    <label for="numero_cotizacion">Número de Cotización:</label> <!-- Etiqueta para el campo de entrada del número de cotización -->
                    <input type="text" id="numero_cotizacion" name="numero_cotizacion" required pattern="\d+" required placeholder="12345"> <!-- Campo de texto para ingresar el número de cotización. También es obligatorio -->
                    
                    <label for="validez_cotizacion">Validez de la Cotización:</label> <!-- Etiqueta para el campo de entrada de la validez de la cotización -->
                    <input type="number" id="validez_cotizacion" name="validez_cotizacion" required min="1" required placeholder="30"> <!-- Campo de número para ingresar la validez de la cotización en días. El atributo "required" asegura que no se deje vacío -->
                    
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

            <!-- Fila 3 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
                    <label for="proyecto_nombre">Nombre del Proyecto:</label> <!-- Etiqueta para el campo de entrada del nombre del proyecto -->
                    <input type="text" id="proyecto_nombre" name="proyecto_nombre" required> <!-- Campo de texto para ingresar el nombre del proyecto. El atributo "required" hace que el campo sea obligatorio -->
        
                    <label for="proyecto_codigo">Código del Proyecto:</label> <!-- Etiqueta para el campo de entrada del código del proyecto -->
                    <input type="text" id="proyecto_codigo" name="proyecto_codigo" required> <!-- Campo de texto para ingresar el código del proyecto. También es obligatorio -->
        
                    <label for="area_trabajo">Área de Trabajo:</label> <!-- Etiqueta para el campo de entrada del área de trabajo -->
                    <input type="text" id="area_trabajo" name="area_trabajo" required> <!-- Campo de texto para ingresar el área de trabajo. Este campo es obligatorio -->
        
                    <label for="tipo_trabajo">Tipo de Trabajo:</label> <!-- Etiqueta para el campo de entrada del tipo de trabajo -->
                    <input type="text" id="tipo_trabajo" name="tipo_trabajo" required> <!-- Campo de texto para ingresar el tipo de trabajo. También es obligatorio -->
        
                    <label for="riesgo">Riesgo:</label> <!-- Etiqueta para el campo de entrada del riesgo asociado al proyecto -->
                    <input type="text" id="riesgo" name="riesgo" required> <!-- Campo de texto para ingresar el nivel o tipo de riesgo. Este campo es obligatorio -->
                </div>
                <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
                    <label for="dias_compra">Días de Compra:</label> <!-- Etiqueta para el campo de entrada de los días de compra -->
                    <input type="number" id="dias_compra" name="dias_compra"> <!-- Campo de número para ingresar la cantidad de días de compra. Este campo no es obligatorio -->
        
                    <label for="dias_trabajo">Días de Trabajo:</label> <!-- Etiqueta para el campo de entrada de los días de trabajo -->
                    <input type="number" id="dias_trabajo" name="dias_trabajo"> <!-- Campo de número para ingresar la cantidad de días de trabajo. No es obligatorio -->
        
                    <label for="trabajadores">Número de Trabajadores:</label> <!-- Etiqueta para el campo de entrada del número de trabajadores -->
                    <input type="number" id="trabajadores" name="trabajadores"> <!-- Campo de número para ingresar la cantidad de trabajadores. Este campo no es obligatorio -->
        
                    <label for="horario">Horario:</label> <!-- Etiqueta para el campo de entrada del horario -->
                    <input type="text" id="horario" name="horario"> <!-- Campo de texto para ingresar el horario. Este campo no es obligatorio -->
        
                    <label for="colacion">Colación:</label> <!-- Etiqueta para el campo de entrada de colación -->
                    <input type="text" id="colacion" name="colacion"> <!-- Campo de texto para ingresar la información sobre la colación. No es obligatorio -->
        
                    <label for="entrega">Entrega:</label> <!-- Etiqueta para el campo de entrada de la entrega -->
                    <input type="text" id="entrega" name="entrega"> <!-- Campo de texto para ingresar detalles sobre la entrega. Este campo no es obligatorio -->
                </div>
            </div> <!-- Cierra la fila -->

            <!-- Fila 4 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
                    <label for="cliente_nombre">Nombre del Cliente:</label> <!-- Etiqueta para el campo de entrada del nombre del cliente -->
                    <input type="text" id="cliente_nombre" name="cliente_nombre" required> <!-- Campo de texto para ingresar el nombre del cliente. El atributo "required" hace que el campo sea obligatorio -->
        
                    <label for="cliente_rut">RUT del Cliente:</label> <!-- Etiqueta para el campo de entrada del RUT del cliente -->
                    <input type="text" id="cliente_rut" name="cliente_rut" required required oninput="formatRut(this)"> <!-- Campo de texto para ingresar el RUT del cliente. También es obligatorio -->
        
                    <label for="cliente_empresa">Empresa del Cliente:</label> <!-- Etiqueta para el campo de entrada de la empresa del cliente -->
                    <input type="text" id="cliente_empresa" name="cliente_empresa"> <!-- Campo de texto para ingresar el nombre de la empresa del cliente. Este campo no es obligatorio -->
        
                    <label for="cliente_direccion">Dirección del Cliente:</label> <!-- Etiqueta para el campo de entrada de la dirección del cliente -->
                    <input type="text" id="cliente_direccion" name="cliente_direccion"> <!-- Campo de texto para ingresar la dirección del cliente. No es obligatorio -->
        
                    <label for="cliente_lugar">Lugar del Cliente:</label> <!-- Etiqueta para el campo de entrada del lugar del cliente -->
                    <input type="text" id="cliente_lugar" name="cliente_lugar"> <!-- Campo de texto para ingresar el lugar del cliente. Este campo no es obligatorio -->
        
                    <label for="cliente_fono">Teléfono del Cliente:</label> <!-- Etiqueta para el campo de entrada del teléfono del cliente -->
                    <input type="text" id="cliente_fono" name="cliente_fono" pattern="\+?\d{7,15}" placeholder="+1234567890"> <!-- Campo de texto para ingresar el teléfono del cliente. Este campo no es obligatorio -->
                </div>
                <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
                    <label for="cliente_email">Email del Cliente:</label> <!-- Etiqueta para el campo de entrada del email del cliente -->
                    <input type="email" id="cliente_email" name="cliente_email"> <!-- Campo de correo electrónico para ingresar el email del cliente. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        
                    <label for="cliente_cargo">Cargo del Cliente:</label> <!-- Etiqueta para el campo de entrada del cargo del cliente -->
                    <input type="text" id="cliente_cargo" name="cliente_cargo"> <!-- Campo de texto para ingresar el cargo del cliente. Este campo no es obligatorio -->
        
                    <label for="cliente_giro">Giro del Cliente:</label> <!-- Etiqueta para el campo de entrada del giro del cliente -->
                    <input type="text" id="cliente_giro" name="cliente_giro"> <!-- Campo de texto para ingresar el giro o sector del cliente. No es obligatorio -->
        
                    <label for="cliente_comuna">Comuna del Cliente:</label> <!-- Etiqueta para el campo de entrada de la comuna del cliente -->
                    <input type="text" id="cliente_comuna" name="cliente_comuna"> <!-- Campo de texto para ingresar la comuna del cliente. Este campo no es obligatorio -->
        
                    <label for="cliente_ciudad">Ciudad del Cliente:</label> <!-- Etiqueta para el campo de entrada de la ciudad del cliente -->
                    <input type="text" id="cliente_ciudad" name="cliente_ciudad"> <!-- Campo de texto para ingresar la ciudad del cliente. No es obligatorio -->
        
                    <label for="cliente_tipo">Tipo de Cliente:</label> <!-- Etiqueta para el campo de entrada del tipo de cliente -->
                    <input type="text" id="cliente_tipo" name="cliente_tipo"> <!-- Campo de texto para ingresar el tipo de cliente. Este campo no es obligatorio -->
                </div>
            </div> <!-- Cierra la fila -->

            <!-- Fila 5 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
                    <label for="enc_nombre">Nombre del Encargado:</label> <!-- Etiqueta para el campo de entrada del nombre del encargado -->
                    <input type="text" id="enc_nombre" name="enc_nombre"> <!-- Campo de texto para ingresar el nombre del encargado. Este campo no es obligatorio -->
        
                    <label for="enc_email">Email del Encargado:</label> <!-- Etiqueta para el campo de entrada del email del encargado -->
                    <input type="email" id="enc_email" name="enc_email"> <!-- Campo de correo electrónico para ingresar el email del encargado. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico -->
        
                    <label for="enc_fono">Teléfono del Encargado:</label> <!-- Etiqueta para el campo de entrada del teléfono del encargado -->
                    <input type="text" id="enc_fono" name="enc_fono" pattern="\+?\d{7,15}" placeholder="+1234567890"> <!-- Campo de texto para ingresar el teléfono del encargado. Este campo no es obligatorio -->
                </div>
                <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
                    <label for="enc_celular">Celular del Encargado:</label> <!-- Etiqueta para el campo de entrada del celular del encargado -->
                    <input type="text" id="enc_celular" name="enc_celular" pattern="\+?\d{7,15}" placeholder="+1234567890"> <!-- Campo de texto para ingresar el número de celular del encargado. Este campo no es obligatorio -->
        
                    <label for="enc_proyecto">Proyecto Asignado:</label> <!-- Etiqueta para el campo de entrada del proyecto asignado al encargado -->
                    <input type="text" id="enc_proyecto" name="enc_proyecto"> <!-- Campo de texto para ingresar el nombre del proyecto asignado al encargado. No es obligatorio -->
                </div>
            </div> <!-- Cierra la fila -->

            <!-- Fila 6 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <div class="box-6 data-box"> <!-- Crea una caja para ingresar datos, ocupando 6 de las 12 columnas disponibles en el diseño -->
                    <label for="vendedor_nombre">Nombre del Vendedor:</label> <!-- Etiqueta para el campo de entrada del nombre del vendedor -->
                    <input type="text" id="vendedor_nombre" name="vendedor_nombre" required> <!-- Campo de texto para ingresar el nombre del vendedor. El atributo "required" hace que el campo sea obligatorio -->
        
                    <label for="vendedor_email">Email del Vendedor:</label> <!-- Etiqueta para el campo de entrada del email del vendedor -->
                    <input type="email" id="vendedor_email" name="vendedor_email" required> <!-- Campo de correo electrónico para ingresar el email del vendedor. El tipo "email" valida que el texto ingresado sea una dirección de correo electrónico. También es obligatorio -->
                </div>
                <div class="box-6 data-box data-box-left"> <!-- Crea otra caja para ingresar datos, ocupando las otras 6 columnas. Se aplica una clase adicional "data-box-left" para estilo -->
                    <label for="vendedor_telefono">Teléfono del Vendedor:</label> <!-- Etiqueta para el campo de entrada del teléfono del vendedor -->
                    <input type="text" id="vendedor_telefono" name="vendedor_telefono"> <!-- Campo de texto para ingresar el teléfono del vendedor. Este campo no es obligatorio -->
        
                    <label for="vendedor_celular">Celular del Vendedor:</label> <!-- Etiqueta para el campo de entrada del celular del vendedor -->
                    <input type="text" id="vendedor_celular" name="vendedor_celular"> <!-- Campo de texto para ingresar el número de celular del vendedor. Este campo no es obligatorio -->
                </div>
            </div> <!-- Cierra la fila -->

            
            <!-- sección para Detalle de Cotización -->
            <fieldset> <!-- Define un grupo de campos relacionados en un formulario, usualmente con una leyenda para agrupar la información -->
                <legend>Detalle de la Cotización</legend> <!-- Proporciona un título para el grupo de campos dentro del fieldset -->
                <div id="detalle-container"> <!-- Crea un contenedor para los detalles de la cotización. Este contenedor se utilizará para agregar dinámicamente secciones de detalle -->
                    <!-- Sección de Títulos -->
                    <div class="detalle-section"> <!-- Define una sección dentro del contenedor para agregar títulos y otros detalles relacionados con la cotización -->
                        <button type="button" onclick="addDetailSection()">Agregar un nuevo título</button> <!-- Botón que permite agregar una nueva sección de detalle. La función JavaScript "addDetailSection()" se ejecutará cuando se haga clic en el botón -->
                    </div>
                </div> <!-- Cierra el contenedor de detalles -->
            </fieldset> <!-- Cierra el fieldset -->

            <script src="../../js/crear_nuevo/formulario_cotizacion.js"></script> <!-- Enlaza un archivo JavaScript externo que contiene funciones para manejar la lógica del formulario de cotización -->

            <!-- Sección para los cálculos finales -->
            <div id="calculos-finales"> <!-- Crea un contenedor para mostrar los cálculos finales de la cotización -->
                <fieldset> <!-- Define un grupo de campos relacionados en un formulario -->
                    <legend>Cálculos Finales</legend> <!-- Proporciona un título para el grupo de campos dentro del fieldset -->
                    <table class="detalle-table"> <!-- Crea una tabla para mostrar los cálculos finales de la cotización -->
                        <thead> <!-- Define el encabezado de la tabla -->
                            <tr> <!-- Fila de encabezado de la tabla -->
                                <th>NETO</th> <!-- Encabezado de columna para el valor neto -->
                                <th>DESCUENTO</th> <!-- Encabezado de columna para el descuento aplicado -->
                                <th>IVA 19%</th> <!-- Encabezado de columna para el IVA del 19% -->
                                <th>TOTAL</th> <!-- Encabezado de columna para el total final -->
                            </tr>
                        </thead>
                        <tbody> <!-- Define el cuerpo de la tabla -->
                            <tr> <!-- Fila de datos de la tabla -->
                                <td><input type="number" id="detalle_neto" step="1" min="1" readonly></td> <!-- Campo de entrada para el valor neto. Solo lectura -->
                                <td><input type="number" id="detalle_descuento" step="0" min="0" value="0" oninput="calculateTotals()"></td> <!-- Campo de entrada para el descuento. Permite entrada y actualiza cálculos con la función "calculateTotals()" -->
                                <td><input type="number" id="detalle_iva" readonly></td> <!-- Campo de entrada para el IVA calculado. Solo lectura -->
                                <td><input type="number" id="detalle_total" step="0" min="0" readonly></td> <!-- Campo de entrada para el total final. Solo lectura -->
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
            </div>

            <button type="submit">Generar Cotización</button> <!-- Botón para enviar el formulario y generar la cotización -->
            </form> <!-- Cierra el formulario -->
            </div> <!-- Cierra el contenedor principal -->

            <!-- Fila 7 -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <div class="box-12 data-box"> <!-- Crea una caja para ingresar datos, ocupando las 12 columnas disponibles en el diseño -->
                    <label for="observaciones">Observaciones Adicionales:</label> <!-- Etiqueta para el campo de entrada de observaciones adicionales -->
                    <textarea id="observaciones" name="observaciones" rows="4" cols="50"></textarea> <!-- Campo de texto para ingresar observaciones adicionales. Permite múltiples líneas -->
                </div>
            </div>

            <!-- Botón de envío -->
            <div class="row"> <!-- Crea una fila para organizar los elementos en una disposición horizontal -->
                <div class="box-12"> <!-- Crea una caja para el botón de envío, ocupando las 12 columnas disponibles en el diseño -->
                    <button type="submit" id="btnEnviar">Enviar Cotización</button> <!-- Botón para enviar el formulario y procesar la cotización -->
                </div>
            </div>
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

<script src="../../js/crear_nuevo/formulario_cotizacion.js"></script> <!-- Enlaza nuevamente el archivo JavaScript para manejar la lógica del formulario de cotización -->
<script src="../../js/crear_nuevo/actualizar_logo.js"></script> <!-- Enlaza un archivo JavaScript externo para actualizar el logo o realizar otras actualizaciones -->
</body>
</html>
