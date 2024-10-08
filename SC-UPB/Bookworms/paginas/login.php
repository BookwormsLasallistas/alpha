<?php 
include_once("../modulos/header.php");
include_once("../modulos/navbar.php");
include_once("../modulos/conexion.php");
?>
<link rel="stylesheet" href="../styles/login.css">
<?php 
if (isset($_POST['enviar'])){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $celular = $_POST['celular'];
    $id_isc = $_POST['id_isc'];
    $rol = '0';
    $grado = $_POST['grado'];

    $qry1 = "INSERT INTO usuarios (id_isc, rol, nombre, correo, clave, celular, grado) VALUES ('$id_isc', '$rol', '$nombre', '$correo', '$clave', '$celular', '$grado')";
    $resultado1 = mysqli_query($conn, $qry1);
}

?>
<body>
<div class="bg"></div>
    <div class="all">
        <div class="container-log" id="container">
            <div class="form-container sing-up">
                <form method="POST">
                    <h1>REGISTRO</h1>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required="required">
                    <input type="email" id="correo" name="correo" placeholder="E-mail" required="required">
                    <input type="password" id="clave" name="clave" placeholder="Clave" required="required">
                    <input type="tel" name="celular" id="celular " placeholder="Telefono" required="required">
                    <input type="tel" id="id_isc" name="id_isc" placeholder="Identificación de estudiante" required="required">
                    <select id="grado" class="form-control" name="grado">
                        <option required="required" disabled selected>Seleccionar Grado</option>
                        <option value="transición" required="required">Transición</option>
                        <option value="1" required="required">1</option>
                        <option value="2" required="required">2</option>
                        <option value="3" required="required">3</option>
                        <option value="4" required="required">4</option>
                        <option value="5" required="required">5</option>
                        <option value="6" required="required">6</option>
                        <option value="7" required="required">7</option>
                        <option value="8" required="required">8</option>
                        <option value="9" required="required">9</option>
                        <option value="10" required="required">10</option>
                        <option value="11" required="required">11</option>
                    </select>
                    <button type="submit" name="enviar" href="paginas/index.php">Registrarse</button>
                </form>
            </div>
            <div class="form-container sing-in">
                <form method="POST" action="../modulos/validar.php">
                    <h1>INICIAR SESIÓN</h1>
                    <input type="email" id="correo" name="correo" placeholder="E-mail" required="required">
                    <input type="password" id="clave" name="clave" placeholder="Clave" required="required">
                    <a href="../paginas/recuperar.php">¿Olvidaste tu contraseña?</a>
                    <button type="submit" href="">Iniciar sesión</button>
                </form> 
            </div>
            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-left">
                        <h1>¿Ya tienes una cuenta?</h1>
                        <button class="hidden" id="login">¡Inicia sesión!</button>
                    </div>
                    <div class="toggle-panel toggle-right">
                        <h1>¿No tienes una cuenta?</h1>
                        <button class="hidden" id="register">¡Registrate!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/login.js"></script>
    <?php 
    include_once("../modulos/footer.php");
    ?>
</body>