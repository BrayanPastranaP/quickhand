<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Service</title>

 <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-ABW9SJu54RvwoP3Fh25ZNsxLzJ5qc5AW6QAxL8eL+jg/b2C1MP0E1h1hs4e0I0e3mvz7eL5Z3dU3TP4vPeMxB3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <link rel="stylesheet" href="stylesProfileService.css">
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



 <?php
include '../backend/conexion.php'; // Conexión a la base de datos

// Obtener el ID del servicio de la URL
$serviceId = isset($_GET['serviceId']) ? intval($_GET['serviceId']) : null;

if ($serviceId) {
  // Incluir el archivo del backend para obtener los datos del servicio
  include '../backend/ver_servicioCliente.php'; 

  // Verificar si se obtuvieron los datos del servicio
  if (isset($service)) {
    ?>

    <div class="container">
    <!-- Titulo del servicio (header) -->
      <div class="header">
        <h1><?php echo htmlspecialchars($service['descripcion']); ?></h1>
      </div>
      <!-- Breve descripcion del servicio-->


      <!-- Galería de imágenes -->
<div class="gallery"></div>

<div class="slider-container">
  <div class="main-image">
    <img
      alt="Main design showcase image"
      height="400"
      src=""
      id="current-image"
    />
    <div class="overlay">
      <i class="fas fa-chevron-left arrow-left"></i>
      <i class="fas fa-chevron-right arrow-right"></i>
    </div>
  </div>
  <div class="review" id="current-review">
    <div class="review-text"></div>
    <div class="reviewer"></div>
  </div>
  <div class="thumbnails"></div>
</div>



<!-- Reviews (cuando se crea la pagina del servicio están vacías) -->
<div class="review-slider">
    <?php if (!empty($service['reseñas'])): ?>
        <?php foreach ($service['reseñas'] as $review): ?>
            <div class="review">
                <p>"<?php echo htmlspecialchars($review['comentarios']); ?>"</p>
                <div class="reviewer">
                    <img
                        alt="Profile picture of the reviewer"
                        height="50"
                        src="https://storage.googleapis.com/a1aa/image/HdQGHVUG3FYJAdQkqueQnRJNaiGk1xs2eNkQ8WKWdHfQl9KnA.jpg" 
                        width="50"
                    />
                    <div>
                        <p>Valorado por <?php echo htmlspecialchars($review['cliente_nombre']); ?> <?php echo htmlspecialchars($review['fecha']); ?></p>
                        <div class="rating">
                            <?php 
                            // Asumiendo que la calificación es un número del 1 al 5
                            for ($i = 1; $i <= 5; $i++): 
                                if ($i <= $review['calificacion']): ?>
                                    <i class="fas fa-star"></i>
                                <?php else: ?>
                                    <i class="far fa-star"></i>
                                <?php endif; 
                            endfor; ?>
                            <span><?php echo htmlspecialchars($review['calificacion']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay más reseñas disponibles para este servicio.</p>
    <?php endif; ?>
    
    <div class="navigation-buttons">
        <button id="prev"><i class="fas fa-chevron-left"></i></button>
        <button id="next"><i class="fas fa-chevron-right"></i></button>
    </div>
    <button id="toggle-reviews" class="category">Mostrar/ocultar comentarios</button>
</div>

<div class="comments-list" id="comments-list">
    <?php if (!empty($service['reseñas'])): ?>
        <?php foreach ($service['reseñas'] as $review): ?>
            <div class="review">
                <p>"<?php echo htmlspecialchars($review['comentarios']); ?>"</p>
                <div class="reviewer">
                    <img
                        alt="Profile picture of the reviewer"
                        height="50"
                        src="https://storage.googleapis.com/a1aa/image/HdQGHVUG3FYJAdQkqueQnRJNaiGk1xs2eNkQ8WKWdHfQl9KnA.jpg" <!-- Puedes cambiar esta URL si tienes un sistema para manejar imágenes de perfil -->
                        width="50"
                    />
                    <div>
                        <p>Reviewed by <?php echo htmlspecialchars($review['cliente_nombre']); ?> <?php echo htmlspecialchars($review['fecha']); ?></p>
                        <div class="rating">
                            <?php 
                            // Asumiendo que la calificación es un número del 1 al 5
                            for ($i = 1; $i <= 5; $i++): 
                                if ($i <= $review['calificacion']): ?>
                                    <i class="fas fa-star"></i>
                                <?php else: ?>
                                    <i class="far fa-star"></i>
                                <?php endif; 
                            endfor; ?>
                            <span><?php echo htmlspecialchars($review['calificacion']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay más reseñas disponibles para este servicio.</p>
    <?php endif; ?>
</div>


      <!-- Si el provvedor del servicio indico una ubicacasion esta se vera en esta seccion-->

      <div>
        <h2>Ubicación</h2>
      </div>
      <div id="map" style="height: 400px; width: 100%"></div>


      <!-- Aqui nuevamente se despliega el ombre del servicio y su precio -->

      <div class="package">
  <h3>Solicitar servicio</h3>
  <p><?php echo htmlspecialchars($service['descripcion']); ?></p>

  <div class="price">$120</div>
  <a class="button" id="request-service-button" href="#">Solicitar</a>
</div>

<!-- Modal para confirmar servicio -->
<div id="service-modal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeServiceModal()">&times;</span>
    <h2>Confirmar Servicio</h2>
    <form id="service-form">
      <div class="form-group">
        <label for="comment">Comentario:</label>
        <textarea id="comment" name="comentario" placeholder="Escribe tu comentario..." required></textarea>
      </div>
      <div class="form-group">
        <label for="service-location">Ubicación del Servicio:</label>
        <input type="text" id="service-location" name="ubicacion_servicio" placeholder="Ingrese la ubicación si es necesario..." />
      </div>
      <button type="submit">Confirmar Servicio</button>
    </form>
  </div>
</div>


<div id="popup" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
  <div style="background:white; padding:20px; border-radius:10px; width:300px; text-align:center;">
    <h3>Procesar Pago</h3>
    <!-- Aquí se insertará el botón de PayPal -->
    <div id="paypal-button-container"></div>
    <button id="close-popup">Cerrar</button>
  </div>
</div>

      <!-- Aqui se colocan las categorias -->

      <div class="categories-container" id="categories-container">
  <h2>Categorías</h2>
  <div id="categories-list"></div>
</div>

<div class="tags-container" id="tags-container">
  <h2>Etiquetas</h2>
  <div id="tags-list"></div>
</div>


      <!-- Aqui se desplegara informacion del proveedor-->

      <div class="profile-header">
        <img
          alt="Profile picture of Miko"
          height="80"
          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpBaqzoCWFdeJQIjXBn9UbR4CLb8959fqUZA&s"
          width="80"
        />
        <div class="profile-info">
          <h1><?php echo htmlspecialchars($service['proveedor_nombre']); ?></h1>
          <p><?php echo htmlspecialchars($service['descripcion_proveedor']); ?></p>
          <div class="rating">
            <i class="fas fa-star"> </i>
            <span class="rating-value"> 4.9 (1,459) </span>
            <span class="top-rated">Mejor valorado ★★★ </span>
          </div>
        </div>
      </div>
      <div class="profile-details">
        <p class="expert-in">Experto en:</p>
        <p>
          <i class="fas fa-check-circle"> </i>
          <?php echo htmlspecialchars($service['areas_expertise']); ?>
        </p>
      </div>
      <div class="profile-stats">
        <div>
          <p>Origen</p>
          <p><?php echo htmlspecialchars($service['ubicacion_trabajo']); ?></p>
        </div>
        <div>
          <p>Miembro desde</p>
          <p>Sep 2024</p>
        </div>
        <div>
          <p>Tiempo de respuesta promedio</p>
          <p>2 horas</p>
        </div>
        <div>
          <p>Idiomas</p>
          <p>Español</p>
        </div>
      </div>
      <h2>Biografía</h2>
  <div class="profile-bio" id="profile-bio">
    <!-- Aquí se cargará la biografía -->
  </div>



      <!-- Aqui se desplagaran los posibles otros servicios que tenga el proveedor-->
      
      <div class="portfolio">
  <h2>Otros servicios</h2>
  <div class="portfolio-item" id="portfolio-item">
    <img
      id="main-image"
      alt="Main Portfolio Image"
      height="200"
      src=""
      width="200"
    />
    <div class="portfolio-item-content">
      <h2 id="item-title"></h2>
      <p id="item-description"></p>
      <div class="tag" id="item-tag"></div>
    </div>
  </div>
  <div class="portfolio-thumbnails"></div>
</div>

      <div class="contact">
        <a class="button" href="#"> Contáctame </a>
      </div>
    </div>


    <?php
  } else {
    echo '<p>No se encontró información para el servicio.</p>';
  }
} else {
  echo '<p>ID de servicio no proporcionado.</p>';
}
?>

    <script>
      // Inicializa el mapa con una vista inicial
      var map = L.map("map").setView([24.0223, -104.6700], 13);

      // Utiliza los tiles oscuros de CartoDB
      L.tileLayer(
        "https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png",
        {
          attribution:
            '&copy; <a href="https://carto.com/">CartoDB</a> contributors',
          maxZoom: 19,
        }
      ).addTo(map);

      // Añade un marcador en la posición inicial
      L.marker([24.0223, -104.6700])
        .addTo(map)
        .bindPopup("Donde puedes encontrarme")
        .openPopup();
    </script>

    <script>
      function changePortfolioItem(imageUrl, title, description) {
        document.getElementById("main-image").src = imageUrl;
        document.getElementById("item-title").textContent = title;
        document.getElementById("item-description").textContent = description;
      }
    </script>

<script src="scriptsService.js"></script>

  </body>
</html>
