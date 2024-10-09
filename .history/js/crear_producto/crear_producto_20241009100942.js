
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



// Función para obtener las opciones del select
function loadSelectOptions(callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../../php/crear_producto/get_tipo_productos.php', true); // Ajusta la ruta si es necesario
    xhr.onload = function () {
        if (xhr.status === 200) {
            callback(xhr.responseText);
        } else {
            console.error("Error al cargar las opciones del select: " + xhr.statusText);
        }
    };
    xhr.send();
}

function addRow() {
    var table = document.getElementById('productos-table').getElementsByTagName('tbody')[0];
    var row = table.insertRow();

    // Cargar las opciones del select
    loadSelectOptions(function(selectOptions) {
        row.innerHTML = `
            <td><input type="text" name="nombre_producto[]" required></td>
            <td><textarea name="descripcion_producto[]" rows="4"></textarea></td>
            <td><input type="number" step="0.01" name="precio_producto[]" required></td>
            <td><input type="file" name="foto_producto[]" accept="image/*"></td>
            <td>
                <select name="id_tipo_producto[]" required>
                    ${selectOptions}
                </select>
            </td>
            <td><button type="button" onclick="removeRow(this)">Eliminar</button></td>
        `;
    });
}

function removeRow(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

// Inicializar el primer select al cargar la página
window.onload = function() {
    loadSelectOptions(function(selectOptions) {
        var firstSelect = document.querySelector('#productos-table tbody tr select');
        firstSelect.innerHTML = selectOptions;
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