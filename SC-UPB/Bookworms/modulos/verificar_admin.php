<?php
    include_once("../modulos/conexion.php");
    include_once("header.php");
    if(isset($_SESSION["usuario"])){
        $tipoUsuario =  $_SESSION['rol'];
    }else{
        $tipoUsuario = "";
    }

    if(!isset($_SESSION["usuario"]) || $tipoUsuario == "0"){
        header("Location: http://localhost/SC-UPB/Bookworms/paginas/404.php");
        die();
    }
