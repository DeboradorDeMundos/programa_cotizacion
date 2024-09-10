function addDetailSection() {
    const container = document.getElementById('detalle-container');
    
    // Crear una nueva sección de detalle con separador
    const newSection = document.createElement('div');
    newSection.classList.add('detalle-section');

    // Crear y agregar un separador
    const separator = document.createElement('hr');
    separator.classList.add('section-separator');
    container.appendChild(separator);

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
    addTitleButton.onclick = function() { addTitle(flexibleContainer, newSection, addTitleButton); };
    buttonContainer.appendChild(addTitleButton);

    // Botón para agregar cabecera
    const addHeaderButton = document.createElement('button');
    addHeaderButton.setAttribute('type', 'button');
    addHeaderButton.textContent = 'Agregar Cabecera';
    addHeaderButton.onclick = function() { addHeader(flexibleContainer, addHeaderButton); };
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
    addSubtitleButton.onclick = function() { addSubtitle(flexibleContainer); };
    buttonContainer.appendChild(addSubtitleButton);

    // Agregar el contenedor de botones y la sección al contenedor principal
    newSection.appendChild(buttonContainer);
    container.appendChild(newSection);
}

function addTitle(container, section, titleButton) {
    if (section.querySelector('.titulo-container')) {
        alert('Solo puede haber un título por sección.');
        return;
    }

    // Crear una nueva sección con título
    const titleContainer = document.createElement('div');
    titleContainer.classList.add('titulo-container');
    titleContainer.style.display = 'flex';
    titleContainer.style.alignItems = 'center';

    const titleLabel = document.createElement('label');
    titleLabel.textContent = 'Título:';
    titleContainer.appendChild(titleLabel);

    const titleInput = document.createElement('input');
    titleInput.setAttribute('type', 'text');
    titleInput.required = true;
    titleContainer.appendChild(titleInput);

    const removeTitleButton = document.createElement('button');
    removeTitleButton.setAttribute('type', 'button');
    removeTitleButton.textContent = 'Eliminar Título y Sección';
    removeTitleButton.onclick = function() { section.remove(); };
    titleContainer.appendChild(removeTitleButton);

    container.appendChild(titleContainer);

    // Deshabilitar el botón de agregar título después de agregarlo
    titleButton.disabled = true;
}

function addHeader(container, headerButton) {
    if (container.querySelector('thead')) {
        alert('Solo puede haber una cabecera por sección.');
        return;
    }

    const tableContainer = document.createElement('div');
    tableContainer.classList.add('table-container');

    const table = document.createElement('table');
    table.classList.add('detalle-table');

    const thead = document.createElement('thead');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <th>Tipo</th>
        <th>Nombre producto</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Precio Uni.</th>
        <th>Descuento %</th>
        <th>Total</th>
        <th>Acción</th>
    `;
    thead.appendChild(newRow);

    const tbody = document.createElement('tbody'); // Crear tbody para agregar detalles

    table.appendChild(thead);
    table.appendChild(tbody);
    tableContainer.appendChild(table);

    const removeHeaderButton = document.createElement('button');
    removeHeaderButton.setAttribute('type', 'button');
    removeHeaderButton.textContent = 'Eliminar Cabecera';
    removeHeaderButton.onclick = function() { 
        tableContainer.remove(); 
        headerButton.disabled = false;
    };
    tableContainer.appendChild(removeHeaderButton);

    container.appendChild(tableContainer);

    // Deshabilitar el botón de agregar cabecera después de agregarla
    headerButton.disabled = true;
}

function addDetailRow(container) {
    const table = container.querySelector('.detalle-table tbody');
    
    if (!table) {
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
    table.appendChild(newRow);
}

function addSubtitle(container) {
    const subtitleContainer = document.createElement('div');
    subtitleContainer.classList.add('subtitulo-container');
    
    const subtitleInput = document.createElement('input');
    subtitleInput.setAttribute('type', 'text');
    subtitleInput.required = true;
    subtitleInput.placeholder = 'Subtítulo';
    subtitleContainer.appendChild(subtitleInput);

    const removeSubtitleButton = document.createElement('button');
    removeSubtitleButton.setAttribute('type', 'button');
    removeSubtitleButton.textContent = 'Eliminar Subtítulo';
    removeSubtitleButton.onclick = function() { subtitleContainer.remove(); };
    subtitleContainer.appendChild(removeSubtitleButton);

    container.appendChild(subtitleContainer);
}
