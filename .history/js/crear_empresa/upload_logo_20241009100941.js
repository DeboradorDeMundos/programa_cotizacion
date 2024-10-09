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
    -------------------------------------- Inicio ITred Spa Upload Logo .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


document.querySelector('.contenedor-logo').addEventListener('click', function() {
    document.getElementById('subir-logo').click();
});

document.getElementById('subir-logo').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const Lector = new FileReader();
        Lector.onload = function(e) {
            document.getElementById('Previsualizar-logo').src = e.target.result;
        };
        Lector.LeerComoDatoURL(file);
    }
});

document.getElementById('formulario-cotizacion').addEventListener('submit', function(event) {
    const SubirLogo = document.getElementById('subir-logo');
    const MensajeLogo = document.getElementById('mensaje-logo');

    if (!SubirLogo.files.length) {
        MensajeLogo.style.display = 'block'; // Muestra el mensaje si no hay logo
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
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
*/