
/* 
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ 
*/


/* --------------------------------------------------------------------------------------------------------------
    -------------------------------------- INICIO ITred Spa Programa Cotizacion .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    function mostrarCampoBusqueda() {
        var busquedaPor = document.getElementById('busqueda-por').value;
        var campoRut = document.getElementById('campo-rut');
        var campoNombre = document.getElementById('campo-nombre');
        var btnBuscar = document.getElementById('btn-buscar');

        // Mostrar el campo correspondiente según la selección
        campoRut.style.display = busquedaPor === 'rut' ? 'block' : 'none';
        campoNombre.style.display = busquedaPor === 'nombre' ? 'block' : 'none';
        
        // Mostrar el botón de búsqueda solo si se ha seleccionado un criterio
        btnBuscar.style.display = (busquedaPor === 'rut' || busquedaPor === 'nombre') ? 'block' : 'none';
    }

    
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Programa Cotizacion .JS ---------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


/*
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
*/