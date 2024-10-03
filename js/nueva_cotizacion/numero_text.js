
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
    -------------------------------------- INICIO ITred Spa Numero text .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

    function numeroATexto(numero) {
        const unidades = [
            '', 'uno', 'dos', 'tres', 'cuatro', 'cinco',
            'seis', 'siete', 'ocho', 'nueve', 'diez',
            'once', 'doce', 'trece', 'catorce', 'quince',
            'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'
        ];
    
        const decenas = [
            '', '', 'veinte', 'treinta', 'cuarenta',
            'cincuenta', 'sesenta', 'setenta',
            'ochenta', 'noventa'
        ];
    
        const centenas = [
            '', 'cien', 'doscientos', 'trescientos',
            'cuatrocientos', 'quinientos',
            'seiscientos', 'setecientos',
            'ochocientos', 'novecientos'
        ];
    
        if (numero === 0) {
            return 'cero';
        } else if (numero < 20) {
            return unidades[numero];
        } else if (numero < 100) {
            const decena = Math.floor(numero / 10);
            const unidad = numero % 10;
            return decenas[decena] + (unidad > 0 ? ' y ' + unidades[unidad] : '');
        } else if (numero < 1000) {
            const centena = Math.floor(numero / 100);
            const resto = numero % 100;
            if (centena === 1 && resto > 0) {
                return 'ciento ' + numeroATexto(resto);
            }
            return centenas[centena] + (resto > 0 ? ' ' + numeroATexto(resto) : '');
        } else if (numero < 1000000) {
            const miles = Math.floor(numero / 1000);
            const resto = numero % 1000;
            if (miles === 1) {
                return 'mil' + (resto > 0 ? ' ' + numeroATexto(resto) : '');
            }
            return numeroATexto(miles) + ' mil' + (resto > 0 ? ' ' + numeroATexto(resto) : '');
        } else if (numero < 1000000000) {
            const millones = Math.floor(numero / 1000000);
            const resto = numero % 1000000;
            if (millones === 1) {
                return 'un millón' + (resto > 0 ? ' ' + numeroATexto(resto) : '');
            }
            return numeroATexto(millones) + ' millones' + (resto > 0 ? ' ' + numeroATexto(resto) : '');
        }
    
        return 'Número fuera de rango';
    }
    
    // Función para obtener el valor del input y convertirlo a texto
    function convertirTotalATexto() {
        const totalFinalInput = document.getElementById('total_final');
        const totalEnTexto = document.getElementById('total_en_texto');
        
        const numero = parseInt(totalFinalInput.value, 10); // Convertir el valor del input a un número entero
        if (!isNaN(numero)) {
            totalEnTexto.textContent = numeroATexto(numero); // Mostrar el número en texto
        } else {
            totalEnTexto.textContent = ''; // Si el valor no es válido, limpiar el texto
        }
    }
    
    // Detectar cuando el valor del input cambia
    document.getElementById('total_final').addEventListener('input', convertirTotalATexto);
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Numero text .JS ---------------------------------------
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