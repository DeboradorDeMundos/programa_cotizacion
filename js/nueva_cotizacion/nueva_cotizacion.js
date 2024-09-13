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
    -------------------------------------- INICIO ITred Spa Nueva_Cotizacion .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
   
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('fecha_emision').value = new Date().toISOString().split('T')[0];
    });
    
  
    
    let tituloCount = 0; // Contador global para los títulos
    
    function addDetailSection() {
        const container = document.getElementById('detalle-container');
        const newSection = document.createElement('div');
        newSection.classList.add('detalle-section');
        newSection.dataset.tituloIndex = tituloCount; // Asigna un índice único al título
    
        newSection.innerHTML = `
            <div class="detalle-content">
                <div class="titulo-container" style="display: flex; align-items: center;">
                    <label for="titulo">Título:</label>
                    <input type="text" name="detalle_titulo[${tituloCount}]" required style="margin-right: 10px;">
                    <button type="button" class="btn-eliminar-titulo" onclick="removeDetailSection(this)">Eliminar Título</button>
                </div>
                <table class="detalle-table">
                    <thead>
                        <!-- Las filas de la cabecera se agregarán aquí -->
                    </thead>
                    <tbody class="detalle-contenido">
                        <!-- Las filas de detalles y subtítulos se agregarán aquí -->
                    </tbody>
                </table>
            </div>
            <div class="detalle-buttons">
                <button type="button" onclick="addcabeza(this)">Agregar Cabecera</button>
                <button type="button" onclick="addDetailRow(this)">Agregar detalles</button>
                <button type="button" onclick="addSubtitleRow(this)">Agregar subtítulo</button>
            </div>
        `;
        container.appendChild(newSection);
        tituloCount++; // Incrementa el contador de títulos
    }
    
    function removeDetailSection(button) {
        if (confirm('¿Estás seguro de que quieres eliminar esta sección?')) {
            const section = button.closest('.detalle-section');
            section.remove();
            calculateTotals();
        }
    }
    
    function addDetailRow(button) {
        const section = button.closest('.detalle-section');
        const tableBody = section.querySelector('.detalle-contenido');
        const tituloIndex = section.dataset.tituloIndex; // Obtiene el índice del título
    
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select name="tipo_producto[${tituloIndex}][]">
                    <option value="nuevo">Nuevo</option>
                    <option value="insumo">Insumo</option>
                    <option value="producto">Producto</option>
                    <option value="material">Material</option>
                    <option value="ferreteria">Ferretería</option>
                    <option value="profesional">Profesional</option>
                    <option value="tecnico">Técnico</option>
                    <option value="maestro">Maestro</option>
                    <option value="ayudante">Ayudante</option>
                </select>
            </td>
            <td><input type="text" name="nombre_producto[${tituloIndex}][]"></td>
            <td><input type="checkbox" onclick="toggleDescription(this)"></td>
            <td><input type="number" name="detalle_cantidad[${tituloIndex}][]" step="1" min="1" required oninput="updateTotal(this)"></td>
            <td><input type="number" name="detalle_precio_unitario[${tituloIndex}][]" step="0.01" min="0" required oninput="updateTotal(this)"></td>
            <td><input type="number" name="detalle_descuento[${tituloIndex}][]" step="1" min="0" required oninput="updateTotal(this)"></td>
            <td><input type="number" name="detalle_total[${tituloIndex}][]" step="0.01" min="0" readonly></td>
            <td><button type="button" class="btn-eliminar" onclick="removeDetailRow(this)">Eliminar</button></td>
        `;
        tableBody.appendChild(newRow);
    
        const descriptionRow = document.createElement('tr');
        descriptionRow.className = 'descripcion-row';
        descriptionRow.style.display = 'none';
        descriptionRow.innerHTML = `
            <td colspan="7">
                <textarea name="detalle_descripcion[${tituloIndex}][]" placeholder="Ingrese sólo si requiere ingresar una descripción extendida del producto o servicio"></textarea>
            </td>
        `;
        tableBody.appendChild(descriptionRow);
    
        calculateTotals();
    }
    
    function addSubtitleRow(button) {
        const section = button.closest('.detalle-section');
        const tableBody = section.querySelector('.detalle-contenido');
        const tituloIndex = section.dataset.tituloIndex; // Obtiene el índice del título
    
        const newSubtitle = document.createElement('tr');
        newSubtitle.classList.add('subtitulo');
        newSubtitle.innerHTML = `
            <td colspan="7">
                <label for="subtitulo">Subtítulo:</label>
                <input type="text" name="detalle_subtitulo[${tituloIndex}][]" style="margin-right: 10px;">
            </td>
            <td><button type="button" class="btn-eliminar-titulo" onclick="removeSubtitleRow(this)">Eliminar subtítulo</button></td>
        `;
        tableBody.appendChild(newSubtitle);
    }
    
    function removeSubtitleRow(button) {
        const subtitle = button.closest('tr');
        subtitle.remove();
    }
    
    function removeDetailRow(button) {
        const row = button.closest('tr');
        const descriptionRow = row.nextElementSibling;
    
        row.remove();
        if (descriptionRow && descriptionRow.classList.contains('descripcion-row')) {
            descriptionRow.remove();
        }
    
        calculateTotals();
    }
    
    
    function toggleDescription(checkbox) {
        const descriptionRow = checkbox.closest('tr').nextElementSibling;
        descriptionRow.style.display = checkbox.checked ? 'table-row' : 'none';
    }
    
    function updateTotal(input) {
        const row = input.closest('tr');
        const section = row.closest('.detalle-section');
        const tituloIndex = section.dataset.tituloIndex; // Obtiene el índice del título
    
        const cantidad = parseFloat(row.querySelector(`input[name="detalle_cantidad[${tituloIndex}][]"]`).value) || 0;
        const precioUnitario = parseFloat(row.querySelector(`input[name="detalle_precio_unitario[${tituloIndex}][]"]`).value) || 0;
        const descuento = parseFloat(row.querySelector(`input[name="detalle_descuento[${tituloIndex}][]"]`).value) || 0;
        const totalInput = row.querySelector(`input[name="detalle_total[${tituloIndex}][]"]`);
    
        const desc = (precioUnitario * (descuento / 100));
        const total = (cantidad * (precioUnitario - desc)).toFixed(2);
        totalInput.value = total;
    
        calculateTotals();
    }
    
    
function calculateTotals() {
    const rows = document.querySelectorAll('.detalle-section .detalle-table tbody tr');
    console.log('Número de filas:', rows.length); // Verifica cuántas filas se seleccionaron

    let subTotal = 0;
    let descuentoGlobalPorcentaje = parseFloat(document.getElementById('descuento_global_porcentaje').value) || 0;
    let descuentoGlobalMonto = 0;
    let ivaValor = 0;
    let totalFinal = 0;

    rows.forEach(row => {
        const totalInput = row.querySelector('input[name^="detalle_total"]'); // Usa un selector más general
        console.log('Input de Total:', totalInput); // Verifica si se encuentra el input

        if (totalInput) {
            const totalItem = parseFloat(totalInput.value) || 0;
            subTotal += totalItem;
            console.log(`Total Item (${row.id}): ${totalItem}`); // Verifica el total por fila
        } else {
            console.log(`No se encontró input en la fila ${row.id}`);
        }
    });

    descuentoGlobalMonto = Math.round(subTotal * (descuentoGlobalPorcentaje / 100));
    ivaValor = ((subTotal - descuentoGlobalMonto) * 0.19).toFixed(2);  // 19% IVA
    totalFinal = Math.round(subTotal - descuentoGlobalMonto + parseFloat(ivaValor));

    console.log(`Subtotal: ${subTotal}`);
    console.log(`Descuento Global Monto: ${descuentoGlobalMonto}`);
    console.log(`IVA Valor: ${ivaValor}`);
    console.log(`Total Final: ${totalFinal}`);

    document.getElementById('sub_total').value = Math.round(subTotal);
    document.getElementById('descuento_global_monto').value = descuentoGlobalMonto;
    document.getElementById('monto_neto').value = Math.round(subTotal - descuentoGlobalMonto);
    document.getElementById('total_iva').value = ivaValor;
    document.getElementById('total_final').value = totalFinal;

    calcularPago();
}
    function formatRut(input) {
        let rut = input.value.replace(/\D/g, '');
        if (rut.length > 1) {
            rut = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + rut.slice(-1);
        }
        input.value = rut;
    }
    

    
    function togglePaymentInfo(checkbox) {
        const table = checkbox.closest('table');
        const paymentInfoContainer = table.querySelector('.payment-info');
        const paymentHeader = table.querySelector('.payment-header');
    
        if (checkbox.checked) {
            paymentInfoContainer.style.display = 'table-row-group';
            paymentHeader.style.display = 'table-row';
        } else {
            paymentInfoContainer.style.display = 'none';
            paymentHeader.style.display = 'none';
        }
    }
    
    /* --------------------------------------------------------------------------------------------------------------
        --------------------------------------- FINAL ITred Spa Nueva_Cotizacion .JS ----------------------------------------
    -----
        
        /* --------------------------------------------------------------------------------------------------------------
            ---------------------------------------- FIN ITred Spa Nueva_Cotizacion .JS ---------------------------------------
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