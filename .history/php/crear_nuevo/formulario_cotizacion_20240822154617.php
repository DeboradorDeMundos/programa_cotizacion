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
            <img src="imagenes/logo.png" alt="Logo de la Empresa" class="logo">
            <div class="header-info">
                <div class="info-box">
                    <p>Rut: <span id="empresa-rut"></span></p>
                    <p>Cotización: <span>Cotización</span></p>
                    <p>Número de Cotización: <span id="cotizacion-numero"></span></p>
                </div>
                <p class="fecha-generacion">Fecha: <span id="fecha-generacion"></span></p>
            </div>
        </header>

        <form id="cotizacion-form" method="POST" action="procesar_cotizacion.php">
            <fieldset>
                <legend>Datos del Proyecto</legend>
                <label for="numero_cotizacion">Número de Cotización:</label>
                <input type="text" id="numero_cotizacion" name="numero_cotizacion" required>

                <label for="fecha_emision">Fecha de Emisión:</label>
                <input type="date" id="fecha_emision" name="fecha_emision" required>

                <label for="fecha_validez">Fecha de Validez:</label>
                <input type="date" id="fecha_validez" name="fecha_validez" required>

                <label for="dias_compra">Días de Compra:</label>
                <input type="text" id="dias_compra" name="dias_compra">

                <label for="dias_trabajo">Días de Trabajo:</label>
                <input type="text" id="dias_trabajo" name="dias_trabajo">

                <label for="trabajadores">Número de Trabajadores:</label>
                <input type="number" id="trabajadores" name="trabajadores">

                <label for="horario">Horario:</label>
                <input type="text" id="horario" name="horario">

                <label for="colacion">Colación:</label>
                <input type="text" id="colacion" name="colacion">

                <label for="entrega">Entrega:</label>
                <input type="text" id="entrega" name="entrega">
            </fieldset>

            <fieldset>
                <legend>Datos del Cliente</legend>
                <label for="id_cliente">ID del Cliente:</label>
                <input type="number" id="id_cliente" name="id_cliente" required>

                <label for="id_proyecto">ID del Proyecto:</label>
                <input type="number" id="id_proyecto" name="id_proyecto" required>

                <label for="id_empresa">ID de la Empresa:</label>
                <input type="number" id="id_empresa" name="id_empresa" required>

                <label for="total_neto">Total Neto:</label>
                <input type="number" step="0.01" id="total_neto" name="total_neto" required>

                <label for="iva">IVA:</label>
                <input type="number" step="0.01" id="iva" name="iva" required>

                <label for="total_con_iva">Total con IVA:</label>
                <input type="number" step="0.01" id="total_con_iva" name="total_con_iva" required>

                <label for="descuento">Descuento:</label>
                <input type="number" step="0.01" id="descuento" name="descuento">

                <label for="total_final">Total Final:</label>
                <input type="number" step="0.01" id="total_final" name="total_final">
            </fieldset>

            <button type="submit">Generar Cotización</button>
        </form>
    </div>

    <script src="../js/crear_nuevo/formulario_cotizacion.js"></script>
</body>
</html>
