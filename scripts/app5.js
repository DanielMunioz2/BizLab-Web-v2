function fetchFactura() {
    fetch('llamar_factura.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
    .then(response => response.json())
    .then(data => {
        data.forEach(factura => {
            const estadoElement = document.getElementById(`estado-${factura.id_Factura}`);
            if (estadoElement) {
                estadoElement.textContent = factura.estadoFactura;
            }
        });
    })
    .catch(err => console.error('Error al obtener facturas:', err));
}

function fetchUsuario() {
    fetch('llamar_usuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
    .then(response => response.json())
    .then(data => {
        data.forEach(user => {
            const estadoElement = document.getElementById(`estado-${user.id_usuario}`);
            if (estadoElement) {
                estadoElement.textContent = user.user_estado;
            }
        });
    })
    .catch(err => console.error('Error al obtener usuarios:', err));
}

setInterval(fetchFactura, 10000); 
setInterval(fetchUsuario, 10000);

document.addEventListener('DOMContentLoaded', function() {
    fetchFactura(); 
    fetchUsuario(); 
});
