<?php 
include_once("../modulos/header.php");
include_once("../modulos/navbar.php");
?>

<body>
<div class="bg"></div>
<link rel="stylesheet" href="../styles/devolucion.css">
<div class="all">
    <div class="res">
        <div class="res-titles">
            <h1>¿Cómo te pareció el libro?</h1>
            <h1>¡Déjanos una reseña!</h1>
        </div>
        <div class="container-res">
            <form action="">
                <textarea name="titulo" id="titulo" placeholder="Titulo..." required="required"></textarea>
                <textarea id="descripcion" name="descripcion" placeholder="Descripción..." required="required"></textarea>
                <textarea id="resena" name="resena" placeholder="Escribe tu reseña aquí..." required="required"></textarea>
                <div class="star-container">
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
                <button type="submit">¡Delvuélveme!</button>
            </form>
        </div>
    </div>
    <div class="devolucion">
        <div class="image-container">
            <div class="image-style">
                <img src="../img/Portadas/Cien años solito.jpeg" alt="" height="322px" width="241px">
            </div>
        </div>
    </div>
</div>
<?php 
include_once("../modulos/footer.php");
?>
</body>

