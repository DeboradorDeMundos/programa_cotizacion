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
    -------------------------------------- Inicio ITred Spa Formulario Cuenta .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    let accounts = [];
    let cuenta = false;
    
    // Función para agregar una cuenta
    function addAccount() {
        const nombreCuenta = document.getElementById('nombre-cuenta').value;
        const rutTitular = document.getElementById('rut-titular').value;
        const celular = document.getElementById('celular').value;
        const emailBanco = document.getElementById('email-banco').value;
        const idBanco = document.getElementById('id-banco').options[document.getElementById('id-banco').selectedIndex].text;
        const tipoCuenta = document.getElementById('id-tipocuenta').options[document.getElementById('id-tipocuenta').selectedIndex].text;
        const numeroCuenta = document.getElementById('numero-cuenta').value;
    
        if (nombreCuenta && rutTitular && celular && emailBanco && idBanco && tipoCuenta && numeroCuenta) {
            if (accounts.length >= 4) {
                alert('Solo puedes agregar un máximo de 4 cuentas bancarias.');
                return;
            }
    
            accounts.push({
                nombre: nombreCuenta,
                rut: rutTitular,
                celular: celular,
                email: emailBanco,
                banco: idBanco,
                tipoCuenta: tipoCuenta,
                numeroCuenta: numeroCuenta
            });
    
            updateTable();
    
            // Limpiar campos
            document.getElementById('nombre-cuenta').value = '';
            document.getElementById('rut-titular').value = '';
            document.getElementById('celular').value = '';
            document.getElementById('email-banco').value = '';
            document.getElementById('id-banco').selectedIndex = 0;
            document.getElementById('id-tipocuenta').selectedIndex = 0;
            document.getElementById('numero-cuenta').value = '';
    
            if (!cuenta) {
                cuenta = true;
                makeFieldsOptional();
            }
    
            document.getElementById('submit-button').disabled = accounts.length === 0;
    
            updateHiddenFields();
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
        table.innerHTML = '';
    
        if (accounts.length === 0) return;
    
        const headerRow = document.createElement('tr');
        accounts.forEach(account => {
            const th = document.createElement('th');
            th.innerText = `${account.tipoCuenta} - ${account.nombre}`;
            headerRow.appendChild(th);
        });
        table.appendChild(headerRow);
    
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
    
    function updateHiddenFields() {
        const hiddenInput = document.getElementById('hidden-accounts');
        hiddenInput.value = accounts.map(account => 
            `${account.nombre}|${account.rut}|${account.celular}|${account.email}|${account.banco}|${account.tipoCuenta}|${account.numeroCuenta}`
        ).join(';');
    }

    function validateName(input) {
        // Eliminar caracteres no permitidos (números y caracteres especiales)
        input.value = input.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');
    }
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Formulario Cuenta .JS ---------------------------------------
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