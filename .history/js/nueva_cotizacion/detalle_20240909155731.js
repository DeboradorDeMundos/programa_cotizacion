
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
    -------------------------------------- INICIO ITred Spa Detalle.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

    function addcabeza(button) {   
        const tableHead = button.closest('.detalle-section').querySelector('thead');
    
        // Verifica si ya hay un encabezado para evitar duplicados
        if (!tableHead.querySelector('tr')) {
            // Crear la fila del encabezado
            const new2row = document.createElement('tr');
            new2row.innerHTML = `
                <th>Tipo</th>
                <th>Nombre producto</th>
                <th>DESCRIPCIÓN</th>
                <th>CANTIDAD</th>
                <th>PRECIO UNI.</th>
                <th>DESCUENTO %</th>
                <th>TOTAL</th>
                <th>ACCIÓN</th>
            `;
            tableHead.appendChild(new2row);
    
            // Crear el botón para eliminar el encabezado
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'btn-eliminar-titulo';
            removeButton.textContent = 'Eliminar cabecera';
            removeButton.onclick = () => removeCabeza(button);
            tableHead.appendChild(removeButton);
        }
    }
    
    function removeCabeza(button) {
        const tableHead = button.closest('.detalle-section').querySelector('thead');
    
        // Verifica si hay una fila para eliminar
        const row = tableHead.querySelector('tr');
        if (row) {
            row.remove(); // Elimina la fila del encabezado
        }
    
        // Elimina el botón de eliminar cabecera
        const removeButton = tableHead.querySelector('.btn-eliminar-titulo');
        if (removeButton) {
            removeButton.remove();
        }
    
        calculateTotals(); // Recalcular los totales después de eliminar
    }
    


/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Detalle.JS ---------------------------------------
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