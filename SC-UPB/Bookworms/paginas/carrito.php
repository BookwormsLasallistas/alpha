<?php
include_once("../modulos/header.php");
include_once("../modulos/navbar.php");
include_once("../modulos/conexion.php");
include_once("../modulos/logica/carrito_logica.php")
?> 
<link rel="stylesheet" href="../styles/libro.css">
<div class="bg"></div>

    <br>
    <div class="row">

<!-- ---------------------------------------------------------- Libros ---------------------------------------------------------- -->

            <?php
            if ($filas_libros) {
                while ($row = mysqli_fetch_array($stmt_libros)) {
            ?>

            <div class="wrapper lista-productos">
                <div class="container">
                    <div class="">
                        <img class="portada" src="<?php echo $row["portada"]; ?>" alt="" height="300px" width="250px">
                    </div>
                    <div class="bottom">
                    <div class="left">
                        <div class="details"><br>
                            <div class ="catalogo"><a title="<?php echo $row["nombre"]; ?>"><h4><?php echo $row["nombre"]; ?></h4></a></div>
                            <p><?php 
                                                
                                                if($row['disponibilidad'] ){
                                                    echo "Disponible";
                                                }else{
                                                    echo "Ocupado/Reparación";
                                                }
                                            ?></p>
                            </div>
                        <?php
                            if(isset($_SESSION['usuario'])){
                        ?>
                            
                                <a title="¡Eliminar de favoritos!" href="carrito.php?id_carrito=<?php echo $row["id_carrito"]; ?>"><i id="icon" class="fa-regular fa-bookmark fa-xl xd" style="color: #e7b11f;"></i></a>
                            <form action="" method="POST" class="Formulario_Carrito">
                            <input type="hidden" name="id_libro" value="<?php echo $row["id_libro"]; ?>">
                            <?php if($row['disponibilidad'] ){ ?>
                            <button type="submit" class="btn_prestamo" name="prestar_libro">Préstamo</button>  
                            <?php
                            }
                            ?>
                            </form>     
                        <?php
                            }  
                        ?>
                        <div class="decoration"><img src="../img/Vector decorativo.png" width="300px"></div>
                        </div>
                    </div>
                </div>
                <div class="inside">
                    <div class="icon"><i class="material-icons">info_outline</i></div>
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
                            <td><?php echo $row["lenguaje"]; ?></td>
                        </tr>
                        <tr>
                            <th>Género: </th>
                        </tr>
                        <tr>
                            <td><?php echo $row["genero"]; ?></td>
                        </tr>
                        <tr>
                            <th>Editorial: </th>
                        </tr>
                        <tr>
                            <td><?php echo $row["editorial"]; ?></td>
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
            <?php
            }
            }else{
                echo '<center><h1 class = "title-carrito">Ops! Parece que no has agregado ningún libro a tu carrito!</h1></center>';
            }

            ?> 

<!-- ---------------------------------------------------------- Revistas ---------------------------------------------------------- -->

            <?php
            if ($filas_revistas) {
                while ($row = mysqli_fetch_array($stmt_revistas)) {
            ?>

            <div class="wrapper lista-productos">
                <div class="container">
                    <div class="">
                        <img class="portada" src="<?php echo $row["portada"]; ?>" alt="" height="300px" width="250px">
                    </div>
                    <div class="bottom">
                    <div class="left">
                        <div class="details"><br>
                            <div class ="catalogo"><a title="<?php echo $row["nombre"]; ?>"><h4><?php echo $row["nombre"]; ?></h4></a></div>
                            <p><?php 
                                                
                                                if($row['disponibilidad'] ){
                                                    echo "Disponible";
                                                }else{
                                                    echo "Ocupado/Reparación";
                                                }
                                            ?></p>
                            </div>
                        <?php
                            if(isset($_SESSION['usuario'])){
                        ?>
                            
                                <a title="¡Eliminar de favoritos!" href="carrito.php?id_carrito_revistas=<?php echo $row["id_carrito_revistas"]; ?>"><i id="icon" class="fa-regular fa-bookmark fa-xl xd" style="color: #e7b11f;"></i></a>
                            <form action="" method="POST" class="Formulario_Carrito">
                            <input type="hidden" name="id_revista" value="<?php echo $row["id_revista"]; ?>">
                            <?php if($row['disponibilidad'] ){ ?>
                            <button type="submit" class="btn_prestamo" name="prestar_revista">Préstamo</button>  
                            <?php
                            }
                            ?>
                            </form>     
                        <?php
                            }  
                        ?>
                        <div class="decoration"><img src="../img/Vector decorativo.png" width="300px"></div>
                        </div>
                    </div>
                </div>
                <div class="inside">
                    <div class="icon"><i class="material-icons">info_outline</i></div>
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
                            <td><?php echo $row["lenguaje"]; ?></td>
                        </tr>
                        <tr>
                            <th>Género: </th>
                        </tr>
                        <tr>
                            <td><?php echo $row["genero"]; ?></td>
                        </tr>
                        <tr>
                            <th>Editorial: </th>
                        </tr>
                        <tr>
                            <td><?php echo $row["editorial"]; ?></td>
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
            <?php
            }
            }else{
                echo '<center><h1 class = "title-carrito">Ops! Parece que no has agregado ninguna revista a tu carrito!</h1></center>';
            }
            ?> 
    </div>
<?php
    include_once("../modulos/footer.php");
?>
