<?php

include_once("../modulos/header.php");
include_once("../modulos/navbar.php");
include_once("../modulos/conexion.php");
include_once("../modulos/verificar_admin.php");

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $qry="SELECT * FROM revistas WHERE id ='$id'";
    $resultado = mysqli_query($conn, $qry);
    if (mysqli_num_rows($resultado) == 1 ){
    
        $registro = mysqli_fetch_array($resultado);
        $nombre = $registro['nombre'];
        $autor = $registro['autor'];
        $publicacion = $registro['publicacion'];
        $sinopsis = $registro['sinopsis'];
        $portada = $registro['portada'];
        $disponibilidad = $registro['disponibilidad'];
        $volumen = $registro['volumen'];
        $numero = $registro['numero'];
    
    }
}


?>

<?php 
if (isset($_POST['enviar'])){
    $nombre = $_POST['nombre'];
    $autor = $_POST['autor'];
    $publicacion = $_POST['publicacion'];
    $sinopsis = $_POST['sinopsis'];
    $disponibilidad = $_POST['disponibilidad'];
    $lenguaje = $_POST['lenguaje'];
    $genero = implode(', ', $_POST['genero']);
    $editorial = $_POST['editorial'];
    $volumen = $_POST['volumen'];
    $numero = $_POST['numero'];

    if (isset($_FILES['portada']) && $_FILES['portada']['error'] === UPLOAD_ERR_OK) {

        $nombreArchivo = basename($_FILES['portada']['name']); // basename para evitar rutas maliciosas
        $tipoArchivo = $_FILES['portada']['type'];
        $tamañoArchivo = $_FILES['portada']['size'];
        $rutaTemporal = $_FILES['portada']['tmp_name'];
        $carpetaDestino = '../img/Portadas'. $nombreArchivo;

        // Verificar el tamaño del archivo
        if ($tamañoArchivo > 16000000) { // Limitar a 16MB
            echo "El archivo es demasiado grande.";
            exit();
        }

        // Verificar el tipo de archivo
        $tiposPermitidos = array("image/jpeg", "image/png", "image/jpg");
        if (!in_array($tipoArchivo, $tiposPermitidos)) {
            echo "Solo se permiten archivos JPEG, PNG o jpg.";
            exit();
        }

        // Mover el archivo subido a una ubicación permanente
        if (move_uploaded_file($rutaTemporal, $carpetaDestino)) {
            echo "El archivo ha sido subido con éxito.";
        } else {
            echo "Error al subir el archivo.";
        } 
    }else {
        echo "No se subió ningún archivo o hubo un error.";
    }

    $qry2 = "UPDATE revistas SET nombre='$nombre', autor='$autor', publicacion='$publicacion', sinopsis='$sinopsis', portada='$carpetaDestino', disponibilidad='$disponibilidad', lenguaje='$lenguaje', genero='$genero', editorial='$editorial', volumen='$volumen', numero='$numero' WHERE id='$id'";
    $resultado2 = mysqli_query($conn, $qry2);

}
?>

<link rel="stylesheet" href="../styles/editar_admin.css">
<div class="bg"></div>
<center>
<div class="container-form">
    <form method="POST" action="" enctype="multipart/form-data">
        <h1>Editar libro</h1>
        <fieldset>
        <label for="user_name">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required="required" value= "<?php echo ($registro['nombre']); ?>">
        <label for="user_email">Autor: </label>
            <input type="text" class="form-control" id="autor" name="autor" required="required" value= "<?php echo ($registro['autor']) ?>">
        <label for="user_password">Publicación: </label>
            <input type="date" class="form-control" id="publicacion" name="publicacion" required="required" value= "<?php echo ($registro['publicacion']) ?>">
        </fieldset>
        <fieldset>
        <label for="" class="form-label">Sinopsis: </label>
            <textarea class="form-control" name="sinopsis" id="sinopsis " required="required" aria-describedby="helpId"><?php echo ($registro['sinopsis']) ?></textarea>
        <label>Lenguaje: </label>
        <select name="lenguaje" class="form-control" required="required">
            <option value="Español" required="required">Español</option>
            <option value="Inglés" required="required">Inglés</option>
            <option value="Portugués" required="required">Portugués</option>
        </select>
        <label>Género: </label>
        <select name="genero[]" class="form-control" required="required" multiple>
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
            <option value="Libros de texto" required="required">Libros de texto</option>
            <option value="Manuales" required="required">Manuales</option>
            <option value="Material de consulta" required="required">Material de consulta</option>
            <option value="Obras de gramática" required="required">Obras de gramática</option>
            <option value="Textos de matemáticas" required="required">Textos de matemáticas</option>
            <option value="Guías de estudio" required="required">Guías de estudio</option>
            <option value="Libros de ejercicios" required="required">Libros de ejercicios</option>
            <option value="Revistas académicas" required="required">Revistas académicas</option>
        </select>
        <label>Editorial: </label>
        <select name="editorial" class="form-control" required="required">
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
        <label for="image">Selecciona una imagen:</label>
            <input type="file" id="portada" name="portada" required="required" class="form-control" value= "<?php echo ($registro['portada']) ?>">
        <label>Volumen:</label>
            <input type="number" class="form-control" id="volumen" name="volumen" required="required" value="<?php echo ($registro['volumen']) ?>">
        <label>Número:</label>
            <input type="number" class="form-control" id="numero" name="numero" required="required" value="<?php echo ($registro['numero']) ?>">
        </fieldset>
            <br>
            <h6 >Disponibilidad: </h6>
            <select name="disponibilidad" class="form-control">
                <option value="1">Disponible</option>
                <option value="0">Ocupado/Reparación</option>
            </select>
            <br><br>
            <center><button type="submit" name="enviar" class="btn btn-outline-light form-control">Guardar cambios</button></center>
            <?php 
            if (isset($_POST['enviar'])){
            echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
            <script type='text/javascript'>
            function redirect() {

            }
            window.onload = redirect;
            </script>";
            }
            ?>
    </form>
</div>
</center>