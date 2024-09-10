<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Cotización</title>
    <link rel="stylesheet" href="styles/formulario_cotizacion.css">
</head>
<body>
    <div class="container">
        <header>
            <img src="../../imagenes/logo.png" alt="Logo de la Empresa" class="logo">
            <div class="header-info">
                <div class="info-box">
                    <label for="empresa-rut">Rut: </label>
                    <input type="text" id="empresa-rut" name="empresa_rut" required>
                    <br><label for="empresa-nombre">Nombre: </label>
                    <input type="text" name="empresa_nombre" required>
                    <p>Cotización:</p>
                    <label for="cotizacion-numero">Número de Cotización:</label>
                    <input type="text" id="cotizacion-numero" name="numero_cotizacion">
                </div>

            </div>
        </header>

        <form id="cotizacion-form" method="POST" action="procesar_cotizacion.php">
            <fieldset>
                <legend>Datos del Proyecto</legend>
                <label for="proyecto_nombre">Nombre del Proyecto:</label>
                <input type="text" id="proyecto_nombre" name="proyecto_nombre" required>

                <label for="codigo_prov">Código del Proyecto:</label>
                <input type="text" id="codigo_prov" name="codigo_prov" required>

                <label for="area_trabajo">Área de Trabajo:</label>
                <input type="text" id="area_trabajo" name="area_trabajo" required>

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

                <label for="cliente_fono">Teléfono del Cliente:</label>
                <input type="text" id="cliente_fono" name="cliente_fono">

                <label for="cliente_email">Email del Cliente:</label>
                <input type="email" id="cliente_email" name="cliente_email">
            </fieldset>

            <fieldset>
                <legend>Datos del Vendedor</legend>
                <label for="vendedor_nombre">Nombre del Vendedor:</label>
                <input type="text" id="vendedor_nombre" name="vendedor_nombre" required>

                <label for="vendedor_email">Email del Vendedor:</label>
                <input type="email" id="vendedor_email" name="vendedor_email" required>

                <label for="vendedor_fono">Teléfono del Vendedor:</label>
                <input type="text" id="vendedor_fono" name="vendedor_fono" required>
            </fieldset>

            <fieldset>
                <legend>Datos de la Cotización</legend>
                <label for="fecha_cotizacion">Fecha de la Cotización:</label>
                <input type="date" id="fecha_cotizacion" name="fecha_cotizacion" required>

                <label for="validez_cotizacion">Validez (días):</label>
                <input type="number" id="validez_cotizacion" name="validez_cotizacion" required>

                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" required>

                <label for="descripcion_servicio">Descripción del Servicio:</label>
                <textarea id="descripcion_servicio" name="descripcion_servicio" required></textarea>

                <label for="precio_unitario">Precio Unitario:</label>
                <input type="number" step="0.01" id="precio_unitario" name="precio_unitario" required>
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

            <button type="submit">Generar Cotización</button>
        </form>
    </div>

    <script src="../js/crear_nuevo/formulario_cotizacion.js"></script>
</body>
</html>
