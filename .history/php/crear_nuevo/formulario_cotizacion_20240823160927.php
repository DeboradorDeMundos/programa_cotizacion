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
                        <th>IVA 19%</th>
                        <th>TOTAL</th>
                        <th>DESCUENTO</th>
                        <th>TOTAL CON DESCUENTO</th>
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

    

    <script src="../../js/crear_nuevo/formulario_cotizacion.js"></script>
    <script src="../../js/crear_nuevo/actualizar_logo.js"></script>
</body>
</html>
