
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
    -------------------------------------- INICIO ITred Spa Cargar Logo Empresa .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// TÍTULO: FUNCIÓN PARA PREVISUALIZAR LA IMAGEN SELECCIONADA
    //  Permite al usuario ver una vista previa de la imagen que ha seleccionado para subir.
    function PrevisualizarImagen(event) {

        //  Accede al elemento que disparó el evento para obtener el archivo seleccionado.
        const Entrada = event.target; 

        //  FileReader permite leer el contenido de archivos de manera asíncrona.
        const Lector = new FileReader(); 

        //  Asigna el resultado de la lectura como fuente de la imagen de previsualización.
        Lector.onload = function() {
            // Título: Obtener el elemento de imagen para la previsualización
            //  Selecciona el elemento <img> donde se mostrará la imagen cargada.
            const Previsualizacion = document.getElementById('Previsualizar-logo'); 

            //  Establece la fuente de la imagen al resultado de la lectura del archivo.
            Previsualizacion.src = Lector.result; 
        };

        //  Asegura que se haya seleccionado al menos un archivo antes de intentar leerlo.
        if (Entrada.files && Entrada.files[0]) {

            //  Inicia la lectura del archivo seleccionado para que pueda ser mostrado como una imagen.
            Lector.readAsDataURL(Entrada.files[0]); 
        }
    }

// TÍTULO: OBTENER EL ELEMENTO DE IMAGEN PARA LA PREVISUALIZACIÓN
    //  Agrega un evento de escucha al botón de carga para activar la previsualización cuando se selecciona un archivo.
    document.getElementById('subir-logo').addEventListener('change', PrevisualizarImagen); 

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Cargar Logo Empresa .JS ---------------------------------------
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