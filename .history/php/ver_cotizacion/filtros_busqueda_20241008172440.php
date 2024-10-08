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
     <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cotizaciones</title>
    <link rel="stylesheet" href="../../css/ver_listado/filtros_busqueda.css">
</head>
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


<script src="../../js/ver_cotizacion/filtros_busqueda.js"></script> 

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
