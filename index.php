<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Marketplace</title>
  <link
    rel="stylesheet"
    href="https://unicons.iconscout.com/release/v3.0.6/css/line.css" />
  <link
    rel="stylesheet"
    href="https://unicons.iconscout.com/release/v3.0.6/css/solid.css" />
  <link rel="stylesheet" href="css/app.css" />
  <link rel="stylesheet" href="css/fancybox.css" />
  <link rel="stylesheet" href="css/swiper-bundle.min.css" />
  <link rel="stylesheet" href="css/services.css" />
</head>

<body>
  <!-- Header Section -->
  <header>
    <div class="banner banner-diversity">
      <h1>Encuentra a un experto, para lo que necesitas</h1>
      <p>
        From design to development, writing to marketing, get top-tier
        freelance talent for your business.
      </p>
      <form class="search-form">
        <input type="text" placeholder="Buscar servicios..." />
        <button type="submit">Empezar</button>
      </form>
      <h2 class="title_typed">
        Aquí estan los mejores <span class="typed"></span>
      </h2>
    </div>
  </header>

  <!-- Categories Section -->
  <section class="categories container">
    <h2>Explora nuestras <span class="bold">categorías</span> 🔥</h2>
    <div class="category-list">
      <div class="category-item">
        <i class="uil uil-pen"></i>
        <p>Graphic Design</p>
      </div>
      <div class="category-item">
        <i class="uil uil-chart-line"></i>
        <p>Digital Marketing</p>
      </div>
      <div class="category-item">
        <i class="uil uil-file-edit-alt"></i>
        <p>Writing & Translation</p>
      </div>
      <div class="category-item">
        <i class="uil uil-video"></i>
        <p>Video & Animation</p>
      </div>
      <div class="category-item">
        <i class="uil uil-code-branch"></i>
        <p>Programming & Tech</p>
      </div>
      <div class="category-item">
        <i class="uil uil-music"></i>
        <p>Music & Audio</p>
      </div>
    </div>
  </section>





  <section class="container ia_container">
    <h2>¿Cómo <span class="bold">podemos</span> ayudarte?</h2>
    <p>Nuestro modelo de IA te ayudará a encontrar al <span class="bold">profesional que necesitas</span>.</p>
    <p>Descríbenos lo que necesitas, por ejemplo: "tengo problemas con mi baño". 👌</p>

    <div class="respuesta_ia_container">
      <div>
        <textarea id="consulta" rows="5"></textarea>
      </div>
      <button type="button" id="botonConsulta">Consultar</button>
      <h3>IA QuickHand te <span class="bold">recomienda...</span></h3>
      <p id="resultadoConsulta"></p>
    </div>


    <script type="importmap">
      {
      "imports": {
        "@google/generative-ai": "https://esm.run/@google/generative-ai"
      }
    }
  </script>

    <script type="module">
      import {
        GoogleGenerativeAI
      } from "@google/generative-ai"
      const clave = "AIzaSyBkeZzzip6Trc5uJaOAeiwnw9cn3gyC6ZQ" // copiar su clave

      const genAI = new GoogleGenerativeAI(clave)
      const model = genAI.getGenerativeModel({
        model: "gemini-pro"
      })

      document.querySelector("#botonConsulta").addEventListener("click", async () => {
        desactivarBoton()

        const consulta = document.querySelector("#consulta").value;
        const promptInicial = "A partir de los siguientes datos, dame una recomendacion sobre que especialista o tecnico necesito contactar para solucionar mi inconveniente. " +
          consulta +
          " \nNo tomes mas de 200 tokens. Resume mas la informacion para alguien de 18 a 25 años. no pases de mas de 200 tokens.\nNo indiques los titulos de las respuestas. Solo dame la recomendacion resumida.";
        const resultadoConsulta = document.querySelector("#resultadoConsulta")
        try {
          const result = await model.generateContent(promptInicial)
          const response = await result.response
          const text = response.text()

          // Mostrar el resultado en el frontend
          function eliminarAsteriscos(cadena) {
            // Expresión regular para encontrar todos los asteriscos
            const regex = /\*/g;

            // Reemplazar todos los asteriscos por una cadena vacía
            const cadenaSinAsteriscos = cadena.replace(regex, '');

            return cadenaSinAsteriscos;
          }

          resultadoConsulta.innerHTML = eliminarAsteriscos(text)
        } catch (error) {
          resultadoConsulta.innerHTML = 'Problemas en la consulta'
        }
        activarBoton()
      })

      function desactivarBoton() {
        const botonConsulta = document.querySelector("#botonConsulta")
        botonConsulta.disabled = true
        botonConsulta.innerText = "Consultando..."
      }

      function activarBoton() {
        const botonConsulta = document.querySelector("#botonConsulta")
        botonConsulta.disabled = false
        botonConsulta.innerText = "Consultar"
      }
    </script>
  </section>















  <!-- Featured Services Section -->
  <section class="featured-services container">
    <h2>Servicios más <span class="bold">solicitados</span> 💹</h2>
    <div class="services-grid">
      <div class="service-item">
        <img src="img/plomeria.jpg" alt="Service 1" />
        <div class="info_servicio">
          <h3>Plomería</h3>
          <div>
            <i class="uil uil-star"></i>
            <i class="uil uil-star"></i>
            <i class="uil uil-star"></i>
          </div>
          <p>De los mejores de la ciudad.</p>
          <a href="#servicios">Ver más</a>
        </div>
      </div>
      <div class="service-item">
        <img src="img/electricista.jpg" alt="Service 1" />
        <div class="info_servicio">
          <h3>Eléctricista</h3>
          <div>
            <i class="uil uil-star"></i>
            <i class="uil uil-star"></i>
            <i class="uil uil-star"></i>
          </div>
          <p>De los mejores de la ciudad.</p>
          <a href="#servicios">Ver más</a>
        </div>
      </div>
      <div class="service-item">
        <img src="img/mecanica.jpg" alt="Service 1" />
        <div class="info_servicio">
          <h3>Mecánico</h3>
          <div>
            <i class="uil uil-star"></i>
            <i class="uil uil-star"></i>
            <i class="uil uil-star"></i>
          </div>
          <p>De los mejores de la ciudad.</p>
          <a href="#servicios">Ver más</a>
        </div>
      </div>
      <div class="service-item">
        <img src="img/carpinteria.avif" alt="Service 1" />
        <div class="info_servicio">
          <h3>Carpintería</h3>
          <div>
            <i class="uil uil-star"></i>
            <i class="uil uil-star"></i>
            <i class="uil uil-star"></i>
          </div>
          <p>De los mejores de la ciudad.</p>
          <a href="#servicios">Ver más</a>
        </div>
      </div>
    </div>
  </section>

  <section class="testimonials container">
    <h2 class="testimonials__title">Lo que nuestros clientes piensan de <span class="bold">nosotros</span> 😀</h2>
    <div class="testimonials__grid">
      <!-- Testimonial 1 -->
      <div class="testimonial">
        <div class="testimonial__header">
          <img
            src="img/persona.avif"
            alt="Karla Mendoza"
            class="testimonial__img" />
          <div>
            <h3 class="testimonial__name">Karla Mendoza</h3>
            <span class="testimonial__role">Client</span>
          </div>
        </div>
        <p class="testimonial__text">
          "Elite freelancers delivered on time and exceeded our expectations."
        </p>
        <div class="testimonial__rating">
          <i class="uil uil-star"></i>
          <i class="uil uil-star"></i>
          <i class="uil uil-star"></i>
          <i class="uil uil-star"></i>
          <i class="uil uil-star"></i>
        </div>
      </div>

      <!-- Testimonial 2 -->
      <div class="testimonial">
        <div class="testimonial__header">
          <img
            src="img/persona.avif"
            alt="Carlos Axel"
            class="testimonial__img" />
          <div>
            <h3 class="testimonial__name">Carlos Axel</h3>
            <span class="testimonial__role">Client</span>
          </div>
        </div>
        <p class="testimonial__text">
          "Professional service with high-quality results. Highly recommend!"
        </p>
        <div class="testimonial__rating">
          <i class="uil uil-star"></i>
          <i class="uil uil-star"></i>
          <i class="uil uil-star"></i>
          <i class="uil uil-star"></i>
          <i class="uil uil-star"></i>
        </div>
      </div>

      <!-- Testimonial 3 -->
      <div class="testimonial">
        <div class="testimonial__header">
          <img
            src="img/persona.avif"
            alt="Emily K."
            class="testimonial__img" />
          <div>
            <h3 class="testimonial__name">Michael Jordan</h3>
            <span class="testimonial__role">Client</span>
          </div>
        </div>
        <p class="testimonial__text">
          "An easy platform to use with top-tier freelancers."
        </p>
        <div class="testimonial__rating">
          <i class="uil uil-star"></i>
          <i class="uil uil-star"></i>
          <i class="uil uil-star"></i>
          <i class="uil uil-star"></i>
          <i class="uil uil-star"></i>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action Section -->
  <section class="cta container">
    <div class="cta-content">
      <h2>¿Quieres pertenecer a <span class="bold">nuestro</span> equipo?</h2>
      <p>
        Join thousands of businesses that trust our platform to find the best
        freelance talent. Sign up now to start your journey!
      </p>
      <a href="login_chamba.php" target="_blank" class="cta-button">Get Started</a>
    </div>
  </section>

  <!-- section busqueda servicios -->

  <section class="container_services container" id="servicios">
    <div class="container_busqueda">
      <div class="form_busqueda">
        <div class="img_busqueda">
          <img src="img/seo.png" alt="Seo" />
        </div>
        <form action="">
          <h3>¿Qué es lo que <span class="bold">hacemos</span>?</h3>
          <p>
            Nos encargamos de encontrar a los
            <span class="bold">mejores</span> de la ciudad y contáctarlos
            contigo. <br />
            ¡Aquí puedes agendar una cita con ellos!
          </p>
          <input
            type="text"
            class="barra-busqueda"
            id="barra-busqueda"
            placeholder="¿Qué estás buscando?" />
        </form>
      </div>

      <div class="categorias slide-container swiper contenedor">
        <div class="slide-content">
          <div class="swiper-wrapper" id="categorias">
            <a href="#" class="activo swiper-slide">Todos</a>
            <a href="#" class="swiper-slide">Mecánica</a>
            <a href="#" class="swiper-slide">Electricidad</a>
            <a href="#" class="swiper-slide">Plomería</a>
            <a href="#" class="swiper-slide">Jardinería</a>
            <a href="#" class="swiper-slide">Limpieza</a>
            <a href="#" class="swiper-slide">Transporte</a>
            <a href="#" class="swiper-slide">Mudanza</a>

            <a href="#" class="swiper-slide">Pintura</a>
            <a href="#" class="swiper-slide">Mascotas</a>
            <a href="#" class="swiper-slide">Aire</a>
          </div>
        </div>
      </div>
    </div>

    <section class="grid gallery-container" id="grid">
      <!-- Item 1: Reparación de autos -->
      <div
        class="item"
        data-categoria="mecánica"
        data-etiquetas="mecanica Mecánica autos taller automotriz">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/mecanica.jpg"
                data-caption="Trabajos de mecánica con expertos">
                <img class="rounded" src="img/mecanica.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Reparación de autos</h3>
              <a href="cliente/service.php?serviceId=3" target="_blank"><img src="img/persona.webp" alt="" />Luis Torres</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$120.00</p>
              </div>
              <p class="titulo_categoria">Mecánica</p>
              <p class="product-description">
                Servicio completo de reparación de autos, desde diagnósticos
                hasta reparaciones avanzadas.
              </p>

              <a href="login.php" target="_blanck" target="_blank" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 2: Servicio eléctrico -->
      <div
        class="item"
        data-categoria="electricidad"
        data-etiquetas="electricidad instalación reparación luces">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/electricidad.jpg"
                data-caption="Soluciones eléctricas profesionales">
                <img class="rounded" src="img/electricidad.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Servicio eléctrico</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Karely Duran</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$80.00</p>
              </div>
              <p class="titulo_categoria">Electricidad</p>
              <p class="product-description">
                Instalación y reparación de sistemas eléctricos en hogares y
                oficinas.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 3: Servicio de plomería -->
      <div
        class="item"
        data-categoria="plomería"
        data-etiquetas="plomeria tuberías desagües reparaciones">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/plomeria.jpg"
                data-caption="Reparaciones de plomería eficientes">
                <img class="rounded" src="img/plomeria.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Servicio de plomería</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Angel Misael</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$65.00</p>
              </div>
              <p class="titulo_categoria">Plomería</p>
              <p class="product-description">
                Servicios de plomería, incluyendo reparación de tuberías y
                mantenimiento de desagües.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 4: Servicio de jardinería -->
      <div
        class="item"
        data-categoria="jardinería"
        data-etiquetas="jardineriaípaisajismo poda plantas">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/jardineria.jpg"
                data-caption="Transforma tu jardín con nosotros">
                <img class="rounded" src="img/jardineria.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Servicio de jardinería</h3>
              <a href="cliente/service.php?serviceId=1" target="_blank"><img src="img/persona.webp" alt="" />Fernando Tellez</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$50.00</p>
              </div>
              <p class="titulo_categoria">Jardinería</p>
              <p class="product-description">
                Paisajismo, poda de árboles y mantenimiento de jardines.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 5: Servicio de limpieza -->
      <div
        class="item"
        data-categoria="limpieza"
        data-etiquetas="limpieza hogar oficinas limpieza profunda">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/limpieza.jpg"
                data-caption="Limpieza profesional para tu hogar">
                <img class="rounded" src="img/limpieza.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Servicio de limpieza</h3>
              <a href="cliente/service.php?serviceId=2#" target="_blank"><img src="img/persona.webp" alt="" />Ana Martínez</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$45.00</p>
              </div>
              <p class="titulo_categoria">Limpieza</p>
              <p class="product-description">
                Servicios de limpieza profunda para hogares y oficinas.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 6: Transporte privado -->
      <div
        class="item"
        data-categoria="transporte"
        data-etiquetas="transporte taxi alquiler autos">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/transporte.jpg"
                data-caption="Servicio de transporte privado">
                <img class="rounded" src="img/transporte.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Transporte privado</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Sergio Rios</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$70.00</p>
              </div>
              <p class="titulo_categoria">Transporte</p>
              <p class="product-description">
                Servicio de transporte privado en autos de alta gama.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 7: Servicio de mudanza -->
      <div
        class="item"
        data-categoria="mudanza"
        data-etiquetas="mudanza embalaje transporte muebles">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/mudanza.jpg"
                data-caption="Mudanzas rápidas y seguras">
                <img class="rounded" src="img/mudanza.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Servicio de mudanza</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Mariana Quiñones</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$90.00</p>
              </div>
              <p class="titulo_categoria">Mudanza</p>
              <p class="product-description">
                Servicios de mudanza, embalaje y transporte de muebles.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 9: Pintura y decoración -->
      <div
        class="item"
        data-categoria="pintura"
        data-etiquetas="pintura decoracion interiores">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/pintura.jpg"
                data-caption="Diseño y pintura para tus espacios">
                <img class="rounded" src="img/pintura.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Pintura y decoración</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Eder Ceniceros</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$75.00</p>
              </div>
              <p class="titulo_categoria">Pintura</p>
              <p class="product-description">
                Servicios de pintura y decoración de interiores y exteriores.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 10: Cuidado de mascotas -->
      <div
        class="item"
        data-categoria="mascotas"
        data-etiquetas="cuidado mascotas veterinaria">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/mascotas.jpg"
                data-caption="Cuidado especializado para tus mascotas">
                <img class="rounded" src="img/mascotas.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Cuidado de mascotas</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Jacqueline Moreno</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$40.00</p>
              </div>
              <p class="titulo_categoria">Mascotas</p>
              <p class="product-description">
                Servicios de cuidado, paseo y atención veterinaria para
                mascotas.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->
      <!-- Item 1: Reparación de autos -->
      <div
        class="item"
        data-categoria="mecánica"
        data-etiquetas="mecanica Mecánica autos taller automotriz">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/mecanica2.jpg"
                data-caption="Trabajos de mecánica con expertos">
                <img class="rounded" src="img/mecanica2.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Reparación de autos</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Carlos Axel</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$220.00</p>
              </div>
              <p class="titulo_categoria">Mecánica</p>
              <p class="product-description">
                Servicio completo de reparación de autos, desde diagnósticos
                hasta reparaciones avanzadas.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 2: Servicio eléctrico -->
      <div
        class="item"
        data-categoria="electricidad"
        data-etiquetas="electricidad instalación reparación luces">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/electricista2.jpg"
                data-caption="Soluciones eléctricas profesionales">
                <img class="rounded" src="img/electricista2.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Servicio eléctrico</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Karely Duran</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$80.00</p>
              </div>
              <p class="titulo_categoria">Electricidad</p>
              <p class="product-description">
                Instalación y reparación de sistemas eléctricos en hogares y
                oficinas.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 3: Servicio de plomería -->
      <div
        class="item"
        data-categoria="plomería"
        data-etiquetas="plomeria tuberías desagües reparaciones">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/plomeria2.jpg"
                data-caption="Reparaciones de plomería eficientes">
                <img class="rounded" src="img/plomeria2.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Servicio de plomería</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Jesus Gabriel</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$605.00</p>
              </div>
              <p class="titulo_categoria">Plomería</p>
              <p class="product-description">
                Servicios de plomería, incluyendo reparación de tuberías y
                mantenimiento de desagües.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 4: Servicio de jardinería -->
      <div
        class="item"
        data-categoria="jardinería"
        data-etiquetas="jardineriaípaisajismo poda plantas">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/jardineria.jpg"
                data-caption="Transforma tu jardín con nosotros">
                <img class="rounded" src="img/jardineria.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Servicio de jardinería</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Fernando Tellez</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$50.00</p>
              </div>
              <p class="titulo_categoria">Jardinería</p>
              <p class="product-description">
                Paisajismo, poda de árboles y mantenimiento de jardines.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 5: Servicio de limpieza -->
      <div
        class="item"
        data-categoria="limpieza"
        data-etiquetas="limpieza hogar oficinas limpieza profunda">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/limpieza.jpg"
                data-caption="Limpieza profesional para tu hogar">
                <img class="rounded" src="img/limpieza.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Servicio de limpieza</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Leticia Ontiveros</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$45.00</p>
              </div>
              <p class="titulo_categoria">Limpieza</p>
              <p class="product-description">
                Servicios de limpieza profunda para hogares y oficinas.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 6: Transporte privado -->
      <div
        class="item"
        data-categoria="transporte"
        data-etiquetas="transporte taxi alquiler autos">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/transporte.jpg"
                data-caption="Servicio de transporte privado">
                <img class="rounded" src="img/transporte.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Transporte privado</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Sergio Rios</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$70.00</p>
              </div>
              <p class="titulo_categoria">Transporte</p>
              <p class="product-description">
                Servicio de transporte privado en autos de alta gama.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 7: Servicio de mudanza -->
      <div
        class="item"
        data-categoria="mudanza"
        data-etiquetas="mudanza embalaje transporte muebles">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/mudanza.jpg"
                data-caption="Mudanzas rápidas y seguras">
                <img class="rounded" src="img/mudanza.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Servicio de mudanza</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Mariana Quiñones</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$90.00</p>
              </div>
              <p class="titulo_categoria">Mudanza</p>
              <p class="product-description">
                Servicios de mudanza, embalaje y transporte de muebles.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 9: Pintura y decoración -->
      <div
        class="item"
        data-categoria="pintura"
        data-etiquetas="pintura decoracion interiores">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/pintura.jpg"
                data-caption="Diseño y pintura para tus espacios">
                <img class="rounded" src="img/pintura.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Pintura y decoración</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Eder Ceniceros</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$75.00</p>
              </div>
              <p class="titulo_categoria">Pintura</p>
              <p class="product-description">
                Servicios de pintura y decoración de interiores y exteriores.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->

      <!-- Item 10: Cuidado de mascotas -->
      <div
        class="item"
        data-categoria="mascotas"
        data-etiquetas="cuidado mascotas veterinaria">
        <div class="item-content">
          <div class="service-card">
            <div class="product-image-container">
              <a
                data-fancybox="gallery"
                href="img/mascotas.jpg"
                data-caption="Cuidado especializado para tus mascotas">
                <img class="rounded" src="img/mascotas.jpg" />
              </a>
            </div>

            <div class="product-info">
              <h3 class="product-title">Cuidado de mascotas</h3>
              <a href="#"><img src="img/persona.webp" alt="" />Jacqueline Moreno</a>

              <div class="califa_container">
                <div class="product-rating">
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                  <i class="uis uis-favorite"></i>
                </div>
                <p class="product-price">$40.00</p>
              </div>
              <p class="titulo_categoria">Mascotas</p>
              <p class="product-description">
                Servicios de cuidado, paseo y atención veterinaria para
                mascotas.
              </p>

              <a href="login.php" target="_blanck" class="add-to-cart-btn">Solicitar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- se acaba item -->
    </section>
  </section>

  <!-- Footer Section -->
  <footer>
    <div class="footer-content">
      <p>&copy; 2024 QuickHand - All rights reserved.</p>
      <ul class="footer-links">
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Service</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
  </footer>

  <!--==================== SCROLL TOP ====================-->
  <a href="#" class="scrollup" id="scroll-up">
    <i class="uil uil-arrow-up scrollup__icon"></i>
  </a>

  <script src="js/typed.js"></script>
  <script src="js/config-typed.js"></script>

  <script src="js/muuri.js"></script>
  <script src="js/jQuery.js"></script>
  <script src="js/fancybox.umd.js"></script>
  <script src="js/swiper-bundle.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>