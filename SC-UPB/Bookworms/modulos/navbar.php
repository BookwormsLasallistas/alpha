<?php
    include_once("../modulos/conexion.php");
    include_once("header.php");
    if(isset($_SESSION["usuario"])){
        $tipoUsuario =  $_SESSION['rol'];
    }else{
        $tipoUsuario = "";
    }
?> 
<?php
if(!isset($_SESSION["usuario"])){  // no hay sesion
?>
<nav class="Navbar">
        <input type="checkbox" id="sidebar-active">
        <label for="sidebar-active" class="open-sidebar-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"></path></svg>
        </label>
        <label id="overlay" for="sidebar-active"></label>
        <div class="links-container">
            <label for="sidebar-active" class="close-sidebar-button">
                <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"></path></svg>
            </label>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#e7b11f" class="principalLogo"><path d="M260-320q47 0 91.5 10.5T440-278v-394q-41-24-87-36t-93-12q-36 0-71.5 7T120-692v396q35-12 69.5-18t70.5-6Zm260 42q44-21 88.5-31.5T700-320q36 0 70.5 6t69.5 18v-396q-33-14-68.5-21t-71.5-7q-47 0-93 12t-87 36v394Zm-40 118q-48-38-104-59t-116-21q-42 0-82.5 11T100-198q-21 11-40.5-1T40-234v-482q0-11 5.5-21T62-752q46-24 96-36t102-12q58 0 113.5 15T480-740q51-30 106.5-45T700-800q52 0 102 12t96 36q11 5 16.5 15t5.5 21v482q0 23-19.5 35t-40.5 1q-37-20-77.5-31T700-240q-60 0-116 21t-104 59ZM280-494Z"/></svg>
            <a class="principalPage" href="http://localhost/SC-UPB/Bookworms/paginas/catalogo.php">Bookworms Lasallistas</a>
            <div class="elementos">
                <a class="nav-link active " href="http://localhost/SC-UPB/Bookworms/paginas/index.php" aria-current="page">Página Principal <span class="visually-hidden">(current)</span></a>
                <a class="nav-link active" href="http://localhost/SC-UPB/Bookworms/paginas/catalogo.php">Catálogo</a>
                <a class="nav-link active" href="../paginas/foro.php">Foro Institucional</a>
                <a class="nav-link dropdown-toggle active" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Información</a>
                <div class="dropdown-menu Dropdown" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="http://localhost/SC-UPB/Bookworms/paginas/nosotros.php">Nosotros</a>
                </div>
            </div>
            <div class="iconos">
                <a href="http://localhost/SC-UPB/Bookworms/paginas/login.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg></a>
            </div>
        </div>
    </nav>


<?php 
}  
?>

<?php
if ($tipoUsuario == "0"){   
?>


<nav class="Navbar">
        <?php

        $id = $_SESSION['id_usuario'];
        $qry = " SELECT * FROM usuarios WHERE id='$id'"; 
        $resultado = mysqli_query($conn, $qry);
        $registro = mysqli_fetch_array ($resultado);

        ?>
        <input type="checkbox" id="sidebar-active">
        <label for="sidebar-active" class="open-sidebar-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"></path></svg>
        </label>
        <label id="overlay" for="sidebar-active"></label>
        <div class="links-container">
            <label for="sidebar-active" class="close-sidebar-button">
                <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"></path></svg>
            </label>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#e7b11f" class="principalLogo"><path d="M260-320q47 0 91.5 10.5T440-278v-394q-41-24-87-36t-93-12q-36 0-71.5 7T120-692v396q35-12 69.5-18t70.5-6Zm260 42q44-21 88.5-31.5T700-320q36 0 70.5 6t69.5 18v-396q-33-14-68.5-21t-71.5-7q-47 0-93 12t-87 36v394Zm-40 118q-48-38-104-59t-116-21q-42 0-82.5 11T100-198q-21 11-40.5-1T40-234v-482q0-11 5.5-21T62-752q46-24 96-36t102-12q58 0 113.5 15T480-740q51-30 106.5-45T700-800q52 0 102 12t96 36q11 5 16.5 15t5.5 21v482q0 23-19.5 35t-40.5 1q-37-20-77.5-31T700-240q-60 0-116 21t-104 59ZM280-494Z"/></svg>
            <a class="principalPage" href="http://localhost/SC-UPB/Bookworms/paginas/catalogo.php" > Bookworms Lasallistas</a>
            <div class="elementos">
                <a class="nav-link active " href="http://localhost/SC-UPB/Bookworms/paginas/index.php" aria-current="page">Página Principal <span class="visually-hidden">(current)</span></a>
                <a class="nav-link active" href="http://localhost/SC-UPB/Bookworms/paginas/catalogo.php">Catálogo</a>
                <a class="nav-link active" href="../paginas/foro.php">Foro Institucional</a>
                <a class="nav-link dropdown-toggle active" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Información</a>
                <div class="dropdown-menu Dropdown" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="http://localhost/SC-UPB/Bookworms/paginas/nosotros.php">Nosotros</a>
                </div>
                <a class="nav-link active" href="http://localhost/SC-UPB/Bookworms/paginas/editar_usuario.php?id=<?php echo $id; ?>">
                    <i class="fa-solid fa-user fa-lg" style="color: #27366e;"></i>
                    <?php 
                        $nombre = $_SESSION['usuario'];
                        echo $nombre;
                    ?> 
                </a>
            </div>
            <div class="iconos">
                <a href="http://localhost/SC-UPB/Bookworms/modulos/cerrar_sesion.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg></a>
                <a href="http://localhost/SC-UPB/Bookworms/paginas/carrito.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M0 96C0 43 43 0 96 0l96 0 0 190.7c0 13.4 15.5 20.9 26 12.5L272 160l54 43.2c10.5 8.4 26 .9 26-12.5L352 0l32 0 32 0c17.7 0 32 14.3 32 32l0 320c0 17.7-14.3 32-32 32l0 64c17.7 0 32 14.3 32 32s-14.3 32-32 32l-32 0L96 512c-53 0-96-43-96-96L0 96zM64 416c0 17.7 14.3 32 32 32l256 0 0-64L96 384c-17.7 0-32 14.3-32 32z"/></svg></i></a>
                <a href=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 0c-17.7 0-32 14.3-32 32l0 19.2C119 66 64 130.6 64 208l0 18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416l384 0c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8l0-18.8c0-77.4-55-142-128-156.8L256 32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/></svg></a>
            </div>
        </div>
    </nav>


<?php
}        
?>


<?php
if ($tipoUsuario == "1"){   
?>

    <nav class="Navbar">
        <?php

        $id = $_SESSION['id_usuario'];
        $qry = " SELECT * FROM usuarios WHERE id='$id'"; 
        $resultado = mysqli_query($conn, $qry);
        $registro = mysqli_fetch_array ($resultado);

        ?>
        <input type="checkbox" id="sidebar-active">
        <label for="sidebar-active" class="open-sidebar-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"></path></svg>
        </label>
        <label id="overlay" for="sidebar-active"></label>
        <div class="links-container">
            <label for="sidebar-active" class="close-sidebar-button">
                <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"></path></svg>
            </label>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#e7b11f" class="principalLogo"><path d="M260-320q47 0 91.5 10.5T440-278v-394q-41-24-87-36t-93-12q-36 0-71.5 7T120-692v396q35-12 69.5-18t70.5-6Zm260 42q44-21 88.5-31.5T700-320q36 0 70.5 6t69.5 18v-396q-33-14-68.5-21t-71.5-7q-47 0-93 12t-87 36v394Zm-40 118q-48-38-104-59t-116-21q-42 0-82.5 11T100-198q-21 11-40.5-1T40-234v-482q0-11 5.5-21T62-752q46-24 96-36t102-12q58 0 113.5 15T480-740q51-30 106.5-45T700-800q52 0 102 12t96 36q11 5 16.5 15t5.5 21v482q0 23-19.5 35t-40.5 1q-37-20-77.5-31T700-240q-60 0-116 21t-104 59ZM280-494Z"/></svg>
            <a class="principalPage" href="http://localhost/SC-UPB/Bookworms/paginas/catalogo.php" > Bookworms Lasallistas</a>
            <div class="elementos">
                <a class="nav-link active " href="http://localhost/SC-UPB/Bookworms/paginas/index.php" aria-current="page">Página Principal <span class="visually-hidden">(current)</span></a>
                <a class="nav-link active" href="http://localhost/SC-UPB/Bookworms/paginas/catalogo.php">Catálogo</a>
                <a class="nav-link active" href="../paginas/foro.php">Foro Institucional</a>
                <a class="nav-link dropdown-toggle active" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Información</a>
                <div class="dropdown-menu Dropdown" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="http://localhost/SC-UPB/Bookworms/paginas/nosotros.php">Nosotros</a>
                </div>
                <a class="nav-link dropdown-toggle active" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Central Biblioteca</a>
                <div class="dropdown-menu Dropdown" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="http://localhost/SC-UPB/Bookworms/paginas/admin_libros.php">Admin Biblioteca</a>
                    <a class="dropdown-item" href="http://localhost/SC-UPB/Bookworms/paginas/admin_revistas.php">Admin Hemeroteca</a>
                    <a class="dropdown-item" href="http://localhost/SC-UPB/Bookworms/paginas/admin_prestamos.php">Admin Prestamos</a>
                    <a class="dropdown-item" href="http://localhost/SC-UPB/Bookworms/paginas/admin_usuarios.php">Admin Usuarios</a>
                </div>
                <a class="nav-link active" href="http://localhost/SC-UPB/Bookworms/paginas/editar_usuario.php?id=<?php echo $id; ?>">
                    <i class="fa-solid fa-user fa-lg" style="color: #27366e;"></i>
                    <?php 
                        $nombre = $_SESSION['usuario'];
                        echo $nombre;
                    ?> 
                </a>
            </div>
            <div class="iconos">
                <a href="http://localhost/SC-UPB/Bookworms/modulos/cerrar_sesion.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg></a>
                <a href="http://localhost/SC-UPB/Bookworms/paginas/carrito.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M0 96C0 43 43 0 96 0l96 0 0 190.7c0 13.4 15.5 20.9 26 12.5L272 160l54 43.2c10.5 8.4 26 .9 26-12.5L352 0l32 0 32 0c17.7 0 32 14.3 32 32l0 320c0 17.7-14.3 32-32 32l0 64c17.7 0 32 14.3 32 32s-14.3 32-32 32l-32 0L96 512c-53 0-96-43-96-96L0 96zM64 416c0 17.7 14.3 32 32 32l256 0 0-64L96 384c-17.7 0-32 14.3-32 32z"/></svg></i></a>
                <a href=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 0c-17.7 0-32 14.3-32 32l0 19.2C119 66 64 130.6 64 208l0 18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416l384 0c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8l0-18.8c0-77.4-55-142-128-156.8L256 32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3l-64 0-64 0c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"/></svg></a>
            </div>
        </div>
    </nav>



<?php
}        
?>

<script>
    const sidebarToggle = document.getElementById('sidebar-active');
    sidebarToggle.addEventListener('change', function() {
        if (this.checked) {
            document.body.classList.add('sidebar-open');
        } else {
            document.body.classList.remove('sidebar-open');
        }
    });
</script>
