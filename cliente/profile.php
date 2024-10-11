<html>
  <head>
    <title>Profile</title>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="stylesProfileService.css" />
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar">
      <ul class="navbar-menu">
        <li class="navbar-item"><a href="/quickhand/index.php">Home</a></li>
      </ul>
    </nav>
    <div class="container">
        <div class="profile-card">
            <img
              id="profile-image"
              alt="Profile Image"
              height="100"
              src="https://storage.googleapis.com/a1aa/image/yrw9pH6b1mrHD5faGCjS0yyN1j37gl7EEzlaC79HKyHzWxyJA.jpg"
              width="100"
            />
            <h2 id="client-name">Ulises Chavez</h2>
            <p id="client-username">@ulicesC12</p>
            <div class="info">
              <p>
                <i class="fas fa-map-marker-alt"></i>
                <span id="client-location">Durango, Mexico</span>
              </p>
              <p>
                <i class="fas fa-calendar-alt"></i>
                Joined in October 2024
              </p>
              <p>
                <i class="fas fa-language"></i>
                <span id="client-languages">Español</span>
              </p>
              <p>
                <i class="fas fa-phone"></i>
                <span id="client-phone">+52 123 456 7890</span>
              </p>
            </div>
        
            <!-- Botón para editar el perfil -->
            <a class="button" id="edit-profile-button" href="#">
              <i class="fas fa-edit"></i>
              Edit Profile
            </a>
        
            <!-- Modal para editar información del cliente -->
            <div id="edit-modal" class="modal">
              <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Editar Perfil del Cliente</h2>
                <form id="edit-form">
                  <div class="form-group">
                    <label for="name">Nombre del Cliente:</label>
                    <input type="text" id="name" name="nombre_cliente" required />
                  </div>
                  <div class="form-group">
                    <label for="phone">Teléfono de Contacto:</label>
                    <input type="tel" id="phone" name="telefono_cliente" required />
                  </div>
                  <div class="form-group">
                    <label for="location">Ubicación del Cliente:</label>
                    <input type="text" id="location" name="ubicacion_cliente" required />
                  </div>
                  <div class="form-group">
                    <label for="languages">Idiomas Preferidos:</label>
                    <input type="text" id="languages" name="idiomas_preferidos" required />
                  </div>
                  <div class="form-group">
                    <label for="profile-image-input">Imagen de Perfil:</label>
                    <input
                      type="file"
                      id="profile-image-input"
                      name="imagen_perfil"
                      accept="image/*"
                      onchange="previewImage(event)"
                    />
                    <img
                      id="image-preview"
                      src=""
                      alt="Vista Previa"
                      style="display: none; margin-top: 10px; max-width: 100%; border-radius: 5px;"
                    />
                  </div>
                  <button type="submit">Guardar Cambios</button>
                </form>
              </div>
            </div>
          </div>
        

      <div class="orders">
        <h3>Servicios solicitados</h3>

        <div class="order-container">
          <div class="order">
            <div class="order-info">
              <p><strong>Servicio:</strong> Diseño de Logo</p>
              <p><strong>Proveedor:</strong> MikoDesign</p>
              <p>
                <strong>Comentarios:</strong> El proveedor fue muy puntual y
                entendió bien las necesidades del cliente.
              </p>
              <p><strong>Fecha del Pedido:</strong> 10/01/2024</p>
              <p><strong>Estado:</strong> Completado</p>
              <p><strong>Fecha de Servicio:</strong> 15/01/2024</p>
              <p><strong>Precio:</strong> $150</p>
            </div>
          </div>
        </div>

        <div class="order-container">
          <div class="order">
            <div class="order-info">
              <p><strong>Servicio:</strong> Desarrollo Web</p>
              <p><strong>Proveedor:</strong> WebCraft</p>
              <p>
                <strong>Comentarios:</strong> Excelente comunicación, aunque los
                tiempos fueron un poco largos.
              </p>
              <p><strong>Fecha del Pedido:</strong> 05/01/2024</p>
              <p><strong>Estado:</strong> En progreso</p>
              <p><strong>Fecha de Servicio:</strong> 20/01/2024</p>
              <p><strong>Precio:</strong> $500</p>
            </div>
          </div>
        </div>

        <!-- Contenedor para órdenes adicionales -->
        <div id="more-orders" style="display: none">
          <div class="order-container">
            <div class="order">
              <div class="order-info">
                <p><strong>Servicio:</strong> Rediseño de Página</p>
                <p><strong>Proveedor:</strong> CreativeLabs</p>
                <p>
                  <strong>Comentarios:</strong> Muy satisfecho con el trabajo
                  realizado.
                </p>
                <p><strong>Fecha del Pedido:</strong> 12/01/2024</p>
                <p><strong>Estado:</strong> Completado</p>
                <p><strong>Fecha de Servicio:</strong> 25/01/2024</p>
                <p><strong>Precio:</strong> $300</p>
              </div>
            </div>
          </div>

          <div class="order-container">
            <div class="order">
              <div class="order-info">
                <p><strong>Servicio:</strong> Marketing Digital</p>
                <p><strong>Proveedor:</strong> DigiSolutions</p>
                <p>
                  <strong>Comentarios:</strong> Resultados visibles en poco
                  tiempo.
                </p>
                <p><strong>Fecha del Pedido:</strong> 15/01/2024</p>
                <p><strong>Estado:</strong> En progreso</p>
                <p><strong>Fecha de Servicio:</strong> 30/01/2024</p>
                <p><strong>Precio:</strong> $400</p>
              </div>
            </div>
          </div>
        </div>

        <button id="toggle-orders" onclick="toggleOrders()" class="category">
          Ver más órdenes
        </button>
      </div>

      <div class="reviews">
        <h3>Suppliers' opinions</h3>
        <div class="rating">
          <i class="fas fa-star"> </i>
          <i class="fas fa-star"> </i>
          <i class="fas fa-star"> </i>
          <i class="fas fa-star"> </i>
          <i class="fas fa-star"> </i>
        </div>
        <p>ulicesC12 doesn't have any opinions yet.</p>
      </div>
    </div>
    <script src="scriptsProfile.js"></script>
  </body>
</html>
