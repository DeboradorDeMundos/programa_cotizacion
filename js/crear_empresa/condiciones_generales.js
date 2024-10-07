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
    -------------------------------------- Inicio ITred Spa Condiciones Generales .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    
    let contadorCondiciones = 0;

    // Función para agregar una nueva condición
    function agregarCondicion() {
        contadorCondiciones++;
    
        const contenedor = document.getElementById('contenedor-condiciones');
    
        // Crear nueva fila de condición
        const divCondicion = document.createElement('div');
        divCondicion.className = 'fila-condicion';
        divCondicion.dataset.index = contadorCondiciones;
    
        // Crear el HTML con el botón de eliminar al lado del input
        divCondicion.innerHTML = `
            <span class="numero-condicion">${contadorCondiciones}-. </span>
            <input type="text" name="condicion_${contadorCondiciones}" placeholder="Ingrese condición ${contadorCondiciones}" oninput="eliminarCaracteresInvalidos(this)"/>
            <button type="button" class="btn-eliminar-condicion" onclick="eliminarCondicion(this)">Eliminar</button>
        `;
    
        contenedor.appendChild(divCondicion);
    
        // Hacer readonly la condición anterior
        if (contadorCondiciones > 1) {
            const condicionAnterior = contenedor.children[contadorCondiciones - 2];
            const campoInput = condicionAnterior.querySelector('input');
            campoInput.setAttribute('readonly', 'readonly');
        }
    }
    
    // Función para eliminar una condición
    function eliminarCondicion(boton) {
        const contenedor = document.getElementById('contenedor-condiciones');
        const divCondicion = boton.parentElement;
    
        if (divCondicion) {
            divCondicion.remove(); // Elimina la condición seleccionada
            contadorCondiciones--;
    
            // Ajustar la numeración
            actualizarNumeracion(contenedor, 'condicion');
        }
    }
    /* --------------------------------------------------------------------------------------------------------------
        ---------------------------------------- FIN ITred Spa Condiciones Generales .JS ---------------------------------------
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
    