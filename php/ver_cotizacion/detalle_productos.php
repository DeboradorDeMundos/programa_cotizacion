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

 <div class="section">
    <h3>PRODUCTOS</h3>
    <table class="tabla-productos">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?php echo $producto['nombre_producto']; ?></td>
                        <td><?php echo $producto['cantidad']; ?></td>
                        <td>$<?php echo $producto['precio_unitario']; ?></td>
                        <td>$<?php echo $producto['total']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No se encontraron productos.</td>
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