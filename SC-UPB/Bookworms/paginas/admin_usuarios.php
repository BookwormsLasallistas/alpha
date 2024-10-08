<?php 
include_once("../modulos/header.php");
include_once("../modulos/navbar.php");
include_once("../modulos/conexion.php");
include_once("../modulos/verificar_admin.php");
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

    $qry1 = "INSERT INTO usuarios (id_isc, rol, nombre, correo, clave, celular, grado) VALUES ('$id_isc', '$rol', '$nombre', '$correo', '$clave', '$celular', '$grado')";
    $resultado1 = mysqli_query($conn, $qry1);
    echo "<script> ";
}
?>
<link rel="stylesheet" href="../styles/admin.css">
<div class="bg"></div>

        <center><div class="p-5 mb-4 bg-outline-light rounded-3 col-md-9">
            <h1 class="text-admin"><center>Lista de Usuarios</center></h1>
            <div class="table-responsive">
            
            <div class="table-responsive">
            <div class="container-fluid">
            </div>

                <?php
                    $qry="SELECT * FROM usuarios";
                    $resultado=mysqli_query($conn,$qry);
                ?>
                <table class="table tabla-users" id="Tabla-usuarios">
                    <thead>
                        <tr class="table tabla-header">
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Id ISC</th>
                            <th scope="col">Grado</th>
                            <th scope="col">Rol</th>
                            <th scope="col"><center>Acciones</center></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while ($registro = mysqli_fetch_array($resultado)) {
                        ?>
                        <tr class="tabla-body">
                            <td scope="row"><?php echo $registro['nombre']; ?></td>
                            <td><?php echo $registro['correo']; ?></td>
                            <td><?php echo $registro['celular']; ?></td>
                            <td><?php echo $registro['id_isc']; ?></td>
                            <td><?php echo $registro['grado']; ?></td>
                            <td><?php 
                                    if($registro['rol'] ){
                                        echo "Admin";
                                    }else{
                                        echo "Usuario";
                                    }
                                 ?></td>
                            <td ><button type="button" class="btn btn-primary"><a href="../paginas/editar_usuario.php?id=<?php echo $registro['id']; ?>"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a></button>
                            </td>
                            <td><button type="button" class="btn btn-danger"><a href="?id=<?php echo $registro['id']; ?>"><i class="fa-solid fa-trash-can" style="color: #ffffff;"></i></a></button>
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
            willOpen: () => {
                // Aplicar estilo adicional cuando se abre el modal
                const popup = Swal.getPopup();
                popup.style.backdropFilter = "blur(2px)"; // Fondo borroso
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, elimina el registro
                window.location.href = "../modulos/eliminar.php?id=' . $id . '";
            } else {
                // Si se hace clic en "Cancelar", redirige a la página anterior
                history.back();
            }
        }); 
    });
</script>';
}
?>
<script>
    $(document).ready(function() {
        $('#Tabla-usuarios').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
            }
        });
    });
</script>
<?php 
include_once("../modulos/footer.php");
?>
