document.addEventListener('DOMContentLoaded', function() {
    function loadTipoCuenta() {
        fetch('../../../php//get_tipo_cuenta/get_tipos_cuenta.php')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('id-tipocuenta');
                select.innerHTML = '<option value="">Seleccionar Tipo de Cuenta</option>'; // Opcional: valor predeterminado
                data.forEach(tipo => {
                    const option = document.createElement('option');
                    option.value = tipo.id_tipocuenta;
                    option.textContent = tipo.tipocuenta;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar tipo de cuenta:', error));
    }

    loadTipoCuenta();
});
