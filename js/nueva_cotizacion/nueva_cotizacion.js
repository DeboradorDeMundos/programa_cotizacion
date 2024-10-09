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
        // Establece el valor del campo 'fecha_emision' a la fecha actual en formato ISO
        document.getElementById('fecha_emision').value = new Date().toISOString().split('T')[0];
    });
    
    function FormatearRut(input) {
        // Elimina cualquier carácter que no sea un dígito
        let rut = input.value.replace(/\D/g, '');
        if (rut.length > 1) {
            // Formatea el RUT agregando puntos cada tres dígitos y un guion antes del último dígito
            rut = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + rut.slice(-1);
        }
        // Asigna el valor formateado de vuelta al campo de entrada
        input.value = rut;
    }
    
    function MostrarInformacionDePago(checkbox) {
        // Encuentra la tabla más cercana al checkbox
        const table = checkbox.closest('table');
        // Busca el contenedor de información de pago y la cabecera de pago dentro de la tabla
        const ContenedorDePago = table.querySelector('.payment-info');
        const CabeceraPago = table.querySelector('.payment-header');
    
        // Muestra u oculta la información de pago según el estado del checkbox
        if (checkbox.checked) {
            ContenedorDePago.style.display = 'table-row-group'; // Muestra el contenedor de pago
            CabeceraPago.style.display = 'table-row'; // Muestra la cabecera de pago
        } else {
            ContenedorDePago.style.display = 'none'; // Oculta el contenedor de pago
            CabeceraPago.style.display = 'none'; // Oculta la cabecera de pago
        }
    }

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Nueva_Cotizacion .JS ---------------------------------------
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