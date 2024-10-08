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
    -------------------------------------- Inicio ITred Spa Condiciones Generales .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    
    let conditionCount = 0;

    // Agregar Condición
    function addCondition() {
        conditionCount++;
    
        const contenedor = document.getElementById('contenedor-condicion');
    
        // Crear nueva fila de condición
        const conditionDiv = document.createElement('div');
        conditionDiv.className = 'condition-row';
        conditionDiv.dataset.index = conditionCount;
    
        // Crear el HTML con el botón de eliminar al lado del input
        conditionDiv.innerHTML = `
            <span class="condition-number">${conditionCount}-. </span>
            <input type="text" name="condition_${conditionCount}" placeholder="Ingrese condición ${conditionCount}" oninput="removeInvalidChars(this)"/>
            <button type="button" class="remove-condition-btn" onclick="removeCondition(this)">Eliminar</button>
        `;
    
        contenedor.appendChild(conditionDiv);
    
        // Hacer readonly la condición anterior
        if (conditionCount > 1) {
            const previousCondition = contenedor.children[conditionCount - 2];
            const inputField = previousCondition.querySelector('input');
            inputField.setAttribute('readonly', 'readonly');
        }
    }
    
    // Función para eliminar condiciones
    function removeCondition(button) {
        const contenedor = document.getElementById('contenedor-condicion');
        const conditionDiv = button.parentElement;
    
        if (conditionDiv) {
            conditionDiv.remove(); // Elimina la condición seleccionada
            conditionCount--;
    
            // Ajustar la numeración
            updateNumeration(contenedor, 'condition');
        }
    }

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Condiciones Generales .JS ---------------------------------------
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