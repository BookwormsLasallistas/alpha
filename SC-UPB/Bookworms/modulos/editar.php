<?php

$id = $_GET['id'];

include_once("../modulos/header.php");
include_once("../modulos/navbar.php");
include_once("../modulos/conexion.php");

if (isset($_GET['id'])){
  $id = $_GET['id'];
  $qry="SELECT * FROM usuarios WHERE id ='$id'";
  $resultado = mysqli_query($conn, $qry);
  if (mysqli_num_rows($resultado) == 1 ){
      $registro = mysqli_fetch_array($resultado);
      $nombre = $registro['nombre'];
      $correo = $registro['correo'];
      $clave = $registro['clave'];
      $celular = $registro['celular'];
      $id_isc = $registro['id_isc'];
      $rol = $registro['rol'];
      $grado = $registro['grado'];
    }
  }
?>


<?php 
if (isset($_POST['enviar'])){  
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $celular = $_POST['celular'];
    $id_isc = $_POST['id_isc'];
    $rol = $_POST['rol'];
    $grado = $_POST['grado'];
    
    $qry2 = "UPDATE  usuarios SET id_isc='$id_isc', rol='$rol', nombre='$nombre', correo='$correo', clave='$clave', celular='$celular', grado='$grado' WHERE id=$id";

    $resultado2 = mysqli_query($conn, $qry2);
    
    
    echo "<script>Registro actualizado :)</script>"; }
    
  
  if (isset($_POST['editar'])){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $celular = $_POST['celular'];
    $id_isc = $_POST['id_isc'];
    $rol = '0';
    $grado = $_POST['grado'];
    
    $qry2 = "UPDATE usuarios SET id_isc='$id_isc', rol='$rol', nombre='$nombre', correo='$correo', clave='$clave', celular='$celular', grado='$grado' WHERE id=$id";
    
    $resultado2 = mysqli_query($conn, $qry2);
    

    
    echo "<script>Registro actualizado :)</script>"; }
?>
 
<link rel="stylesheet" href="../styles/editar_admin.css">
<div class="bg"></div>

<br>
<?php
if ($tipoUsuario == "1"){   
?>

<div class="bg"></div>
<div class="edit mb-3">
<div class="edit-container mb-3">
<h1 class="title"><center>Editar Usuario</center></h1>
 <div class="form-edit"> 
  <form method="POST">
    <fieldset>
      <label for="user_name" class="subtitle">Nombre:</label>
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Walter White" required="required" value= "<?php echo ($registro['nombre']) ?>" >
      
      <label for="user_email" class="subtitle">Email:</label>
      <input type="email" class="form-control" id="correo" name="correo" placeholder="ejemplo@dominio.com" required="required" value= "<?php echo ($registro['correo']) ?>">
      
      <label for="user_password" class="subtitle">Clave:</label>
      <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña" required="required" value= "<?php echo ($registro['clave']) ?>">
    </fieldset>
    <fieldset class="subtitle">
      <label for="" class="form-label" class="subtitle">Teléfono:</label>
      <input type="tel" class="form-control" name="celular" id="celular " aria-describedby="helpId" required="required" placeholder="1234567890" required pattern="[0-9]{10}" maxlength="10" value= "<?php echo ($registro['celular']) ?>">
      <label for="id_isc" class="subtitle">Identificación de estudiante:</label>
      <input type="tel" class="form-control" id="id_isc" name="id_isc" placeholder="1234567890" required="required" value= "<?php echo ($registro['id_isc']) ?>">
      <label for="grado" class="subtitle">Grado</label>
      <input type="tel" class="form-control" id="grado" name="grado" placeholder="5" required="required" value= "<?php echo ($registro['grado']) ?>">
    </fieldset>

    
      <br>
      
      <h6 style="color: white;">Rol:</h6>
      
      <select name="rol" required="required" class="form-control">
          <option value="1">Admin</option>
          <option value="0">Usuario</option>
      </select>
      <br><br>
      <center><button type="submit" name="enviar" class="btn btn-outline-light form-control">Confirmar edición :)</button></center> 
      <?php 
        if (isset($_POST['enviar'])){
          echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>';
          echo '<script>
          document.addEventListener("DOMContentLoaded", function() {
          Swal.fire({
          background: "white", // Fondo transparente
              icon: "success",
              title: "¡Usuario editado de forma exitosa!",
              confirmButtonText: "Cerrar",
              backdrop: false // Evita el fondo oscuro
          }).then(function(result) {
              if (result.isConfirmed) {
              window.location.href = "../paginas/admin_usuarios.php"; // Redirige al usuario después de cerrar el mensaje
              }
          });
          });
          </script>';

  }
          ?>
  </form>
  </div>
  <div class="books">

    <div class="item">  
                        <h1>Cien años de soledad</h1>
                        <p>Fecha de prestamo: 01 / 01 / 2024</p>
                        <p>Fecha indicada de devolución: 08 / 01 / 2024</p>
                        <p>Fecha de devolución: 08 / 01 / 2024</p>
                        <p>Atraso: No</p>
                        <div class="imagen-item">
                            <img id="imagen" src="../img/Portadas/Cien años solito.jpeg" alt="" height="128" width="125">
                        </div>
                        <div class="decoration"><img src="../img/Vector decorativo.png"></div>
                    </div>
    </div>
  </div>
</div>
</div>
<?php
}

if ($tipoUsuario == "0"){
?>
<h1 style="color: white;"><center>Editar Usuario</center></h1>

<div class="bg"></div>
<form method="POST">
  <fieldset>
    <label for="user_name" style="color: white;">Nombre:</label>
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Walter White" required="required" value= "<?php echo ($registro['nombre']) ?>" >
    
    <label for="user_email" style="color: white;">Email:</label>
    <input type="email" class="form-control" id="correo" name="correo" placeholder="ejemplo@dominio.com" required="required" value= "<?php echo ($registro['correo']) ?>">
    
    <label for="user_password" style="color: white;">Clave:</label>
    <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña" required="required" value= "<?php echo ($registro['clave']) ?>">
  </fieldset>
  <fieldset>
  <label for="" class="form-label" style="color: white;">Teléfono:</label>
    <input type="tel" class="form-control" name="celular" id="celular " aria-describedby="helpId" required="required" placeholder="1234567890" required pattern="[0-9]{10}" maxlength="10" value= "<?php echo ($registro['celular']) ?>">
    <label for="id_isc" style="color: white;">Identificación de estudiante:</label>
    <input type="tel" class="form-control" id="id_isc" name="id_isc" placeholder="1234567890" required="required" value= "<?php echo ($registro['id_isc']) ?>">
    <label for="grado" style="color: white;">Grado</label>
    <input type="tel" class="form-control" id="grado" name="grado" placeholder="5" required="required" value= "<?php echo ($registro['grado']) ?>">
  </fieldset>
<br><br>
     <center><button type="submit" name="editar" class="btn btn-outline-light form-control">Confirmar edición :)</button></center> 
     <?php 
      if (isset($_POST['editar'])){
        session_start();
          if(isset($_SESSION["usuario"])){
            session_destroy();
          }
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>';
                        echo '<script>
                        document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                         background: "white", // Fondo transparente
                            icon: "success",
                            title: "¡Usuario editado de forma exitosa!",
                            text: "Para ver los cambios reflejados, vuelve a iniciar sesión.",
                            confirmButtonText: "Cerrar",
                            backdrop: false // Evita el fondo oscuro
                        }).then(function(result) {
                            if (result.isConfirmed) {
                            window.location.href = "../paginas/login.php"; // Redirige al usuario después de cerrar el mensaje
                            }
                        });
                        });
                        </script>';
        
        }
        ?>
</form>
<?php
} 
?>