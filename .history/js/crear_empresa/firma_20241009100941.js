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
    -------------------------------------- Inicio ITred Spa Firma .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    document.addEventListener('DOMContentLoaded', () => {
        const DesplegarFirmaAutomatica = document.getElementById('auto-desplegar-firma');
        const ContenedorFirmaManual = document.getElementById('firma-manual');
        const InputFirmaImagen = document.getElementById('firma-imagen');
        const PrevisualizacionFirma = document.getElementById('previsualizacion-firma');
        const MensajeFirmaDigital = document.getElementById('Mensaje-Firma-Digital'); // Contenedor del mensaje de firma digital
    
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
            const logo = document.getElementById('subir-logo').src;
        
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
    
        document.querySelectorAll('input[name="opcion-firma"]').forEach((input) => {
            input.addEventListener('change', () => {
                // Oculta todas las secciones de firma
                document.querySelectorAll('.desplegar-firma').forEach((element) => {
                    element.style.display = 'none';
                });
    
                // Muestra la sección correspondiente según la opción seleccionada
                if (input.value === 'automatic') {
                    DesplegarFirmaAutomatica.innerText = generateAutomaticSignature();
                    DesplegarFirmaAutomatica.style.display = 'block';
                } else if (input.value === 'manual') {
                    ContenedorFirmaManual.style.display = 'block';
                } else if (input.value === 'image') {
                    InputFirmaImagen.style.display = 'block';
                } else if (input.value === 'digital') {
                    MensajeFirmaDigital.style.display = 'block'; // Muestra el mensaje de firma digital
                }
    
                // Asegúrate de ocultar el campo de imagen si se selecciona otra opción
                if (input.value !== 'image') {
                    InputFirmaImagen.style.display = 'none';
                    PrevisualizacionFirma.style.display = 'none'; // Oculta la previsualización de la imagen si se elige otra opción
                }
            });
        });
    
        // Evento para manejar la subida de la imagen y mostrar la previsualización
        InputFirmaImagen.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file && file.type === 'image/png') {
                const Lector = new FileReader();
                Lector.onload = (e) => {
                    PrevisualizacionFirma.src = e.target.result;
                    PrevisualizacionFirma.style.display = 'block';
                };
                Lector.LeerComoDatoURL(file);
            } else {
                alert('Por favor selecciona un archivo PNG válido.');
            }
        });
       document.addEventListener('DOMContentLoaded', () => {
    const BotonAgregarFirma = document.getElementById('add-signature');
    const ContenedorFirmaManual = document.getElementById('firma-manual');

    // Escuchar el evento para agregar una nueva fila de firma manual
    BotonAgregarFirma.addEventListener('click', () => {
        const NuevaFilaFirma = document.createElement('div');
        NuevaFilaFirma.classList.add('signature-row');
        NuevaFilaFirma.style.display = 'flex'; 
        NuevaFilaFirma.style.flexDirection = 'column'; 
        NuevaFilaFirma.style.marginBottom = '10px'; 

        // Crear campos para nombre, cargo, empresa, área, teléfono, email, dirección y RUT
        NuevaFilaFirma.innerHTML = `
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
        ContenedorFirmaManual.insertBefore(NuevaFilaFirma, BotonAgregarFirma);

        // Agregar funcionalidad para eliminar una fila
        const BotonQuitar = NuevaFilaFirma.querySelector('.remove-signature');
        BotonQuitar.addEventListener('click', () => {
            ContenedorFirmaManual.removeChild(NuevaFilaFirma);
        });
    });
});
    
        // Evento para eliminar la firma manualmente ingresada
        ContenedorFirmaManual.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-signature')) {
                event.target.parentElement.remove();
            }
        });
    });
    

    document.getElementById('firma-imagen').addEventListener('change', function(event) {
        const Lector = new FileReader();
        Lector.onload = function() {
            const Previsualizacion = document.getElementById('previsualizacion-firma');
            Previsualizacion.src = Lector.result;
            Previsualizacion.style.display = 'block';
        };
        Lector.LeerComoDatoURL(event.target.files[0]);
    });

    function VerificarSeleccionFirma() {
        const BotonSubir = document.getElementById('boton-subir');
        const OpcionSeleccionada = document.querySelector('input[name="opcion-firma"]:checked');
        
        // Habilitar o deshabilitar el botón de envío según la selección
        if (OpcionSeleccionada) {
            BotonSubir.disabled = false; // Habilitar si hay una selección
        } else {
            BotonSubir.disabled = true; // Deshabilitar si no hay selección
        }
    }

    

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Firma .JS ---------------------------------------
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