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
        function loadBancos() {
            fetch('../../php/crear_empresa/get_bancos.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // No necesita parámetros
                })
                .then(data => {
                    const select = document.getElementById('id-banco');
                    select.innerHTML = '<option value="">Seleccionar Banco</option>'; // Opcional: valor predeterminado
                    data.forEach(banco => {
                        const option = document.createElement('option');
                        option.value = banco.id_banco;
                        option.textContent = banco.nombre_banco;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al cargar bancos:', error));
        }
    
        // Cargar bancos al cargar la página
        loadBancos();
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