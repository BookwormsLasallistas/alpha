<?php

include_once("../modulos/header.php");
include_once("../modulos/navbar.php");
include_once("../modulos/conexion.php");
include_once("../modulos/verificar_admin.php");

if (isset($_GET['id_prestamo'])){
    $id = $_GET['id_prestamo'];
    $qry="SELECT * FROM prestamos WHERE id_prestamo ='$id'";
    $resultado = mysqli_query($conn, $qry);
    if (mysqli_num_rows($resultado) == 1 ){
        $registro = mysqli_fetch_array($resultado);
        $fechaHoy = $registro['fecha_prestamo'];
        $fechaD = $registro['fecha_devolucion'];
        
    }
}


?>

<?php 
if (isset($_POST['enviar'])){
    $fechaHoy = $_POST['fechaHoy'];
    $fechaD = $_POST['fechaD'];

    $qry2 = "UPDATE prestamos SET fecha_prestamo='$fechaHoy', fecha_devolucion='$fechaD' WHERE id_prestamo='$id'";
    $resultado2 = mysqli_query($conn, $qry2);

}
?>
 
<div class="bg"></div>
<link rel="stylesheet" href="../styles/editar_admin.css">

<center>
    <div class="container-form">
        <form method="POST" action="">
            <h1>Editar Préstamo</h1>
            <fieldset>
            <label for="user_name">Fecha del préstamo:</label>
                <input type="text" class="form-control" id="fechaHoy" name="fechaHoy" required="required" value= "<?php echo ($registro['fecha_prestamo']); ?>">
            <label for="user_email">Fecha de devolución: </label>
                <input type="text" class="form-control" id="fechaD" name="fechaD" required="required" value= "<?php echo ($registro['fecha_devolucion']) ?>">
            </fieldset>
            <br><br>
            <center><button type="submit" name="enviar" class="btn btn-outline-light form-control">Guardar cambios</button></center>
            <?php 
            if (isset($_POST['enviar'])){
            echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
            <script type='text/javascript'>
            function redirect() {
                window.location = '../paginas/admin_prestamos.php';
            }
            window.onload = redirect;
            </script>";
            }
            ?>
        </form>
    </div>
</center>