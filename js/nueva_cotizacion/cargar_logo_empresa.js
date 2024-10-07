
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
    -------------------------------------- INICIO ITred Spa Cargar Logo Empresa .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// Función para previsualizar la imagen
function PrevisualizarImagen(event) {
    const Entrada = event.target;
    const Lector = new FileReader();

    Lector.onload = function() {
        const preview = document.getElementById('logo-preview');
        preview.src = Lector.result;
    };

    if (Entrada.files && Entrada.files[0]) {
        Lector.readAsDataURL(Entrada.files[0]);
    }
}

// Escuchar cuando el Entrada de archivo cambia para mostrar la previsualización
document.getElementById('logo-upload').addEventListener('change', PrevisualizarImagen);


/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Cargar Logo Empresa .JS ---------------------------------------
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