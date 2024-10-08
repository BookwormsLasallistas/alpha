<?php
    include('conexion.php');
    // Recibe los parámetros de los filtros seleccionados
    $disponibilidad = $_GET["disponibilidad"];
    $lenguaje = $_GET["lenguaje"];
    $editorial = $_GET["editorial"];
    $genero = $_GET["genero"];
    $calificacion = $_GET["calificacion"];

    // Realiza una consulta SQL para obtener los resultados
    $query = "SELECT * FROM libros WHERE disponibilidad = '$disponibilidad' AND lenguaje = '$lenguaje' AND editorial = '$editorial' AND genero = '$genero' AND puntuacion = '$calificacion'";
    $result = mysqli_query($conn, $query);

    // Devuelve los resultados en formato JSON
    echo json_encode($result);
