<?php
include("conexion.php");
session_start(); // Asegurarnos de que las sesiones estén iniciadas

// Verificar si los datos fueron recibidos
if (!isset($_POST['tipo']) || !isset($_POST['id']) || !isset($_POST['comentario'])) {
    die("Datos incompletos.");
}

$tipo = $_POST['tipo']; // tipo: objetivo, resultado, politica, medida
$idElemento = intval($_POST['id']); // ID del elemento
$comentario = mysqli_real_escape_string($cn, $_POST['comentario']); // Comentario del usuario
$codigo = isset($_SESSION['codigo']) ? $_SESSION['codigo'] : 'Desconocido'; // Código de sesión

// Insertar la sugerencia en la base de datos
$sql = "INSERT INTO sugerencias (codigo, tipo, id_elemento, descripcion, fecha, estado) 
        VALUES ('$codigo', '$tipo', $idElemento, '$comentario', NOW(), 1)";

if (mysqli_query($cn, $sql)) {
    // Si la sugerencia fue guardada con éxito, redirigir al administrador
    header("Location: objetivo1admin.php"); // Redirigir a la página principal del administrador
    exit;
} else {
    // Si hubo un error en la inserción
    echo "Error al guardar la sugerencia: " . mysqli_error($cn);
}

// Cerrar la conexión
mysqli_close($cn);
?>
