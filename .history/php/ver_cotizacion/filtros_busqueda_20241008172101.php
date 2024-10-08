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


<!-- ------------------------
     -- INICIO CONEXION BD --
     ------------------------ -->

<?php
// Establece la conexión a la base de datos de ITred Spa
$mysqli = new mysqli('localhost', 'root', '', 'itredspa_bd');

<form id="filtro-form">
    <label for="numero_cotizacion">Número de Cotización:</label>
    <input type="text" id="numero_cotizacion" name="numero_cotizacion">
    
    <label for="estado">Estado:</label>
    <select id="estado" name="estado">
        <option value="">Todos</option>
        <option value="Pendiente">Pendiente</option>
        <option value="Aprobado">Aprobado</option>
        <option value="Rechazado">Rechazado</option>
    </select>

    <label for="fecha_inicio">Fecha Inicio:</label>
    <input type="date" id="fecha_inicio" name="fecha_inicio">

    <label for="fecha_fin">Fecha Fin:</label>
    <input type="date" id="fecha_fin" name="fecha_fin">

    <button type="submit">Buscar</button>
</form>



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
