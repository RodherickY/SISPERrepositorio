
<?php
session_start(); // Inicia la sesión
include("conexion.php"); // Conecta con la base de datos

// Captura los datos del formulario
$usu = $_POST["txtusuario"];
$pass = $_POST["txtpass"];

// Consulta para verificar las credenciales
$sql = "SELECT * FROM usuario WHERE codigo='$usu' AND passwoard='$pass'";
$f = mysqli_query($cn, $sql); // Ejecuta la consulta
$r = mysqli_fetch_assoc($f);  // Asocia los resultados a un arreglo

if ($r) {
    // Credenciales válidas: obtén el tipo de usuario
    $tipo_usuario = $r["tipo_usuario"];
    
    // Guardar información en la sesión
    $_SESSION["usuario"] = $r["codigo"];
    $_SESSION["auth"] = 1;
    $_SESSION["tipo_usuario"] = $tipo_usuario;

    // Redirigir según el tipo de usuario
    if ($tipo_usuario == 1) {
        header('Location: prininstitucion.php'); // Página para el administrador
    } elseif ($tipo_usuario == 2) {
        header('Location: principal.php'); // Página para el usuario normal
    } else {
        header('Location: error_tipo_usuario.php'); // Si no coincide con ningún tipo conocido
    }
} else {
    // Credenciales incorrectas
    header('Location: index.php?error=1'); // Devuelve al inicio con un mensaje de error
}
?>
