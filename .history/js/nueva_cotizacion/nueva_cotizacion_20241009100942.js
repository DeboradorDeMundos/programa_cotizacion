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
    -------------------------------------- INICIO ITred Spa Nueva_Cotizacion .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
   
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('fecha_emision').value = new Date().toISOString().split('T')[0];
    });
    
    
    function FormatearRut(input) {
        let rut = input.value.replace(/\D/g, '');
        if (rut.length > 1) {
            rut = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + rut.slice(-1);
        }
        input.value = rut;
    }
    

    
    function MostrarInformacionDePago(checkbox) {
        const table = checkbox.closest('table');
        const ContenedorDePago = table.querySelector('.payment-info');
        const CabeceraPago = table.querySelector('.payment-header');
    
        if (checkbox.checked) {
            ContenedorDePago.style.display = 'table-row-group';
            CabeceraPago.style.display = 'table-row';
        } else {
            ContenedorDePago.style.display = 'none';
            CabeceraPago.style.display = 'none';
        }
    }
    


 


    
    /* --------------------------------------------------------------------------------------------------------------
        --------------------------------------- FINAL ITred Spa Nueva_Cotizacion .JS ----------------------------------------
    -----
        
        /* --------------------------------------------------------------------------------------------------------------
            ---------------------------------------- FIN ITred Spa Nueva_Cotizacion .JS ---------------------------------------
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