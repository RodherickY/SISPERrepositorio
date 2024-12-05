<?php
//filtro de seguridad para usuarios identificados
session_start();// inicia la sesion

if ($_SESSION["auth"]!=1) { // si el dato es diferente de 1 redirecciona al login

    header("location: index.php");
    exit();// cierra el script
    
}

?>
