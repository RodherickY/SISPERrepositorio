<?php

include("auth.php");

$cod=$_SESSION["usuario"];

$nombre= $_FILES["archivo"]["name"];
$archivo= $_FILES["archivo"]["tmp_name"];

list($n,$e)=explode(".",$nombre);

if (trim($e)=="png") {
    //reemplazar el archivo y redirecciona a principal
    
    move_uploaded_file($archivo, "imgusuario/".$cod.".png");
    header('location: datosprincipales.php');


} else {
    //caso contrario redireccionar a imagenperfil

    header('location: cambiarfotoperfil.php');
}










?>