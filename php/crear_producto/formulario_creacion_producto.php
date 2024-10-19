<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
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

// Consultar los tipos de productos disponibles en la base de datos
$sql = "SELECT id_tipo_producto, tipo_producto FROM p_tipo_producto";
$result = $conn->query($sql);

// Preparar opciones para el select de tipos de productos
$options = "";
if ($result->num_rows > 0) {
    // Si hay tipos de productos, agregar cada uno como una opción en el select
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value=\"" . $row["id_tipo_producto"] . "\">" . htmlspecialchars($row["tipo_producto"]) . "</option>";
    }
} else {
    // Si no hay tipos de productos, mostrar un mensaje en la opción
    $options = "<option value=\"\">No hay tipos de productos disponibles</option>";
}

// Cierra la conexión a la base de datos después de obtener los tipos de productos
$conn->close();
?>

<h2>Crear Productos</h2>

<!-- Formulario para la creación de productos -->
<form id="productos-form" action="procesar_productos.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <!-- Título para los detalles del producto -->
        <legend>Detalles del Producto</legend>
        
        <table id="productos-table">
            <thead>
                <tr>
                    <!-- Columna para cada elemento -->
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
                    <!-- Título para el campo de nombre del producto -->
                    <td><!-- Campo para el nombre del producto -->
                        <label for="nombre_producto">Nombre del Producto:</label>
                        <input type="text" name="nombre_producto[]" required>
                    </td>
                    
                    <!-- Título para el campo de descripción del producto -->
                    <td><!-- Campo para la descripción del producto -->
                        <label for="descripcion_producto">Descripción:</label>
                        <textarea name="descripcion_producto[]" rows="4"></textarea>
                    </td>
                    
                    <!-- Título para el campo de precio del producto -->
                    <td><!-- Campo para el precio del producto -->
                        <label for="precio_producto">Precio:</label>
                        <input type="number" step="0.01" name="precio_producto[]" required>
                    </td>
                    
                    <!-- Título para el campo de foto del producto -->
                    <td><!-- Campo para subir la foto del producto -->
                        <label for="foto_producto">Foto:</label>
                        <input type="file" name="foto_producto[]" accept="image/*">
                    </td>
                    
                    <!-- Título para el select de tipo de producto -->
                    <td><!-- Select para elegir el tipo de producto -->
                        <label for="id_tipo_producto">Tipo de Producto:</label>
                        <select name="id_tipo_producto[]" required>
                            <?php echo $options; ?> <!-- Opciones generadas desde la consulta a la base de datos -->
                        </select>
                    </td>
                    
                    <!-- Título para el botón de eliminar fila -->
                    <td><!-- Botón para eliminar la fila actual -->
                        <button type="button" onclick="removeRow(this)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <!-- Campo oculto para el ID de la empresa, que se enviará con el formulario -->
        <input type="hidden" name="id_empresa" value="<?php echo htmlspecialchars($id_empresa); ?>">
        
        <div class="form-group">
            <!-- Título para el botón de agregar un nuevo producto -->
            <button type="button" class="btn-nuevo" onclick="addRow()">Nuevo Producto</button>
            
            <!-- Título para el botón de enviar el formulario y guardar los productos -->
            <button type="submit" class="btn-guardar">Guardar Productos</button>
        </div>
    </fieldset>
</form>

<!-- Script para la funcionalidad del formulario, como agregar y eliminar filas -->
<script src="../../js/crear_producto/crear_producto.js"></script>

<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Formulario creacion producto .PHP ----------------------------------------
    ------------------------------------------------------------------------------------------------------------- -->
	
     
<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
-->