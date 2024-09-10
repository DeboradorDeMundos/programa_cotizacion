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
    

    
    function calculateAdelanto() {
        const porcentajeAdelanto = parseFloat(document.getElementById('porcentaje_adelanto').value) || 0;
        const totalFinal = parseFloat(document.getElementById('total_final').value) || 0;
        const montoAdelanto = (totalFinal * (porcentajeAdelanto / 100)).toFixed(2);
    
        document.getElementById('monto_adelanto').value = montoAdelanto;
    }
    


    function addDetailRow(button) {

        const tableBody = button.closest('.detalle-section').querySelector('tbody');
        // Crear la fila del detalle del producto
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
            <select name="tipo_producto[]">
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
            <td><input type="text" name="nombre_producto[]"></td>
            <td><input type="checkbox" onclick="toggleDescription(this)"></td>
            <td><input type="number" name="detalle_cantidad[]" step="1" min="1" required oninput="updateTotal(this)"></td>
            <td><input type="number" name="detalle_precio_unitario[]" step="0.01" min="0" required oninput="updateTotal(this)"></td>
            <td><input type="number" name="detalle_descuento[]" step="1" min="0" required oninput="updateTotal(this)"></td>
            <td><input type="number" name="detalle_total[]" step="0.01" min="0" readonly></td>
            <td><button type="button" class="btn-eliminar" onclick="removeDetailRow(this)">Eliminar</button></td>
        `;
        tableBody.appendChild(newRow);
    
        // Crear la fila para la descripción desplegable
        const descriptionRow = document.createElement('tr');
        descriptionRow.className = 'descripcion-row';
        descriptionRow.style.display = 'none';
        descriptionRow.innerHTML = `
            <td colspan="7">
                <textarea name="detalle_descripcion[]" placeholder="Ingrese sólo si requiere ingresar una descripción extendida del producto o servicio"></textarea>
            </td>
        `;
        tableBody.appendChild(descriptionRow);
    
        calculateTotals();
    }
    
    function toggleDescription(checkbox) {
        const descriptionRow = checkbox.closest('tr').nextElementSibling;
        if (checkbox.checked) {
            descriptionRow.style.display = 'table-row';
        } else {
            descriptionRow.style.display = 'none';
        }
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
    
    function addDetailSection() {
        const container = document.getElementById('detalle-container');
        
        // Crear una nueva sección de detalle
        const newSection = document.createElement('div');
        newSection.classList.add('detalle-section');
    
        // Crear un contenedor flexible para los elementos
        const flexibleContainer = document.createElement('div');
        flexibleContainer.classList.add('flexible-container');
    
        newSection.appendChild(flexibleContainer);
    
        // Crear el contenedor de botones
        const buttonContainer = document.createElement('div');
        buttonContainer.classList.add('detalle-buttons');
    
        // Botón para agregar título
        const addTitleButton = document.createElement('button');
        addTitleButton.setAttribute('type', 'button');
        addTitleButton.textContent = 'Agregar Título';
        addTitleButton.onclick = function() { addTitle(flexibleContainer); };
        buttonContainer.appendChild(addTitleButton);
    
        // Botón para agregar cabecera
        const addHeaderButton = document.createElement('button');
        addHeaderButton.setAttribute('type', 'button');
        addHeaderButton.textContent = 'Agregar Cabecera';
        addHeaderButton.onclick = function() { addcabeza(flexibleContainer); };
        buttonContainer.appendChild(addHeaderButton);
    
        // Botón para agregar detalles
        const addDetailButton = document.createElement('button');
        addDetailButton.setAttribute('type', 'button');
        addDetailButton.textContent = 'Agregar Detalle';
        addDetailButton.onclick = function() { addDetailRow(flexibleContainer); };
        buttonContainer.appendChild(addDetailButton);
    
        // Botón para agregar subtítulo
        const addSubtitleButton = document.createElement('button');
        addSubtitleButton.setAttribute('type', 'button');
        addSubtitleButton.textContent = 'Agregar Subtítulo';
        addSubtitleButton.onclick = function() { addSubtitleRow(flexibleContainer); };
        buttonContainer.appendChild(addSubtitleButton);
    
        // Agregar el contenedor de botones y la sección al contenedor principal
        newSection.appendChild(buttonContainer);
        container.appendChild(newSection);
    }
    
    function addTitle(container) {
        const titleContainer = document.createElement('div');
        titleContainer.classList.add('titulo-container');
        titleContainer.style.display = 'flex';
        titleContainer.style.alignItems = 'center';
    
        const titleLabel = document.createElement('label');
        titleLabel.setAttribute('for', 'titulo');
        titleLabel.textContent = 'Título:';
        titleContainer.appendChild(titleLabel);
    
        const titleInput = document.createElement('input');
        titleInput.setAttribute('type', 'text');
        titleInput.setAttribute('name', 'detalle_titulo[]');
        titleInput.required = true;
        titleInput.style.marginRight = '10px';
        titleContainer.appendChild(titleInput);
    
        const removeTitleButton = document.createElement('button');
        removeTitleButton.setAttribute('type', 'button');
        removeTitleButton.classList.add('btn-eliminar-titulo');
        removeTitleButton.textContent = 'Eliminar Título';
        removeTitleButton.onclick = function() { titleContainer.remove(); };
        titleContainer.appendChild(removeTitleButton);
    
        container.appendChild(titleContainer);
    }
    
    function addcabeza(container) {
        const tableHead = container.querySelector('thead');
        let thead;
        
        if (!tableHead) {
            const table = document.createElement('table');
            table.classList.add('detalle-table');
    
            thead = document.createElement('thead');
            table.appendChild(thead);
            
            const tbody = document.createElement('tbody');
            table.appendChild(tbody);
    
            container.appendChild(table);
        } else {
            thead = tableHead;
        }
    
        // Crear la fila del encabezado
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <th>Tipo</th>
            <th>Nombre producto</th>
            <th>DESCRIPCIÓN</th>
            <th>CANTIDAD</th>
            <th>PRECIO UNI.</th>
            <th>DESCUENTO %</th>
            <th>TOTAL</th>
            <th>ACCIÓN</th>
        `;
    
        const removeHeaderButton = document.createElement('button');
        removeHeaderButton.setAttribute('type', 'button');
        removeHeaderButton.classList.add('btn-eliminar-titulo');
        removeHeaderButton.textContent = 'Eliminar Cabecera';
        removeHeaderButton.onclick = function() { newRow.remove(); };
    
        newRow.querySelector('th:last-child').appendChild(removeHeaderButton);
    
        thead.appendChild(newRow);
    }
    
    function addDetailRow(container) {
        const tableBody = container.querySelector('tbody');
    
        if (!tableBody) {
            alert('Primero debe agregar una cabecera.');
            return;
        }
    
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>Tipo Detalle</td>
            <td>Nombre Producto</td>
            <td>Descripción</td>
            <td>Cantidad</td>
            <td>Precio Unitario</td>
            <td>Descuento %</td>
            <td>Total</td>
            <td><button type="button" class="btn-eliminar-detalle" onclick="this.closest('tr').remove();">Eliminar</button></td>
        `;
        tableBody.appendChild(newRow);
    }
    
    function addSubtitleRow(container) {
        const subtitleContainer = document.createElement('div');
        subtitleContainer.classList.add('subtitulo-container');
        
        const subtitleInput = document.createElement('input');
        subtitleInput.setAttribute('type', 'text');
        subtitleInput.setAttribute('name', 'detalle_subtitulo[]');
        subtitleInput.required = true;
        subtitleInput.style.marginRight = '10px';
        subtitleInput.placeholder = 'Subtítulo';
        subtitleContainer.appendChild(subtitleInput);
    
        const removeSubtitleButton = document.createElement('button');
        removeSubtitleButton.setAttribute('type', 'button');
        removeSubtitleButton.classList.add('btn-eliminar-subtitulo');
        removeSubtitleButton.textContent = 'Eliminar Subtítulo';
        removeSubtitleButton.onclick = function() { subtitleContainer.remove(); };
        subtitleContainer.appendChild(removeSubtitleButton);
    
        container.appendChild(subtitleContainer);
    }
    

    
    function addSubtitleRow(button) {
        const section = button.closest('.detalle-section');
        const subtitulosContainer = section.querySelector('.subtitulos-container');
        
        const newSubtitle = document.createElement('div');
        newSubtitle.classList.add('subtitulo');
        newSubtitle.style.display = 'flex';
        newSubtitle.style.alignItems = 'center';
        newSubtitle.innerHTML = `
            <label for="subtitulo">Subtítulo:</label>
            <input type="text" name="detalle_subtitulo[]" style="margin-right: 10px;">
            <button type="button" class="btn-eliminar-titulo" onclick="removeSubtitleRow(this)">Eliminar subtítulo</button>
        `;
        
        // En lugar de insertBefore, simplemente lo agregamos al final del contenedor de subtítulos
        subtitulosContainer.appendChild(newSubtitle);
    }
    
    function removeSubtitleRow(button) {
        const subtitle = button.closest('.subtitulo');
        subtitle.remove();
    }
    
    function removeDetailSection(button) {
        const confirmacion = confirm('¿Estás seguro de que quieres eliminar esta sección?');
        if (confirmacion) {
            const section = button.closest('.detalle-section');
            section.remove();
    
            calculateTotals();
        }
    }
    
    function updateTotal(input) {
        const row = input.closest('tr');
        const cantidad = parseFloat(row.querySelector('input[name="detalle_cantidad[]"]').value) || 0;
        const precioUnitario = parseFloat(row.querySelector('input[name="detalle_precio_unitario[]"]').value) || 0;
        const descuento = parseFloat(row.querySelector('input[name="detalle_descuento[]"]').value) || 0;
        const totalInput = row.querySelector('input[name="detalle_total[]"]');
    
        const desc = (precioUnitario * (descuento / 100));
        const total = (cantidad * (precioUnitario - desc)).toFixed(2);
        totalInput.value = total;
    
        calculateTotals();
    }
    
    function calculateTotals() {
        const rows = document.querySelectorAll('.detalle-section .detalle-table tbody tr');
        let subTotal = 0;
        let ivaValor = 0;
        let descuentoGlobalPorcentaje = parseFloat(document.getElementById('descuento_global_porcentaje').value) || 0;
        let descuentoGlobalMonto = 0;
        let totalFinal = 0;
    
        rows.forEach(row => {
            const totalInput = row.querySelector('input[name="detalle_total[]"]');
            if (totalInput) {
                const totalItem = parseFloat(totalInput.value) || 0;
                subTotal += totalItem;
            }
        });
    
        descuentoGlobalMonto = Math.round(subTotal * (descuentoGlobalPorcentaje / 100));
        ivaValor = ((subTotal - descuentoGlobalMonto) * 0.19).toFixed(2);  // 19% IVA
        totalFinal = Math.round(subTotal - descuentoGlobalMonto + parseFloat(ivaValor));
    
        document.getElementById('sub_total').value = Math.round(subTotal);
        document.getElementById('descuento_global_monto').value = descuentoGlobalMonto;
        document.getElementById('monto_neto').value = Math.round(subTotal - descuentoGlobalMonto);
        document.getElementById('total_iva').value = ivaValor;
        document.getElementById('total_final').value = totalFinal;
    
        // Recalcular adelanto
        calculateAdelanto();
    }
    
    function formatRut(input) {
        // Obtiene el valor del campo y elimina los caracteres no numéricos
        let rut = input.value.replace(/\D/g, '');
    
        // Aplica el formato de RUT
        if (rut.length > 1) {
            rut = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + rut.slice(-1);
        }
    
        // Asigna el valor formateado de vuelta al campo de entrada
        input.value = rut;
    }
    

 
    
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('logo-preview');
            output.src = reader.result;
            output.style.display = 'block';
            document.getElementById('logo-text').style.display = 'none';
        }
        reader.readAsDataURL(event.target.files[0]);
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