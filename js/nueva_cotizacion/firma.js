
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
    
// TÍTULO: CAMBIAR ALINEACIÓN DE FIRMA
    // Función para cambiar la alineación del contenedor de la firma (izquierda, centro o derecha)
    function cambiarAlineacion(alineacion) {
        const contenedor = document.getElementById('firma-container'); // Obtener contenedor de firma
        const imagen = contenedor.querySelector('.imagen-firma'); // Obtener imagen de la firma
        const textoFirmaContainer = contenedor.querySelector('#texto-firma-container'); // Obtener contenedor de texto de la firma

        // Restablecer estilos
        contenedor.style.textAlign = ''; // Reiniciar la alineación
        textoFirmaContainer.style.display = ''; // Reiniciar el tipo de visualización

        // Ocultar la imagen por defecto
        if (imagen) {
            imagen.style.display = 'none'; // Ocultar imagen
            imagen.style.margin = '0'; // Reiniciar márgenes
        }

        if (alineacion === 'izquierda') {
            // Alinear contenido a la izquierda con imagen a la izquierda
            contenedor.style.textAlign = 'left'; // Alinear contenedor a la izquierda
            textoFirmaContainer.style.display = 'inline-block'; // Alinear el texto junto a la imagen
            textoFirmaContainer.style.verticalAlign = 'middle'; // Alinear texto verticalmente al centro
            if (imagen) {
                imagen.style.display = 'inline-block'; // Mostrar imagen al lado izquierdo
                imagen.style.marginRight = '10px'; // Espacio entre imagen y texto
                imagen.style.verticalAlign = 'middle'; // Alinear imagen al centro
                imagen.style.height = 'auto'; // Mantener proporción
            }
        } else if (alineacion === 'centro') {
            // Alinear contenido centrado con imagen debajo del texto
            contenedor.style.textAlign = 'center'; // Alinear contenedor al centro
            textoFirmaContainer.style.display = 'block'; // Mostrar texto en bloque (vertical)
            if (imagen) {
                imagen.style.display = 'block'; // Imagen debajo de los campos
                imagen.style.marginTop = '10px'; // Espacio entre texto e imagen
                imagen.style.width = 'auto'; // Ajustar ancho automáticamente
                imagen.style.maxWidth = '150px'; // Limitar el ancho de la imagen
                imagen.style.margin = '0 auto'; // Centrar la imagen horizontalmente
                imagen.style.height = 'auto'; // Mantener proporción
            }
        } else if (alineacion === 'derecha') {
            // Alinear contenido a la derecha con imagen a la derecha
            contenedor.style.textAlign = 'right'; // Alinear contenedor a la derecha
            textoFirmaContainer.style.display = 'inline-block'; // Alinear texto junto a la imagen
            textoFirmaContainer.style.verticalAlign = 'middle'; // Alinear texto verticalmente al centro
            if (imagen) {
                imagen.style.display = 'inline-block'; // Mostrar imagen al lado derecho
                imagen.style.marginLeft = '10px'; // Espacio entre texto e imagen
                imagen.style.verticalAlign = 'middle'; // Alinear imagen al centro
                imagen.style.height = 'auto'; // Mantener proporción
            }
        }

        // Aplicar estilo a cada texto
        const textos = contenedor.querySelectorAll('.texto-firma'); // Obtener todos los textos de la firma
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