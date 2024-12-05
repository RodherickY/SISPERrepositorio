<?php
session_start();
include("conexion.php");


$usu=$_POST["txtusuario"];
$pass=$_POST["txtpass"];



$sql="select * from usuario where codigo='$usu' and password='$pass'";


$f=mysqli_query($cn,$sql);
$r=mysqli_fetch_assoc($f);

$valor=$r["codigo"];

if ($valor==null) {

   header('location:index.php');

}else {
    $_SESSION["usuario"] = $valor;
    $_SESSION["auth"] = 1;
    if($valor== "admin001"){
        header('location:principalAdmin.php');
    }else{
        header('location:principal.php');
    }
    }
   
   

?>