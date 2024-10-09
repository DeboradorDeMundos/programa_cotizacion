
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
    -------------------------------------- INICIO ITred Spa Traer foto.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

    function VerImagen(event) {
        const Lector = new FileReader(); // Crear una nueva instancia de FileReader
    
        // Definir la función que se ejecutará cuando se cargue la imagen
        Lector.onload = function() {
            const output = document.getElementById('Previsualizar-logo'); // Obtener el elemento de imagen para previsualización
            output.src = Lector.result; // Asignar el resultado de la lectura (imagen) a la fuente de la imagen
            output.style.display = 'block'; // Mostrar la imagen
            document.getElementById('logo-text').style.display = 'none'; // Ocultar el texto del logo
        }
    
        // Leer el archivo seleccionado como un dato URL
        Lector.readAsDataURL(event.target.files[0]);
    }
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Traer foto.JS ---------------------------------------
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