<?php


include("conexion.php");

$id = $_GET["id"];

$sql = "UPDATE sugerencia 
        SET estado = 2
        WHERE idsugerencia = '$id'";
        
mysqli_query($cn, $sql);

header('location:missugerencias.php');



?>