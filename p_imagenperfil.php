<?php
include("auth.php");



$cod = $_SESSION["usuario"];

$nombre = $_FILES["archivo"]["name"];
$archivo = $_FILES["archivo"]["tmp_name"];

list($n,$e) = explode(".",$nombre);

if (strtolower(trim($e))=="png") {
    //reemplazar el archivo
    move_uploaded_file($archivo,"img_sisper/".$cod.".png");
    header('location: principal.php'); 
}else {
    //redirecciona a imagenperfil
    header('location: imagenperfil.php');
}

?>





