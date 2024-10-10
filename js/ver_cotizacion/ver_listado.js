
/* 
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ 
*/


/* --------------------------------------------------------------------------------------------------------------
    -------------------------------------- INICIO ITred Spa Ver Listado .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


    document.addEventListener('DOMContentLoaded', () => {
        const table = document.getElementById('tabla-cotizaciones');
        const headers = table.querySelectorAll('th.sortable');
        let sortOrder = 1; // 1 para ascendente, -1 para descendente
        let currentColumn = null;
    
        headers.forEach(header => {
            header.addEventListener('click', function() {
                const type = this.getAttribute('data-type');
                const index = Array.prototype.indexOf.call(headers, this);
                
                // Alternar orden si es la misma columna
                if (currentColumn === index) {
                    sortOrder *= -1; // Alternar entre ascendente y descendente
                } else {
                    // Nueva columna seleccionada, ordenar ascendentemente por defecto
                    sortOrder = 1;
                }
    
                currentColumn = index;
    
                // Obtener todas las filas del tbody
                const rowsArray = Array.from(table.querySelectorAll('tbody tr'));
                
                // Ordenar las filas según el tipo de dato
                rowsArray.sort((rowA, rowB) => {
                    const cellA = rowA.cells[index].textContent.trim();
                    const cellB = rowB.cells[index].textContent.trim();
    
                    if (type === 'number') {
                        return sortOrder * (parseFloat(cellA) - parseFloat(cellB));
                    } else if (type === 'date') {
                        return sortOrder * (new Date(cellA) - new Date(cellB));
                    } else {
                        return sortOrder * cellA.localeCompare(cellB);
                    }
                });
    
                // Eliminar las filas actuales y agregar las ordenadas
                const tbody = table.querySelector('tbody');
                tbody.innerHTML = ''; // Limpiar el tbody
                rowsArray.forEach(row => tbody.appendChild(row));
    
                // Actualizar las flechas en los encabezados
                headers.forEach(header => {
                    header.querySelector('.arrow').textContent = ''; // Limpiar todas las flechas
                });
    
                this.querySelector('.arrow').textContent = sortOrder === 1 ? '▲' : '▼'; // Mostrar flecha correcta
            });
        });
    });

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Ver Listado .JS ---------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


/*
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
*/