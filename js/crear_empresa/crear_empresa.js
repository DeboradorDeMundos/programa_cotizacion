/* 
Sitio Web Creado por ITred Spa.
Dirección: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ 
*/

/* --------------------------------------------------------------------------------------------------------------
    -------------------------------------- INICIO ITred Spa crear_empresa .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    
    function formatRut(input) {
        // Obtiene el valor del campo y elimina cualquier carácter que no sea numérico
        let rut = input.value.replace(/\D/g, '');
    
        // Verifica si la longitud total excede el máximo permitido
        if (rut.length > 9) {
            rut = rut.slice(0, 9); // Limita a 8 dígitos
        }
    
        // Aplica el formato RUT: puntos para los miles y guion para el dígito verificador
        if (rut.length > 1) {
            rut = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + rut.slice(-1);
        }
    
        // Asigna el valor formateado al campo de entrada
        input.value = rut;
    
        // Limita la longitud total considerando el formato RUT completo
        if (input.value.length > 12) {
            input.value = input.value.slice(0, 12); // Asegura que no exceda el formato esperado
        }
    }
    
    // Configura los botones para agregar requisitos, obligaciones y condiciones
    document.getElementById('add-requisito-btn').addEventListener('click', addRequisito);
    document.getElementById('add-obligaciones-btn').addEventListener('click', addObligaciones);
    document.getElementById('add-condition-btn').addEventListener('click', addCondition);
    
    // Configura la acción cuando se envía el formulario
    document.getElementById('cotizacion-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Previene el envío del formulario para manejarlo manualmente
    
        // Crea cadenas delimitadas por "|" para cada tipo de dato (condiciones, requisitos, obligaciones)
        let conditionsString = '';
        document.querySelectorAll('#contenedor-condicion .condition-row').forEach((conditionDiv, index) => {
            const inputField = conditionDiv.querySelector('input');
            if (inputField) {
                conditionsString += (index > 0 ? '|' : '') + inputField.value;
            }
        });
    
        let requisitosString = '';
        document.querySelectorAll('#requisito-contenedor .requisito-row').forEach((requisitoDiv, index) => {
            const inputField = requisitoDiv.querySelector('input');
            if (inputField) {
                requisitosString += (index > 0 ? '|' : '') + inputField.value;
            }
        });
    
        let obligacionesString = '';
        document.querySelectorAll('#obligaciones-contenedor .obligaciones-row').forEach((obligacionesDiv, index) => {
            const inputField = obligacionesDiv.querySelector('input');
            if (inputField) {
                obligacionesString += (index > 0 ? '|' : '') + inputField.value;
            }
        });
    
        // Verifica si hay cuentas bancarias antes de permitir el envío del formulario
        if (accounts.length === 0) {
            alert('Debe agregar al menos una cuenta bancaria antes de enviar el formulario.');
            return;
        }
    
        // Crea una cadena delimitada con los datos de cuentas bancarias
        let cuentasString = '';
        accounts.forEach((account, index) => {
            cuentasString += (index > 0 ? '|' : '') +
                `${account.nombre},${account.rut},${account.celular},${account.email},${account.banco},${account.tipoCuenta},${account.numeroCuenta}`;
        });
    
        // Crea campos ocultos en el formulario para enviar los datos concatenados
        const hiddenInputCuentas = document.createElement('input');
        hiddenInputCuentas.type = 'hidden';
        hiddenInputCuentas.name = 'cuentas_bancarias';
        hiddenInputCuentas.value = cuentasString;
        this.appendChild(hiddenInputCuentas);
    
        const hiddenInputConditions = document.createElement('input');
        hiddenInputConditions.type = 'hidden';
        hiddenInputConditions.name = 'condiciones';
        hiddenInputConditions.value = conditionsString;
        this.appendChild(hiddenInputConditions);
    
        const hiddenInputRequisitos = document.createElement('input');
        hiddenInputRequisitos.type = 'hidden';
        hiddenInputRequisitos.name = 'requisitos';
        hiddenInputRequisitos.value = requisitosString;
        this.appendChild(hiddenInputRequisitos);
    
        const hiddenInputObligaciones = document.createElement('input');
        hiddenInputObligaciones.type = 'hidden';
        hiddenInputObligaciones.name = 'obligaciones';
        hiddenInputObligaciones.value = obligacionesString;
        this.appendChild(hiddenInputObligaciones);
    
        // Finalmente, envía el formulario
        this.submit();
    });
    
    // Función para verificar si se seleccionó alguna firma
    function checkSignatureSelection() {
        const signatureOptions = document.querySelectorAll('input[name="signature-option"]');
        const isAnySelected = Array.from(signatureOptions).some(option => option.checked);
        
        // Desactiva el botón de envío si no hay firma seleccionada o si no se agregó ninguna cuenta bancaria
        document.getElementById('submit-button').disabled = !isAnySelected || accounts.length === 0;
    }
    
    // Agrega un event listener a cada opción de firma para detectar cambios
    const signatureOptions = document.querySelectorAll('input[name="signature-option"]');
    signatureOptions.forEach(option => {
        option.addEventListener('change', checkSignatureSelection);
    });
    
    // Llama a la función cuando la página carga para asegurar que el botón esté en el estado correcto
    checkSignatureSelection();
    
    /* --------------------------------------------------------------------------------------------------------------
        -------------------------------------- FIN ITred Spa crear_empresa .JS --------------------------------------
        ------------------------------------------------------------------------------------------------------------- */
    
    /*
    Sitio Web Creado por ITred Spa.
    Dirección: Guido Reni #4190
    Pedro Aguirre Cerda - Santiago - Chile
    contacto@itred.cl o itred.spa@gmail.com
    https://www.itred.cl
    Creado, Programado y Diseñado por ITred Spa.
    BPPJ
    */
    