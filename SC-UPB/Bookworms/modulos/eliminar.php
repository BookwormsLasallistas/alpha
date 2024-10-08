<?php 
include_once("../modulos/conexion.php");
if (isset($_GET['id'])){      
    $id = $_GET['id']; 
    $qry3 = "DELETE FROM usuarios WHERE id=$id";
    $resultado3 = mysqli_query($conn, $qry3);

    if (!$resultado3) {
        die("Fallo en el borrado de la base de datos");
    } else {
        header("Location: ../paginas/admin_usuarios.php");
    }
}

if (isset($_GET['id_carrito'])){
    $id = $_GET['id_carrito'];
    $query = "DELETE FROM carrito WHERE id_carrito= $id";       /* Prepara el query para el borrado en la b.d. */
    $re = mysqli_query($conn, $query);
    if (!$re) {
        die("Fallo en el borrado de la base de datos");
    } else {
        header("Location: ../paginas/carrito.php");
    }
}

if (isset($_GET['id_carrito_revistas'])){
    $id = $_GET['id_carrito_revistas'];
    $query = "DELETE FROM carrito_revistas WHERE id_carrito_revistas= $id";       /* Prepara el query para el borrado en la b.d. */
    $re = mysqli_query($conn, $query);
    if (!$re) {
        die("Fallo en el borrado de la base de datos");
    } else {
        header("Location: ../paginas/carrito.php");
    }
}

if (isset($_GET['id_prestamo'])){
    $id_prestamo = $_GET['id_prestamo'];
    $query = "DELETE FROM prestamos WHERE id_prestamo= $id_prestamo";       /* Prepara el query para el borrado en la b.d. */
    $re = mysqli_query($conn, $query);
    if (!$re) {
        die("Fallo en el borrado de la base de datos");
    } else {
        header("Location: ../paginas/admin_prestamos.php");
    }
    
}

if (isset($_GET['id_prestamo_revista'])){
    $id_prestamo = $_GET['id_prestamo_revista'];
    $query = "DELETE FROM prestamos_revistas WHERE id_prestamo= $id_prestamo";       /* Prepara el query para el borrado en la b.d. */
    $re = mysqli_query($conn, $query);
    if (!$re) {
        die("Fallo en el borrado de la base de datos");
    } else {
        header("Location: ../paginas/admin_prestamos.php");
    }
    
}



