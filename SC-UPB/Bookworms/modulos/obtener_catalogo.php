<?php
include_once("../modulos/conexion.php");

if (isset($_GET['id']) && isset($_GET['tipo'])) {
  $tipo = $_GET['tipo'];
  $id = $_GET['id'];
  $qry = "SELECT * FROM $tipo WHERE id = '$id'";
  $resultado = mysqli_query($conn, $qry);
  $catalogo = mysqli_fetch_array($resultado);
  
  echo json_encode($catalogo);
}