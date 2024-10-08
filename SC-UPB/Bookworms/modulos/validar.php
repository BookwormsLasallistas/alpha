
<link rel="stylesheet" href="../styles/validar.css">
<?php
    include('conexion.php');

    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $consulta = "SELECT * FROM usuarios WHERE correo='$correo' AND clave='$clave'";

    $resultado =  mysqli_query($conn, $consulta);

    $filas = mysqli_num_rows($resultado); 


    if ($filas) {
        $f = mysqli_fetch_array($resultado); 
    
        session_start(); 
    
        $_SESSION['usuario'] = $f['nombre'];
    
        $_SESSION['rol'] = $f['rol'];
        $_SESSION['correo'] = $f['correo'];
        $_SESSION['id_usuario'] = $f['id'];
        
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>';
                        
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            background: "white", // Fondo transparente
            icon: "success",
            title: "Bienvenido",
            text: "¡Bienvenido a Bookworms Lasallistas!",
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
            backdrop: false // Evita el fondo oscuro
        }).then(function(result) {
            if (result.isConfirmed) {
            window.location.href = "../paginas/libros.php"; // Redirige al usuario después de cerrar el mensaje
            }
        });
        });
        </script>';
    }else{
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>';
        
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            background: "white", // Fondo transparente
            icon: "error",
            title: "Usuario no existe",
            confirmButtonColor: "#e7b11fCC",  // Cambia el color del botón de confirmación
            confirmButtonText: "Regresar",
            background: "#27366eCC", // Fondo con transparencia
            color: "#ffffff", // Texto blanco
            customClass: {
                popup: "swal2-popup-custom-2", // Clase personalizada para el popup
                icon: "swal2-icon-custom-2",   // Clase personalizada para el icono
                title: "swal2-title-custom-2", // Clase personalizada para el título
                confirmButton: "swal2-button-blur-2 swal2-button-custom-2", // Clase personalizada para el botón de confirmación
            },
            backdrop: false // Evita el fondo oscuro
        }).then(function(result) {
            if (result.isConfirmed) {
            window.location.href = "../paginas/login.php"; // Redirige al usuario después de cerrar el mensaje
            }
        });
        });
        </script>';
    }

    mysqli_free_result($resultado);

    mysqli_close($conn);
    ?>

<div class="bg"></div>
