<?php
include("conexion.php");

include("cabeceraLogo.php");
include("barralateral.php");

if (!isset($_GET['codigo'])) {
    die("Error: Código no especificado.");
}

$codigo = mysqli_real_escape_string($cn, $_GET['codigo']);

$sql = "SELECT p.*, d.* 
        FROM persona p 
        LEFT JOIN datoespecifico d ON p.codigo = d.codigo 
        WHERE p.codigo = '$codigo'";

$result = mysqli_query($cn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    // Mostrar datos de la persona
    echo "<table border='1' align='center' style='margin: auto; '>";
    echo "<tr><td>Nombre:</td><td>{$row['nombre']} {$row['apaterno']} {$row['amaterno']}</td></tr>";
    echo "<tr><td>Provincia:</td><td>{$row['provincia']}</td></tr>";
    echo "<tr><td>Correo:</td><td>{$row['correo']}</td></tr>";
    echo "</table>";
} else {
    echo "Persona no encontrada.";
}
?>