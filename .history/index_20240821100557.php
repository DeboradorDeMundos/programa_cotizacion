<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización ITred Spa</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js" defer></script>
</head>
<body>
    <h1>Formulario de Cotización</h1>
    <form action="php/crear.php" method="POST">
        <label for="cliente">Nombre del Cliente:</label>
        <input type="text" id="cliente" name="cliente" required><br><br>

        <label for="producto">Producto/Servicio:</label>
        <input type="text" id="producto" name="producto" required><br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" required><br><br>

        <label for="precio">Precio Unitario:</label>
        <input type="number" id="precio" name="precio" required><br><br>

        <input type="submit" value="Generar Cotización">
    </form>
</body>
</html>
