<?php 
include_once("../modulos/header.php");
include_once("../modulos/navbar.php");
include_once("../modulos/conexion.php");

/*Paginación */

if (isset($_GET["disponibilidad"])) {
    $disponibilidad = $_GET["disponibilidad"][0];
} else {
    $disponibilidad = "all";
}

if (isset($_GET["lenguaje"])) {
    $lenguaje = $_GET["lenguaje"][0];
} else {
    $lenguaje = "all";
}

if (isset($_GET["editorial"])) {
    $editorial = $_GET["editorial"][0];
} else {
    $editorial = "all";
}

if (isset($_GET["genero"])) {
    $genero = $_GET["genero"][0];
} else {
    $genero = "all";
}

if (isset($_GET["calificacion"])) {
    $calificacion = $_GET["calificacion"][0];
} else {
    $calificacion = "all";
}

if (isset($_GET["buscar"])) {
    $buscar = $_GET["buscar"];
} else {
    $buscar = "";
}

$inicio = 0;

$rows_por_pagina = 8;

if ($disponibilidad != "all" || $lenguaje != "all" || $editorial != "all" || $genero != "all" || $calificacion != "all") {
    $query = "SELECT * FROM revistas WHERE ";
    if ($disponibilidad != "all") {
        $query .= "disponibilidad = '" . ($disponibilidad == "Disponible" ? 1 : 0) . "' AND ";
    }
    if ($lenguaje != "all") {
        $query .= "lenguaje = '" . $lenguaje . "' AND ";
    }
    if ($editorial != "all") {
        $query .= "editorial = '" . $editorial . "' AND ";
    }
    if ($genero != "all" && $genero != "") {
        $query .= "genero LIKE '%".$genero."%' AND ";
    }
    if ($calificacion != "all") {
        $query .= "puntuacion = '" . $calificacion . "' AND ";
    }
    $query = substr($query, 0, -5); // Elimina el " AND " extra al final
    $result = mysqli_query($conn, $query);

    $numero_de_rows = $result->num_rows;

    $paginas=ceil($numero_de_rows / $rows_por_pagina);

    if(isset($_GET['pagina'])){
        $id = intval($_GET['pagina']);
        $pagina = intval($_GET['pagina']) - 1;
        $inicio = $pagina * $rows_por_pagina;

        if ($inicio < 0) {
            $inicio = 0;
        }
    }else{
        $id = 1;
    }

    $query_1="SELECT * FROM revistas WHERE ";
    if ($disponibilidad != "all") {
        $query_1 .= "disponibilidad = '" . ($disponibilidad == "Disponible" ? 1 : 0) . "' AND ";
    }
    if ($lenguaje != "all") {
        $query_1 .= "lenguaje = '" . $lenguaje . "' AND ";
    }
    if ($editorial != "all") {
        $query_1 .= "editorial = '" . $editorial . "' AND ";
    }
    if ($genero != "all" && $genero != "") {
        $query_1 .= "genero LIKE '%".$genero."%' AND ";
    }
    if ($calificacion != "all") {
        $query_1 .= "puntuacion = '" . $calificacion . "' AND ";
    }
    $query_1 = substr($query_1, 0, -5); // Elimina el " AND " extra al final
    $query_1 .= " LIMIT $inicio, $rows_por_pagina";
    $resultado_limite = mysqli_query($conn, $query_1);

} elseif (isset($_GET["buscar"]) && !empty($_GET["buscar"])) {
    $buscar = $_GET["buscar"];

    $query = "SELECT * FROM revistas WHERE nombre LIKE '%$buscar%' OR autor LIKE '%$buscar%' OR genero LIKE '%$ buscar%' OR editorial LIKE '%$buscar%'";

    $result = mysqli_query($conn, $query);

    $numero_de_rows = $result->num_rows;

    $paginas=ceil($numero_de_rows / $rows_por_pagina);

    if(isset($_GET['pagina'])){
        $id = intval($_GET['pagina']);
        $pagina = intval($_GET['pagina']) - 1;
        $inicio = $pagina * $rows_por_pagina;

        if ($inicio < 0) {
            $inicio = 0;
        }
    }else{
        $id = 1;
    }

    $query_1="SELECT * FROM revistas WHERE nombre LIKE '%$buscar%' OR autor LIKE '%$buscar%' OR genero LIKE '%$buscar%' OR editorial LIKE '%$buscar%' LIMIT $inicio, $rows_por_pagina";
    $resultado_limite = mysqli_query($conn, $query_1);

} else {
    $query = "SELECT * FROM revistas";
    $result = mysqli_query($conn, $query);

    $numero_de_rows = $result->num_rows;

    $paginas=ceil($numero_de_rows / $rows_por_pagina);

    if(isset($_GET['pagina'])){
        $id = intval($_GET['pagina']);
        $pagina = intval($_GET['pagina']) - 1;
        $inicio = $pagina * $rows_por_pagina;

        if ($inicio < 0) {
            $inicio = 0;
        }
    }else{
        $id = 1;
    }

    $query_1="SELECT * FROM revistas LIMIT $inicio, $rows_por_pagina";
    $resultado_limite = mysqli_query($conn, $query_1);
}


if (!isset($_SESSION)) {
    session_start();

}

    if (isset($_GET['id'])) {
            $revistaId = $_GET["id"];
            $usuarioId = $_SESSION['id_usuario'];

            $qry2 ="INSERT INTO carrito_revistas (id_usuario, id_revista) VALUES ($usuarioId, $revistaId)";
            
            $resultado2 = mysqli_query($conn, $qry2);
            
                
                if ($resultado2) {
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>';
                        echo '<script>
                        document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                         background: "white", // Fondo transparente
                            icon: "success",
                            title: "Que lo disfrutes",
                            text: "¡Agregado a favoritos!",
                            confirmButtonText: "Cerrar",
                            backdrop: false // Evita el fondo oscuro
                        }).then(function(result) {
                            if (result.isConfirmed) {
                            window.location.href = "revistas.php"; // Redirige al usuario después de cerrar el mensaje
                            }
                        });
                        });
                        </script>';
                    } else {
                        echo '<script>
                        document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            background: "white", // Fondo transparente
                            icon: "error",
                            title: "¡Ops!... Algo ha ocurrido",
                            text: "Error al agregar a favoritos",
                            confirmButtonText: "Cerrar",
                            backdrop: false // Evita el fondo oscuro
                        }).then(function(result) {
                            if (result.isConfirmed) {
                            window.location.href = "revistas.php"; // Redirige al usuario después de cerrar el mensaje
                            }
                        });
                        });
                        </script>';
                    }
                } 
    
?>

<!-- --------------------------------------------------------LIBROS---------------------------------------------------- -->

<link rel="stylesheet" href="../styles/libro.css">
<link rel="stylesheet" href="../styles/catalogo.css">
<div class="bg"></div>

<h1 class="titulo-pagina">¡Bienvenido a la hemeroteca!</h1>

<br><br>

<!-- Agrega un contenedor para los select de filtro -->
<div>
    <div id="filters" class="filterBox">
    <form id="filtro-form" action="../paginas/revistas.php" method="get">
        <select id="disponibilidad-select" name="disponibilidad[]" class="searchSelect">
            <option disabled selected>Disponibilidades</option>
            <option value="all">Todos</option>
            <option value="Disponible">Disponibles</option>
            <option value="Ocupado">Ocupados</option>
        </select>
        <select id="lenguaje-select" name="lenguaje[]" class="searchSelect">
            <option disabled selected>Lenguajes</option>
            <option value="all">Todos</option>
            <option value="Español" required="required">Español</option>
            <option value="Inglés" required="required">Inglés</option>
            <option value="Portugués" required="required">Portugués</option>
        </select>
        <select id="editorial-select" name="editorial[]" class="searchSelect">
            <option disabled selected>Editoriales</option>
            <option value="all">Todos</option>
            <option value="Alfaomega" required="required">Alfaomega</option>
            <option value="Arango Editores" required="required">Arango Editores</option>
            <option value="Editorial Abya-Yala" required="required">Editorial Abya-Yala</option>
            <option value="Editorial Bonaventuriana" required="required">Editorial Bonaventuriana</option>
            <option value="Editorial El Espectador" required="required">Editorial El Espectador</option>
            <option value="Editorial Eafit" required="required">Editorial Eafit</option>
            <option value="Editorial La Oveja Negra" required="required">Editorial La Oveja Negra</option>
            <option value="Editorial Norma" required="required">Editorial Norma</option>
            <option value="Editorial Planeta" required="required">Editorial Planeta</option>
            <option value="Editorial Pontificia Universidad Javeriana" required="required">Editorial Pontificia Universidad Javeriana</option>
            <option value="Editorial Random House Mondadori" required="required">Editorial Random House Mondadori</option>
            <option value="Ediciones SM" required="required">Ediciones SM</option>
            <option value="Ediciones Tercer Mundo" required="required">Ediciones Tercer Mundo</option>
            <option value="Panamericana" required="required">Panamericana</option>
            <option value="Libros y Más" required="required">Libros y Más</option>
            <option value="Universidad de los Andes" required="required">Universidad de los Andes</option>
            <option value="Siglo del Hombre Editores" required="required">Siglo del Hombre Editores</option>
            <option value="Tusquets Editores" required="required">Tusquets Editores</option>
            <option value="Editorial El Jinete Azul" required="required">Editorial El Jinete Azul</option>
            <option value="Ediciones desde Abajo" required="required">Ediciones desde Abajo</option>
        </select>
        <select id="genero-select" name="genero[]" class="searchSelect">
            <option disabled selected>Géneros</option>
            <option value="all">Todos</option>
            <option value="Ciencia ficción" required="required">Ciencia ficción</option>
            <option value="Cuento" required="required">Cuento</option>
            <option value="Ensayo" required="required">Ensayo</option>
            <option value="Fábula" required="required">Fábula</option>
            <option value="Ficción histórica" required="required">Ficción histórica</option>
            <option value="Literatura infantil" required="required">Literatura infantil</option>
            <option value="Narrativa" required="required">Narrativa</option>
            <option value="Novela" required="required">Novela</option>
            <option value="Poesía" required="required">Poesía</option>
            <option value="Teatro" required="required">Teatro</option>
            <option value="Texto académico" required="required">Texto académico</option>
            <option value="Texto informativo" required="required">Texto informativo</option>
            <option value="Diccionarios" required="required">Diccionarios</option>
            <option value="Enciclopedias" required="required">Enciclopedias</option>
            <option value="Libros de texto" required="required">Libros de texto</option >
            <option value="Manuales" required="required">Manuales</option>
            <option value="Material de consulta" required="required">Material de consulta</option>
            <option value="Obras de gramática" required="required">Obras de gramática</option>
            <option value="Textos de matemáticas" required="required">Textos de matemáticas</option>
            <option value="Guías de estudio" required="required">Guías de estudio</option>
            <option value="Libros de ejercicios" required="required">Libros de ejercicios</option>
            <option value="Revistas académicas" required="required">Revistas académicas</option>
        </select>
        <select id="calificacion-select" name="calificacion[]" class="searchSelect">
            <option disabled selected>Calificaciones</option>
            <option value="all">Todos</option>
            <option value="5 estrellas">5 estrellas</option>
            <option value="4 estrellas">4 estrellas</option>
            <option value="3 estrellas">3 estrellas</option>
            <option value="2 estrellas">2 estrellas</option>
            <option value="1 estrella">1 estrella</option>
        </select>
        <br>
        <button class="filterButton disabled" type="submit">
                <i class="material-icons">
                    filter_alt
                </i>
            </button>
    </form>
    </div>

    <!-- Agrega un campo de búsqueda -->
    <form method="get">
        <div class="searchBox">
            <input class="searchInput"type="text" name="buscar" placeholder="Buscar...">
            <button class="searchButton disabled" type="submit">
                <i class="material-icons">
                    search
                </i>
            </button>
      </div>
    </form>

    <!-- Agrega un contenedor para la lista de libros -->
    <div id="products">
        <div class="row">
                <?php
                    while ($row = mysqli_fetch_array($resultado_limite)) {
                    ?>
            <div class="wrapper lista-productos">
                <div class="container">
                    <div class="">
                        <img class="portada" src="<?php echo $row["portada"]; ?>" alt="" height="300px" width="250px">
                    </div>
                    <div class="bottom">
                        <div class="left">
                            <div class="details"><br>
                                <div class ="catalogo">
                                    <a title="<?php echo $row["nombre"]; ?>"><h4><?php echo $row["nombre"]; ?></h4></a>
                                </div>
                                <p>
                                    <?php 
                                        if($row['disponibilidad'] ){
                                            echo "Disponible";
                                        }else{
                                            echo "Ocupado/Reparación";
                                        }
                                    ?>
                                </p>
                                <div class="star-container" data-rating="<?php echo $row["puntuacion"]; ?>">
                                    <div class="star-widget">
                                        <input type="radio" name="rate" id="rate-5">
                                        <label for="rate-5" class="fas fa-star"></label>
                                        <input type="radio" name="rate" id="rate-4">
                                        <label for="rate-4" class="fas fa-star"></label>
                                        <input type="radio" name="rate" id="rate-3">
                                        <label for="rate-3" class="fas fa-star"></label>
                                        <input type="radio" name="rate" id="rate-2">
                                        <label for="rate-2" class="fas fa-star"></label>
                                        <input type="radio" name="rate" id="rate-1">
                                        <label for="rate-1" class="fas fa-star"></label>
                                    </div>
                                </div>
                            </div>
                            <?php
                                if(isset($_SESSION['usuario'])){
                                    if(!$row['disponibilidad']){     
                            ?>
                                <a title="¡No estoy disponible en el momento!" href=""><i id="icon"  class="fa-regular fa-bookmark fa-xl xd" style="color: #e7b11f;"></i></a>
                            <?php
                                }else{
                            ?>
                                <a title="¡Añádeme a tus favoritos!" href="revistas.php?id=<?php echo $row['id']; ?>"><i id="icon"  class="fa-solid fa-bookmark fa-xl xd" style="color: #e7b11f;"></i></a>
                            <?php    
                                    }
                                }
                            ?>
                            <div class="decoration">
                                <img src="../img/Vector decorativo.png" width="303px">
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="inside">
                    <div class="icon">
                        <i class="material-icons">info_outline</i>
                    </div>
                    <div class="contents">
                        <table>
                            <tr>
                                <th>Autor: </th>
                            </tr>
                            <tr>
                                <td><?php echo $row["autor"]; ?></td>
                            </tr>
                            <tr>
                                <th>Públicación: </th>
                            </tr>
                            <tr>
                                <td><?php echo $row["publicacion"]; ?></td>
                            </tr>
                            <tr>
                                <th>Lenguaje: </th>
                            </tr>
                            <tr>
                                <td class="lenguaje"><?php echo $row["lenguaje"]; ?></td>
                            </tr>
                            <tr>
                                <th>Género: </th>
                            </tr>
                            <tr>
                                <td class="genero"><?php echo $row["genero"]; ?></td>
                            </tr>
                            <tr>
                                <th>Editorial: </th>
                            </tr>
                            <tr>
                                <td class="editorial"><?php echo $row["editorial"]; ?></td>
                            </tr>
                            <tr>
                                <th>Sinopsis: </th>
                            </tr>
                            <tr>
                                <td><?php echo $row["sinopsis"]; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
                <?php } ?>
        </div>
    </div>
</div>
<!-- --------------------------------------------------------PAGINACION---------------------------------------------------- -->
        <div class="page-info">
            <?php
                if(!isset($_GET['pagina'])){
                    $pagina = 1;
                }else{
                    $pagina = $_GET['pagina'];
                }
            ?>    
                
            <a>Mostrando <?php echo $pagina ?> de <?php echo $paginas ?> paginas</a>
        </div>
<nav class="paginate" aria-label="Page navigation">
    <div class="pagination">
        
        <!--Boton de anterior-->
        <?php
            if(isset($_GET['pagina']) && $_GET['pagina'] > 1){
                if (isset($_GET["disponibilidad"]) && isset($_GET["lenguaje"]) && isset($_GET["editorial"]) && isset($_GET["genero"]) && isset($_GET["calificacion"])) {
                    ?>
                    <a href="?pagina=<?php echo $_GET['pagina'] - 1?>&disponibilidad=<?php echo $disponibilidad?>&lenguaje=<?php echo $lenguaje?>&editorial=<?php echo $editorial?>&genero=<?php echo $genero?>&calificacion=<?php echo $calificacion?>" class="page-link"><<</a>
                    <?php
                } else {
                    ?>
                    <a href="?pagina=<?php echo $_GET['pagina'] - 1?>" class="page-link"><<</a>
                    <?php
                }
            }else{
                ?>
                <a class="page-link"><<</a>
                <?php
            }
        ?>
        

        <!--Botones de paginas-->
        <div class="page-numbers">
            <?php
            for($contador = 1; $contador <= $paginas; $contador++){
                ?>
                <?php
                if (isset($_GET["disponibilidad"]) && isset($_GET["lenguaje"]) && isset($_GET["editorial"]) && isset($_GET["genero"]) && isset($_GET["calificacion"]) && isset($_GET["buscar"])) {
                    ?>
                    <a href="?pagina=<?php echo $contador?>&disponibilidad=<?php echo $disponibilidad?>&lenguaje=<?php echo $lenguaje?>&editorial=<?php echo $editorial?>&genero=<?php echo $genero?>&calificacion=<?php echo $calificacion?>&buscar=<?php echo $buscar?>" class="page-link"><?php echo $contador?></a>
                    <?php
                } elseif (isset($_GET["buscar"])) {
                    ?>
                    <a href="?pagina=<?php echo $contador?>&buscar=<?php echo $buscar?>" class="page-link"><?php echo $contador?></a>
                    <?php
                } else {
                    ?>
                    <a href="?pagina=<?php echo $contador?>" class="page-link"><?php echo $contador?></a>
                    <?php
                }
                ?>
                <?php
            }
            ?>
        </div>

        <!--Boton de siguiente-->
        <?php
            if(isset($_GET['pagina'])){
                if($_GET['pagina'] >= $paginas){
                    ?> <a class="page-link">>></a> <?php
                }else{
                    if (isset($_GET["disponibilidad"]) && isset($_GET["lenguaje"]) && isset($_GET["editorial"]) && isset($_GET["genero"]) && isset($_GET["calificacion"])) {
                        ?>
                        <a href="?pagina=<?php echo $_GET['pagina'] + 1?>&disponibilidad=<?php echo $disponibilidad?>&lenguaje=<?php echo $lenguaje?>&editorial=<?php echo $editorial?>&genero=<?php echo $genero?>&calificacion=<?php echo $calificacion?>" class="page-link">>></a>
                        <?php
                    } else {
                        ?>
                        <a href="?pagina=<?php echo $_GET['pagina'] + 1?>" class="page-link">>></a>
                        <?php
                    }
                }
            }else{
                if (isset($_GET["disponibilidad"]) && isset($_GET["lenguaje"]) && isset($_GET["editorial"]) && isset($_GET["genero"]) && isset($_GET["calificacion"])) {
                    ?>
                    <a href="?pagina=2&disponibilidad=<?php echo $disponibilidad?>&lenguaje=<?php echo $lenguaje?>&editorial=<?php echo $editorial?>&genero=<?php echo $genero?>&calificacion=<?php echo $calificacion?>" class="page-link">>></a>
                    <?php
                } else {
                    ?>
                    <a href="?pagina=2" class="page-link">>></a>
                    <?php
                }
            }
        ?>

    </div>
</nav>
<script src="../js/catalogo.js"></script>



<?php 
include_once("../modulos/footer.php");

?>
