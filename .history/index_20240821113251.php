<!DOCTYPE html>
<html lang="es">
<head>
    <!-- ------------------------------------------------------------------------------------------------------------
    ------------------------------------- INICIO ITred Spa Menú básico .PHP --------------------------------------
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

    <!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Menú básico .PHP ----------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
        <title>Cotización ITred Spa</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js" defer></script>
</head>

    <h1>Cotización ITred Spa</h1>
    <form action="php/crear_nuevo/crear.php" method="POST">
        <h2>Datos de Cotización</h2>
        
        <!-- Información del Proyecto -->
        <label for="proyecto">Proyecto:</label>
        <input type="text" id="proyecto" name="proyecto" required><br><br>

        <label for="cod_prov">Código Prov:</label>
        <input type="text" id="cod_prov" name="cod_prov" required><br><br>

        <!-- Datos del Cliente -->
        <h3>Datos Cliente</h3>
        <label for="cliente_empresa">Empresa:</label>
        <input type="text" id="cliente_empresa" name="cliente_empresa" required><br><br>

        <label for="cliente_rut">RUT:</label>
        <input type="text" id="cliente_rut" name="cliente_rut" required><br><br>

        <label for="cliente_direccion">Dirección:</label>
        <input type="text" id="cliente_direccion" name="cliente_direccion" required><br><br>

        <label for="cliente_fono">Teléfono:</label>
        <input type="text" id="cliente_fono" name="cliente_fono" required><br><br>

        <label for="cliente_email">E-mail:</label>
        <input type="email" id="cliente_email" name="cliente_email" required><br><br>

        <!-- Detalles de los Servicios -->
        <h3>Detalles del Servicio</h3>
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" required></textarea><br><br>

        <label for="precio_unitario">Precio Unitario:</label>
        <input type="number" id="precio_unitario" name="precio_unitario" required><br><br>

        <input type="submit" value="Generar Cotización">
    </form>

    <!-- Área para mostrar la cotización generada -->
    <div id="cotizacion_resultado">
        <!-- Aquí se mostrará el contenido generado por el script PHP -->
    </div>


    <!--
    Sitio Web Creado por ITred Spa.
    Direccion: Guido Reni #4190
    Pedro Agui Cerda - Santiago - Chile
    contacto@itred.cl o itred.spa@gmail.com
    https://www.itred.cl
    Creado, Programado y Diseñado por ITred Spa.
    BPPJ
    -->
</body>
</html>
