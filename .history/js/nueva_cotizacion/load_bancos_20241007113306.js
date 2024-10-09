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
    -------------------------------------- INICIO ITred Spa Load Bancos .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    document.addEventListener('DOMContentLoaded', function() {
        // Función para llenar el select de bancos
        function CargarBancos() {
            fetch('../../php/crear_empresa/get_bancos.php')
                .then(response => response.text())  // Leer el contenido como texto (HTML)
                .then(data => {
                    const select = document.getElementById('id-banco');
                    select.innerHTML = data;  // Insertar directamente las opciones generadas en el select
                })
                .catch(error => console.error('Error al cargar bancos:', error));
        }
    
        // Cargar bancos al cargar la página
        CargarBancos();
    });

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Load Bancos .JS ---------------------------------------
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