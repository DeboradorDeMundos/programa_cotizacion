
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
    -------------------------------------- Inicio ITred Spa Crear Producto .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// TÍTULO: PARA LA FUNCIÓN DE CARGA DE OPCIONES DEL SELECT
    // Función para obtener las opciones del select desde el servidor
    function loadSelectOptions(callback) {
        var xhr = new XMLHttpRequest(); // Crea un nuevo objeto XMLHttpRequest
        xhr.open('GET', '../../php/crear_producto/get_tipo_productos.php', true); // Configura la solicitud GET
        xhr.onload = function () {
            if (xhr.status === 200) {
                callback(xhr.responseText); // Llama a la función callback con la respuesta del servidor
            } else {
                console.error("Error al cargar las opciones del select: " + xhr.statusText); // Muestra un error en la consola si la carga falla
            }
        };
        xhr.send(); // Envía la solicitud al servidor
    }

// TÍTULO: PARA LA FUNCIÓN DE AGREGAR UNA NUEVA FILA
    // Función para agregar una nueva fila a la tabla de productos
    function addRow() {
        var table = document.getElementById('productos-table').getElementsByTagName('tbody')[0]; // Obtiene el cuerpo de la tabla
        var row = table.insertRow(); // Inserta una nueva fila en el cuerpo de la tabla

        // Cargar las opciones del select
        loadSelectOptions(function(selectOptions) {
            row.innerHTML = ` // Establece el contenido HTML de la nueva fila
                <td><input type="text" name="nombre_producto[]" required></td>
                <td><textarea name="descripcion_producto[]" rows="4"></textarea></td>
                <td><input type="number" step="0.01" name="precio_producto[]" required></td>
                <td><input type="file" name="foto_producto[]" accept="image/*"></td>
                <td>
                    <select name="id_tipo_producto[]" required>
                        ${selectOptions} // Inserta las opciones del select obtenidas del servidor
                    </select>
                </td>
                <td><button type="button" onclick="removeRow(this)">Eliminar</button></td>
            `;
        });
    }

// TÍTULO: PARA LA FUNCIÓN DE ELIMINAR UNA FILA
    // Función para eliminar una fila de la tabla
    function removeRow(button) {
        var row = button.parentNode.parentNode; // Obtiene la fila correspondiente al botón presionado
        row.parentNode.removeChild(row); // Elimina la fila del DOM
    }

// TÍTULO: PARA LA INICIALIZACIÓN DEL PRIMER SELECT AL CARGAR LA PÁGINA
    // Inicializar el primer select al cargar la página
    window.onload = function() {
        loadSelectOptions(function(selectOptions) {
            var firstSelect = document.querySelector('#productos-table tbody tr select'); // Selecciona el primer select en la tabla
            firstSelect.innerHTML = selectOptions; // Inserta las opciones del select obtenidas del servidor
        });
    };
    
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Crear Producto .JS ---------------------------------------
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