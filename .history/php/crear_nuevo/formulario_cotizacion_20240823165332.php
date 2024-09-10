<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Cotización</title>
    <link rel="stylesheet" href="../../css/crear_nuevo/formulario_cotizacion.css">
</head>
<body>
    <div class="container">
        <form id="cotizacion-form" method="POST" action="http://localhost/Cotizacion_css_ITred_Spa_/php/crear_nuevo/procesar_cotizacion.php" enctype="multipart/form-data">
            <!-- Fila 1 -->
            <div class="row">
                <div class="box-6 logo-box">
                    <!-- Imagen del logo o foto de perfil -->
                    <label for="logo-upload" class="logo-container">
                        <img src="http://localhost/Cotizacion_css_ITred_Spa_/imagenes/cotizacion/logo.png" alt="Logo de la Empresa" class="logo" id="logo-preview">
                        <input type="file" id="logo-upload" name="logo_upload" accept="image/*" style="display:none;">
                        <span>Cargar Logo de Empresa</span>
                    </label>
                </div>
                <div class="box-6 data-box data-box-red">
                    <label for="empresa_rut">RUT de la Empresa:</label>
                    <input type="text" id="empresa_rut" name="empresa_rut" required>

                    <label for="numero_cotizacion">Número de Cotización:</label>
                    <input type="text" id="numero_cotizacion" name="numero_cotizacion" required>

                    <label for="validez_cotizacion">Validez de la Cotización:</label>
                    <input type="number" id="validez_cotizacion" name="validez_cotizacion" required>

                    <label for="fecha_emision">Fecha de Emisión:</label>
                    <input type="date" id="fecha_emision" name="fecha_emision" required>
                </div>
            </div>

            <!-- Fila 2 -->
            <div class="row">
                <div class="box-12 data-box">
                    <label for="empresa_nombre">Nombre de la Empresa:</label>
                    <input type="text" id="empresa_nombre" name="empresa_nombre" required>

                    <label for="empresa_area">Área de la Empresa:</label>
                    <input type="text" id="empresa_area" name="empresa_area">

                    <label for="empresa_direccion">Dirección de la Empresa:</label>
                    <input type="text" id="empresa_direccion" name="empresa_direccion">

                    <label for="empresa_telefono">Teléfono de la Empresa:</label>
                    <input type="text" id="empresa_telefono" name="empresa_telefono">

                    <label for="empresa_email">Email de la Empresa:</label>
                    <input type="email" id="empresa_email" name="empresa_email">
                </div>
            </div>

            <!-- Fila 3 -->
            <div class="row">
                <div class="box-6 data-box">
                    <label for="proyecto_nombre">Nombre del Proyecto:</label>
                    <input type="text" id="proyecto_nombre" name="proyecto_nombre" required>

                    <label for="proyecto_codigo">Código del Proyecto:</label>
                    <input type="text" id="proyecto_codigo" name="proyecto_codigo" required>

                    <label for="area_trabajo">Área de Trabajo:</label>
                    <input type="text" id="area_trabajo" name="area_trabajo" required>

                    <label for="tipo_trabajo">Tipo de Trabajo:</label>
                    <input type="text" id="tipo_trabajo" name="tipo_trabajo" required>

                    <label for="riesgo">Riesgo:</label>
                    <input type="text" id="riesgo" name="riesgo" required>
                </div>
                <div class="box-6 data-box data-box-left">
                    <label for="dias_compra">Días de Compra:</label>
                    <input type="number" id="dias_compra" name="dias_compra">

                    <label for="dias_trabajo">Días de Trabajo:</label>
                    <input type="number" id="dias_trabajo" name="dias_trabajo">

                    <label for="trabajadores">Número de Trabajadores:</label>
                    <input type="number" id="trabajadores" name="trabajadores">

                    <label for="horario">Horario:</label>
                    <input type="text" id="horario" name="horario">

                    <label for="colacion">Colación:</label>
                    <input type="text" id="colacion" name="colacion">

                    <label for="entrega">Entrega:</label>
                    <input type="text" id="entrega" name="entrega">
                </div>
            </div>

            <!-- Fila 4 -->
            <div class="row">
                <div class="box-6 data-box">
                    <label for="cliente_nombre">Nombre del Cliente:</label>
                    <input type="text" id="cliente_nombre" name="cliente_nombre" required>

                    <label for="cliente_rut">RUT del Cliente:</label>
                    <input type="text" id="cliente_rut" name="cliente_rut" required>

                    <label for="cliente_empresa">Empresa del Cliente:</label>
                    <input type="text" id="cliente_empresa" name="cliente_empresa">

                    <label for="cliente_direccion">Dirección del Cliente:</label>
                    <input type="text" id="cliente_direccion" name="cliente_direccion">

                    <label for="cliente_lugar">Lugar del Cliente:</label>
                    <input type="text" id="cliente_lugar" name="cliente_lugar">

                    <label for="cliente_fono">Teléfono del Cliente:</label>
                    <input type="text" id="cliente_fono" name="cliente_fono">
                </div>
                <div class="box-6 data-box data-box-left">
                    <label for="cliente_email">Email del Cliente:</label>
                    <input type="email" id="cliente_email" name="cliente_email">

                    <label for="cliente_cargo">Cargo del Cliente:</label>
                    <input type="text" id="cliente_cargo" name="cliente_cargo">

                    <label for="cliente_giro">Giro del Cliente:</label>
                    <input type="text" id="cliente_giro" name="cliente_giro">

                    <label for="cliente_comuna">Comuna del Cliente:</label>
                    <input type="text" id="cliente_comuna" name="cliente_comuna">

                    <label for="cliente_ciudad">Ciudad del Cliente:</label>
                    <input type="text" id="cliente_ciudad" name="cliente_ciudad">

                    <label for="cliente_tipo">Tipo de Cliente:</label>
                    <input type="text" id="cliente_tipo" name="cliente_tipo">
                </div>
            </div>

            <!-- Fila 5 -->
            <div class="row">
                <div class="box-6 data-box">
                    <label for="enc_nombre">Nombre del Encargado:</label>
                    <input type="text" id="enc_nombre" name="enc_nombre">

                    <label for="enc_email">Email del Encargado:</label>
                    <input type="email" id="enc_email" name="enc_email">

                    <label for="enc_fono">Teléfono del Encargado:</label>
                    <input type="text" id="enc_fono" name="enc_fono">
                </div>
                <div class="box-6 data-box data-box-left">
                    <label for="enc_celular">Celular del Encargado:</label>
                    <input type="text" id="enc_celular" name="enc_celular">

                    <label for="enc_proyecto">Proyecto Asignado:</label>
                    <input type="text" id="enc_proyecto" name="enc_proyecto">
                </div>
            </div>

            <!-- Fila 6 -->
            <div class="row">
                <div class="box-6 data-box">
                    <label for="vendedor_nombre">Nombre del Vendedor:</label>
                    <input type="text" id="vendedor_nombre" name="vendedor_nombre" required>

                    <label for="vendedor_email">Email del Vendedor:</label>
                    <input type="email" id="vendedor_email" name="vendedor_email" required>
                </div>
                <div class="box-6 data-box data-box-left">
                    <label for="vendedor_telefono">Teléfono del Vendedor:</label>
                    <input type="text" id="vendedor_telefono" name="vendedor_telefono">

                    <label for="vendedor_celular">Celular del Vendedor:</label>
                    <input type="text" id="vendedor_celular" name="vendedor_celular">
                </div>
            </div>

            
            <!-- sección para Detalle de Cotización -->
    <fieldset>
    <legend>Detalle de la Cotización</legend>
    <div id="detalle-container">
        <!-- Sección de Títulos -->
        <div class="detalle-section">
            <button type="button" onclick="addDetailSection()">Agregar un nuevo título</button> 
</fieldset>

<script src="../../js/crear_nuevo/formulario_cotizacion.js"></script>
<!-- Sección para los cálculos finales -->
<div id="calculos-finales">
        <fieldset>
            <legend>Cálculos Finales</legend>
            <table class="detalle-table">
                <thead>
                    <tr>
                        <th>NETO</th>
                        <th>DESCUENTO</th>
                        <th>IVA 19%</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td><input type="number" id="detalle_neto" step="1" min="1" readonly></td>
                    <td><input type="number" id="detalle_iva" readonly></td>
                    <td><input type="number" id="detalle_total" step="0" min="0" readonly></td>
                    
                    <td><input type="number" id="detalle_descuento" step="0" min="0" value="0" oninput="calculateTotals()"></td>
                    <td><input type="number" id="detalle_total_con_descuento" step="0" min="0" value="0" readonly></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </div>
    

            <button type="submit">Generar Cotización</button>
        </form>
    </div>


            <!-- Fila 7 -->
            <div class="row">
                <div class="box-12 data-box">
                    <label for="observaciones">Observaciones Adicionales:</label>
                    <textarea id="observaciones" name="observaciones" rows="4" cols="50"></textarea>
                </div>
            </div>

            <!-- Botón de envío -->
            <div class="row">
                <div class="box-12">
                    <button type="submit" id="btnEnviar">Enviar Cotización</button>
                </div>
            </div>
        </form>
    </div>

    <table>
        <tr>
            <th style="background-color:lightgray">CONDICIONES GENERALES</th>
        </tr>
        <tr>
            <td>1.- VALORES EXPRESADOS SERAN FACTURADOS EN MONEDA NACIONAL.</td>
        </tr>
        <tr>
            <td>2.- VALORES SUJETOS A VARIACION, DEBIDO A QUE LOS EQUIPOS, MATERIALES Y HERRAMIENTAS SON CALCULADOS CON EL VALOR DOLAR DIA</td>
        </tr>
        <tr>
            <td>3.- LAS INSTALACIONES NO INCLUYEN EQUIPOS, MATERIALES, FERRETERIA U OTRO TIPO DE HERRAMIENTAS QUE SE REQUIERAN PARA 
                EL TRABAJO, QUE NO SE ENCUENTRE DETALLADO DENTRO DE ESTA COTIZACION.</td>
        </tr>
        <tr>
            <td>4.- GARANTIA 6 MESES, DESDE EL DIA DE LA ENTREGA, LA QUE CADUCA AUTOMATICAMENTE, EN CASO DE NO CUPLIR LOS PAGOS, EN LAS FECHAS
                ACORDADAS</td>
        </tr>
        <tr>
            <td>5.- GARANTIA 6 MESES, DESDE EL DIA DE LA ENTREGA, LA QUE CADUCA AUTOMATICAMENTE, EN CASO DE HABER MANIPULACION O INTERVENCION DE
                TERCEROS</td>
        </tr>
        <tr>
            <td>6.- SI ALGUN TRABAJO, MATERIAL, PRODUCTO, EQUIPO, FERRETERIA O MANO DE OBRA, QUE NO SE ENCUENTRE EN ESTA COTIZACION, SE DEBERA COTIZAR
                Y AGREGAR EL VALOR A LA COTIZACION</td>
        </tr>
        <tr>
            <td>7.- LUGAR DE TRABAJO LIBRE DE OBJETOS, QUE SE PUEDAN, ROMPER, DAÑAR O ENTORPECER ELTRABAJO, DE LO CONTRARIO, SE DEBERA
                COTIZAR Y AGREGAR EL MOVIMIENTO DE OBJETOS A LA COTIZACION</td>
        </tr>
        <tr>
            <td>8.- EL CLIENTE DEBE INDICAR EL HORARIO DE ENTRADA Y DE SALIDA, CONTEMPLANDO QUE NUESTRO HORARIO DE TRABAJO ES DE LUNES A VIERNES DE
                9:00 AM A 18:30HRS</td>
        </tr>
        <tr>
            <td>9.- LOS DIAS DE TRABAJO, SON COTIZADOS DE LUNES A VIERNES DE 9:30AM A 18:30HRS., CON 1HR. DE COLACION, SI EL CLIENTE PRESENTA ALGUN
                PROBLEMA DE HORARIO O URGENCIAS, DEBERA DAR AVISO ANTES DE COMENZAR EL PROYECTO, PARA AGREGAR HORAS EXTRAS, VIATICOS Y TODO
                LO QUE CORRESPONDE PARA CUMPLIR CON LA URGENCIA DEL CLIENTE, YA SEA TRABAJO DESPUES DE LA HORA LABORAL, FIN DE SEMANA O FESTIVOS</td>
        </tr>
        <tr>
            <td>10.- EL CLIENTE DEBE INDICAR LOS HORARIOS, EN LOS CUALES, SE PERMITE HACER RUIDOS FUERTES O INTERVENIR ENTRADAS, PASILLOS, CON MESONES,
                ESCALERAS, HERRAMIENTAS, ENTRE OTROS, ESTO ES MUY IMPORTANTE, PORQUE SI LOS HORARIOS SON MUY COMPLICADOS O REDUCIDOS, SE DEBERA
                RECALCULAR EL PRESUPUESTO</td>
        </tr>
  </table>
  <h2>TRANFERENCIAS A:</h2>
  <table>
        <tr>
            <th>CHEQUERA ELECTRONICA ITRED SPA</th>
            <th>CUENTA CORRIENTE PERSONAL</th>
            <th>CUENTA RUT PERSONAL</th>
        </tr>
        <tr>
            <td>BANCO: Banco Estado</td>
            <td>BANCO: Santander</td>
            <td>BANCO: Banco Estado</td>
        </tr>
        <tr>
            <td>TIPO CUENTA: Chequera electronica</td>
            <td>TIPO CUENTA: Cuenta corrente</td>
            <td>TIPO CUENTA: Cuenta rut</td>
        </tr>
        <tr>
            <td>NUMERO CUENTA: 902-7-053409-0</td>
            <td>NUMERO CUENTA: 0-000-77-51325-6</td>
            <td>NUMERO CUENTA: 15457398</td>
        </tr>
        <tr>
            <td>NOMBRE: ITRED SPA</td>
            <td>NOMBRE: Barner Piña Jara</td>
            <td>NOMBRE: Barner Piña Jara</td>
            </tr>
        <tr>
            <td>RUT: 77.243.277-1</td>
            <td>RUT: 15.457.398-4</td>
            <td>RUT:15.457.398-4</td>
        </tr>
        <tr>
            <td>E-MAIL: barnerp1@gmail.com</td>
            <td>E-MAIL: barnerp1@gmail.com</td>
            <td>E-MAIL: barnerp1@gmail.com</td>
        </tr>
  </table>
  <p>SIN OTRO PARTICULAR, Y ESPERANDO QUE LA PRESENTE OFERTA SEA DE SU INTERÉS, SE DESPIDE ATENTAMENTE</p>
  <p>BARNER PATRICIO PIÑA JARA</p>
  <p>JEFE DE PROYECTO TECNOLOGIA Y CONSTRUCCION</p>
  <p>ITRED SPA.</p>

    <script src="../../js/crear_nuevo/formulario_cotizacion.js"></script>
    <script src="../../js/crear_nuevo/actualizar_logo.js"></script>
</body>
</html>
