
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

    // Función para previsualizar la imagen seleccionada
    function PrevisualizarImagen(event) {
        const Entrada = event.target; // Obtener el elemento de entrada de archivo que disparó el evento
        const Lector = new FileReader(); // Crear una nueva instancia de FileReader para leer el archivo

        // Definir lo que sucede una vez que se ha cargado el archivo
        Lector.onload = function() {
            const Previsualizacion = document.getElementById('Previsualizar-logo'); // Obtener el elemento de imagen para la previsualización
            Previsualizacion.src = Lector.result; // Asignar el resultado de la lectura como fuente de la imagen
        };

        // Verificar si hay archivos seleccionados y leer el primer archivo
        if (Entrada.files && Entrada.files[0]) {
            Lector.readAsDataURL(Entrada.files[0]); // Leer el archivo como una URL de datos
        }
    }

    // Escuchar el cambio en el elemento de entrada de archivo para mostrar la previsualización
    document.getElementById('subir-logo').addEventListener('change', PrevisualizarImagen); // Agregar un evento de escucha para el cambio

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