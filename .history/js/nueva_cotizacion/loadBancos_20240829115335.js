
document.addEventListener('DOMContentLoaded', function() {
    // Función para llenar el select de bancos
    function loadBancos() {
        fetch('../../../php/c/get_bancos.php')
            .then(response => response.json({}))
            .then(data => {
                const select = document.getElementById('id-banco');
                select.innerHTML = '<option value="">Seleccionar Banco</option>'; // Opcional: valor predeterminado
                data.forEach(banco => {
                    const option = document.createElement('option');
                    option.value = banco.id_banco;
                    option.textContent = banco.nombre_banco;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar bancos:', error));
    }
    // Cargar bancos y tipo de cuenta al cargar la página
    loadBancos();
});

