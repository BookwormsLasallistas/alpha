<?php 
include_once("../modulos/header.php");
include_once("../modulos/navbar.php");
include_once("../modulos/conexion.php");
include_once("../modulos/verificar_admin.php");
?>



<?php
$tipo = "revistas";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>';

    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡Se eliminará el contenido!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e7b11fCC",  // Cambia el color del botón de confirmación
            cancelButtonColor: "#C98484CC",
            confirmButtonText: "Sí, bórralo",
            cancelButtonText: "Cancelar",
            background: "#27366eCC", // Fondo con transparencia
            color: "#ffffff", // Texto blanco
            customClass: {
                    popup: "swal2-popup-custom", // Clase personalizada para el popup
                    icon: "swal2-icon-custom",   // Clase personalizada para el icono
                    title: "swal2-title-custom", // Clase personalizada para el título
                    content: "swal2-content-custom", // Clase personalizada para el contenido de texto
                    confirmButton: "swal2-button-blur swal2-button-custom", // Clase personalizada para el botón de confirmación
                    cancelButton: "swal2-button-blur swal2-button-custom-cancel",  // Clase personalizada para el botón de cancelación
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, elimina el registro
                    window.location.href = "../modulos/eliminar_catalogo.php?id=' . $id . '&tipo=' .$tipo. '";
                } else {
                    // Si se hace clic en "Cancelar", redirige a la página anterior
                    history.back();
                }
            }); 
        });
    </script>';
}



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
            echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            background: "white", // Fondo transparente
            icon: "success",
            title: "Éxito!",
            text: "¡El elemento se ha subido a la base de datos!",
            confirmButtonText: "Cerrar",
            confirmButtonColor: "#e7b11fCC",  // Cambia el color del botón de confirmación
            background: "#27366e", // Fondo con transparencia
            color: "#ffffff", // Texto blanco
            customClass: {
                popup: "swal2-popup-custom", // Clase personalizada para el popup
                icon: "swal2-icon-custom",   // Clase personalizada para el icono
                title: "swal2-title-custom", // Clase personalizada para el título
                text: "swal2-content-custom", // Clase personalizada para el contenido de texto
                confirmButton: "swal2-button-blur swal2-button-custom", // Clase personalizada para el botón de confirmación
                cancelButton: "swal2-button-blur swal2-button-custom-cancel",  // Clase personalizada para el botón de cancelación
            },    
            backdrop: false // Evita el fondo oscuro
        }).then(function(result) {
            if (result.isConfirmed) {
            window.location.href = "../paginas/admin_'.$tipo.'.php"; // Redirige al usuario después de cerrar el mensaje
            }
        });
        });
        </script>';
        } else {
            echo "Error al subir el archivo.";
        } 
    }else {
        echo "No se subió ningún archivo o hubo un error.";
    }

    $qry ="INSERT INTO revistas (nombre, autor, publicacion, sinopsis, portada, disponibilidad, lenguaje, genero, editorial, volumen, numero) VALUES ('$nombre', '$autor', '$publicacion', '$sinopsis', '$carpetaDestino', '$disponibilidad', '$lenguaje', '$genero', '$editorial', '$volumen', '$numero')";   
    $resultado = mysqli_query($conn, $qry);
}
?>

<link rel="stylesheet" href="../styles/admin.css">
<div class="bg"></div>
<center>
<div class="container-form">
    <form method="POST" action="" enctype="multipart/form-data">
    <h1 class="text-admin">Ingreso de revistas</h1>
    <fieldset>
    <label>Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required="required">
    <label>Autor: </label>
        <input type="text" class="form-control" id="autor" name="autor" required="required">
    <label>Publicación: </label>
        <input type="date" class="form-control" id="publicacion" name="publicacion" required="required">
    </fieldset>
    <fieldset>
    <label>Sinopsis: </label>
        <textarea class="form-control" name="sinopsis" id="sinopsis " aria-describedby="helpId" required="required"></textarea>
    <label>Lenguaje: </label>
    <select name="lenguaje" class="form-control">
        <option disabled selected>Escoge el lenguaje de la revista</option>
        <option value="Español" required="required">Español</option>
        <option value="Inglés" required="required">Inglés</option>
        <option value="Portugués" required="required">Portugués</option>
    </select>
    <label>Género: </label>
    <select name="genero[]" class="form-control" multiple>
        <option disabled selected>Escoge el género de la revista</option>
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
    <select name="editorial" class="form-control">
        <option disabled selected>Escoge la editorial de las revistas</option>
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
    <label for="imagen">Selecciona una imagen:</label>
        <input type="file" id="portada" name="portada" required="required" class="form-control">
    <label>Volumen:</label>
        <input type="number" class="form-control" id="nombre" name="nombre" required="required">
    <label>Número:</label>
        <input type="number" class="form-control" id="nombre" name="nombre" required="required">

    </fieldset>

    
        <br>
        
        <h6>Disponibilidad: </h6>
        
        <select name="disponibilidad" class="form-control">
            <option value="Disponible" required="required">Disponible</option>
            <option value="Ocupado/Reparación" required="required">Ocupado/Reparación</option>
        </select>
        <br><br>
        <center><button type="submit" name="enviar" class="btn btn-outline-light form-control">Ingresa libro </button></center>
    </form>
</div>
</center>
<br>

<center><div class="p-5 mb-4 bg-outline-light rounded-3 col-md-9">
            <h1 class="text-admin"><center>Lista de Revistas</center></h1>
            <div class="table-responsive">
            <div class="container-fluid">
            </div>
                <?php
                    $qry="SELECT * FROM revistas";
                    $resultado=mysqli_query($conn,$qry);
                ?>
                <table class="table table-light table_id data-dynamic-table-wrapper table-responsive display"  tabindex="0" id="Tabla-revistas">
                    <thead>
                        <tr class="table table-secondary tabla-header">
                            <th scope="col" data-only-sort-enabled scope="col">Nombre</th>
                            <th scope="col" data-only-sort-enabled scope="col">Autor</th>
                            <th scope="col" data-only-sort-enabled scope="col">Publicación</th>    
                            <th scope="col" data-only-sort-enabled scope="col">Género</th>
                            <th scope="col" data-only-sort-enabled scope="col">Editorial</th>
                            <th scope="col" data-only-sort-enabled scope="col">Volumen</th>
                            <th scope="col" data-only-sort-enabled scope="col">Número</th>
                            <th scope="col" data-only-sort-enabled scope="col">Disponibilidad</th>
                            <th scope="col" data-only-sort-enabled scope="col"></th>
                            <th scope="col" data-only-sort-enabled scope="col"><center>Acciones</center></th>
                            <th scope="col" data-only-sort-enabled scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while ($registro = mysqli_fetch_array($resultado)) {
                        ?>
                        <tr class="tabla-body">
                            <td scope="row"><?php echo $registro['nombre']; ?></td>
                            <td scope="row"><?php echo $registro['autor']; ?></td>
                            <td scope="row"><?php echo $registro['publicacion']; ?></td>
                            <td scope="row"><?php echo $registro['genero']; ?></td>
                            <td scope="row"><?php echo $registro['editorial']; ?></td>
                            <td scope="row"><?php echo $registro['volumen']; ?></td>
                            <td scope="row"><?php echo $registro['numero']; ?></td>
                            <td scope="row"><?php 
                                    if($registro['disponibilidad'] ){
                                        echo "Disponible";
                                    }else{
                                        echo "Ocupado/Reparación";
                                    }
                                ?>
                            </td>
                            <td>
                                <center><button type="button" class="btn btn-primary"><a href="../modulos/editar_<?php echo $tipo; ?>.php?id=<?php echo $registro['id']; ?>" ><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a></button></center>
                            </td>
                            <td>
                                <center><button type="button" class="btn btn-danger"><a href="?id=<?php echo $registro['id']; ?>&tipo=<?php echo $tipo;?>"><i class="fa-solid fa-trash-can" style="color: #ffffff;"></i></a></button></center>
                            </td>
                            <td>
                                <center><button type="button" class="btn btn-info inspeccionar"><a data-id="<?php echo $registro['id']; ?>" data-tipo="<?php echo $tipo;?>"><i class="fa-solid fa-magnifying-glass inspeccionar" style="color: #ffffff;"></i></a></button></center>
                            </td>
                        </tr>
                       <?php   }  ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    </center>



    <?php 
include_once("../modulos/footer.php");
?>
<script src="../js/inspeccionar_libro.js"></script>
<script>
    $(document).ready(function() {
        $('#Tabla-revistas').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
            }
        });
    });
</script>
