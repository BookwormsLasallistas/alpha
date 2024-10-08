// Asocia el evento de clic al <a> con la clase fa-magnifying-glass
$('.fa-magnifying-glass').on('click', function(event) {
  event.stopPropagation();
  event.preventDefault();
  
  // Recupera los datos del atributo data-*
  var id = $(this).parent('a').data('id');
  var tipo = $(this).parent('a').data('tipo');
  
  // Hace una solicitud AJAX al servidor para obtener los datos del libro
  $.ajax({
    type: 'GET',
    url: '../modulos/obtener_catalogo.php',
    data: {id: id, tipo: tipo},
    dataType: 'json',
    success: function(data) {
      console.log('Alerta creada');
      var catalogo = data;
      // Muestra una alerta con la información
      Swal.fire({
        title: 'Información del libro',
        html: `
          <p style="text-align: justify;"><strong>Nombre:</strong><br> ${catalogo.nombre}</p>
          <p style="text-align: justify;"><strong>Autor:</strong><br> ${catalogo.autor}</p>
          <p style="text-align: justify;"><strong>Lenguaje:</strong><br> ${catalogo.lenguaje}</p>
          <p style="text-align: justify;"><strong>Género:</strong><br> ${catalogo.genero}</p>
          <p style="text-align: justify;"><strong>Editorial:</strong><br> ${catalogo.editorial}</p>
          <p style="text-align: justify;"><strong>Publicación:</strong><br> ${catalogo.publicacion}</p>
          <p style="text-align: justify;"><strong>Puntuación:</strong><br> ${catalogo.puntuacion}</p>
          <p style="text-align: justify;"><strong>Sinopsis:</strong><br> ${catalogo.sinopsis}</p>
        `,
        confirmButtonText: 'Cerrar',
        confirmButtonColor: '#e7b11fCC',
        background: '#27366e',
        color: '#ffffff',
        customClass: {
          popup: 'swal2-popup-custom',
          icon: 'swal2-icon-custom',
          title: 'swal2-title-custom',
          content: 'swal2-content-custom',
          confirmButton: 'swal2-button-blur swal2-button-custom',
          cancelButton: 'swal2-button-blur swal2-button-custom-cancel',
        },
        backdrop: false
        
      });
    },
    error: function(xhr, status, error) {
      console.log('Error en la solicitud AJAX:', error);
    }
  });
  
  return false;
});