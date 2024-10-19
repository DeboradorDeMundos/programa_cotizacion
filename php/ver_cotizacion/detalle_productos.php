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
    ------------------------------------- INICIO ITred Spa Dettalle productos .PHP --------------------------------------
 ------------------------------------------------------------------------------------------------------------- -->
 <div class="section"> <!-- Título: Sección de productos -->
    <!-- Título: Encabezado de productos -->
    <h3>PRODUCTOS</h3> 
    <!-- Título: Tabla de productos -->
    <table class="tabla-productos"> 
        <!-- Título: Encabezado de la tabla -->
        <thead> 
            <tr>
                <!-- Título: Descripción del producto --> 
                <th>Descripción</th>
                <!-- Título: Cantidad del producto --> 
                <th>Cantidad</th>
                <!-- Título: Precio unitario del producto --> 
                <th>Precio Unitario</th>
                <!-- Título: Total del producto --> 
                <th>Total</th>
            </tr>
        </thead>
        <!-- Título: Cuerpo de la tabla -->
        <tbody> 
            <?php if (!empty($productos)): ?> <!-- Título: Verificación de productos -->
                <?php foreach ($productos as $producto): ?> <!-- Título: Iteración sobre productos -->
                    <tr>
                        <!-- Título: Nombre del producto --> 
                        <td><?php echo $producto['nombre_producto']; ?></td> 
                        <!-- Título: Cantidad --> 
                        <td><?php echo $producto['cantidad']; ?></td> 
                        <!-- Título: Precio unitario --> 
                        <td>$<?php echo $producto['precio_unitario']; ?></td> 
                        <!-- Título: Total --> 
                        <td>$<?php echo $producto['total']; ?></td> 
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4"><!-- Título: Mensaje si no hay productos --> No se encontraron productos.</td> 
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>




<!-- ------------------------------------------------------------------------------------------------------------
    -------------------------------------- FIN ITred Spa Dettalle productos .PHP -----------------------------------
    ------------------------------------------------------------------------------------------------------------- -->

<!--
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITredSpa.
BPPJ
-->