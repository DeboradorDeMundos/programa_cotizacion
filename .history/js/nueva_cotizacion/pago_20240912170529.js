
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
            <input type="number" id="porcentaje-pago" name="porcentaje_pago[]" min="0" max="100" required oninput="calculatePago(this)">
            <label>Monto de pago:</label>
            <input type="number" id="monto-pago" name="monto_pago[]" min="0" required readonly>
            <label>Fecha de pago:</label>
            <input type="date" name="fecha_pago[]" required>
        `;
    
        // Agregar el bloque al contenedor
        container.appendChild(paymentBlock);
    }
    
    // Función para calcular el monto de pago basado en el porcentaje (puedes ajustar la lógica según lo que necesites)
    function calculatePago(input) {
        const paymentBlock = input.closest('.payment-block');
        const porcentaje = input.value;
        const monto = paymentBlock.querySelector('[name="monto_pago[]"]');
        // Suponiendo que tienes un valor base para calcular el monto
        const valorBase = 1000; // Reemplaza esto con la lógica correcta
        monto.value = (valorBase * (porcentaje / 100)).toFixed(2);
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