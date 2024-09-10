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
        <header>
            <img src="../../imagenes/cotizacion/logo.png" alt="Logo de la Empresa" class="logo">
        </header>
        <form id="cotizacion-form" method="POST" action="procesar_cotizacion.php">
            <div class="header-info">
                <div class="info-box">
                    <label for="empresa_rut">RUT de la Empresa: </label>
                    <input type="text" id="empresa_rut" name="empresa_rut" required>

                    <label for="empresa_nombre">Nombre de la Empresa: </label>
                    <input type="text" id="empresa_nombre" name="empresa_nombre" required>

                    <label for="empresa_area">Área de la Empresa: </label>
                    <input type="text" id="empresa_area" name="empresa_area">

                    <label for="empresa_direccion">Dirección de la Empresa: </label>
                    <input type="text" id="empresa_direccion" name="empresa_direccion">

                    <label for="numero_cotizacion">Número de Cotización:</label>
                    <input type="text" id="numero_cotizacion" name="numero_cotizacion" required>

                    <label for="validez_cotizacion">Validez de la Cotización (días):</label>
                    <input type="number" id="validez_cotizacion" name="validez_cotizacion" required>

                    <label for="fecha_emision">Fecha de Emisión:</label>
                    <input type="date" id="fecha_emision" name="fecha_emision" required>

                    <label for="empresa_telefono">Teléfono de la Empresa:</label>
                    <input type="text" id="empresa_telefono" name="empresa_telefono">

                    <label for="empresa_email">Email de la Empresa:</label>
                    <input type="email" id="empresa_email" name="empresa_email">
                </div>
            </div>
            <fieldset>
                <legend>Datos del Proyecto</legend>
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
            </fieldset>

            <fieldset>
                <legend>Datos del Cliente</legend>
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
            </fieldset>

            <fieldset>
                <legend>Datos del Encargado</legend>
                <label for="enc_nombre">Nombre del Encargado:</label>
                <input type="text" id="enc_nombre" name="enc_nombre">

                <label for="enc_email">Email del Encargado:</label>
                <input type="email" id="enc_email" name="enc_email">

                <label for="enc_fono">Teléfono del Encargado:</label>
                <input type="text" id="enc_fono" name="enc_fono">

                <label for="enc_celular">Celular del Encargado:</label>
                <input type="text" id="enc_celular" name="enc_celular">

                <label for="enc_proyecto">Proyecto Asignado:</label>
                <input type="text" id="enc_proyecto" name="enc_proyecto">
            </fieldset>

            <fieldset>
                <legend>Datos del Vendedor</legend>
                <label for="vendedor_nombre">Nombre del Vendedor:</label>
                <input type="text" id="vendedor_nombre" name="vendedor_nombre" required>

                <label for="vendedor_email">Email del Vendedor:</label>
                <input type="email" id="vendedor_email" name="vendedor_email" required>

                <label for="vendedor_fono">Teléfono del Vendedor:</label>
                <input type="text" id="vendedor_fono" name="vendedor_fono" required>

                <label for="vendedor_celular">Celular del Vendedor:</label>
                <input type="text" id="vendedor_celular" name="vendedor_celular">
            </fieldset>

            <fieldset>
                <legend>Datos Adicionales</legend>
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
            </fieldset>

            <!-- Nueva sección para Detalle de Cotización -->
            <fieldset>
                <legend>Detalle de la Cotización</legend>
                <div id="detalle-container">
                    <!-- Sección de Títulos -->
                    <div class="detalle-section">
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="detalle_titulo[]" required>
                        <button type="button" onclick="addDetailRow(this)">Agregar detalles</button>
                        <table class="detalle-table">
                            <thead>
                                <tr>
                                    <th>CANTIDAD</th>
                                    <th>DESCRIPCIÓN</th>
                                    <th>PRECIO UNI.</th>
                                    <th>TOTAL</th>
                                    <th>ACCION</th>
                                 </tr>
                            </thead>
                            <tbody>
                                <!-- Fila de ejemplo -->
                                <tr>
                                    <td><input type="number" name="detalle_cantidad[]" step="1" min="1" required></td>
                                    <td><input type="text" name="detalle_descripcion[]" required></td>
                                    <td><input type="number" name="detalle_precio_unitario[]" step="0.01" min="0" required></td>
                                    <td><input type="number" name="detalle_total[]" step="0.01" min="0" value="0"></td>
                                    <td><button type="button" onclick="removeDetailRow(this)">Eliminar</button></td>
                                </tr>
                                <tr>
                                    <td><input type="number" name="detalle_neto[]" step="1" min="1" required></td>
                                    <td><input type="number" name="detalle_descripcion[]" required></td>
                                    <td><input type="number" name="detalle_precio_unitario[]" step="0.01" min="0" required></td>
                                    <td><input type="number" name="detalle_total[]" step="0.01" min="0" value="0"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="button" onclick="addDetailSection()">Agregar un nuevo titulo</button>
            </fieldset>

            <button type="submit">Generar Cotización</button>
        </form>
    </div>

    <script src="../../js/crear_nuevo/formulario_cotizacion.js"></script>
</body>
</html>
