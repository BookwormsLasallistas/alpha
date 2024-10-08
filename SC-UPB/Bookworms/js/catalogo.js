document.addEventListener('DOMContentLoaded', function() {
    const starContainers = document.querySelectorAll('.star-container');
  
    for (let i = 0; i < starContainers.length; i++) {
      const rating = parseInt(starContainers[i].getAttribute('data-rating'), 10);
      const stars = starContainers[i].querySelectorAll('input[type="radio"]');
      const labels = starContainers[i].querySelectorAll('label');
  
      for (let j = 0; j < rating; j++) {
        stars[stars.length - 1 - j].checked = true;
        labels[labels.length - 1 - j].classList.add('selected');
      }
    }
  });

// Seleccionamos ambos contenedores
const filterBox = document.querySelector('.filterBox');
const searchBox = document.querySelector('.searchBox');

// Función para manejar el clic dentro de los contenedores
const handleBoxClick = (event) => {
    event.stopPropagation(); // Evita la propagación del evento
    const box = event.currentTarget; // Obtiene el contenedor que fue clickeado
    box.classList.toggle('active'); // Toggle de la clase active
    const button = box.querySelector('.filterButton, .searchButton');
    button.classList.toggle('disabled');
};

// Agregamos eventos de clic para cada contenedor
filterBox.addEventListener('click', handleBoxClick);
searchBox.addEventListener('click', handleBoxClick);

// Agregamos eventos de clic a los elementos select e input para detener la propagación
const filterInputs = filterBox.querySelectorAll('select, input');
filterInputs.forEach(input => {
    input.addEventListener('click', (event) => {
        event.stopPropagation();
    });
});

const searchInputs = searchBox.querySelectorAll('select, input');
searchInputs.forEach(input => {
    input.addEventListener('click', (event) => {
        event.stopPropagation();
    });
});

/*---------------------------------------------------------------------------------------------------------------------------------*/

// Evento en el documento para quitar 'active' si se hace clic fuera de ambos elementos
document.addEventListener('click', (event) => {
    if (filterBox.classList.contains('active') && !filterBox.contains(event.target)) {
        filterBox.classList.remove('active');
        const button = filterBox.querySelector('.filterButton');
        button.classList.add('disabled');
    }

    if (searchBox.classList.contains('active') && !searchBox.contains(event.target)) {
        searchBox.classList.remove('active');
        const button = searchBox.querySelector('.searchButton');
        button.classList.add('disabled');
    }
});
