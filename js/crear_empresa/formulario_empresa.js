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
    -------------------------------------- Inicio ITred Spa Formulario Empresa .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// TÍTULO PARA DOCUMENT.ADD_EVENT_LISTENER('DOMCONTENTLOADED')
    // Función que se ejecuta cuando el contenido del DOM ha sido completamente cargado
    document.addEventListener('DOMContentLoaded', () => {
        // Establece el valor del campo 'fecha_creacion' a la fecha actual en formato ISO (YYYY-MM-DD)
        document.getElementById('fecha_creacion').value = new Date().toISOString().split('T')[0];
    });

// TÍTULO PARA VALIDAR EL NOMBRE DE LA EMPRESA
    // Evento para validar el nombre de la empresa al introducir texto
    document.getElementById('empresa_nombre').addEventListener('input', function () {
        const input = this;
        // Elimina caracteres no válidos (solo permite letras, números y algunos caracteres especiales)
        input.value = input.value.replace(/[^A-Za-zÀ-ÿ0-9\s&.-]/g, '');
    });

// TÍTULO PARA VALIDAR EL ÁREA DE LA EMPRESA
    // Evento para validar el área de la empresa al introducir texto
    document.getElementById('empresa_area').addEventListener('input', function () {
        const input = this;
        // Elimina caracteres no válidos (solo permite letras y algunos caracteres especiales)
        input.value = input.value.replace(/[^A-Za-zÀ-ÿ\s&.-]/g, '');
    });

// TÍTULO PARA VALIDAR LA DIRECCIÓN DE LA EMPRESA
    // Evento para validar la dirección de la empresa al introducir texto
    document.getElementById('empresa_direccion').addEventListener('input', function () {
        const input = this;
        // Elimina caracteres no válidos (solo permite letras, números y algunos caracteres especiales)
        input.value = input.value.replace(/[^A-Za-z0-9À-ÿ\s#,-.]/g, '');
    });

// TÍTULO PARA BANDERASPAIS2
    // Objeto que asocia códigos de país de América con imágenes de banderas
    const banderasPais2 = {
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

// TÍTULO PARA BANDERA POR DEFECTO 2
    // Imagen de bandera por defecto cuando no coincide con ningún código
    const banderaPorDefecto2 = "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/World_Flag_%282004%29.svg/640px-World_Flag_%282004%29.svg.png"; // Bandera por defecto

// TÍTULO PARA DETECTARPAIS2
    // Función para detectar el país según el número de teléfono ingresado
    function detectarPais2(input) {
        const numeroTelefono2 = input.value.trim(); // Asegúrate de eliminar espacios
        const imagenBandera2 = document.getElementById("flag_encargado"); // Asegúrate de tener la imagen con este ID
        
        // Itera sobre los códigos de país para detectar el correcto
        for (const codigo in banderasPais2) {
            if (numeroTelefono2.startsWith(codigo)) {
                imagenBandera2.src = banderasPais2[codigo]; // Asigna la imagen de la bandera correspondiente
                imagenBandera2.style.display = "inline"; // Mostrar la imagen de la bandera
                return; // Detener la función si se encuentra el país
            }
        }
        // Si no se encuentra un código de país coincidente, muestra la bandera por defecto
        imagenBandera2.src = banderaPorDefecto2; // Asigna la imagen de la bandera por defecto
        imagenBandera2.style.display = "inline"; // Mostrar la imagen de la bandera por defecto
    }

// TÍTULO PARA ASEGURA MAS Y DETECTAR PAIS 6
    // Función para asegurar que el '+' esté presente y detectar el país
    function asegurarMasYDetectarPais6(input) {
        // Verificar si el valor actual comienza con '+'
        if (!input.value.startsWith('+')) {
            input.value = '+' + input.value.replace(/^\+/, ''); // Agregar '+' al inicio si no está presente
        }
        
        // Permitir solo números después del '+' y mantener el '+'
        const validCharacters = input.value.replace(/[^0-9]/g, ''); // Eliminar caracteres no válidos, excepto '+'
        input.value = input.value[0] + validCharacters; // Mantener el '+' y agregar solo los números
    }

// TÍTULO PARA WINDOW.ONLOAD
    // Asegúrate de que la bandera se actualice al cargar la página
    window.onload = function() {
        const campoTelefono2 = document.getElementById('enc-fono'); // Obtén el campo de entrada del teléfono
        asegurarMasYDetectarPais6(campoTelefono2); // Llama a la función para asegurar "+" y detectar el país
    };

// TÍTULO PARA COMPLETAR EMAIL
    // Función para completar el correo electrónico automáticamente
    function CompletarEmail(input) {
        // Eliminar comillas simples y dobles de la entrada
        input.value = input.value.replace(/['"]/g, '');

        // Patrón de expresión regular para validar el correo electrónico
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
        
        // Verifica si el correo electrónico tiene un formato válido
        if (!emailPattern.test(input.value)) {
            // Comprueba si el valor no contiene '@'
            if (!input.value.includes('@')) {
                // Añadir '@gmail.com' si no se ingresó un dominio
                input.value += '@gmail.com'; 
            } else {
                alert("Por favor, ingresa un correo electrónico válido."); // Mensaje de error si no es válido
            }
        }
    }

// TÍTULO PARA QUITAR CARACTERES INVALIDOS
    // Función para quitar caracteres inválidos de la entrada
    function QuitarCaracteresInvalidos(input) {
        // Eliminar comillas simples, dobles y cualquier otro carácter no deseado
        input.value = input.value.replace(/['"]/g, '');
    }

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Formulario Empresa .JS ---------------------------------------
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