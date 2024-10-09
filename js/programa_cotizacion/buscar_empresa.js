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
        const Formulario = document.getElementById('empresaForm'); // Obtener el formulario de la empresa
        const menu = document.getElementById('menuNavegacion'); // Obtener el menú de navegación
        const btnSalir = document.getElementById('btnSalir'); // Obtener el botón de salir
        
        // Verificar si el usuario está conectado
        if (isLoggedIn) {
            Formulario.classList.add('hidden'); // Ocultar el formulario
            menu.classList.remove('hidden'); // Mostrar el menú de navegación
            btnSalir.classList.remove('hidden'); // Mostrar el botón de salir
        } else {
            Formulario.classList.remove('hidden'); // Mostrar el formulario
            menu.classList.add('hidden'); // Ocultar el menú de navegación
            btnSalir.classList.add('hidden'); // Ocultar el botón de salir
        }
    }
    
    function salir() {
        ExpandirMenu(false); // Llamar a ExpandirMenu con false para cerrar sesión
    }
    
    // Esperar a que el contenido del DOM se haya cargado
    document.addEventListener('DOMContentLoaded', () => {
        // Verificar si el menú de navegación existe en el DOM
        if (document.querySelector('nav#menuNavegacion')) {
            ExpandirMenu(true); // Llamar a ExpandirMenu con true para mostrar el menú
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