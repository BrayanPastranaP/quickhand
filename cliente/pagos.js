paypal.Buttons({
    createOrder: async function(data, actions) {
        const response = await fetch('http://localhost:3000/create-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        if (!response.ok) {
            const errorMessage = await response.text(); // Obtener mensaje de error detallado
            throw new Error(`Error en la creación del pedido: ${errorMessage}`);
        }

        const orderData = await response.json();
        return orderData.id; // Retorna el ID del pedido
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            alert('Transacción completada por ' + details.payer.name.given_name);
        });
    },
    onError: function(err) {
        console.error('Error durante el proceso de pago', err);
        alert('Ocurrió un error en el proceso de pago. Por favor, inténtalo de nuevo.');
    }
}).render('#paypal-button-container');
