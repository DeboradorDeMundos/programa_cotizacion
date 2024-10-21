/* 
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ 
*/


/* --------------------------------------------------------------------------------------------------------------
    -------------------------------------- INICIO ITred Spa Programa Cotizacion .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// TÍTULO: EXPANDIR MENÚ
    // Función para mostrar u ocultar el menú de navegación y el formulario de empresa según el estado de sesión
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
    // Función para cerrar sesión
    function salir() {
        ExpandirMenu(false); // Llamar a ExpandirMenu con false para cerrar sesión
    }

    //  Este evento se ejecuta cuando todo el contenido del DOM ha sido completamente cargado, asegurando que todos los elementos están disponibles para manipulación.
    document.addEventListener('DOMContentLoaded', () => {
        //  Verifica si el elemento de navegación existe en el DOM antes de llamar a la función ExpandirMenu.
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
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
*/