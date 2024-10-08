<?php

$nombre = $_SESSION['usuario'];
$consulta = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
$resultado = mysqli_query($conn, $consulta);
$filas = mysqli_num_rows($resultado); 
if ($filas) {
    $f = mysqli_fetch_array($resultado); 
    $_SESSION['id_usuario'] = $f['id'];
    $idUsuario = $_SESSION['id_usuario'];
}


/*----------------------------------------------Libros backend------------------------------------------------------------------ */

    if (isset($_GET['id_carrito'])) {
        $id = $_GET['id_carrito'];
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>';

        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡Se eliminará tu libro de favoritos!",
                    icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e7b11fCC",  // Cambia el color del botón de confirmación
                cancelButtonColor: "#C98484CC",
                confirmButtonText: "Sí, bórralo",
                cancelButtonText: "Cancelar",
                background: "#27366eCC", // Fondo con transparencia
                color: "#ffffff", // Texto blanco
                customClass: {
                    popup: "swal2-popup-custom", // Clase personalizada para el popup
                    icon: "swal2-icon-custom",   // Clase personalizada para el icono
                    title: "swal2-title-custom", // Clase personalizada para el título
                    content: "swal2-content-custom", // Clase personalizada para el contenido de texto
                    confirmButton: "swal2-button-blur swal2-button-custom", // Clase personalizada para el botón de confirmación
                    cancelButton: "swal2-button-blur swal2-button-custom-cancel",  // Clase personalizada para el botón de cancelación
                },
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, elimina el registro
                        window.location.href = "../modulos/eliminar.php?id_carrito=' . $id . '";
                    } else {
                        // Si se hace clic en "Cancelar", redirige a la página anterior
                        history.back();
                    }
                });
            });
        </script>';
    }


$sql_libros = "SELECT carrito.id_usuario, carrito.id_carrito, carrito.id_libro, libros.id, libros.portada, libros.autor, libros.nombre, libros.sinopsis, libros.publicacion, libros.disponibilidad, libros.lenguaje, libros.genero, libros.editorial FROM libros
        INNER JOIN carrito ON libros.id = carrito.id_libro WHERE carrito.id_usuario = $idUsuario";

$stmt_libros = mysqli_query($conn,$sql_libros);
$filas_libros = mysqli_num_rows($stmt_libros);


if (isset($_POST['prestar_libro'])){
    $consulta2 = mysqli_fetch_array($stmt_libros);
    date_default_timezone_set('America/Bogota');
    $idUsuarios = $consulta2["id_usuario"];
    $idLibro = $_POST['id_libro'];
    $fechaHoy = date("Y-m-d");
    $fechaD = date('Y-m-d', strtotime('+7 day', strtotime($fechaHoy)));
    
    $qry1 = "INSERT INTO prestamos (id_usuario, id_libro, fecha_prestamo, fecha_devolucion) VALUES ('$idUsuarios', '$idLibro', '$fechaHoy', '$fechaD')";
    $resultado1 = mysqli_query($conn, $qry1);

        if($resultado1){
            $qry4 = "DELETE FROM carrito WHERE id_libro = '$idLibro' AND id_usuario = '$idUsuarios'";
            $resultado4 = mysqli_query($conn, $qry4);
            
            if ($resultado4){

                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>';
                                
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "¡Préstamo exitoso!",
                    text: "¡Gracias por usar nuestros servicios!",
                    confirmButtonText: "Cerrar",
                    confirmButtonColor: "#e7b11fCC",  // Cambia el color del botón de confirmación
                    background: "#27366e", // Fondo con transparencia
                    color: "#ffffff", // Texto blanco
                    customClass: {
                        popup: "swal2-popup-custom-2", // Clase personalizada para el popup
                        icon: "swal2-icon-custom-2",   // Clase personalizada para el icono
                        title: "swal2-title-custom-2", // Clase personalizada para el título
                        text: "swal2-content-custom-2", // Clase personalizada para el contenido de texto
                        confirmButton: "swal2-button-blur-2 swal2-button-custom-2", // Clase personalizada para el botón de confirmación
                        cancelButton: "swal2-button-blur-2 swal2-button-custom-cancel-2",  // Clase personalizada para el botón de cancelación
                        },
                }).then(function(result) {
                    if (result.isConfirmed) {
                    window.location.href = "../paginas/carrito.php"; // Redirige al usuario después de cerrar el mensaje
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
                    title: "Humm... :/",
                    text: "Parece que algo malo sucedió, vuelve a intentarlo más tarde.",
                    confirmButtonText: "Cerrar",
                    onfirmButtonColor: "#e7b11fCC",  // Cambia el color del botón de confirmación
                    background: "#27366e", // Fondo con transparencia
                    color: "#ffffff", // Texto blanco
                    customClass: {
                        popup: "swal2-popup-custom-3", // Clase personalizada para el popup
                        icon: "swal2-icon-custom-3",   // Clase personalizada para el icono
                        title: "swal2-title-custom-3", // Clase personalizada para el título
                        text: "swal2-content-custom-3", // Clase personalizada para el contenido de texto
                        confirmButton: "swal2-button-blur-3 swal2-button-custom-3, // Clase personalizada para el botón de confirmación
                        cancelButton: "swal2-button-blur-3 swal2-button-custom-cancel-3",  // Clase personalizada para el botón de cancelación
                        },
                    backdrop: false // Evita el fondo oscuro
                }).then(function(result) {
                    if (result.isConfirmed) {
                    window.location.href = "../paginas/carrito.php"; // Redirige al usuario después de cerrar el mensaje
                    }
                });
                });
                </script>';
            }
        }
        $qry5 = "UPDATE libros SET disponibilidad= '0' WHERE id = '$idLibro'";
        $resultado5 = mysqli_query($conn, $qry5);   
        
    }
/*----------------------------------------------Revistas backend------------------------------------------------------------------ */

if (isset($_GET['id_carrito_revistas'])) {
    $id = $_GET['id_carrito_revistas'];
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>';

    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡Se eliminará tu libro de favoritos!",
                icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e7b11fCC",  // Cambia el color del botón de confirmación
            cancelButtonColor: "#C98484CC",
            confirmButtonText: "Sí, bórralo",
            cancelButtonText: "Cancelar",
            background: "#27366eCC", // Fondo con transparencia
            color: "#ffffff", // Texto blanco
            customClass: {
                popup: "swal2-popup-custom", // Clase personalizada para el popup
                icon: "swal2-icon-custom",   // Clase personalizada para el icono
                title: "swal2-title-custom", // Clase personalizada para el título
                content: "swal2-content-custom", // Clase personalizada para el contenido de texto
                confirmButton: "swal2-button-blur swal2-button-custom", // Clase personalizada para el botón de confirmación
                cancelButton: "swal2-button-blur swal2-button-custom-cancel",  // Clase personalizada para el botón de cancelación
            },
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, elimina el registro
                    window.location.href = "../modulos/eliminar.php?id_carrito_revistas=' . $id . '";
                } else {
                    // Si se hace clic en "Cancelar", redirige a la página anterior
                    history.back();
                }
            });
        });
    </script>';
}

$sql_revistas = "SELECT carrito_revistas.id_usuario, carrito_revistas.id_carrito_revistas, carrito_revistas.id_revista, revistas.id, revistas.portada, revistas.autor, revistas.nombre, revistas.sinopsis, revistas.publicacion, revistas.disponibilidad, revistas.lenguaje, revistas.genero, revistas.editorial, revistas.volumen, revistas.numero FROM revistas
        INNER JOIN carrito_revistas ON revistas.id = carrito_revistas.id_revista WHERE carrito_revistas.id_usuario = $idUsuario";

$stmt_revistas = mysqli_query($conn,$sql_revistas);
$filas_revistas = mysqli_num_rows($stmt_revistas);

if (isset($_POST['prestar_revista'])){
    $consulta2 = mysqli_fetch_array($stmt_revistas);
    date_default_timezone_set('America/Bogota');
    $idUsuarios = $consulta2["id_usuario"];
    $idRevista = $_POST['id_revista'];
    $fechaHoy = date("Y-m-d");
    $fechaDI = date('Y-m-d', strtotime('+7 day', strtotime($fechaHoy)));
    
    $qry1 = "INSERT INTO prestamos_revistas (id_usuario, id_revista, fecha_prestamo, fecha_devolucion_indicada) VALUES ('$idUsuarios', '$idRevista', '$fechaHoy', '$fechaDI')";
    $resultado1 = mysqli_query($conn, $qry1);

        if($resultado1){
            $qry4 = "DELETE FROM carrito_revistas WHERE id_revista = '$idRevista' AND id_usuario = '$idUsuarios'";
            $resultado4 = mysqli_query($conn, $qry4);
            
            if ($resultado4){

                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>';
                                
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "¡Préstamo exitoso!",
                    text: "¡Gracias por usar nuestros servicios!",
                    confirmButtonText: "Cerrar",
                    confirmButtonColor: "#e7b11fCC",  // Cambia el color del botón de confirmación
                    background: "#27366e", // Fondo con transparencia
                    color: "#ffffff", // Texto blanco
                    customClass: {
                        popup: "swal2-popup-custom-2", // Clase personalizada para el popup
                        icon: "swal2-icon-custom-2",   // Clase personalizada para el icono
                        title: "swal2-title-custom-2", // Clase personalizada para el título
                        text: "swal2-content-custom-2", // Clase personalizada para el contenido de texto
                        confirmButton: "swal2-button-blur-2 swal2-button-custom-2", // Clase personalizada para el botón de confirmación
                        cancelButton: "swal2-button-blur-2 swal2-button-custom-cancel-2",  // Clase personalizada para el botón de cancelación
                        },
                }).then(function(result) {
                    if (result.isConfirmed) {
                    window.location.href = "../paginas/carrito.php"; // Redirige al usuario después de cerrar el mensaje
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
                    title: "Humm... :/",
                    text: "Parece que algo malo sucedió, vuelve a intentarlo más tarde.",
                    confirmButtonText: "Cerrar",
                    onfirmButtonColor: "#e7b11fCC",  // Cambia el color del botón de confirmación
                    background: "#27366e", // Fondo con transparencia
                    color: "#ffffff", // Texto blanco
                    customClass: {
                        popup: "swal2-popup-custom-3", // Clase personalizada para el popup
                        icon: "swal2-icon-custom-3",   // Clase personalizada para el icono
                        title: "swal2-title-custom-3", // Clase personalizada para el título
                        text: "swal2-content-custom-3", // Clase personalizada para el contenido de texto
                        confirmButton: "swal2-button-blur-3 swal2-button-custom-3, // Clase personalizada para el botón de confirmación
                        cancelButton: "swal2-button-blur-3 swal2-button-custom-cancel-3",  // Clase personalizada para el botón de cancelación
                        },
                    backdrop: false // Evita el fondo oscuro
                }).then(function(result) {
                    if (result.isConfirmed) {
                    window.location.href = "../paginas/carrito.php"; // Redirige al usuario después de cerrar el mensaje
                    }
                });
                });
                </script>';
            }
        }
        $qry5 = "UPDATE revistas SET disponibilidad= '0' WHERE id = '$idRevista'";
        $resultado5 = mysqli_query($conn, $qry5);   
        
    }
