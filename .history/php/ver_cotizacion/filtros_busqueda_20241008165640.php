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
            <input type="date" name="fecha_desde" id="fecha_desde">
        </div>
        <div>
            <label for="fecha_hasta">Fecha hasta:</label>
            <input type="date" name="fecha_hasta" id="fecha_hasta">
        </div>

        <!-- Filtro por Estado de Cotización -->
        <div>
            <label for="estado">Estado:</label>
            <select name="estado" id="estado">
                <option value="">Todos</option>
                <option value="pendiente">Pendiente</option>
                <option value="aprobada">Aprobada</option>
                <option value="rechazada">Rechazada</option>
            </select>
        </div>

        <!-- Filtro por Número de Cotización -->
        <div>
            <label for="numero_cotizacion">Número de Cotización:</label>
            <input type="text" name="numero_cotizacion" id="numero_cotizacion">
        </div>

        <!-- Filtro por Cliente -->
        <div>
            <label for="id_cliente">Cliente:</label>
            <select name="id_cliente" id="id_cliente">
                <option value="">Todos</option>
                <!-- Aquí se deben generar dinámicamente las opciones de clientes desde la base de datos -->
                <!-- Ejemplo:
                <option value="1">Cliente 1</option>
                <option value="2">Cliente 2</option>
                -->
            </select>
        </div>

        <!-- Filtro por Proyecto -->
        <div>
            <label for="id_proyecto">Proyecto:</label>
            <select name="id_proyecto" id="id_proyecto">
                <option value="">Todos</option>
                <!-- Aquí se deben generar dinámicamente las opciones de proyectos desde la base de datos -->
            </select>
        </div>

        <button type="submit">Filtrar</button>
    </form>
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
