
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
    -------------------------------------- INICIO ITred Spa Load Tipo Cuenta .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */



    document.addEventListener('DOMContentLoaded', function() {
        function CargarTipoCuenta() {
            fetch('../../php/crear_empresa/get_tipos_cuenta.php')
                .then(response => response.text())  // Leer el contenido como texto (HTML)
                .then(data => {
                    const select = document.getElementById('id-tipocuenta');
                    select.innerHTML = data;  // Insertar directamente las opciones generadas en el select
                })
                .catch(error => console.error('Error al cargar tipo de cuenta:', error));
        }
    
        CargarTipoCuenta();
    });
    
    

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Load Tipo Cuenta .JS ---------------------------------------
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