// Mostrar el Pop-Up al hacer clic en el botón de PayPal
document.addEventListener('DOMContentLoaded', () => {
    paypal.Buttons({
        createOrder: function(data, actions) {
            // Aquí iría la lógica de creación de la orden
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '10.00' // Ajusta según sea necesario
                    }
                }]
            }).then(function(orderId) {
                // Muestra el Pop-Up solo una vez
                document.getElementById('popup').style.display = 'flex';
                return orderId;
            });
        },
        onApprove: function(data, actions) {
            // Lógica para manejar el pago aprobado
            return actions.order.capture().then(function(details) {
                alert('Pago completado por: ' + details.payer.name.given_name);
                // Cerrar el Pop-Up después de un pago exitoso
                document.getElementById('popup').style.display = 'none';
            });
        },
        onError: function(err) {
            console.error(err); // Manejar errores
        }
    }).render('#paypal-button-container');

    // Cerrar el Pop-Up
    document.getElementById('close-popup').addEventListener('click', () => {
        document.getElementById('popup').style.display = 'none';
    });

    // Manejar el envío del formulario
    document.getElementById('payment-form').addEventListener('submit', (event) => {
        event.preventDefault();
        // Aquí podrías manejar los datos de la tarjeta de crédito
        const cardNumber = document.getElementById('card-number').value;
        const expiry = document.getElementById('expiry').value;
        const cvc = document.getElementById('cvc').value;

        // Lógica para procesar el pago (ej. enviar a tu servidor)
        console.log({ cardNumber, expiry, cvc });
        alert('Pago procesado con éxito con la tarjeta: ' + cardNumber);
        // Cerrar el Pop-Up
        document.getElementById('popup').style.display = 'none';
    });
});