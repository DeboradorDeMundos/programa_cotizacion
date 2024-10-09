
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
    -------------------------------------- INICIO ITred Spa Adelanto.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


    function AgregarPago() {
        const contenedor = document.getElementById('payments-contenedor');
        const porcentajeInputs = contenedor.querySelectorAll('input[name="porcentaje_pago[]"]');
        let totalPorcentaje = 0;
    
        // Sumar todos los porcentajes existentes
        porcentajeInputs.forEach(input => {
            totalPorcentaje += parseFloat(input.value) || 0;
        });
    
        // Verificar si el total ya alcanza o supera el 100%
        if (totalPorcentaje >= 100) {
            alert("Ya se ha alcanzado el 100% de los pagos. No se pueden agregar más pagos.");
            return;
        }
    
        // Mostrar la tabla si está oculta
        const table = document.getElementById('payment-table');
        if (table.style.display === 'none') {
            table.style.display = 'table';
        }
    
        // Crear un nuevo bloque de pago
        const LineaPago = document.createElement('tr');
    
        // Generar el HTML para un nuevo pago dentro de la tabla
        LineaPago.innerHTML = `
            <td><input type="number" name="numero_pago[]" required oninput="QuitarCaracteresInvalidos(this)"></td>
            <td><textarea name="descripcion_pago[]" placeholder="Descripción del pago" oninput="QuitarCaracteresInvalidos(this)"></textarea></td>
            <td><input type="number" id="porcentaje-pago" name="porcentaje_pago[]" min="0" max="${100 - totalPorcentaje}" required oninput="calcularPago(this)" oninput="QuitarCaracteresInvalidos(this)"></td>
            <td><input type="number" id="monto-pago" name="monto_pago[]" min="0" required readonly oninput="QuitarCaracteresInvalidos(this)"></td>
            <td><input type="date" name="fecha_pago[]" required oninput="QuitarCaracteresInvalidos(this)"></td>
            <td><button type="button" onclick="EliminarPago(this)">Eliminar</button></td>
        `;
    
        // Agregar la nueva fila de pago al cuerpo de la tabla
        contenedor.appendChild(LineaPago);
    }
    
    function EliminarPago(button) {
        // Eliminar la fila correspondiente
        const row = button.closest('tr');
        row.remove();
    
        // Ocultar la tabla si no quedan filas
        const contenedor = document.getElementById('payments-contenedor');
        if (contenedor.children.length === 0) {
            document.getElementById('payment-table').style.display = 'none';
        }
    }
    
    function calcularPago(input) {
        const row = input.closest('tr');
        const montoPagoInput = row.querySelector('#monto-pago');
        const totalFinalInput = document.getElementById('total_final');
    
        const porcentajeAdelanto = parseFloat(input.value) || 0;
        const totalFinal = parseFloat(totalFinalInput.value) || 0;
    
        const montoAdelanto = (totalFinal * (porcentajeAdelanto / 100)).toFixed(2);
        montoPagoInput.value = montoAdelanto;
    
        // Verificar si la suma de todos los porcentajes excede el 100%
        verificarTotalPorcentajes(input);
    }
    
    function verificarTotalPorcentajes(input) {
        const contenedor = document.getElementById('payments-contenedor');
        const porcentajeInputs = contenedor.querySelectorAll('input[name="porcentaje_pago[]"]');
        let totalPorcentaje = 0;
    
        // Sumar todos los porcentajes existentes
        porcentajeInputs.forEach(porcentajeInput => {
            totalPorcentaje += parseFloat(porcentajeInput.value) || 0;
        });
    
        // Si el total supera el 100%, restablecer el último valor y mostrar alerta
        if (totalPorcentaje > 100) {
            // Restablecer el valor del campo actual para no exceder el 100%
            const porcentajeActual = parseFloat(input.value);
            const maxValorPermitido = 100 - (totalPorcentaje - porcentajeActual);
            input.value = Math.max(0, maxValorPermitido);  // Limitar el valor al máximo permitido
    
            alert("La suma de los porcentajes no puede exceder el 100%. Por favor, ajusta los pagos existentes.");
        }
    }

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Adelanto.JS ---------------------------------------
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