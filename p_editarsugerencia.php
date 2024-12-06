<?php
include("auth.php");

include("conexion.php");

$cod=$_SESSION["usuario"];

$idsugerencia=$_POST["idsugerencia"];

$aporte=$_POST["txtaporte"];

$sql = "UPDATE sugerencia 
        SET descripcion = '$aporte'
        WHERE idsugerencia = '$idsugerencia'";
        
mysqli_query($cn, $sql);

header('location:missugerencias.php');



?>