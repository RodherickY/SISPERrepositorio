<?php
include("auth.php");
include("conexion.php");

// Obtén el código del usuario desde la sesión
$cod = $_SESSION['usuario'];

// Obtén los datos del formulario
$correo = $_POST['txtcorreo'];
$celular = $_POST['txtcelular'];
$direccion = $_POST['txtdireccion'];
$sexo = $_POST['lssexo'];


// Actualiza los datos en la base de datos
$sql = "UPDATE datoespecifico
        SET correo = '$correo',
            telefono = '$celular',
            direccion = '$direccion',
            sexo = '$sexo',          
            estado = 1
        WHERE codigo = '$cod'"; // Asegúrate de que esta columna exista

// Ejecuta la consulta y verifica si hay errores
if (!mysqli_query($cn, $sql)) {
    die("Error en la consulta: " . mysqli_error($cn));
}

// Redirige a la página principal
header('location: principal.php');
?>
