<?php
include("auth.php");
include("conexion.php");

$codusuario = $_SESSION["usuario"];
$tipo = $_POST["tipo"]; 
$descripcion = $_POST["descripcion"];
$fecha = date("Y-m-d H:i:s");
$estado = "Enviado";

$sql = "INSERT INTO sugerencia (codigo, tipo, descripcion, fecha, estado) 
        VALUES ('$codusuario', '$tipo', '$descripcion', '$fecha', '$estado')";

if (mysqli_query($cn, $sql)) {
    echo "<script>alert('Mensaje enviado correctamente.'); window.location='comentario.php';</script>";
} else {
    echo "<script>alert('Error al enviar el mensaje. Intente nuevamente.'); window.location='comentario.php';</script>";
}
?>