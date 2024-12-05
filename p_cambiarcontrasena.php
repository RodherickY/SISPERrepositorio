<?php

include("auth.php");
include("conexion.php");

$cod=$_SESSION["usuario"];
$pass=$_POST["txtpass"];
$repass=$_POST["txtrepass"];

if (strcmp($pass,$repass)==0) {
        if (strlen($pass)==8) {
            
            $sql="update usuario
            set password='$pass'
            where codigo='$cod'";

            mysqli_query($cn,$sql);

            header('location: cerrarsesion.php');



        } else {
            header('location: cambiarcontrasena.php');
        }
        
    


} else {
    header('location: cambiarcontrasena.php');
  
}








?>