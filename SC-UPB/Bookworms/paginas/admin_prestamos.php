<?php 
include_once("../modulos/header.php");
include_once("../modulos/navbar.php");
include_once("../modulos/conexion.php");
include_once("../modulos/verificar_admin.php");
?>

<?php
if (isset($_GET['id_prestamo'])) {

    $id_prestamo = $_GET['id_prestamo'];
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
                    window.location.href = "../modulos/eliminar.php?id_prestamo=' . $id_prestamo . '";
                } else {
                    // Si se hace clic en "Cancelar", redirige a la página anterior
                    history.back();
                }
            }); 
        });
    </script>';
}

if (isset($_GET['id_prestamo_revista'])) {

    $id_prestamo = $_GET['id_prestamo_revista'];
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
                    window.location.href = "../modulos/eliminar.php?id_prestamo_revista=' . $id_prestamo . '";
                } else {
                    // Si se hace clic en "Cancelar", redirige a la página anterior
                    history.back();
                }
            }); 
        });
    </script>';
}

?>

<link rel="stylesheet" href="../styles/admin.css">
<div class="bg"></div>

        <center><div class="p-5 mb-4 bg-outline-light rounded-3 col-md-9">
            <h1 class="text-admin"><center>Lista de Préstamos Biblioteca</center></h1>
            <div class="table-responsive">
            
            <div class="table-responsive">
            <div class="container-fluid">
            </div>

                <?php
                    $qry_libros = "SELECT * FROM prestamos JOIN usuarios ON prestamos.id_usuario = usuarios.id JOIN libros ON prestamos.id_libro = libros.id";
                    $stmt_libros = mysqli_query($conn,$qry_libros);
                    
                ?>
                <table class="table table-light table_id" id="Tabla-prestamos-libros">
                    <thead>
                        <tr class="table table-secondary tabla-header">
                            <th scope="col">Id ISC</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Libro prestado</th>
                            <th scope="col">Fecha de préstamo</th>
                            <th scope="col">Fecha de devolución indicada</th>
                            <th scope="col">Fecha de devolución</th>
                            <th scope="col"><center>Acciones</center></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while ($row = mysqli_fetch_array($stmt_libros)) {
                        ?>
                        <tr class="tabla-body">
                            <td scope="row"><?php echo $row['id_isc']; ?></td>
                            <td scope="row"><?php echo $row['correo']; ?></td>
                            <td scope="row"><?php echo $row['nombre']; ?></td>
                            <td scope="row"><?php echo $row['fecha_prestamo']; ?></td>
                            <td scope="row"><?php echo $row['fecha_devolucion_indicada']; ?></td>
                            <td scope="row"><?php echo $row['fecha_devolucion']; ?></td>
                            <td ><button type="button" class="btn btn-primary"><a href="../modulos/editar_prestamos.php?id_prestamo=<?php echo $row['id_prestamo']; ?>" ><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a></button>
                            </td>
                            <td><button type="button" class="btn btn-danger"><a href="?id_prestamo=<?php echo $row['id_prestamo']; ?>"><i class="fa-solid fa-trash-can" style="color: #ffffff;"></i></a></button>
                            </td>
                        </tr>
                        <?php }  ?>
                    </tbody>
                </table>
            </div>
        </div>
        

    </div>
    </center>

    <center><div class="p-5 mb-4 bg-outline-light rounded-3 col-md-9">
            <h1 class="text-admin"><center>Lista de Préstamos Hemeroteca</center></h1>
            <div class="table-responsive">
            
            <div class="table-responsive">
            <div class="container-fluid">
            </div>

                <?php
                    $qry_revistas = "SELECT * FROM prestamos_revistas JOIN usuarios ON prestamos_revistas.id_usuario = usuarios.id JOIN revistas ON prestamos_revistas.id_revista = revistas.id";
                    $stmt_revistas = mysqli_query($conn,$qry_revistas);
                    
                ?>
                <table class="table table-light table_id" id="Tabla-prestamos-revistas">
                    <thead>
                        <tr class="table table-secondary tabla-header">
                            <th scope="col">Id ISC</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Revista prestada</th>
                            <th scope="col">Fecha de préstamo</th>
                            <th scope="col">Fecha de devolución indicada</th>
                            <th scope="col">Fecha de devolución</th>
                            <th scope="col"><center>Acciones</center></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while ($row = mysqli_fetch_array($stmt_revistas)) {
                        ?>
                        <tr class="tabla-body">
                            <td scope="row"><?php echo $row['id_isc']; ?></td>
                            <td scope="row"><?php echo $row['correo']; ?></td>
                            <td scope="row"><?php echo $row['nombre']; ?></td>
                            <td scope="row"><?php echo $row['fecha_prestamo']; ?></td>
                            <td scope="row"><?php echo $row['fecha_devolucion_indicada']; ?></td>
                            <td scope="row"><?php echo $row['fecha_devolucion']; ?></td>
                            <td ><button type="button" class="btn btn-primary"><a href="../modulos/editar_prestamos_revistas.php?id_prestamo_revista=<?php echo $row['id_prestamo']; ?>" ><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a></button>
                            </td>
                            <td><button type="button" class="btn btn-danger"><a href="?id_prestamo_revista=<?php echo $row['id_prestamo']; ?>"><i class="fa-solid fa-trash-can" style="color: #ffffff;"></i></a></button>
                            </td>
                        </tr>
                        <?php }  ?>
                    </tbody>
                </table>
            </div>
        </div>
        

    </div>
    </center>

<script>
    $(document).ready(function() {
        $('#Tabla-prestamos-libros').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
            }
        });
    });
    $(document).ready(function() {
        $('#Tabla-prestamos-revistas').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
            }
        });
    });
</script>
<?php 
include_once("../modulos/footer.php");
?>
