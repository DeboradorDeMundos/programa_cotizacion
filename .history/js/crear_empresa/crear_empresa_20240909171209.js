
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


    let conditionCount = 0; // Contador de condiciones para identificar la posición
    let requisitoCount = 0; // Contador de condiciones para identificar la posición
    let obligacionesCount = 0;

// Agregar Requisito
    function addRequisito() {
        requisitoCount++;

        const contenedor = document.getElementById('requisito-container');

        // Crear nueva fila de requisito
        const requisitoDiv = document.createElement('div');
        requisitoDiv.className = 'requisito-row';
        requisitoDiv.dataset.index = requisitoCount;

        // Crear el HTML con el botón de eliminar al lado del input
        requisitoDiv.innerHTML = `
            <span class="requisito-number">${requisitoCount}-. </span>
            <input type="text" name="requisito_${requisitoCount}" placeholder="Ingrese requisito ${requisitoCount}" />
            <button type="button" class="remove-requisito-btn" onclick="removeRequisito(this)">Eliminar</button>
        `;

        contenedor.appendChild(requisitoDiv);

        // Hacer readonly el requisito anterior
        if (requisitoCount > 1) {
            const previousrequisito = contenedor.children[requisitoCount - 2];
            const inputField = previousrequisito.querySelector('input');
            inputField.setAttribute('readonly', 'readonly');
        }
    }

    // Agregar Obligaciones
    function addObligaciones() {
        obligacionesCount++;

        const contenedor_o = document.getElementById('obligaciones-container');

        // Crear nueva fila de obligación
        const obligacionesDiv = document.createElement('div');
        obligacionesDiv.className = 'obligaciones-row';
        obligacionesDiv.dataset.index = obligacionesCount;

        // Crear el HTML con el botón de eliminar al lado del input
        obligacionesDiv.innerHTML = `
            <span class="obligaciones-number">${obligacionesCount}-. </span>
            <input type="text" name="obligacion_${obligacionesCount}" placeholder="Ingrese obligación ${obligacionesCount}" />
            <button type="button" class="remove-obligaciones-btn" onclick="removeObligaciones(this)">Eliminar</button>
        `;

        contenedor_o.appendChild(obligacionesDiv);

        // Hacer readonly la obligación anterior
        if (obligacionesCount > 1) {
            const previousObligacion = contenedor_o.children[obligacionesCount - 2];
            const inputField = previousObligacion.querySelector('input');
            inputField.setAttribute('readonly', 'readonly');
        }
    }

    // Agregar Condición
    function addCondition() {
        conditionCount++;

        const container = document.getElementById('conditions-container');

        // Crear nueva fila de condición
        const conditionDiv = document.createElement('div');
        conditionDiv.className = 'condition-row';
        conditionDiv.dataset.index = conditionCount;

        // Crear el HTML con el botón de eliminar al lado del input
        conditionDiv.innerHTML = `
            <span class="condition-number">${conditionCount}-. </span>
            <input type="text" name="condition_${conditionCount}" placeholder="Ingrese condición ${conditionCount}" />
            <button type="button" class="remove-condition-btn" onclick="removeCondition(this)">Eliminar</button>
        `;

        container.appendChild(conditionDiv);

        // Hacer readonly la condición anterior
        if (conditionCount > 1) {
            const previousCondition = container.children[conditionCount - 2];
            const inputField = previousCondition.querySelector('input');
            inputField.setAttribute('readonly', 'readonly');
        }
    }

    // Función para eliminar requisitos
    function removeRequisito(button) {
        const contenedor = document.getElementById('requisito-container');
        const requisitoDiv = button.parentElement;

        if (requisitoDiv) {
            requisitoDiv.remove(); // Elimina el requisito seleccionado
            requisitoCount--;

            // Ajustar la numeración
            updateNumeration(contenedor, 'requisito');
        }
    }

    // Función para eliminar obligaciones
    function removeObligaciones(button) {
        const contenedor_o = document.getElementById('obligaciones-container');
        const obligacionesDiv = button.parentElement;

        if (obligacionesDiv) {
            obligacionesDiv.remove(); // Elimina la obligación seleccionada
            obligacionesCount--;

            // Ajustar la numeración
            updateNumeration(contenedor_o, 'obligacion');
        }
    }

    // Función para eliminar condiciones
    function removeCondition(button) {
        const container = document.getElementById('conditions-container');
        const conditionDiv = button.parentElement;

        if (conditionDiv) {
            conditionDiv.remove(); // Elimina la condición seleccionada
            conditionCount--;

            // Ajustar la numeración
            updateNumeration(container, 'condition');
        }
    }

    // Función para actualizar la numeración después de eliminar
    function updateNumeration(container, type) {
        Array.from(container.children).forEach((itemDiv, newIndex) => {
            const numberSpan = itemDiv.querySelector(`.${type}-number`);
            const inputField = itemDiv.querySelector('input');

            const updatedIndex = newIndex + 1;
            numberSpan.textContent = `${updatedIndex}-. `;
            inputField.setAttribute('name', `${type}_${updatedIndex}`);
            inputField.setAttribute('placeholder', `Ingrese ${type} ${updatedIndex}`);

            // Actualizar el dataset del div
            itemDiv.dataset.index = updatedIndex;
        });
    }

    // Configurar los botones de agregar
    document.getElementById('add-requisito-btn').addEventListener('click', addRequisito);
    document.getElementById('add-obligaciones-btn').addEventListener('click', addObligaciones);
    document.getElementById('add-condition-btn').addEventListener('click', addCondition);





    let conditionCount = 0; // Contador de condiciones para identificar la posición
    function addCondition() {
        conditionCount++;
        
        const container = document.getElementById('conditions-container');
        
        // Crear nueva fila de condición
        const conditionDiv = document.createElement('div');
        conditionDiv.className = 'condition-row';
        conditionDiv.dataset.index = conditionCount; // Índice para identificar la condición
    
        conditionDiv.innerHTML = `
            <span class="condition-number">${conditionCount}-. </span>
            <input type="text" name="condition_${conditionCount}" placeholder="Ingrese condición ${conditionCount}" />
        `;
    
        container.appendChild(conditionDiv);
        
        // Hacer readonly la condición anterior
        if (conditionCount > 1) {
            const previousCondition = container.children[conditionCount - 2];
            const inputField = previousCondition.querySelector('input');
            
            // Establecer el campo de entrada anterior como readonly
            inputField.setAttribute('readonly', 'readonly');
            
            // Actualizar el texto en el campo
            inputField.value = inputField.value; // Mantener el texto actual
        }
        
        // Hacer visible el botón de eliminar solo si hay condiciones
        if (conditionCount === 1) {
            document.getElementById('remove-condition-btn').style.display = 'inline';
        }
    }
    
    function removeLastCondition() {
        const container = document.getElementById('conditions-container');
        const lastCondition = container.lastElementChild;
    
        if (lastCondition) {
            lastCondition.remove();
            conditionCount--;
    
            // Ajustar la numeración de las condiciones restantes
            Array.from(container.children).forEach((conditionDiv, index) => {
                // Actualizar el índice
                const newIndex = index + 1;
                const numberSpan = conditionDiv.querySelector('.condition-number');
                const inputField = conditionDiv.querySelector('input');
    
                if (inputField) {
                    // Actualizar el texto del número con el nuevo índice
                    numberSpan.textContent = `${newIndex}-. `;
                    inputField.setAttribute('name', `condition_${newIndex}`);
                    inputField.setAttribute('placeholder', `Ingrese condición ${newIndex}`);
                } else {
                    // Solo actualizar el texto si no hay campo de entrada
                    numberSpan.textContent = `${newIndex}-. ${numberSpan.textContent.split('-. ')[1]}`;
                }
    
                // Actualizar el dataset del div
                conditionDiv.dataset.index = newIndex;
            });
    
            // Ocultar el botón de eliminar si no hay más condiciones
            if (conditionCount === 0) {
                document.getElementById('remove-condition-btn').style.display = 'none';
            }
        }
    }
    
    // Configurar los botones
    document.getElementById('add-condition-btn').addEventListener('click', addCondition);
    document.getElementById('remove-condition-btn').addEventListener('click', removeLastCondition);

    let accounts = [];
    let cuenta = false;
    // Función para agregar una cuenta
    function addAccount() {
        // Obtener los valores del formulario
        const nombreCuenta = document.getElementById('nombre-cuenta').value;
        const rutTitular = document.getElementById('rut-titular').value;
        const celular = document.getElementById('celular').value;
        const emailBanco = document.getElementById('email-banco').value;
        const idBanco = document.getElementById('id-banco').options[document.getElementById('id-banco').selectedIndex].text;
        const tipoCuenta = document.getElementById('id-tipocuenta').options[document.getElementById('id-tipocuenta').selectedIndex].text;
        const numeroCuenta = document.getElementById('numero-cuenta').value;
    
        // Validar que todos los campos requeridos estén llenos
        if (nombreCuenta && rutTitular && celular && emailBanco && idBanco && tipoCuenta && numeroCuenta) {
            // Verificar si ya hay 4 cuentas agregadas
            if (accounts.length >= 4) {
                alert('Solo puedes agregar un máximo de 4 cuentas bancarias.');
                return;
            }
    
            // Añadir la nueva cuenta a la lista de cuentas
            accounts.push({
                nombre: nombreCuenta,
                rut: rutTitular,
                celular: celular,
                email: emailBanco,
                banco: idBanco,
                tipoCuenta: tipoCuenta,
                numeroCuenta: numeroCuenta
            });

            console.log("JSON a enviar:", JSON.stringify(accounts));
    
            // Limpiar los campos del formulario para permitir la entrada de una nueva cuenta
            document.getElementById('nombre-cuenta').value = '';
            document.getElementById('rut-titular').value = '';
            document.getElementById('celular').value = '';
            document.getElementById('email-banco').value = '';
            document.getElementById('id-banco').selectedIndex = 0;
            document.getElementById('id-tipocuenta').selectedIndex = 0;
            document.getElementById('numero-cuenta').value = '';

            updateTable();

            if (!cuenta) {
                cuenta = true;
                makeFieldsOptional();
            }

            document.getElementById('submit-button').disabled = accounts.length === 0;
        } else {
            alert('Por favor, complete todos los campos.');
        }
    }

    function makeFieldsOptional() {
        const fields = ['nombre-cuenta', 'rut-titular', 'celular', 'email-banco', 'id-banco', 'id-tipocuenta', 'numero-cuenta'];
    
        fields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            field.removeAttribute('required');
        });
    }
    
    // Función para actualizar la tabla
    function updateTable() {
        const table = document.getElementById('accounts-table');
        table.innerHTML = ''; // Limpiar la tabla
    
        if (accounts.length === 0) return;
    
        // Crear el encabezado de la tabla
        const headerRow = document.createElement('tr');
        accounts.forEach(account => {
            const th = document.createElement('th');
            th.innerText = `${account.tipoCuenta} - ${account.nombre}`;
            headerRow.appendChild(th);
        });
        table.appendChild(headerRow);
    
        // Agregar las filas para cada tipo de dato
        const rows = [
            'Banco',
            'Tipo de Cuenta',
            'Número de Cuenta',
            'Nombre de la Cuenta',
            'RUT',
            'Email'
        ];
    
        rows.forEach(rowTitle => {
            const row = document.createElement('tr');
            accounts.forEach(account => {
                const cell = document.createElement('td');
                switch (rowTitle) {
                    case 'Banco':
                        cell.innerText = 'Banco: ' + account.banco;
                        break;
                    case 'Tipo de Cuenta':
                        cell.innerText = 'Tipo de cuenta: ' + account.tipoCuenta;
                        break;
                    case 'Número de Cuenta':
                        cell.innerText = 'Numero de cuenta: ' + account.numeroCuenta;
                        break;
                    case 'Nombre de la Cuenta':
                        cell.innerText = 'Nombre de cuenta: ' + account.nombre;
                        break;
                    case 'RUT':
                        cell.innerText = 'Rut: ' + account.rut;
                        break;
                    case 'Email':
                        cell.innerText = 'Email: ' + account.email;
                        break;
                }
                row.appendChild(cell);
            });
            table.appendChild(row);
        });
    }
    
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

        // Convertir el array de condiciones a JSON
        const conditionsJson = JSON.stringify(conditions);
    
        // Verificar si hay cuentas bancarias antes de enviar el formulario
        if (accounts.length === 0) {
            alert('Debe agregar al menos una cuenta bancaria antes de enviar el formulario.');
            return;
        }
    
        // Convertir el array de cuentas a JSON
        const cuentasJson = JSON.stringify(accounts);
    
        // Crear un campo oculto en el formulario con los datos JSON de las cuentas
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'cuentas_bancarias';
        hiddenInput.value = cuentasJson;
        // Agregar el campo oculto al formulario
        this.appendChild(hiddenInput);


        const hiddenInputConditions = document.createElement('input');
        hiddenInputConditions.type = 'hidden';
        hiddenInputConditions.name = 'condiciones';
        hiddenInputConditions.value = conditionsJson;
        this.appendChild(hiddenInputConditions);
    
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