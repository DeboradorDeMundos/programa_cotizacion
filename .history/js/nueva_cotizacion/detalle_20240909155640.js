
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
                    </tr>
                                <button type="button" class="btn-eliminar-titulo" onclick="removecabeza(this)">Eliminar cabecera</button>`
                    ;
    tableHead.appendChild(new2row);

}

function removeCabeza(button) {
    removeCabeza
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