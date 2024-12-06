<?php
include("conexion.php");

// Verificar si los datos fueron recibidos
if (!isset($_POST['tipo']) || !isset($_POST['id']) || !isset($_POST['descripcion'])) {
    die("Datos incompletos.");
}

$tipo = $_POST['tipo']; // tipo: objetivo, resultado, politica, medida
$id = intval($_POST['id']); // ID del elemento que se va a editar
$descripcion = mysqli_real_escape_string($cn, $_POST['descripcion']); // Descripción nueva

// Definir la tabla y la columna según el tipo
switch ($tipo) {
    case 'objetivo':
        $tabla = 'objetivos';
        $columnaId = 'idobjetivo';
        $columnaDescripcion = 'descripcion';
        break;
    case 'resultado':
        $tabla = 'resultado';
        $columnaId = 'idresultado';
        $columnaDescripcion = 'descripcion';
        break;
    case 'politica':
        $tabla = 'politica';
        $columnaId = 'idpolitica';
        $columnaDescripcion = 'descripcion';
        break;
    case 'medida':
        $tabla = 'medida';
        $columnaId = 'idmedida';
        $columnaDescripcion = 'descripcion';
        break;
    default:
        die("Tipo inválido.");
}

// Actualizar en la base de datos
$sql = "UPDATE $tabla SET $columnaDescripcion = '$descripcion' WHERE $columnaId = $id";
if (mysqli_query($cn, $sql)) {
    // Si la actualización fue exitosa, redirigir a la página correspondiente
    header("Location: objetivo1admin.php");
    exit;
} else {
    // Si hubo un error en la actualización
    echo "Error al actualizar: " . mysqli_error($cn);
}

// Cerrar la conexión
mysqli_close($cn);
?>
