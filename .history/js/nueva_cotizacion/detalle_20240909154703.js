
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

    
 function addcabeza(button)

{   
    const tableHead = button.closest('.detalle-section').querySelector('thead');


    // Crear la fila dela encabecera detalle del producto
    const new2row = document.createElement('tr');
    new2row.innerHTML = ` <tr>
                        <th>Tipo</th>
                        <th>Nombre producto</th>
                        <th>DESCRIPCIÓN</th>
                        <th>CANTIDAD</th>
                        <th>PRECIO UNI.</th>
                        <th>DESCUENTO %</th>
                        <th>TOTAL</th>
                        <th>ACCIÓN</th>
                    </tr>`;
    tableHead.appendChild(new2row);

}

function removeDetailRow(button) {
    const row = button.closest('tr');
    const descriptionRow = row.nextElementSibling;

    // Elimina la fila del detalle
    row.remove();

    // Si la siguiente fila es la fila de descripción larga, también eliminarla
    if (descriptionRow && descriptionRow.classList.contains('descripcion-row')) {
        descriptionRow.remove();
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