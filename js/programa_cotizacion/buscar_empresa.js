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


    function ExpandirMenu(isLoggedIn) {
        const Formulario = document.getElementById('empresaForm');
        const menu = document.getElementById('menuNavegacion');
        const btnSalir = document.getElementById('btnSalir');
        
        if (isLoggedIn) {
            Formulario.classList.add('hidden');
            menu.classList.remove('hidden');
            btnSalir.classList.remove('hidden');
        } else {
            Formulario.classList.remove('hidden');
            menu.classList.add('hidden');
            btnSalir.classList.add('hidden');
        }
    }
    
    function salir() {
        ExpandirMenu(false);
    }
    
    document.addEventListener('DOMContentLoaded', () => {
        if (document.querySelector('nav#menuNavegacion')) {
            ExpandirMenu(true);
        }
    });
    


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