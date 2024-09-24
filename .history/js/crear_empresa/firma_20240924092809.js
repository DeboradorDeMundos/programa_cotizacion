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
    -------------------------------------- Inicio ITred Spa Firma .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    document.addEventListener('DOMContentLoaded', () => {
        const autoSignatureDisplay = document.getElementById('auto-signature-display');
        const manualSignaturesContainer = document.getElementById('manual-signatures');
        const addSignatureButton = document.getElementById('add-signature');
        const signatureImageInput = document.getElementById('signature-image');
        const signaturePreview = document.getElementById('signature-preview');
    
        const generateAutomaticSignature = () => {
    const titular_predefinido = `SIN OTRO PARTICULAR, Y ESPERANDO QUE LA PRESENTE OFERTA SEA DE SU INTERÉS, SE DESPIDE ATENTAMENTE:`;
    
    const empresa_nombre = document.getElementById('empresa_nombre').value;
    const empresa_area = document.getElementById('empresa_area').value;
    const empresa_telefono = document.getElementById('empresa_telefono').value;
    const empresa_email = document.getElementById('empresa_email').value; 
    const empresa_direccion = document.getElementById('empresa_direccion').value; 
    const empresa_rut = document.getElementById('empresa_rut').value; 

    // Nuevos campos a agregar
    const nombre_encargado = document.getElementById('nombre_encargado_firma');
    const cargo_encargado = document.getElementById('cargo_encargado_firma');
    const telefono_encargado = document.getElementById('telefono_encargado_firma');

    // Verificar que todos los campos requeridos tengan valor
    if (!empresa_nombre || !empresa_area || !empresa_telefono || !empresa_email || !empresa_direccion || !empresa_rut ) {
        return "Antes debes llenar todos los campos del formulario.";
    }

    return `${titular_predefinido} \n\n${empresa_nombre} -- ${empresa_rut} \n\n${empresa_area} \n\n${empresa_telefono} \n\n${empresa_email} \n\n${empresa_direccion} `;
};

    
        document.querySelectorAll('input[name="signature-option"]').forEach((input) => {
            input.addEventListener('change', () => {
                // Oculta todas las secciones de firma
                document.querySelectorAll('.signature-display').forEach((element) => {
                    element.style.display = 'none';
                });
    
                // Muestra la sección correspondiente según la opción seleccionada
                if (input.value === 'automatic') {
                    autoSignatureDisplay.innerText = generateAutomaticSignature();
                    autoSignatureDisplay.style.display = 'block';
                } else if (input.value === 'manual') {
                    manualSignaturesContainer.style.display = 'block';
                } else if (input.value === 'image') {
                    signatureImageInput.style.display = 'block';
                }
    
                // Asegúrate de ocultar el campo de imagen si se selecciona otra opción
                if (input.value !== 'image') {
                    signatureImageInput.style.display = 'none';
                    signaturePreview.style.display = 'none'; // Oculta la previsualización de la imagen si se elige otra opción
                }
            });
        });
    
        // Evento para manejar la subida de la imagen y mostrar la previsualización
        signatureImageInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file && file.type === 'image/png') {
                const reader = new FileReader();
                reader.onload = (e) => {
                    signaturePreview.src = e.target.result;
                    signaturePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                alert('Por favor selecciona un archivo PNG válido.');
            }
        });
    
       document.addEventListener('DOMContentLoaded', () => {
    const addSignatureButton = document.getElementById('add-signature');
    const manualSignaturesContainer = document.getElementById('manual-signatures');

    // Escuchar el evento para agregar una nueva fila de firma manual
    addSignatureButton.addEventListener('click', () => {
        const newSignatureRow = document.createElement('div');
        newSignatureRow.classList.add('signature-row');
        newSignatureRow.style.display = 'flex'; 
        newSignatureRow.style.flexDirection = 'column'; 
        newSignatureRow.style.marginBottom = '10px'; 

        // Crear campos para nombre, cargo, empresa, área, teléfono, email, dirección y RUT
        newSignatureRow.innerHTML = `
            <input type="text" class="manual-signature-input" name="nombre_encargado[]" placeholder="Nombre del Encargado" style="margin-bottom: 5px;">
            <input type="text" class="manual-signature-input" name="cargo_encargado[]" placeholder="Cargo del Encargado" style="margin-bottom: 5px;">
            <input type="text" class="manual-signature-input" name="nombre_empresa[]" placeholder="Nombre de la Empresa" style="margin-bottom: 5px;">
            <input type="text" class="manual-signature-input" name="area_empresa[]" placeholder="Área de la Empresa" style="margin-bottom: 5px;">
            <input type="text" class="manual-signature-input" name="telefono[]" placeholder="Teléfono" style="margin-bottom: 5px;">
            <input type="email" class="manual-signature-input" name="email[]" placeholder="Email" style="margin-bottom: 5px;">
            <input type="text" class="manual-signature-input" name="direccion[]" placeholder="Dirección" style="margin-bottom: 5px;">
            <input type="text" class="manual-signature-input" name="rut[]" placeholder="RUT" style="margin-bottom: 5px;">
            <button type="button" class="remove-signature" style="background-color: red; color: white; border: none; cursor: pointer; padding: 5px 10px;">Eliminar</button>
        `;

        // Agregar la nueva fila antes del botón de agregar más firmas
        manualSignaturesContainer.insertBefore(newSignatureRow, addSignatureButton);

        // Agregar funcionalidad para eliminar una fila
        const removeButton = newSignatureRow.querySelector('.remove-signature');
        removeButton.addEventListener('click', () => {
            manualSignaturesContainer.removeChild(newSignatureRow);
        });
    });
});


    
        // Evento para eliminar la firma manualmente ingresada
        manualSignaturesContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-signature')) {
                event.target.parentElement.remove();
            }
        });
    });
    
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Firma .JS ---------------------------------------
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