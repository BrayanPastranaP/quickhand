document.addEventListener("DOMContentLoaded", () => {
    // Elementos del DOM
    const requests = document.querySelectorAll('.request-item');
    const modal = document.getElementById('acceptModal');
    const calendarEl = document.getElementById('calendar');
    const closeModal = document.querySelector('.close');
    const confirmAcceptButton = document.getElementById('confirm-accept');

    // Modales de servicios
    const addServiceModal = document.getElementById("addServiceModal");
    const editServiceModal = document.getElementById("editServiceModal");
    const closeAddServiceModal = document.getElementById("close-add-service-modal");
    const closeEditServiceModal = document.getElementById("close-edit-service-modal");
    const addServiceButton = document.getElementById("add-service-btn"); // Botón para abrir el modal de agregar
    const editServiceButtons = document.querySelectorAll(".edit"); // Botones para editar servicios

    let currentRequest = null; // Variable para almacenar la solicitud actual


    fetch('../backend/obtener_trabajos.php')
        .then(response => response.json())
        .then(reservedJobs => {
            console.log(reservedJobs)
            // Inicialización del calendario
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // Vista inicial
                events: reservedJobs, // Pasar los eventos reservados
                height: 500,
                expandRows: true,
                eventClick: function (info) {
                    Swal.fire(info.event.title + ': ' + info.event.extendedProps.description); // Mostrar descripción al hacer clic
                }
            });
            calendar.render(); // Renderizar el calendario
        })
        .catch(error => console.error('Error fetching jobs:', error));

    // Event Listeners
    closeModal.addEventListener('click', closeAcceptModal);
    window.addEventListener('click', handleOutsideClick);
    confirmAcceptButton.addEventListener('click', confirmAccept);

    closeAddServiceModal.addEventListener('click', () => addServiceModal.style.display = "none");
    closeEditServiceModal.addEventListener('click', () => editServiceModal.style.display = "none");

    // Configuración de solicitudes
    requests.forEach(request => {
        const acceptButton = request.querySelector('.accept');
        const rejectButton = request.querySelector('.reject');
        const statusLabel = request.querySelector('.status');
        const completeButton = request.querySelector('.complete');

        acceptButton.addEventListener('click', () => openAcceptModal(request));
        rejectButton.addEventListener('click', () => rejectRequest(request, statusLabel));
        completeButton.addEventListener('click', () => markAsCompleted(statusLabel, completeButton));
    });

    // Manejar el formulario de agregar servicio
    document.getElementById('add-service-form').addEventListener('submit', handleAddService);
    // Manejar el formulario de editar servicio
    document.getElementById('edit-service-form').addEventListener('submit', handleEditService);

    // Eventos para eliminar y editar servicios
    setupServiceEditAndDeleteButtons();

    // Funciones
    function closeAcceptModal() {
        modal.style.display = "none";
        resetModal();
    }

    function handleOutsideClick(event) {
        if (event.target === modal) {
            closeAcceptModal();
        }
        if (event.target === addServiceModal) {
            addServiceModal.style.display = "none";
        }
        if (event.target === editServiceModal) {
            editServiceModal.style.display = "none";
        }
    }

    function openAcceptModal(request) {
        currentRequest = request; // Guardar la solicitud actual seleccionada
        modal.style.display = "block"; // Mostrar el modal
    }

    function rejectRequest(request, statusLabel) {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "No podrás revertir esto.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, rechazarla",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma la acción:
                Swal.fire({
                    title: "Rechazada",
                    text: "La solicitud ha sido rechazada.",
                    icon: "success"
                });

                // Actualizar el estado de la solicitud
                statusLabel.textContent = 'Rechazada';
                updateStatusLabel(statusLabel, 'rejected');
                disableButtons(request);
            }
        });
    }

    function markAsCompleted(statusLabel, completeButton) {
        Swal.fire({
            title: "Marcar como completada",
            text: "¿Estás seguro de que deseas marcar esta solicitud como completada?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, completada",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma la acción
                Swal.fire({
                    title: "Completada",
                    text: "Has marcado la solicitud como completada.",
                    icon: "success"
                });

                // Actualizar el estado de la solicitud
                statusLabel.textContent = 'Completada';
                statusLabel.classList.remove('accepted');
                statusLabel.classList.add('completed');

                // Deshabilitar el botón de completar
                completeButton.disabled = true;
                completeButton.style.opacity = '0.5';
            }
        });
    }

    function confirmAccept() {
        if (!currentRequest) return; // Verificar que haya una solicitud seleccionada

        const selectedDate = document.getElementById('service-date').value;
        const comments = document.getElementById('provider-comments').value;
        const statusLabel = currentRequest.querySelector('.status');
        const completeButton = currentRequest.querySelector('.complete');

        if (!selectedDate) {
            Swal.fire({
                icon: 'warning',
                title: 'Fecha no seleccionada',
                text: 'Por favor, selecciona una fecha disponible.',
            });
            return;
        }

        Swal.fire({
            title: "Confirmar Aceptación",
            html: `<p>Has aceptado la solicitud para el <strong>${selectedDate}</strong>.</p>
                   <p>Comentarios adicionales: ${comments || 'Ninguno'}</p>`,
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar solicitud",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Solicitud Aceptada",
                    text: `La solicitud ha sido aceptada para el ${selectedDate}.`,
                    icon: "success"
                });

                // Actualizar el estado de la solicitud actual
                statusLabel.textContent = 'Aceptada';
                updateStatusLabel(statusLabel, 'accepted');
                completeButton.style.display = 'inline-block'; // Mostrar botón "Marcar como completada"
                disableButtonsExceptComplete(currentRequest);
                addSelectedDateToRequest(currentRequest, selectedDate);

                closeAcceptModal(); // Cerrar el modal
            }
        });
    }


    function updateStatusLabel(statusLabel, newClass) {
        statusLabel.classList.remove('pending', 'rejected', 'more-info');
        statusLabel.classList.add(newClass);
    }

    function addSelectedDateToRequest(request, date) {
        const existingDate = request.querySelector('.selected-date');
        if (existingDate) {
            existingDate.textContent = `Fecha de servicio: ${date}`;
        } else {
            const dateElement = document.createElement('p');
            dateElement.classList.add('selected-date');
            dateElement.textContent = `Fecha de servicio: ${date}`;
            const buttonsContainer = request.querySelector('.buttons-container');
            request.insertBefore(dateElement, buttonsContainer);
        }
    }

    function disableButtonsExceptComplete(request) {
        const buttons = request.querySelectorAll('button:not(.complete)');
        buttons.forEach(button => {
            button.disabled = true;
            button.style.opacity = '0.5';
        });
    }

    function disableButtons(request) {
        const buttons = request.querySelectorAll('button');
        buttons.forEach(button => {
            button.disabled = true;
            button.style.opacity = '0.5';
        });
    }

    function resetModal() {
        document.getElementById('service-date').value = '';
        document.getElementById('provider-comments').value = '';
    }

    function handleAddService(event) {
        event.preventDefault();
    
        // Obtener el modal del formulario
        const addServiceModal = document.getElementById('add-service-form');
    
        // Obtener los campos del formulario dentro del modal
        const serviceName = addServiceModal.querySelector('#service-name').value;
        const serviceDescription = addServiceModal.querySelector('#service-description').value;
        const serviceLocation = addServiceModal.querySelector('#service-location').value;
        const servicePrice = parseFloat(addServiceModal.querySelector('#service-price').value);
        const serviceCategories = addServiceModal.querySelector('#service-category').value;
        const serviceTags = addServiceModal.querySelector('#service-tags').value;
    
        // Crear un objeto FormData
        const formData = new FormData();
        formData.append('service-name', serviceName);
        formData.append('service-description', serviceDescription);
        formData.append('service-location', serviceLocation);
        formData.append('service-price', servicePrice);
        formData.append('service-categories', serviceCategories);
        formData.append('service-tags', serviceTags);
    
        console.log(formData);
    
        // Validar los campos antes de enviar
        if (!serviceName || !serviceDescription || !serviceLocation || isNaN(servicePrice) || !serviceCategories || !serviceTags) {
            alert("Por favor completa todos los campos.");
            return;
        }
    
        // Enviar la solicitud al servidor
        fetch('../backend/agregar_servicio.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                // Aquí puedes cerrar el modal y limpiar los campos si lo deseas
                addServiceModal.style.display = "none"; // Cerrar el modal
                addServiceModal.reset(); // Reiniciar el formulario
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }    

    function handleEditService(event) {
        event.preventDefault();
        const editedService = {
            name: document.getElementById('edit-service-name').value,
            description: document.getElementById('edit-service-description').value,
            location: document.getElementById('edit-service-location').value,
            price: document.getElementById('edit-service-price').value,
            category: document.getElementById('edit-service-category').value,
            tags: document.getElementById('edit-service-tags').value.split(',').map(tag => tag.trim()),
        };

        console.log('Servicio Editado:', editedService);
        editServiceModal.style.display = "none"; // Cerrar el modal
        document.getElementById('edit-service-form').reset(); // Reiniciar el formulario
    }

    function setupServiceEditAndDeleteButtons() {
        const deleteButtons = document.querySelectorAll('.delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const serviceItem = event.target.closest('.service-item');
                const serviceName = serviceItem.querySelector('h3').textContent;

                Swal.fire({
                    title: `¿Estás seguro de que deseas eliminar "${serviceName}"?`,
                    text: "Esta acción no se puede deshacer.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        serviceItem.remove();
                        Swal.fire({
                            title: "Eliminado",
                            text: `"${serviceName}" ha sido eliminado.`,
                            icon: "success"
                        });
                    }
                });
            });
        });

        // Configuración de eventos para botones de editar servicio
        editServiceButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                console.log('click'); // Confirmar que el botón fue clicado

                const serviceItem = event.target.closest('.service-item'); // Obtener el elemento del servicio
                const serviceName = serviceItem.querySelector('h3').textContent; // Obtener nombre del servicio
                const serviceDescription = serviceItem.querySelector('p').textContent.split(': ')[1]; // Obtener descripción
                const serviceLocation = serviceItem.querySelectorAll('p')[1].textContent.split(': ')[1]; // Obtener ubicación
                const servicePrice = serviceItem.querySelectorAll('p')[2].textContent.split(': ')[1]; // Obtener precio
                const serviceCategory = serviceItem.querySelectorAll('p')[3].textContent.split(': ')[1]; // Obtener categorías
                const serviceTags = serviceItem.querySelectorAll('p')[4].textContent.split(': ')[1]; // Obtener tags

                // Rellenar los campos del modal de edición
                document.getElementById('edit-service-name').value = serviceName;
                document.getElementById('edit-service-description').value = serviceDescription;
                document.getElementById('edit-service-location').value = serviceLocation;
                document.getElementById('edit-service-price').value = servicePrice;
                document.getElementById('edit-service-category').value = serviceCategory;
                document.getElementById('edit-service-tags').value = serviceTags;

                editServiceModal.style.display = "block"; // Mostrar modal de edición
            });
        });
    }

    // Mostrar el modal de agregar servicio al hacer clic
    addServiceButton.addEventListener('click', () => {
        addServiceModal.style.display = "block";
    });
});