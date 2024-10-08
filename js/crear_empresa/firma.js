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
        const MostrarFirmaAutomatica = document.getElementById('auto-desplegar-firma');
        const MostrarFirmaManual = document.getElementById('firma-manual');
        const CampoFirmaImagen = document.getElementById('firma-imagen');
        const VistaFirma = document.getElementById('firma-preview');
        const MensajeFirmaDigital = document.getElementById('digital-firma-message'); // Contenedor del mensaje de firma digital
    
        const GenerarFimaAutomatica = () => {
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
                ${titularPredefinido} 
                \n\n${nombreEncargado} 
                \n${cargoEncargado} - ${nombreEmpresa} 
                \n${direccionEmpresa} 
                \nTeléfono: ${telefonoEncargado} 
                \nCelular: ${celularEncargado} 
                \nEmail: ${emailEncargado} 
                \nWeb: ${webEmpresa}`;
        };
    
        document.querySelectorAll('input[name="opcion-firma"]').forEach((input) => {
            input.addEventListener('change', () => {
                // Oculta todas las secciones de firma
                document.querySelectorAll('.desplegar-firma').forEach((element) => {
                    element.style.display = 'none';
                });
    
                // Muestra la sección correspondiente según la opción seleccionada
                if (input.value === 'automatica') {
                    MostrarFirmaAutomatica.innerText = GenerarFimaAutomatica();
                    MostrarFirmaAutomatica.style.display = 'block';
                } else if (input.value === 'manual') {
                    MostrarFirmaManual.style.display = 'block';
                } else if (input.value === 'imagen') {
                    CampoFirmaImagen.style.display = 'block';
                } else if (input.value === 'digital') {
                    MensajeFirmaDigital.style.display = 'block'; // Muestra el mensaje de firma digital
                }
    
                // Asegúrate de ocultar el campo de imagen si se selecciona otra opción
                if (input.value !== 'imagen') {
                    CampoFirmaImagen.style.display = 'none';
                    VistaFirma.style.display = 'none'; // Oculta la previsualización de la imagen si se elige otra opción
                }
            });
        });
    
        // Evento para manejar la subida de la imagen y mostrar la previsualización
        CampoFirmaImagen.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file && file.type === 'image/png') {
                const reader = new FileReader();
                reader.onload = (e) => {
                    VistaFirma.src = e.target.result;
                    VistaFirma.style.display = 'block';
                };
                reader.readAsDataURL(archivo);
            } else {
                alert('Por favor selecciona un archivo PNG válido.');
            }
        });
       document.addEventListener('DOMContentLoaded', () => {
    const BotonAgregarFirma = document.getElementById('agregar-firma');
    const MostrarFirmaManual = document.getElementById('firma-manual');

    // Escuchar el evento para agregar una nueva fila de firma manual
    BotonAgregarFirma.addEventListener('click', () => {
        const FilaNuevaFirma = document.createElement('div');
        FilaNuevaFirma.classList.add('fila-firma');
        FilaNuevaFirma.style.display = 'flex'; 
        FilaNuevaFirma.style.flexDirection = 'column'; 
        FilaNuevaFirma.style.marginBottom = '10px'; 

        // Crear campos para nombre, cargo, empresa, área, teléfono, email, dirección y RUT
        FilaNuevaFirma.innerHTML = `
            <input type="text" class="manual-firma-input" name="nombre_encargado[]" placeholder="Nombre del Encargado" style="margin-bottom: 5px;">
            <input type="text" class="manual-firma-input" name="cargo_encargado[]" placeholder="Cargo del Encargado" style="margin-bottom: 5px;">
            <input type="text" class="manual-firma-input" name="nombre_empresa[]" placeholder="Nombre de la Empresa" style="margin-bottom: 5px;">
            <input type="text" class="manual-firma-input" name="area_empresa[]" placeholder="Área de la Empresa" style="margin-bottom: 5px;">
            <input type="text" class="manual-firma-input" name="telefono[]" placeholder="Teléfono" style="margin-bottom: 5px;">
            <input type="email" class="manual-firma-input" name="email[]" placeholder="Email" style="margin-bottom: 5px;">
            <input type="text" class="manual-firma-input" name="direccion[]" placeholder="Dirección" style="margin-bottom: 5px;">
            <input type="text" class="manual-firma-input" name="rut[]" placeholder="RUT" style="margin-bottom: 5px;">
            <button type="button" class="remove-firma" style="background-color: red; color: white; border: none; cursor: pointer; padding: 5px 10px;">Eliminar</button>
        `;

        // Agregar la nueva fila antes del botón de agregar más firmas
        MostrarFirmaManual.insertBefore(FilaNuevaFirma, BotonAgregarFirma);

        // Agregar funcionalidad para eliminar una fila
        const removeButton = FilaNuevaFirma.querySelector('.remove-firma');
        removeButton.addEventListener('click', () => {
            MostrarFirmaManual.removeChild(FilaNuevaFirma);
        });
    });
});
    
        // Evento para eliminar la firma manualmente ingresada
        MostrarFirmaManual.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-firma')) {
                event.target.parentElement.remove();
            }
        });
    });
    

    document.getElementById('firma-imagen').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('firma-preview');
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    });

    function checkSignatureSelection() {
        const botonsubir = document.getElementById('submit-button');
        const seleccionaropcion = document.querySelector('input[name="opcion-firma"]:checked');
        
        // Habilitar o deshabilitar el botón de envío según la selección
        if (seleccionaropcion) {
            botonsubir.disabled = false; // Habilitar si hay una selección
        } else {
            botonsubir.disabled = true; // Deshabilitar si no hay selección
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