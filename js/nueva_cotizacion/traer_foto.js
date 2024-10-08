
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
    -------------------------------------- INICIO ITred Spa Traer foto.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


    function VerImagen(event) {
        const Lector = new FileReader();
        Lector.onload = function() {
            const output = document.getElementById('Previsualizar-logo');
            output.src = Lector.result;
            output.style.display = 'block';
            document.getElementById('logo-text').style.display = 'none';
        }
        Lector.LeerComoDatoURL(event.target.files[0]);
    }


/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Traer foto.JS ---------------------------------------
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