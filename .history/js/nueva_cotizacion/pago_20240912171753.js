
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
    -------------------------------------- INICIO ITred Spa Adelanto.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


    function addPayment() {
        // Contenedor donde se agregan los pagos
        const container = document.getElementById('payments-container');
    
        // Crear un nuevo bloque de pago
        const paymentBlock = document.createElement('div');
        paymentBlock.classList.add('payment-block');
    
        // Generar el HTML para un nuevo pago
        paymentBlock.innerHTML = `
            <hr>
            <h4>Pago</h4>
            <label>N° Pago:</label>
            <input type="number" name="numero_pago[]" required>
            <label>Descripción de pago:</label>
            <textarea name="descripcion_pago[]" placeholder="Descripción del pago"></textarea>
            <label>% De pago:</label>
            <input type="number" id="porcentaje-pago" name="porcentaje_pago[]" min="0" max="100" required oninput="calculateAdelanto(this)">
            <label>Monto de pago:</label>
            <input type="number" id="monto-pago" name="monto_pago[]" min="0" required readonly>
            <label>Fecha de pago:</label>
            <input type="date" name="fecha_pago[]" required>
        `;
    
        // Agregar el bloque al contenedor
        container.appendChild(paymentBlock);
    }
    
    // Función para calcular el monto de pago basado en el porcentaje (puedes ajustar la lógica según lo que necesites)
  
    
    function calcularPago() {
        // Obtén los elementos del DOM
        const porcentajePagoInput = document.getElementById('porcentaje-pago');
        const totalFinalInput = document.getElementById('total_final');
        const montoPagoInput = document.getElementById('monto-pago');
    
        // Lee los valores y asigna 0 si no están presentes o son inválidos
        const porcentajeAdelanto = parseFloat(porcentajePagoInput ? porcentajePagoInput.value : 0) || 0;
        const totalFinal = parseFloat(totalFinalInput ? totalFinalInput.value : 0) || 0;
    
        // Calcula el monto del adelanto
        const montoAdelanto = (totalFinal * (porcentajeAdelanto / 100)).toFixed(2);
    
        // Asigna el monto calculado al campo correspondiente
        if (montoPagoInput) {
            montoPagoInput.value = montoAdelanto;
        } else {
            console.error("El elemento 'monto-pago' no está disponible en el DOM.");
        }
    }

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Adelanto.JS ---------------------------------------
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