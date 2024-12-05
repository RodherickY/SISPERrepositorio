<?php
include("conexion.php");

// Obtener los datos enviados desde el formulario
$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];
$fnacimiento = $_POST['fnacimiento'];
$provincia = $_POST['provincia'];

// Generar la contraseña
$contrasena = generapass();

// Insertar datos en la tabla `persona`
$query_persona = "INSERT INTO persona (codigo, nombre, apaterno, amaterno, fnacimiento, provincia) 
                  VALUES ('$dni', '$nombre', '$apaterno', '$amaterno', '$fnacimiento', '$provincia')";
mysqli_query($cn, $query_persona);

// Insertar datos en la tabla `usuario`
$query_usuario = "INSERT INTO usuario (codigo, tipo_usuario, password) 
                  VALUES ('$dni', 2, '$contrasena')";
mysqli_query($cn, $query_usuario);

// Insertar datos en la tabla `datoespecifico`
$query_datoespecifico = "INSERT INTO datoespecifico (codigo) VALUES ('$dni')";
mysqli_query($cn, $query_datoespecifico);

// Redirigir o mostrar un mensaje de éxito
header('Location: registrar.php');

function generapass() {
    $plantilla = "qwertyuiopasdfghjklzxcvbnm1234567890";
    $password = "";

    for ($i = 0; $i < 8; $i++) {
        $password .= substr($plantilla, rand(0, strlen($plantilla) - 1), 1);
    }

    return $password;
}
?>
