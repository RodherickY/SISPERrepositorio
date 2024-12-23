<?php
//include("cabecera.php");
include("conexion.php");

include("cabeceraLogo.php");
include("barralateral.php");

if (!isset($_GET['codigo'])) {
    die("Error: Código no especificado.");
}

$codigo = mysqli_real_escape_string($cn, $_GET['codigo']);

$sql = "SELECT i.*, d.* 
        FROM institucion i 
        LEFT JOIN datoespecifico d ON i.codigo = d.codigo 
        WHERE i.codigo = '$codigo'";

$result = mysqli_query($cn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    // Mostrar datos de la institución
    echo "<table border='1' align='center' style='margin: auto; '>";
    echo "<tr><td>Nombre:</td><td>{$row['nombre']}</td></tr>";
    echo "<tr><td>Director:</td><td>{$row['director']}</td></tr>";
    echo "<tr><td>Provincia:</td><td>{$row['provincia']}</td></tr>";
    echo "</table>";
} else {
    echo "Institución no encontrada.";
}
?>