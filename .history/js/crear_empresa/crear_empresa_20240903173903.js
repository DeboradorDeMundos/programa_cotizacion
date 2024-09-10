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
    -------------------------------------- INICIO ITred Spa Formulario Cotizacion .JS --------------------------------------
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

    function addCondition() {
        conditionCount++;
        
        const container = document.getElementById('conditions-container');
        
        // Crear nueva fila de condición
        const conditionDiv = document.createElement('div');
        conditionDiv.className = 'condition-row';
        conditionDiv.dataset.index = conditionCount; // Índice para identificar la condición
    
        conditionDiv.innerHTML = `
            <span>${conditionCount}-. <input type="text" name="condition_${conditionCount}" placeholder="Ingrese condición ${conditionCount}" /></span>
        `;
    
        container.appendChild(conditionDiv);
    
        // Convertir la condición anterior en texto
        if (conditionCount > 1) {
            const previousCondition = container.children[conditionCount - 2];
            const inputField = previousCondition.querySelector('input');
            const conditionText = document.createElement('span');
            conditionText.textContent = ${conditionCount - 1}-. ${inputField.value}; // Mostrar el índice correcto
            previousCondition.innerHTML = ''; // Limpiar el contenido anterior
            previousCondition.appendChild(conditionText); // Agregar el texto
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
            for (let i = 0; i < container.children.length; i++) {
                const conditionDiv = container.children[i];
                const index = i + 1; // Nuevo índice
                const conditionText = conditionDiv.querySelector('span');
                if (conditionDiv.querySelector('input')) {
                    conditionDiv.innerHTML = <span>${index}-. <input type="text" name="condition_${index}" placeholder="Ingrese condición ${index}" /></span>;
                } else {
                    conditionText.textContent = ${index}-. ${conditionText.textContent.split('-. ')[1]};
                }
                conditionDiv.dataset.index = index; // Actualizar índice en el dataset
            }
    
            // Ocultar el botón de eliminar si no hay más condiciones
            if (conditionCount === 0) {
                document.getElementById('remove-condition-btn').style.display = 'none';
            }
        }
    }
    
    // Configurar los botones
    document.getElementById('add-condition-btn').addEventListener('click', addCondition);
    document.getElementById('remove-condition-btn').addEventListener('click', removeLastCondition);
    /* --------------------------------------------------------------------------------------------------------------
        ---------------------------------------- FIN ITred Spa Formulario Cotizacion .JS ---------------------------------------
        ------------------------------------------------------------------------------------------------------------- */
    
    
    /*
    Sitio Web Creado por ITred Spa.
    Direccion: Guido Reni #4190
    Pedro Agui Cerda - Santiago - Chile
    contacto@itred.cl o itred.spa@gmail.com
    https://www.itred.cl
    Creado, Programado y Diseñado por ITred Spa.BPPJ*/