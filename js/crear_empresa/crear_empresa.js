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
    -------------------------------------- INICIO ITred Spa crear_empresa .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    
    function formatRut(input) {
        // Obtiene el valor del campo y elimina los caracteres no numéricos
        let rut = input.value.replace(/\D/g, '');
    
        // Verifica si la longitud total supera el máximo permitido
        if (rut.length > 9) {
            rut = rut.slice(0, 9); // Limita a 8 dígitos
        }
    
        // Aplica el formato de RUT
        if (rut.length > 1) {
            rut = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + rut.slice(-1);
        }
    
        // Asigna el valor formateado de vuelta al campo de entrada
        input.value = rut;
    
        // Limitar longitud total considerando el formato
        if (input.value.length > 12) {
            input.value = input.value.slice(0, 12); // Asegura que no exceda el formato esperado
        }
    }
    
    // Configurar los botones de agregar
    document.getElementById('add-requisito-btn').addEventListener('click', addRequisito);
    document.getElementById('add-obligaciones-btn').addEventListener('click', addObligaciones);
    document.getElementById('add-condition-btn').addEventListener('click', addCondition);
    
    document.getElementById('cotizacion-form').addEventListener('submit', function(event) {
        event.preventDefault();
    
        // Crear cadenas delimitadas para cada tipo de datos
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
    
        // Verificar si hay cuentas bancarias antes de enviar el formulario
        if (accounts.length === 0) {
            alert('Debe agregar al menos una cuenta bancaria antes de enviar el formulario.');
            return;
        }
    
        // Crear cadena delimitada para cuentas bancarias
        let cuentasString = '';
        accounts.forEach((account, index) => {
            cuentasString += (index > 0 ? '|' : '') +
                `${account.nombre},${account.rut},${account.celular},${account.email},${account.banco},${account.tipoCuenta},${account.numeroCuenta}`;
        });
    
        // Crear campos ocultos en el formulario con los datos
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
    
        // Enviar el formulario
        this.submit();
    });

    // Función para verificar si hay una firma seleccionada
    function checkSignatureSelection() {
        const signatureOptions = document.querySelectorAll('input[name="signature-option"]');
        const isAnySelected = Array.from(signatureOptions).some(option => option.checked);
        
        // Desactiva el botón si no hay firma seleccionada
        document.getElementById('submit-button').disabled = !isAnySelected || accounts.length === 0;
    }

    // Agrega un event listener para cada opción de firma
    const signatureOptions = document.querySelectorAll('input[name="signature-option"]');
    signatureOptions.forEach(option => {
        option.addEventListener('change', checkSignatureSelection);
    });

    // Llama a la función al cargar la página para establecer el estado inicial del botón
    checkSignatureSelection();
    
    /* --------------------------------------------------------------------------------------------------------------
        ---------------------------------------- FIN ITred Spa crear_empresa .JS ---------------------------------------
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