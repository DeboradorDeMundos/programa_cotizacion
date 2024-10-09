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
    ------------------------------------- INICIO ITred Spa Formulario Creacion Porductos .PHP --------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

<?php
// Establece la conexión a la base de datos de ITred Spa
$conn = new mysqli('localhost', 'root', '', 'ITredSpa_bd');
?>
<!-- ---------------------
     -- FIN CONEXION BD --
     --------------------- -->
<?php
// Obtener el ID de la empresa desde la URL
$id_empresa = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Obtener los tipos de productos
$sql = "SELECT id_tipo_producto, tipo_producto FROM p_tipo_producto";
$result = $conn->query($sql);

// Preparar opciones para el select
$options = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value=\"" . $row["id_tipo_producto"] . "\">" . htmlspecialchars($row["tipo_producto"]) . "</option>";
    }
} else {
    $options = "<option value=\"\">No hay tipos de productos disponibles</option>";
}

$conn->close();
?>
<h2>Crear Productos</h2>
<form id="productos-form" action="procesar_productos.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Detalles del Producto</legend>
                    <table id="productos-table">
                        <thead>
                            <tr>
                                <th>Nombre del Producto</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Foto</th>
                                <th>Tipo de Producto</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="nombre_producto[]" required></td>
                                <td><textarea name="descripcion_producto[]" rows="4"></textarea></td>
                                <td><input type="number" step="0.01" name="precio_producto[]" required></td>
                                <td><input type="file" name="foto_producto[]" accept="image/*"></td>
                                <td>
                                    <select name="id_tipo_producto[]" required>
                                        <?php echo $options; ?>
                                    </select>
                                </td>
                                <td><button type="button" onclick="removeRow(this)">Eliminar</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Campo oculto para el ID de la empresa -->
                    <input type="hidden" name="id_empresa" value="<?php echo htmlspecialchars($id_empresa); ?>">
                    <div class="form-group">
                        <button type="button" class="btn-nuevo" onclick="addRow()">Nuevo Producto</button>
                        <button type="submit" class="btn-guardar">Guardar Productos</button>
                    </div>
                </fieldset>
            </form>

            <script src="../../js/crear_producto/crear_producto.js"></script> 

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Formulario creacion producto .PHP ----------------------------------------
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