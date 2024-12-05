<?php
include("conexion.php");

// Obtener los datos enviados desde el formulario
$num_institucion = $_POST['numinstitucion'];
$nombre = $_POST['nombre'];
$provincia = $_POST['provincia'];
$director = $_POST['director'];
$nalumnos = $_POST['nalumnos'];
$ndocentes = $_POST['ndocentes'];
$nadministrativos = $_POST['nadministrativos'];

// Generar la contraseña
$contrasena = generapass();

// Insertar datos en la tabla `institucion`
$query_institucion = "INSERT INTO institucion(codigo, nombre, provincia, director, nalumnos, ndocentes, nadministrativos) 
                      VALUES ('$num_institucion', '$nombre', '$provincia', '$director', $nalumnos, $ndocentes, $nadministrativos)";
mysqli_query($cn, $query_institucion);

// Insertar datos en la tabla `usuario`
$query_usuario = "INSERT INTO usuario(codigo, tipo_usuario, password) 
                  VALUES ('$num_institucion',1, '$contrasena')";
mysqli_query($cn, $query_usuario);

// Insertar datos en la tabla 'datoespecifico'
$query_especifico = "INSERT INTO datoespecifico(codigo) VALUES ('$num_institucion')";
mysqli_query($cn, $query_especifico);

// Redirigir o mostrar un mensaje de éxito
header('location: registrar.php');

function generapass() {
    $plantilla = "qwertyuiopasdfghjklzxcvbnm1234567890";
    $password = "";

    for ($i = 0; $i < 8; $i++) {
        $password .= substr($plantilla, rand(0, strlen($plantilla) - 1), 1);
    }

    return $password;
}
?>
