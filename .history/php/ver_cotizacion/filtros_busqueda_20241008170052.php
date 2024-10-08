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
    ------------------------------------- INICIO ITred Spa Filtro Busqueda .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->


    <div class="filtro-cotizaciones">
    <form method="GET" action="">
        <!-- Filtro por Fecha de Emisión -->
        <div>
            <label for="fecha_desde">Fecha desde:</label>
            <input type="date" name="fecha_desde" id="fecha_desde" value="<?php echo isset($_GET['fecha_desde']) ? $_GET['fecha_desde'] : ''; ?>">
        </div>
        <div>
            <label for="fecha_hasta">Fecha hasta:</label>
            <input type="date" name="fecha_hasta" id="fecha_hasta" value="<?php echo isset($_GET['fecha_hasta']) ? $_GET['fecha_hasta'] : ''; ?>">
        </div>

        <!-- Filtro por Estado de Cotización -->
        <div>
            <label for="estado">Estado:</label>
            <select name="estado" id="estado">
                <option value="">Todos</option>
                <option value="pendiente" <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                <option value="aprobada" <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'aprobada') ? 'selected' : ''; ?>>Aprobada</option>
                <option value="rechazada" <?php echo (isset($_GET['estado']) && $_GET['estado'] == 'rechazada') ? 'selected' : ''; ?>>Rechazada</option>
            </select>
        </div>

        <!-- Filtro por Número de Cotización -->
        <div>
            <label for="numero_cotizacion">Número de Cotización:</label>
            <input type="text" name="numero_cotizacion" id="numero_cotizacion" value="<?php echo isset($_GET['numero_cotizacion']) ? $_GET['numero_cotizacion'] : ''; ?>">
        </div>

        <button type="submit">Filtrar</button>
    </form>
</div>

<?php
// Iniciar la consulta base para buscar cotizaciones según la empresa seleccionada
$consulta = "SELECT * FROM C_Cotizaciones WHERE id_empresa = :id_empresa";

// Agregar filtro por fechas si se seleccionan
if (!empty($_GET['fecha_desde'])) {
    $consulta .= " AND fecha_emision >= :fecha_desde";
}
if (!empty($_GET['fecha_hasta'])) {
    $consulta .= " AND fecha_emision <= :fecha_hasta";
}

// Agregar filtro por estado si se selecciona
if (!empty($_GET['estado'])) {
    $consulta .= " AND estado = :estado";
}

// Agregar filtro por número de cotización si se proporciona
if (!empty($_GET['numero_cotizacion'])) {
    $consulta .= " AND numero_cotizacion LIKE :numero_cotizacion";
}

// Preparar la consulta en PDO
$sentencia = $mysql->prepare($consulta);

// Vincular parámetros de la consulta
$sentencia->bindValue(':id_empresa', $id_empresa);

if (!empty($_GET['fecha_desde'])) {
    $sentencia->bindValue(':fecha_desde', $_GET['fecha_desde']);
}
if (!empty($_GET['fecha_hasta'])) {
    $sentencia->bindValue(':fecha_hasta', $_GET['fecha_hasta']);
}
if (!empty($_GET['estado'])) {
    $sentencia->bindValue(':estado', $_GET['estado']);
}
if (!empty($_GET['numero_cotizacion'])) {
    $sentencia->bindValue(':numero_cotizacion', '%' . $_GET['numero_cotizacion'] . '%');
}

// Ejecutar la consulta
$sentencia->execute();
$resultados = $sentencia->fetchAll();
?>

<!-- Mostrar resultados de la consulta -->
<div class="listado-cotizaciones">
    <?php if (!empty($resultados)): ?>
        <table>
            <thead>
                <tr>
                    <th>Número de Cotización</th>
                    <th>Fecha de Emisión</th>
                    <th>Fecha de Validez</th>
                    <th>Estado</th>
                    <!-- Puedes agregar más columnas aquí según lo que quieras mostrar -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $cotizacion): ?>
                    <tr>
                        <td><?php echo $cotizacion['numero_cotizacion']; ?></td>
                        <td><?php echo $cotizacion['fecha_emision']; ?></td>
                        <td><?php echo $cotizacion['fecha_validez']; ?></td>
                        <td><?php echo $cotizacion['estado']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No se encontraron cotizaciones con los criterios seleccionados.</p>
    <?php endif; ?>
</div>


<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Filtro Busqueda .PHP -----------------------------------
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
