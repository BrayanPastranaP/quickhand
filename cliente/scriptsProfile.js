function toggleOrders() {
    const moreOrders = document.getElementById('more-orders');
    const toggleButton = document.getElementById('toggle-orders');
    
    // Verificar si las órdenes están visibles
    if (moreOrders.style.display === 'none') {
        moreOrders.style.display = 'block'; // Muestra las órdenes adicionales
        toggleButton.innerText = 'Ocultar órdenes'; // Cambia el texto del botón
    } else {
        moreOrders.style.display = 'none'; // Oculta las órdenes
        toggleButton.innerText = 'Ver más órdenes'; // Cambia el texto del botón
    }
}

// Abrir el modal
document.getElementById('edit-profile-button').onclick = function() {
    // Llenar los campos del modal con la información actual
    document.getElementById('name').value = document.getElementById('client-name').textContent;
    document.getElementById('phone').value = document.getElementById('client-phone').textContent;
    document.getElementById('location').value = document.getElementById('client-location').textContent;
    document.getElementById('languages').value = document.getElementById('client-languages').textContent;

    document.getElementById('edit-modal').style.display = 'block';
}

// Cerrar el modal
function closeModal() {
    document.getElementById('edit-modal').style.display = 'none';
    // Limpiar la vista previa de la imagen al cerrar
    document.getElementById('image-preview').style.display = 'none';
    document.getElementById('image-preview').src = '';
}

// Cerrar el modal al hacer clic fuera del contenido del modal
window.onclick = function(event) {
    const modal = document.getElementById('edit-modal');
    if (event.target === modal) {
        closeModal();
    }
}

// Manejar el envío del formulario
document.getElementById('edit-form').onsubmit = function(event) {
    event.preventDefault(); // Evitar el envío por defecto

    // Obtener los valores de los campos del formulario
    const name = document.getElementById('name').value;
    const phone = document.getElementById('phone').value;
    const location = document.getElementById('location').value;
    const languages = document.getElementById('languages').value;

    // Actualizar la información en la sección del usuario
    document.getElementById('client-name').textContent = name;
    document.getElementById('client-phone').textContent = phone;
    document.getElementById('client-location').textContent = location;
    document.getElementById('client-languages').textContent = languages;

    // Cambiar la imagen de perfil si se ha seleccionado una nueva
    const imageInput = document.getElementById('profile-image-input');
    if (imageInput.files.length > 0) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profile-image').src = e.target.result; // Establecer la nueva imagen de perfil
        }
        reader.readAsDataURL(imageInput.files[0]); // Leer el archivo como URL de datos
    }

    alert("Cambios guardados."); // Mensaje de confirmación
    closeModal(); // Cerrar el modal después de guardar
}

// Previsualizar la imagen seleccionada
function previewImage(event) {
    const imagePreview = document.getElementById('image-preview');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result; // Establecer la fuente de la imagen de vista previa
            imagePreview.style.display = 'block'; // Mostrar la vista previa
        }
        reader.readAsDataURL(file); // Leer el archivo como URL de datos
    }
}

