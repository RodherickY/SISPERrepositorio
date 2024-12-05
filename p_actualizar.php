<?php
include("auth.php");
include("conexion.php");

$cod = $_SESSION["usuario"];

$correo = $_POST["txtcorreo"];
$celular = $_POST["txtcelular"];
$direccion = $_POST["txtdireccion"];
$sexo = $_POST["opcsexo"];

$sql = "UPDATE datoespecifico
        SET correo = '$correo',
            telefono = '$celular',
            direccion = '$direccion',
            sexo = '$sexo',
            estado = 1
        WHERE codigo = '$cod'";

mysqli_query($cn, $sql);

header('Location: datosprincipales.php');

?>
