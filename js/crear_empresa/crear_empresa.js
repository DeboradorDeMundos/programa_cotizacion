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
    
        // Aplica el formato de RUT
        if (rut.length > 1) {
            rut = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + rut.slice(-1);
        }
    
        // Asigna el valor formateado de vuelta al campo de entrada
        input.value = rut;
    }
    
    // Configurar los botones de agregar
    document.getElementById('add-requisito-btn').addEventListener('click', addRequisito);
    document.getElementById('add-obligaciones-btn').addEventListener('click', addObligaciones);
    document.getElementById('add-condition-btn').addEventListener('click', addCondition);
    
    document.getElementById('cotizacion-form').addEventListener('submit', function(event) {
        event.preventDefault();
    
        // Convertir el array de condiciones a JSON
        const conditions = [];
        document.querySelectorAll('#conditions-container .condition-row').forEach(conditionDiv => {
            const inputField = conditionDiv.querySelector('input');
            if (inputField) {
                conditions.push(inputField.value);
            }
        });
    
        // Convertir el array de requisitos a JSON
        const requisitos = [];
        document.querySelectorAll('#requisito-container .requisito-row').forEach(requisitoDiv => {
            const inputField = requisitoDiv.querySelector('input');
            if (inputField) {
                requisitos.push(inputField.value);
            }
        });
    
        // Convertir el array de obligaciones a JSON
        const obligaciones = [];
        document.querySelectorAll('#obligaciones-container .obligaciones-row').forEach(obligacionesDiv => {
            const inputField = obligacionesDiv.querySelector('input');
            if (inputField) {
                obligaciones.push(inputField.value);
            }
        });
    
        // Convertir los arrays a JSON
        const conditionsJson = JSON.stringify(conditions);
        const requisitosJson = JSON.stringify(requisitos);
        const obligacionesJson = JSON.stringify(obligaciones);
    
        // Verificar si hay cuentas bancarias antes de enviar el formulario
        if (accounts.length === 0) {
            alert('Debe agregar al menos una cuenta bancaria antes de enviar el formulario.');
            return;
        }
    
        // Convertir el array de cuentas a JSON
        const cuentasJson = JSON.stringify(accounts);
    
        // Crear un campo oculto en el formulario con los datos JSON
        const hiddenInputCuentas = document.createElement('input');
        hiddenInputCuentas.type = 'hidden';
        hiddenInputCuentas.name = 'cuentas_bancarias';
        hiddenInputCuentas.value = cuentasJson;
        this.appendChild(hiddenInputCuentas);
    
        const hiddenInputConditions = document.createElement('input');
        hiddenInputConditions.type = 'hidden';
        hiddenInputConditions.name = 'condiciones';
        hiddenInputConditions.value = conditionsJson;
        this.appendChild(hiddenInputConditions);
    
        const hiddenInputRequisitos = document.createElement('input');
        hiddenInputRequisitos.type = 'hidden';
        hiddenInputRequisitos.name = 'requisitos';
        hiddenInputRequisitos.value = requisitosJson;
        this.appendChild(hiddenInputRequisitos);
    
        const hiddenInputObligaciones = document.createElement('input');
        hiddenInputObligaciones.type = 'hidden';
        hiddenInputObligaciones.name = 'obligaciones';
        hiddenInputObligaciones.value = obligacionesJson;
        this.appendChild(hiddenInputObligaciones);
    
        // Enviar el formulario
        this.submit();
    });
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