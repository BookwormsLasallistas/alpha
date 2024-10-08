<?php
 session_start();
  if(isset($_SESSION["usuario"])){
    session_destroy();
    echo '<div class="bg"></div>';
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>';
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
        background: "white", // Fondo transparente
        icon: "info",
        title: "¡Vuelve pronto!",
        text: "¡Has salido de Bookworms Lasallistas!",
        confirmButtonText: "Cerrar",
        confirmButtonColor: "#e7b11fCC",  // Cambia el color del botón de confirmación
        background: "#27366e", // Fondo con transparencia
        color: "#ffffff", // Texto blanco
        customClass: {
            popup: "swal2-popup-custom", // Clase personalizada para el popup
            icon: "swal2-icon-custom",   // Clase personalizada para el icono
            title: "swal2-title-custom", // Clase personalizada para el título
            text: "swal2-content-custom", // Clase personalizada para el contenido de texto
            confirmButton: "swal2-button-blur swal2-button-custom", // Clase personalizada para el botón de confirmación
            cancelButton: "swal2-button-blur swal2-button-custom-cancel",  // Clase personalizada para el botón de cancelación
        },
        backdrop: false 
    }).then(function(result) {
        if (result.isConfirmed) {
        window.location.href = "../paginas/libros.php"; 
        }
    });
    });
    </script>';
  }

?>