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
        
        
    echo "<script>Registro actualizado :)</script>"; 
}
        
      
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
        
    
        
        echo "<script>Registro actualizado :)</script>"; 
    }
?>

<body>
<link rel="stylesheet" href="../styles/editar_usuario.css">
<div class="bg"></div>
<?php
if ($tipoUsuario == "1"){   
?>
<div class="all">
    <div class="edit-container">
        <div class="left-container">
            <div class="header-container">
                <i class="fa-solid fa-user fa-lg" style="color: #27366e; font-size: 150px;"></i>
                <h1><?php echo ($registro['nombre']) ?></h1>
            </div>
            <div class="form-container">
                <form method="POST">
                <h1 id="Titulo">Información de Usuario</h1>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required="required" value="<?php echo ($registro['nombre']) ?>">
                    <input type="email" id="correo" name="correo" placeholder="E-mail" required="required" value="<?php echo ($registro['correo']) ?>">
                    <input type="password" id="clave" name="clave" placeholder="Clave" required="required" value="<?php echo ($registro['clave']) ?>">
                    <input type="tel" name="celular" id="celular " placeholder="Telefono" required="required" required pattern="[0-9]{10}" maxlength="10" value="<?php echo ($registro['celular']) ?>">
                    <input type="tel" id="id_isc" name="id_isc" placeholder="Identificación de estudiante" required="required" value="<?php echo ($registro['id_isc']) ?>">
                    <select id="grado" class="form-control" name="grado">
                        <option required="required" disabled selected>Seleccionar Grado</option>
                        <option value="transición" required="required" <?php echo $grado == 'transición' ? 'selected' : ''; ?>>Transición</option>
                        <option value="1" required="required" <?php echo $grado == '1' ? 'selected' : ''; ?>>1</option>
                        <option value="2" required="required" <?php echo $grado == '2' ? 'selected' : ''; ?>>2</option>
                        <option value="3" required="required" <?php echo $grado == '3' ? 'selected' : ''; ?>>3</option>
                        <option value="4" required="required" <?php echo $grado == '4' ? 'selected' : ''; ?>>4</option>
                        <option value="5" required="required" <?php echo $grado == '5' ? 'selected' : ''; ?>>5</option>
                        <option value="6" required="required" <?php echo $grado == '6' ? 'selected' : ''; ?>>6</option>
                        <option value="7" required="required" <?php echo $grado == '7' ? 'selected' : ''; ?>>7</option>
                        <option value="8" required="required" <?php echo $grado == '8' ? 'selected' : ''; ?>>8</option>
                        <option value="9" required="required" <?php echo $grado == '9' ? 'selected' : ''; ?>>9</option>
                        <option value="10" required="required" <?php echo $grado == '10' ? 'selected' : ''; ?>>10</option>
                        <option value="11" required="required" <?php echo $grado == '11' ? 'selected' : ''; ?>>11</option>
                    </select>
                    <select name="rol" class="form-control">
                        <option value="0" required="required">Administrador</option>
                        <option value="1" required="required">Usuario</option>
                    </select>
                    <button type="submit" name="enviar" href="paginas/index.php">Editar</button>
                </form>
                <?php 
                    if (isset($_POST['enviar'])){
                        echo '<script src="../js/main.js"></script>';
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
                            window.location.href = "../paginas/admin_usuarios.php"; // Redirige al usuario después de cerrar el mensaje
                            }
                        });
                        });
                        </script>';
                        }
                        ?>
            </div>
        </div>
        <div class="right-container">
            <div class="inside">
                <div class="title">
                    <h1>Préstamos y reseñas</h1>
                </div>
                <div class="resenas">
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
</div>
<?php
}

if ($tipoUsuario == "0"){
?>
<div class="all">
    <div class="edit-container">
        <div class="left-container">
            <div class="header-container">
                <i class="fa-solid fa-user fa-lg" style="color: #27366e; font-size: 150px;"></i>
                <h1><?php echo ($registro['nombre']) ?></h1>
            </div>
            <div class="form-container">
                <form method="POST">
                    <h1 id="Titulo">Información de Usuario</h1>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required="required" value="<?php echo ($registro['nombre']) ?>">
                    <input type="email" id="correo" name="correo" placeholder="E-mail" required="required" value="<?php echo ($registro['correo']) ?>">
                    <input type="password" id="clave" name="clave" placeholder="Clave" required="required" value="<?php echo ($registro['clave']) ?>">
                    <input type="tel" name="celular" id="celular " placeholder="Telefono" required="required" required pattern="[0-9]{10}" maxlength="10" value="<?php echo ($registro['celular']) ?>">
                    <input type="tel" id="id_isc" name="id_isc" placeholder="Identificación de estudiante" required="required" value="<?php echo ($registro['id_isc']) ?>">
                    <select id="grado" class="form-control" name="grado">
                        <option required="required" disabled selected>Seleccionar Grado</option>
                        <option value="transición" required="required" <?php echo $grado == 'transición' ? 'selected' : ''; ?>>Transición</option>
                        <option value="1" required="required" <?php echo $grado == '1' ? 'selected' : ''; ?>>1</option>
                        <option value="2" required="required" <?php echo $grado == '2' ? 'selected' : ''; ?>>2</option>
                        <option value="3" required="required" <?php echo $grado == '3' ? 'selected' : ''; ?>>3</option>
                        <option value="4" required="required" <?php echo $grado == '4' ? 'selected' : ''; ?>>4</option>
                        <option value="5" required="required" <?php echo $grado == '5' ? 'selected' : ''; ?>>5</option>
                        <option value="6" required="required" <?php echo $grado == '6' ? 'selected' : ''; ?>>6</option>
                        <option value="7" required="required" <?php echo $grado == '7' ? 'selected' : ''; ?>>7</option>
                        <option value="8" required="required" <?php echo $grado == '8' ? 'selected' : ''; ?>>8</option>
                        <option value="9" required="required" <?php echo $grado == '9' ? 'selected' : ''; ?>>9</option>
                        <option value="10" required="required" <?php echo $grado == '10' ? 'selected' : ''; ?>>10</option>
                        <option value="11" required="required" <?php echo $grado == '11' ? 'selected' : ''; ?>>11</option>
                    </select>
                    <button type="submit" name="editar" href="paginas/index.php">Editar</button>
                </form>
                <?php 
                    if (isset($_POST['editar'])){
                        if(isset($_SESSION["usuario"])){
                            session_destroy();
                        }
                        echo '<script src="../js/main.js"></script>';
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
            </div>
        </div>
        <div class="right-container">
            <div class="inside">
                <div class="title">
                    <h1>Préstamos y reseñas</h1>
                </div>
                <div class="resenas">
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
</div>
<?php
} 
?>
<?php 
include_once("../modulos/footer.php");
?>
</body>