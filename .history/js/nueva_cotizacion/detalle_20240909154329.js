
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

    Function add(button)

{
    const tableBody = button.closest('.detalle-section').querySelector('tbody');

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