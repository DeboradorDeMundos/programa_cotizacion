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
    ------------------------------------- INICIO ITred Spa Traer detalle .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

<?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'ITredSpa_bd');
?>
<!-- ---------------------
// FIN CONEXION BD --
// --------------------- -->

<?php

$id_cotizacion = $_GET['id'] ?? 0; // Obtener el ID de la cotización

// Consultar los títulos, subtítulos y detalles relacionados con la cotización
$sql_titulos = "SELECT * FROM C_Titulos WHERE id_cotizacion = ?";
$stmt_titulos = $mysqli->prepare($sql_titulos);
$stmt_titulos->bind_param("i", $id_cotizacion);
$stmt_titulos->execute();
$titulos_result = $stmt_titulos->get_result();

// Preparar los datos para mostrar
$titulos = [];
while ($titulo = $titulos_result->fetch_assoc()) {
    $id_titulo = $titulo['id_titulo'];

    // Consultar los subtítulos
    $sql_subtitulos = "SELECT * FROM C_Subtitulos WHERE id_titulo = ?";
    $stmt_subtitulos = $mysqli->prepare($sql_subtitulos);
    $stmt_subtitulos->bind_param("i", $id_titulo);
    $stmt_subtitulos->execute();
    $subtitulos_result = $stmt_subtitulos->get_result();
    $subtitulos = $subtitulos_result->fetch_all(MYSQLI_ASSOC);

    // Consultar los detalles
    $sql_detalles = "SELECT * FROM C_Detalles WHERE id_titulo = ?";
    $stmt_detalles = $mysqli->prepare($sql_detalles);
    $stmt_detalles->bind_param("i", $id_titulo);
    $stmt_detalles->execute();
    $detalles_result = $stmt_detalles->get_result();
    $detalles = $detalles_result->fetch_all(MYSQLI_ASSOC);

    $titulos[] = [
        'titulo' => $titulo,
        'subtitulos' => $subtitulos,
        'detalles' => $detalles,
    ];
}

// Cerrar las conexiones
$stmt_titulos->close();
$stmt_subtitulos->close();
$stmt_detalles->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Cotización</title>
    <link rel="stylesheet" href="../../css/ver_cotizacion/traer_detalle.css"> <!-- Estilo CSS -->
    <script src="details.js" defer></script> <!-- Script JavaScript -->
</head>
<body>
    <fieldset>
        <legend>Detalle de la Cotización</legend>
        <div id="contenedor-detalle">
            <?php foreach ($titulos as $titulo_index => $titulo_data): ?>
                <div class="seccion-detalle" data-titulo-index="<?php echo $titulo_index; ?>">
                    <div class="detalle-content">
                        <div class="titulo-contenedor" style="display: flex; align-items: center;">
                            <label for="titulo">Título:</label>
                            <input type="text" name="detalle_titulo[<?php echo $titulo_index; ?>]" value="<?php echo htmlspecialchars($titulo_data['titulo']['nombre']); ?>" required style="margin-right: 10px;">
                            <button type="button" class="btn-eliminar-titulo" onclick="removeDetailSection(this)">Eliminar Título</button>
                        </div>
                        <table class="detalle-table">
                            <thead>
                                <!-- Aquí se agregará dinámicamente la cabecera si no existe -->
                            </thead>
                            <tbody class="detalle-contenido">
                                <?php foreach ($titulo_data['detalles'] as $detalle): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($detalle['tipo']); ?></td>
                                        <td><?php echo htmlspecialchars($detalle['nombre_producto']); ?></td>
                                        <td><input type="checkbox" <?php echo $detalle['descripcion'] ? 'checked' : ''; ?> onclick="toggleDescription(this)"></td>
                                        <td><?php echo htmlspecialchars($detalle['cantidad']); ?></td>
                                        <td><?php echo htmlspecialchars($detalle['precio_unitario']); ?></td>
                                        <td><?php echo htmlspecialchars($detalle['descuento_porcentaje']); ?></td>
                                        <td><?php echo htmlspecialchars($detalle['total']); ?></td>
                                        <td><button type="button" class="btn-eliminar" onclick="removeDetailRow(this)">Eliminar</button></td>
                                    </tr>
                                    <tr class="descripcion-row" style="<?php echo $detalle['descripcion'] ? 'table-row' : 'none'; ?>">
                                        <td colspan="7"><textarea name="detalle_descripcion[<?php echo $titulo_index; ?>][]"><?php echo htmlspecialchars($detalle['descripcion']); ?></textarea></td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php foreach ($titulo_data['subtitulos'] as $subtitulo): ?>
                                    <tr class="subtitulo">
                                        <td colspan="7"><?php echo htmlspecialchars($subtitulo['nombre']); ?></td>
                                        <td><button type="button" class="btn-eliminar-titulo" onclick="removeSubtitleRow(this)">Eliminar subtítulo</button></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="detalle-buttons">
                        <button type="button" onclick="addcabeza(this)">Agregar Cabecera</button>
                        <button type="button" onclick="addDetailRow(this)">Agregar detalles</button>
                        <button type="button" onclick="addSubtitleRow(this)">Agregar subtítulo</button>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="fixed-button-contenedor">
                <button type="button" onclick="addDetailSection()">Agregar un nuevo título</button>
            </div>
        </div>
    </fieldset>
</body>
</html>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Traer detalle .PHP ----------------------------------------
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
