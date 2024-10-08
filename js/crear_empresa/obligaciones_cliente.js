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
        -------------------------------------- Inicio ITred Spa Obligaciones cliente .JS --------------------------------------
        ------------------------------------------------------------------------------------------------------------- */

        let obligacionesCount = 0;

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
                <input type="text" name="obligacion_${obligacionesCount}" placeholder="Ingrese obligación ${obligacionesCount}" oninput="removeInvalidChars(this)"s />
                <button type="button" class="remove-obligaciones-btn" onclick="removerObligaciones(this)">Eliminar</button>
            `;
        
            contenedor_o.appendChild(obligacionesDiv);
        
            // Hacer readonly la obligación anterior
            if (obligacionesCount > 1) {
                const previousObligacion = contenedor_o.children[obligacionesCount - 2];
                const inputField = previousObligacion.querySelector('input');
                inputField.setAttribute('readonly', 'readonly');
            }
        }
        
        // Función para eliminar obligaciones
        function removerObligaciones(button) {
            const contenedor_o = document.getElementById('obligaciones-container');
            const obligacionesDiv = button.parentElement;
        
            if (obligacionesDiv) {
                obligacionesDiv.remove(); // Elimina la obligación seleccionada
                obligacionesCount--;
        
                // Ajustar la numeración
                updateNumeration(contenedor_o, 'obligacion');
            }
        }
        
    /* --------------------------------------------------------------------------------------------------------------
        ---------------------------------------- FIN ITred Spa Obligaciones cliente .JS ---------------------------------------
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