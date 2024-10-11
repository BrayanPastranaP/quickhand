


document.addEventListener('DOMContentLoaded', () => {
    const thumbnails = document.querySelectorAll('.thumbnail');
    const currentImage = document.getElementById('current-image');
    const currentReview = document.getElementById('current-review');
    const leftArrow = document.querySelector('.arrow-left');
    const rightArrow = document.querySelector('.arrow-right');
  
    let currentIndex = 0; // Índice de la imagen actual
  
    // Función para cambiar la imagen y la reseña
    function updateSlider(index) {
      // Manejo de índice infinito
      if (index < 0) {
        currentIndex = thumbnails.length - 1; // Regresar al último
      } else if (index >= thumbnails.length) {
        currentIndex = 0; // Regresar al primero
      } else {
        currentIndex = index;
      }
  
      const selectedThumbnail = thumbnails[currentIndex];
      currentImage.src = selectedThumbnail.src;
      currentReview.innerHTML = selectedThumbnail.getAttribute('data-review');
  
      // Actualizar clases activas
      thumbnails.forEach((thumb, i) => {
        thumb.classList.toggle('active', i === currentIndex);
      });
    }
  
    // Manejar clic en miniaturas
    thumbnails.forEach((thumbnail, index) => {
      thumbnail.addEventListener('click', () => {
        updateSlider(index);
      });
    });
  
    // Manejar clic en flechas
    leftArrow.addEventListener('click', () => {
      updateSlider(currentIndex - 1); // Disminuir índice
    });
  
    rightArrow.addEventListener('click', () => {
      updateSlider(currentIndex + 1); // Aumentar índice
    });
  
    // Inicializar slider
    updateSlider(currentIndex);
  });
  
  

  document.addEventListener('DOMContentLoaded', () => {
    const reviews = document.querySelectorAll('.review-slider .review');
    let currentIndex = 0;

    function showReview(index) {
      reviews.forEach((review, i) => {
        review.style.display = i === index ? 'block' : 'none';
      });
    }

    document.getElementById('prev').addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + reviews.length) % reviews.length; // Cambio cíclico
      showReview(currentIndex);
    });

    document.getElementById('next').addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % reviews.length; // Cambio cíclico
      showReview(currentIndex);
    });

    // Inicializar el primer review
    showReview(currentIndex);

  });

  document.getElementById('toggle-reviews').addEventListener('click', function() {
    const commentsList = document.getElementById('comments-list');
    commentsList.classList.toggle('hidden'); // Alterna la clase 'hidden'

    // Cambiar el texto del botón dependiendo del estado
    if (commentsList.classList.contains('hidden')) {
        this.textContent = 'Mostrar comentarios';
    } else {
        this.textContent = 'Ocultar comentarios';
    }
});


// Abrir el modal cuando se hace clic en el botón "Continue"
document.getElementById('request-service-button').onclick = function(event) {
  event.preventDefault(); // Evitar el comportamiento por defecto del enlace
  document.getElementById('service-modal').style.display = 'block';
}

// Cerrar el modal
function closeServiceModal() {
  document.getElementById('service-modal').style.display = 'none';
}

// Cerrar el modal al hacer clic fuera del contenido del modal
window.onclick = function(event) {
  const modal = document.getElementById('service-modal');
  if (event.target === modal) {
      closeServiceModal();
  }
}

// Manejar el envío del formulario
document.getElementById('service-form').onsubmit = function(event) {
  event.preventDefault(); // Evitar el envío por defecto

  // Obtener los valores del formulario
  const comment = document.getElementById('comment').value;
  const serviceLocation = document.getElementById('service-location').value;

  // Aquí puedes manejar los datos del servicio
  alert(`Comentario: ${comment}\nUbicación del Servicio: ${serviceLocation}`);

  // Cerrar el modal después de confirmar
  closeServiceModal();
}


    document.addEventListener('DOMContentLoaded', () => {
        const serviceId = 1; // Cambia esto según el servicio que estés mostrando
        const commentsList = document.getElementById('comments-list');

        // Función para obtener reseñas del backend
        async function fetchReviews() {
            try {
                const response = await fetch(`../backend/ver_servicioCliente.php?id=${serviceId}`); // Cambia esta ruta a tu API
                const data = await response.json();

                if (data.reseñas && data.reseñas.length > 0) {
                    // Limpiar reseñas anteriores
                    commentsList.innerHTML = '';

                    // Agregar reseñas al DOM
                    data.reseñas.forEach(review => {
                        const reviewDiv = document.createElement('div');
                        reviewDiv.classList.add('review');
                        
                        reviewDiv.innerHTML = `
                            <p>"${review.comentarios}"</p>
                            <div class="reviewer">
                                <img alt="Profile picture of the reviewer" height="50" src="URL_DE_IMAGEN_DEL_REVISOR" width="50" />
                                <div>
                                    <p>Reviewed by ${review.cliente_nombre} - ${review.fecha}</p>
                                    <div class="rating">${generateStars(review.calificacion)}</div>
                                </div>
                            </div>
                        `;
                        
                        commentsList.appendChild(reviewDiv);
                    });
                } else {
                    commentsList.innerHTML = '<p>No hay reseñas disponibles para este servicio.</p>';
                }
            } catch (error) {
                console.error('Error fetching reviews:', error);
                commentsList.innerHTML = '<p>Error al cargar las reseñas.</p>';
            }
        }

        // Función para generar estrellas basadas en la calificación
        function generateStars(rating) {
            const fullStars = Math.floor(rating);
            const halfStars = rating % 1 !== 0 ? 1 : 0; // Para medio estrella
            const stars = [];

            for (let i = 0; i < fullStars; i++) {
                stars.push('<i class="fas fa-star"></i>');
            }
            for (let i = 0; i < halfStars; i++) {
                stars.push('<i class="fas fa-star-half-alt"></i>');
            }
            for (let i = fullStars + halfStars; i < 5; i++) {
                stars.push('<i class="far fa-star"></i>');
            }

            stars.push(`<span> ${rating.toFixed(1)} </span>`); // Muestra la calificación
            return stars.join('');
        }

        // Llamar a la función para cargar reseñas
        fetchReviews();
    });


    // Obtenemos el ID del servicio de la URL
const urlParams = new URLSearchParams(window.location.search);
const serviceId = urlParams.get('serviceId');

const services = {
  1: {
    images: [
      
      "https://arpasa.es/wp-content/uploads/2021/02/mejor-hora-cortar-cesped0.jpg",
      "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTT0GdadarrCEiXKBBI9sL8u0Tgeg8E3pXIgg&s",
      "https://arpasa.es/wp-content/uploads/2021/02/mejor-hora-cortar-cesped1.jpg"
      // Agrega más imágenes relacionadas con cortar el césped aquí
    ],
    reviews: [
      { text: "Great design! Very satisfied with the quality and creativity.", reviewer: "- John Doe" },
      { text: "Excellent quality! Exceeded my expectations.", reviewer: "- Jane Smith" },
      { text: "Great design! Very satisfied with the quality and creativity.", reviewer: "- John Doe" },
      { text: "Excellent quality! Exceeded my expectations.", reviewer: "- Jane Smith" }
    ]
  },
  2: {
    images: [
      "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzz6X5L4cbaWANoCmJzCPcoHt2QM9xM8L9aA&s",
      "https://www.servinet.cat/wp-content/uploads/2018/04/fotopostdesinfeccio.jpg",
      "https://www.kipclin.com/images/imagen_2022-06-24_165945025.png",
      "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ5UMVEHdDJHwcz5FLvUwlABZRWwcRlWfsA1g&s"
      // Agrega más imágenes relacionadas con limpieza aquí
    ],
    reviews: [
      { text: "Excellent service! Very professional.", reviewer: "- Sarah Connor" },
      { text: "Excellent service! Very professional.", reviewer: "- Sarah Connor" },
      { text: "Excellent service! Very professional.", reviewer: "- Sarah Connor" },
      { text: "Excellent service! Very professional.", reviewer: "- Sarah Connor" },
    ]
  },
  3: {
    images: [
      "https://cdn.aarp.net/content/dam/aarpe/es/home/hogar-familia/transporte-comunidades/info-2023/como-elegir-mecanico-de-confianza/_jcr_content/root/container_main/container_body_main/container_body1/container_body_cf/container_image/articlecontentfragment/cfimage.coreimg.50.932.jpeg/content/dam/aarp/auto/2023/07/1140-new-auto-mechanic-bottom-of-car-esp.jpg",
      "https://servitechapp.com/wp-content/uploads/2023/03/MECANICOS-TALLER.jpg",
      "https://www.universidadceulver.edu.mx/wp-content/uploads/2024/07/Mecanica-desempe.webp",
      "https://www.camarounds.com/wp-content/uploads/2020/06/foto-mec%C3%A1nico.jpg"
    ],
    reviews: [
      { text: "Very knowledgeable and helpful.", reviewer: "- Mike Johnson" },
    ]
  },
  4: {
    images: [
      "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpTYdbV2HB2hMW-nqN-mZPD-w01B3yArvtiA&s",
      "https://aprende.com/wp-content/uploads/2022/01/instalacion-de-una-tuberia-funciones-del-plomero.jpg",
      "https://www.plomerovallarta.com/wp-content/uploads/2022/04/plumbing-pipe-wrench.jpg",
      "https://www.ahrexpomexico.com/wp-content/uploads/2023/07/recorte-edgar.jpg"
      // Agrega imágenes relacionadas con plomería aquí
    ],
    reviews: [
      { text: "Quick response and effective work.", reviewer: "- Linda Davis" },
      { text: "Quick response and effective work.", reviewer: "- Linda Davis" },
      { text: "Quick response and effective work.", reviewer: "- Linda Davis" },
      { text: "Quick response and effective work.", reviewer: "- Linda Davis" },
    ]
  }
};

// Cargar imágenes y reseñas según el ID del servicio
const loadServiceContent = (serviceId) => {
  const service = services[serviceId];

  if (service) {
    const mainImage = document.getElementById('current-image');
    const thumbnailsContainer = document.querySelector('.thumbnails');
    const reviewText = document.querySelector('.review-text');
    const reviewerName = document.querySelector('.reviewer');

    // Cargar la primera imagen y reseña
    if (service.images.length > 0) {
      mainImage.src = service.images[0];
    }

    // Cargar las reseñas
    if (service.reviews.length > 0) {
      reviewText.textContent = service.reviews[0].text;
      reviewerName.textContent = service.reviews[0].reviewer;
    }

    // Cargar las miniaturas
    thumbnailsContainer.innerHTML = '';
    service.images.forEach((image, index) => {
      const thumbnail = document.createElement('img');
      thumbnail.src = image;
      thumbnail.alt = `Thumbnail ${index + 1}`;
      thumbnail.className = 'thumbnail';
      thumbnail.addEventListener('click', () => {
        mainImage.src = image;
        reviewText.textContent = service.reviews[index]?.text || '';
        reviewerName.textContent = service.reviews[index]?.reviewer || '';
      });
      thumbnailsContainer.appendChild(thumbnail);
    });
  } else {
    console.error('Servicio no encontrado');
  }
};

// Llamar a la función para cargar el contenido
loadServiceContent(serviceId);


const portfolioItems = {
  1: {
    mainImage: "https://arpasa.es/wp-content/uploads/2021/02/mejor-hora-cortar-cesped0.jpg",
    title: "Cortacésped",
    description: "Diseños de logotipos relacionados con el corte de césped.",
    tag: "Diseño de Logotipos",
    thumbnails: [
      { src: "https://arpasa.es/wp-content/uploads/2021/02/mejor-hora-cortar-cesped1.jpg", title: "Thumbnail 1", description: "Descripción para Thumbnail 1" },
      { src: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTT0GdadarrCEiXKBBI9sL8u0Tgeg8E3pXIgg&s", title: "Thumbnail 2", description: "Descripción para Thumbnail 2" },
      ]
  },
  2: {
    mainImage: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzz6X5L4cbaWANoCmJzCPcoHt2QM9xM8L9aA&s",
    title: "Limpieza",
    description: "Diseños de logotipos relacionados con la limpieza.",
    tag: "Limpieza",
    thumbnails: [
      { src: "https://www.servinet.cat/wp-content/uploads/2018/04/fotopostdesinfeccio.jpg", title: "Thumbnail 1", description: "Descripción para Thumbnail 1" },
      { src: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ5UMVEHdDJHwcz5FLvUwlABZRWwcRlWfsA1g&s", title: "Thumbnail 2", description: "Descripción para Thumbnail 2" },
    ]
  },
  3: {
    mainImage: "https://servitechapp.com/wp-content/uploads/2023/03/MECANICOS-TALLER.jpg",
    title: "Mecánica",
    description: "Diseños de logotipos relacionados con la mecánica.",
    tag: "Mecánica",
    thumbnails: [
      { src: "https://www.universidadceulver.edu.mx/wp-content/uploads/2024/07/Mecanica-desempe.webp", title: "Thumbnail 1", description: "Descripción para Thumbnail 1" },
    ]
  },
  4: {
    mainImage: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpTYdbV2HB2hMW-nqN-mZPD-w01B3yArvtiA&s",
    title: "Plomería",
    description: "Diseños de logotipos relacionados con la plomería.",
    tag: "Plomería",
    thumbnails: [
      { src: "https://www.plomerovallarta.com/wp-content/uploads/2022/04/plumbing-pipe-wrench.jpg", title: "Thumbnail 1", description: "Descripción para Thumbnail 1" },
      { src: "https://www.ahrexpomexico.com/wp-content/uploads/2023/07/recorte-edgar.jpg", title: "Thumbnail 2", description: "Descripción para Thumbnail 2" },
    ]
  }
};

// Cargar contenido del portafolio según el ID del servicio
const loadPortfolioContent = (serviceId) => {
  const portfolioItem = portfolioItems[serviceId];

  if (portfolioItem) {
    const mainImage = document.getElementById('main-image');
    const itemTitle = document.getElementById('item-title');
    const itemDescription = document.getElementById('item-description');
    const itemTag = document.getElementById('item-tag');
    const thumbnailsContainer = document.querySelector('.portfolio-thumbnails');

    // Cargar la imagen principal, título, descripción y etiqueta
    mainImage.src = portfolioItem.mainImage;
    itemTitle.textContent = portfolioItem.title;
    itemDescription.textContent = portfolioItem.description;
    itemTag.textContent = portfolioItem.tag;

    // Cargar miniaturas
    thumbnailsContainer.innerHTML = '';
    portfolioItem.thumbnails.forEach((thumbnail) => {
      const img = document.createElement('img');
      img.src = thumbnail.src;
      img.alt = thumbnail.title;
      img.onclick = () => {
        mainImage.src = thumbnail.src;
        itemTitle.textContent = thumbnail.title;
        itemDescription.textContent = thumbnail.description;
      };
      thumbnailsContainer.appendChild(img);
    });
  } else {
    console.error('Servicio no encontrado');
  }
};

// Llamar a la función para cargar el contenido
loadPortfolioContent(serviceId);
