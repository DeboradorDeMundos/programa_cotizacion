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
    -------------------------------------- Inicio ITred Spa Upload Logo .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

    // Agrega un evento de clic al contenedor del logo
    document.querySelector('.contenedor-logo').addEventListener('click', function() {
        // Cuando se hace clic en el contenedor, simula un clic en el input para subir un logo
        document.getElementById('subir-logo').click();
    });

    // Agrega un evento de cambio al input de subir logo
    document.getElementById('subir-logo').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Obtiene el primer archivo del input
        if (file) {
            const Lector = new FileReader(); // Crea un nuevo lector de archivos
            Lector.onload = function(e) {
                // Cuando se complete la lectura del archivo, establece la imagen de previsualización
                document.getElementById('Previsualizar-logo').src = e.target.result;
            };
            Lector.readAsDataURL(file); // Lee el archivo como una URL de datos
        }
    });

    // Agrega un evento de envío al formulario de cotización
    document.getElementById('formulario-cotizacion').addEventListener('submit', function(event) {
        const SubirLogo = document.getElementById('subir-logo'); // Obtiene el input de subir logo
        const MensajeLogo = document.getElementById('mensaje-logo'); // Obtiene el mensaje para el logo

        // Verifica si no se ha seleccionado ningún archivo
        if (!SubirLogo.files.length) {
            MensajeLogo.style.display = 'block'; // Muestra el mensaje si no hay logo seleccionado
            event.preventDefault(); // Evita que se envíe el formulario
        } else {
            MensajeLogo.style.display = 'none'; // Oculta el mensaje si se ha seleccionado un logo
        }
    });

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Upload Logo .JS ---------------------------------------
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