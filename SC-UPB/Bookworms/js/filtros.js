// Agrega un evento de cambio a los select de filtro
document.getElementById("disponibilidad-select").addEventListener("change", () => {
    // Envía una solicitud AJAX al servidor con los parámetros de los filtros seleccionados
    $.ajax({
      type: "GET",
      url: "../modulos/filtrar_libros.php",
      data: {
        disponibilidad: document.getElementById("disponibilidad-select").value,
        lenguaje: document.getElementById("lenguaje-select").value,
        editorial: document.getElementById("editorial-select").value,
        genero: document.getElementById("genero-select").value,
        calificacion: document.getElementById("calificacion-select").value
      },
      success: function(data) {
        // Recarga la página con los resultados obtenidos del servidor
        window.location.href = "../modulos/prestamos.php";
      }
    });
  });
  
  // Agrega un evento de cambio a los select de filtro
  document.getElementById("lenguaje-select").addEventListener("change", () => {
    // Envía una solicitud AJAX al servidor con los parámetros de los filtros seleccionados
    $.ajax({
      type: "GET",
      url: "filtrar_libros.php",
      data: {
        disponibilidad: document.getElementById("disponibilidad-select").value,
        lenguaje: document.getElementById("lenguaje-select").value,
        editorial: document.getElementById("editorial-select").value,
        genero: document.getElementById("genero-select").value,
        calificacion: document.getElementById("calificacion-select").value
      },
      success: function(data) {
        // Recarga la página con los resultados obtenidos del servidor
        window.location.href = "../modulos/prestamos.php";
      }
    });
  });
  
  // Agrega un evento de cambio a los select de filtro
  document.getElementById("editorial-select").addEventListener("change", () => {
    // Envía una solicitud AJAX al servidor con los parámetros de los filtros seleccionados
    $.ajax({
      type: "GET",
      url: "filtrar_libros.php",
      data: {
        disponibilidad: document.getElementById("disponibilidad-select").value,
        lenguaje: document.getElementById("lenguaje-select").value,
        editorial: document.getElementById("editorial-select").value,
        genero: document.getElementById("genero-select").value,
        calificacion: document.getElementById("calificacion-select").value
      },
      success: function(data) {
        // Recarga la página con los resultados obtenidos del servidor
        window.location.href = "../modulos/prestamos.php";
      }
    });
  });
  
  // Agrega un evento de cambio a los select de filtro
  document.getElementById("genero-select").addEventListener("change", () => {
    // Envía una solicitud AJAX al servidor con los parámetros de los filtros seleccionados
    $.ajax({
      type: "GET",
      url: "filtrar_libros.php",
      data: {
        disponibilidad: document.getElementById("disponibilidad-select").value,
        lenguaje: document.getElementById("lenguaje-select").value,
        editorial: document.getElementById("editorial-select").value,
        genero: document.getElementById("genero-select").value,
        calificacion: document.getElementById("calificacion-select").value
      },
      success: function(data) {
        // Recarga la página con los resultados obtenidos del servidor
        window.location.href = "../modulos/prestamos.php";
      }
    });
  });
  
  // Agrega un evento de cambio a los select de filtro
  document.getElementById("calificacion-select").addEventListener("change", () => {
    // Envía una solicitud AJAX al servidor con los parámetros de los filtros seleccionados
    $.ajax({
      type: "GET",
      url: "filtrar_libros.php",
      data: {
        disponibilidad: document.getElementById("disponibilidad-select").value,
        lenguaje: document.getElementById("lenguaje-select").value,
        editorial: document.getElementById("editorial-select").value,
        genero: document.getElementById("genero-select").value,
        calificacion: document.getElementById("calificacion-select").value
      },
      success: function(data) {
        // Recarga la página con los resultados obtenidos del servidor
        window.location.href = "../modulos/prestamos.php";
      }
    });
  });