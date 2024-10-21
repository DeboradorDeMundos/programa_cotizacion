
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
    -------------------------------------- INICIO ITred Spa Detalle cliente.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// TÍTULO: PARA LA FUNCIÓN DE FORMATEO DE NÚMERO DE TELÉFONO
    // Función para formatear el número de teléfono
    function FormatoNumeroTelefono(input) {
        // Eliminar todo lo que no sea número o espacio
        let value = input.value.replace(/[^\d]/g, '');
        
        // Verificar la longitud del número y formatear
        if (value.length > 10) {
            value = value.replace(/^(\d{2})(\d)(\d{4})(\d{4})$/, '+$1 $2 $3 $4');
        } else if (value.length > 7) {
            value = value.replace(/^(\d{2})(\d)(\d{4})$/, '+$1 $2 $3');
        } else if (value.length > 2) {
            value = value.replace(/^(\d{2})(\d)$/, '+$1 $2');
        } else if (value.length > 1) {
            value = value.replace(/^(\d{2})$/, '+$1');
        }

        input.value = value; // Actualizar el valor del campo de entrada
    }

// TÍTULO: PARA LA FUNCIÓN DE COMPLETAR EMAIL
    // Función para completar el email con un dominio por defecto
    function CompletarEmail(input) {
        // Eliminar comillas simples y dobles
        input.value = input.value.replace(/['"]/g, '');
        
        const PatronEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expresión regular para validar email
        
        // Comprobar si el correo tiene un formato válido
        if (!PatronEmail.test(input.value)) {
            if (!input.value.includes('@')) {
                input.value += '@gmail.com'; // Añadir '@gmail.com' si no se ingresó
            } else {
                alert("Por favor, ingresa un correo electrónico válido."); // Mensaje de error
            }
        }
    }

// TÍTULO: PARA LA FUNCIÓN DE QUITAR CARACTERES INVÁLIDOS
    // Función para quitar caracteres inválidos de un input
    function QuitarCaracteresInvalidos(input) {
        // Eliminar comillas y otros caracteres no deseados
        input.value = input.value.replace(/['"]/g, '');
    }

// TÍTULO: PARA EL OBJETO DE BANDERAS
    // Objeto que asocia códigos de país con imágenes de banderas
    const banderasPais1 = {
        "+1": "https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Flag_of_the_United_States.svg/32px-Flag_of_United_States.svg.png", // USA
        "+52": "https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Flag_of_Mexico.svg/32px-Flag_of_Mexico.svg.png", // Mexico
        "+56": "https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Flag_of_Chile.svg/32px-Flag_of_Chile.svg.png", // Chile
        "+54": "https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Flag_of_Argentina.svg/32px-Flag_of_Argentina.svg.png", // Argentina
        "+57": "https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Flag_of_Colombia.svg/32px-Flag_of_Colombia.svg.png", // Colombia
        "+58": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/06/Flag_of_Venezuela.svg/32px-Flag_of_Venezuela.svg.png", // Venezuela
        "+51": "https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Flag_of_Peru.svg/32px-Flag_of_Peru.svg.png", // Peru
        "+503": "https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Flag_of_El_Salvador.svg/32px-Flag_of_El_Salvador.svg.png", // El Salvador
        "+591": "https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/Flag_of_Bolivia.svg/32px-Flag_of_Bolivia.svg.png", // Bolivia
        "+507": "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Flag_of_Panama.svg/32px-Flag_of_Panama.svg.png", // Panama
        "+505": "https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Flag_of_Nicaragua.svg/32px-Flag_of_Nicaragua.svg.png", // Nicaragua
        "+502": "https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Flag_of_Guatemala.svg/32px-Flag_of_Guatemala.svg.png", // Guatemala
        "+504": "https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Flag_of_Honduras.svg/32px-Flag_of_Honduras.svg.png", // Honduras
        "+53": "https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Flag_of_Cuba.svg/32px-Flag_of_Cuba.svg.png", // Cuba
        "+55": "https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Flag_of_Brazil.svg/32px-Flag_of_Brazil.svg.png", // Brazil
        "+598": "https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Flag_of_Uruguay.svg/32px-Flag_of_Uruguay.svg.png", // Uruguay
        "+509": "https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/Flag_of_Haiti.svg/32px-Flag_of_Haiti.svg.png", // Haiti
        "+593": "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Flag_of_Ecuador.svg/32px-Flag_of_Ecuador.svg.png", // Ecuador
        "+595": "https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Flag_of_Paraguay.svg/32px-Flag_of_Paraguay.svg.png" // Paraguay
    };

// TÍTULO: PARA LA BANDERA POR DEFECTO
    // Imagen de bandera por defecto cuando no coincide con ningún código
    const banderaPorDefecto1 = "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/World_Flag_%282004%29.svg/640px-World_Flag_%282004%29.svg.png"; // Bandera por defecto

// TÍTULO: PARA LA FUNCIÓN DE DETECCIÓN DE PAÍS
    // Función para detectar el país según el número de teléfono ingresado
    function detectarPais1(input1) {
        const numeroTelefono1 = input1.value.trim(); // Asegúrate de eliminar espacios
        const imagenBandera1 = document.getElementById("flag_cliente");
        
        // Itera sobre los códigos de país para detectar el correcto
        for (const codigo1 in banderasPais1) {
            if (numeroTelefono1.startsWith(codigo1)) {
                imagenBandera1.src = banderasPais1[codigo1];
                imagenBandera1.style.display = "inline"; // Mostrar la imagen de la bandera
                return; // Detener la función si se encuentra el país
            }
        }
        // Si no se encuentra un código de país coincidente, muestra la bandera por defecto
        imagenBandera1.src = banderaPorDefecto1;
        imagenBandera1.style.display = "inline";
    }

// TÍTULO: PARA LA FUNCIÓN DE ASEGURAR '+' Y DETECTAR PAÍS
    // Función para asegurar que el '+' esté presente y detectar el país
    function asegurarMasYDetectarPais1(input1) {
        // Verificar si el valor actual comienza con '+'
        if (!input1.value.startsWith('+')) {
            input1.value = '+' + input1.value.replace(/^\+/, ''); // Agregar '+' al inicio
        }

        // Permitir solo números después del '+' y mantener el '+'
        const validCharacters1 = input1.value.replace(/[^0-9]/g, ''); // Eliminar caracteres no válidos, excepto '+'
        input1.value = input1.value[0] + validCharacters1; // Mantener el '+' y agregar solo los números
        
        // Llamar a la función de detección de la bandera
        detectarPais1(input1);
    }

// TÍTULO: PARA LA INICIALIZACIÓN AL CARGAR LA PÁGINA
    // Asegúrate de que la bandera se actualice al cargar la página
    window.onload = function() {
        const campoTelefono1 = document.getElementById('cliente_fono');
        asegurarMasYDetectarPais1(campoTelefono1); // Llama a la función para asegurar "+" y detectar el país
    };

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Detalle cliente.JS ---------------------------------------
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