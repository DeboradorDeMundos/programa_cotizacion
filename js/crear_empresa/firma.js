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
        const signatureImageInput = document.getElementById('signature-image');
        const signaturePreview = document.getElementById('signature-preview');
        const digitalSignatureMessage = document.getElementById('digital-signature-message'); // Contenedor del mensaje de firma digital
    
        const generateAutomaticSignature = () => {
            const titular_predefinido = `SIN OTRO PARTICULAR, Y ESPERANDO QUE LA PRESENTE OFERTA SEA DE SU INTERÉS, SE DESPIDE ATENTAMENTE:`;
        
            const nombre_encargado = document.getElementById('encargado_nombre').value;
            const cargo_encargado = document.getElementById('cargo_encargado').value;
            const empresa_nombre = document.getElementById('empresa_nombre').value;
            const empresa_direccion = document.getElementById('empresa_direccion').value;
            const empresa_ciudad = document.getElementById('empresa_ciudad').value;
            const empresa_pais = document.getElementById('empresa_pais').value;
            const telefono_encargado = document.getElementById('encargado_fono').value;
            const celular_encargado = document.getElementById('encargado_celular').value;
            const email_encargado = document.getElementById('encargado_email').value;
            const web_empresa = document.getElementById('empresa_web').value;
            const logo = document.getElementById('logo-upload').src;
        
            if (!nombre_encargado || !cargo_encargado || !empresa_nombre || !empresa_direccion || !empresa_ciudad || !empresa_pais || !telefono_encargado || !celular_encargado || !email_encargado || !web_empresa) {
                return "Antes debes llenar todos los campos del formulario.";
            }
        
            return `
                ${titular_predefinido} 
                \n\n${nombre_encargado} 
                \n${cargo_encargado} - ${empresa_nombre} 
                \n${empresa_direccion} 
                \n${empresa_ciudad}, ${empresa_pais} 
                \nTeléfono: ${telefono_encargado} 
                \nCelular: ${celular_encargado} 
                \nEmail: ${email_encargado} 
                \nWeb: ${web_empresa}`;
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
                } else if (input.value === 'digital') {
                    digitalSignatureMessage.style.display = 'block'; // Muestra el mensaje de firma digital
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
    

    document.getElementById('signature-image').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('signature-preview');
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });

    function checkSignatureSelection() {
        const submitButton = document.getElementById('submit-button');
        const selectedOption = document.querySelector('input[name="signature-option"]:checked');
        
        // Habilitar o deshabilitar el botón de envío según la selección
        if (selectedOption) {
            submitButton.disabled = false; // Habilitar si hay una selección
        } else {
            submitButton.disabled = true; // Deshabilitar si no hay selección
        }
    }

    

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