const grid = new Muuri('.grid', {
	layout: {
		rounding: false
	}
});

window.addEventListener('load', () => {
	grid.refreshItems().layout();
	document.getElementById('grid').classList.add('imagenes-cargadas');

	// Agregamos los listener de los enlaces para filtrar por categoria.
	const enlaces = document.querySelectorAll('#categorias a');
	enlaces.forEach((elemento) => {
		elemento.addEventListener('click', (evento) => {
			evento.preventDefault();
			enlaces.forEach((enlace) => enlace.classList.remove('activo'));
			evento.target.classList.add('activo');

			const categoria = evento.target.innerHTML.toLowerCase();
			categoria === 'todos' ? grid.filter('[data-categoria]') : grid.filter(`[data-categoria="${categoria}"]`);
		});
	});

	// Agregamos el listener para la barra de busqueda
	document.querySelector('#barra-busqueda').addEventListener('input', (evento) => {
		const busqueda = evento.target.value;
		grid.filter( (item) => item.getElement().dataset.etiquetas.includes(busqueda) );
	});

});



// Agregar galeria fancybox
Fancybox.bind('[data-fancybox="gallery-container"]', {
    Thumbs: {
      Carousel: {
        fill: false,
        center: true,
      },
    },
  });


// Deslizar elementos  con swipper

var swiper = new Swiper(".slide-content", {
	slidesPerView: 6.5,
	spaceBetween: 25,
	centerSlide: 'true',
	fade: 'true',
	grabCursor: 'true',
  
	breakpoints:{
		0: {
			slidesPerView: 4.5,
			spaceBetween: 25,
		},
		520: {
			slidesPerView: 3.5,
			spaceBetween: 5,
		},
		950: {
			slidesPerView: 6.5,
			spaceBetween: 25,
		},
	},
  });
  





  function scrollTop(){
	const scrollTop = document.querySelector('#scroll-up');
  
	if(this.scrollY >= 560) scrollTop.classList.add('show-scroll'); else scrollTop.classList.remove('show-scroll');
  }
  
  window.addEventListener('scroll', scrollTop);