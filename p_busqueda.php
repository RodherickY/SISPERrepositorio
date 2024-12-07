<?php
include("conexion.php");

$criterio = mysqli_real_escape_string($cn, $_GET['criterio']);
$tipo = $_GET['tipo'];

if ($tipo === 'persona') {
    $sql = "SELECT codigo FROM persona 
            WHERE codigo = '$criterio' OR apaterno LIKE '%$criterio%' OR amaterno LIKE '%$criterio%' OR nombre LIKE '%$criterio%'";
    $result = mysqli_query($cn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        header("Location: reportepersonafiltrado.php?codigo=" . $row['codigo']);
    } else {
        echo "<script>alert('Persona no encontrada'); window.location.href='buscarusuario.php';</script>";
    }
} elseif ($tipo === 'institucion') {
    // Buscar en la tabla de instituciones
    $sql = "SELECT codigo FROM institucion 
            WHERE codigo = '$criterio' OR nombre LIKE '%$criterio%'";
    $result = mysqli_query($cn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        header("Location: reporteinstitucionfiltrado.php?codigo=" . $row['codigo']);
    } else {
        echo "<script>alert('Institución no encontrada'); window.location.href='buscarusuario.php';</script>";
    }
} else {
    die("Error: Tipo de usuario no válido.");
}
?>