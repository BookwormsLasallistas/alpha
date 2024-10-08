<?php 
include_once("../modulos/conexion.php");
if (isset($_GET['id']) && isset($_GET['tipo'])){      
    $id = $_GET['id'];
    $tipo = $_GET['tipo'];

    $qry3 = "DELETE FROM $tipo WHERE id=$id";
    $resultado3 = mysqli_query($conn, $qry3);

    if (!$resultado3) {
        die("Fallo en el borrado de la base de datos");
    } else {
        header("Location: ../paginas/admin_".$tipo.".php");
    }
}

?>