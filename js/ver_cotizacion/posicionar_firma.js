
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
    -------------------------------------- INICIO ITred Spa Firma  .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    function cambiarAlineacion(alineacion) {
        const contenedor = document.getElementById('firma-container');
        const imagen = document.getElementById('imagen-firma');
        const textoFirmaContainer = document.getElementById('texto-firma-container');

        // Restablecer estilos
        contenedor.style.textAlign = ''; // Reiniciar la alineación
        textoFirmaContainer.style.display = ''; // Reiniciar el tipo de visualización

        // Ocultar la imagen por defecto
        if (imagen) {
            imagen.style.display = 'none';
        }

        if (alineacion === 'izquierda') {
            contenedor.style.textAlign = 'left';
            textoFirmaContainer.style.display = 'inline-block'; // Alinear el texto junto a la imagen
            if (imagen) {
                imagen.style.display = 'inline-block'; // Mostrar imagen a la derecha
                imagen.style.marginLeft = '10px'; // Espacio entre texto e imagen
                imagen.style.verticalAlign = 'middle'; // Alinear verticalmente
                imagen.style.height = 'auto'; // Mantener proporción
            }
        } else if (alineacion === 'centro') {
            contenedor.style.textAlign = 'center';
            textoFirmaContainer.style.display = 'block'; // Texto en bloque
            if (imagen) {
                imagen.style.display = 'block'; // Mostrar imagen arriba del texto
                imagen.style.marginBottom = '5px'; // Espacio entre imagen y texto
                imagen.style.width = 'auto'; // Ajustar ancho automáticamente
                imagen.style.maxWidth = '150px'; // Limitar el ancho de la imagen
                imagen.style.margin = '0 auto'; // Centrar la imagen
                imagen.style.height = 'auto'; // Mantener proporción
            }
        } else if (alineacion === 'derecha') {
            contenedor.style.textAlign = 'right';
            textoFirmaContainer.style.display = 'inline-block'; // Alinear texto a la izquierda de la imagen
            if (imagen) {
                imagen.style.display = 'inline-block'; // Mostrar imagen a la derecha
                imagen.style.marginLeft = '10px'; // Espacio entre texto e imagen
                imagen.style.verticalAlign = 'middle'; // Alinear verticalmente
                imagen.style.height = 'auto'; // Mantener proporción
            }
        }

        // Aplicar estilo a cada texto
        const textos = contenedor.querySelectorAll('#texto-firma');
        textos.forEach(texto => {
            texto.style.margin = '0'; // Eliminar márgenes para que estén juntos
            texto.style.lineHeight = '1.5'; // Ajustar el interlineado
        });
    }
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Firma  .JS ---------------------------------------
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