<?php
include("auth.php");
include("conexion.php");

$cod = $_SESSION["usuario"];

$correo = $_POST["txtcorreo"];
$direccion = $_POST["txtdireccion"];
$celular = $_POST["txtcelular"];
$fecha = $_POST["txtfecha"];
$sexo = $_POST["opcsexo"];

$sql = "UPDATE datoespecifico
        SET correo = '$correo',
            direccion = '$direccion',
            telefono = '$celular',
            fechanacimiento = '$fecha',
            sexo = '$sexo',
            estado = 1
        WHERE codalumno = '$cod'";

mysqli_query($cn, $sql);

header('Location: principal.php');

?>
