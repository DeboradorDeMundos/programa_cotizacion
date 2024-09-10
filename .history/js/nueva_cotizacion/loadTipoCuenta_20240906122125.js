document.addEventListener('DOMContentLoaded', function() {
    function loadTipoCuenta() {
        fetch('../../php/crear_empresa/get_tipos_cuenta.php')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('id-tipocuenta');
                select.innerHTML = '<option value="">Seleccionar Tipo de Cuenta</option>'; // Opcional: valor predeterminado
                data.forEach(tipo => {
                    const option = document.createElement('option');
                    option.value = tipo.id_tipocuenta;
                    option.textContent = tipo.tipocuenta;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar tipo de cuenta:', error));
    }

    loadTipoCuenta();
});


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