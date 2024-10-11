<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard del Proveedor</title>
    <link rel="stylesheet" href="styles.css" />
    <script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-ABW9SJu54RvwoP3Fh25ZNsxLzJ5qc5AW6QAxL8eL+jg/b2C1MP0E1h1hs4e0I0e3mvz7eL5Z3dU3TP4vPeMxB3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <nav class="navbar">
    <ul class="navbar-menu">
        <li class="navbar-item">
            <a href="/quickhand/index.php" class="home-button">
                <i class="fas fa-home"></i> <!-- Ícono de casa -->
            </a>
        </li>
    </ul>
</nav>

    <header>
        <h1>Dashboard del Proveedor</h1>
        <p>Bienvenido, Luis Torres</p>
    </header>

    <?php
    // En index.php o donde desees mostrar el resumen
    include '../backend/ver_resumen_proveedor.php';
    ?>

    <section class="requests">
        <h2>Gestión de Solicitudes</h2>
        <div class="request-list" id="request-list">
            <?php
        // Incluir el archivo de conexión
        include '../backend/conexion.php';

        // Incluir el archivo que muestra los servicios
        include '../backend/ver_solicitudes.php';
        ?>
        </div>
    </section>

    <!-- Modal Popup para aceptar servicio -->
    <div id="acceptModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Aceptar solicitud de servicio</h2>
            <label for="service-date">Fecha disponible:</label>
            <input type="date" id="service-date" required />

            <label for="provider-comments">Comentarios adicionales:</label>
            <textarea id="provider-comments" placeholder="Añadir algún comentario opcional"></textarea>

            <button id="confirm-accept">Confirmar</button>
        </div>
    </div>

    <section class="calendar">
        <h2>Calendario / Disponibilidad</h2>
        <div id="calendar"></div>
    </section>

    <section class="profile">
        <h2>Perfil del Proveedor</h2>
        <?php include '../backend/ver_perfil_proveedor.php'; ?>
    </section>

    <!-- Sección de Servicios Vigentes -->
    <section class="services">
        <h2>Servicios Vigentes</h2>
        <div id="active-services">
            <?php
        // Incluir el archivo de conexión
        include '../backend/conexion.php';

        // Incluir el archivo que muestra los servicios
        include '../backend/ver_servicios.php';
        ?>
        </div>
        <button id="add-service-btn">Agregar Servicio</button>
    </section>

    <!-- Modal para agregar o editar servicios -->
    <div class="modal" id="service-form">
        <div class="modal-content">
            <span class="close" id="close-modal">&times;</span>
            <h3 id="service-form-title">Agregar Servicio</h3>
            <input type="hidden" id="edit-mode" value="false" />
            <label for="service-name">Nombre del Servicio</label>
            <input type="text" id="service-name" required />

            <label for="service-description">Descripción</label>
            <textarea id="service-description" required></textarea>

            <label for="service-location">Ubicación</label>
            <input type="text" id="service-location" required />

            <label for="service-price">Precio</label>
            <input type="text" id="service-price" required />

            <label for="service-categories">Categorías</label>
            <input type="text" id="service-categories" required />

            <label for="service-tags">Tags</label>
            <input type="text" id="service-tags" required />

            <button id="save-service">Guardar Servicio</button>
        </div>
    </div>

<!-- Modal para agregar un nuevo servicio -->
<div id="addServiceModal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-add-service-modal">&times;</span>
        <h2>Agregar Nuevo Servicio</h2>
        <form id="add-service-form">
            <label for="service-name">Nombre del Servicio</label>
            <input type="text" id="service-name" required />

            <label for="service-description">Descripción</label>
            <textarea id="service-description" required></textarea>

            <label for="service-images">Imágenes para la Galería</label>
            <input type="file" id="service-images" accept="image/*" multiple />

            <label for="service-location">Ubicación</label>
            <input type="text" id="service-location" required />

            <label for="service-price">Precio</label>
            <input type="number" id="service-price" required step="0.01" />

            <label for="service-category">Categorías</label>
            <input type="text" id="service-category" required placeholder="Categoría 1, Categoría 2" />

            <label for="service-tags">Tags del Servicio</label>
            <input type="text" id="service-tags" required placeholder="tag1, tag2, tag3" />

            <button type="submit">Guardar Servicio</button>
        </form>
    </div>
</div>


    <!-- Modal para editar un servicio -->
    <div id="editServiceModal" class="modal">
        <div class="modal-content">
            <span class="close" id="close-edit-service-modal">&times;</span>
            <h2>Editar Servicio</h2>
            <form id="edit-service-form">
                <label for="edit-service-name">Nombre del Servicio</label>
                <input type="text" id="edit-service-name" required />

                <label for="edit-service-description">Descripción</label>
                <textarea id="edit-service-description" required></textarea>

                <label for="edit-service-location">Ubicación</label>
                <input type="text" id="edit-service-location" required />

                <label for="edit-service-price">Precio</label>
                <input type="number" id="edit-service-price" required step="0.01" />

                <label for="edit-service-category">Categorías</label>
                <input type="text" id="edit-service-category" required placeholder="Categoría 1, Categoría 2" />

                <label for="edit-service-tags">Tags del Servicio</label>
                <input type="text" id="edit-service-tags" required placeholder="tag1, tag2, tag3" />

                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <section class="reviews">
        <h2>Reseñas y Valoraciones</h2>

        <div class="review-summary">
            <p><strong>Promedio de Valoraciones:</strong> ⭐ 5.0 (1)</p>

            <div class="feedback">
                <h4>Retroalimentación para el Proveedor</h4>
                <p>
                    ¡Gracias por ofrecer un servicio de calidad! Las valoraciones
                    reflejan la satisfacción de los clientes, pero hay oportunidades
                    para mejorar en la comunicación y la puntualidad. Continúa
                    trabajando en estos aspectos para seguir brindando un excelente
                    servicio.
                </p>
            </div>
        </div>

        <div id="review-list">
            <?php
        // Incluir el archivo de conexión
        include '../backend/conexion.php';

        // Incluir el archivo que muestra los servicios
        include '../backend/ver_resenas.php';
        ?>
        </div>
    </section>

    <script src="app.js"></script>
</body>

</html>