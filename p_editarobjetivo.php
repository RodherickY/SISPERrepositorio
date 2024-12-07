<?php
include("conexion.php");

$tipo = $_POST['tipo']; 
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];

switch ($tipo) {
    case 'objetivo':
        $tabla = 'objetivos';
        $columnaDescripcion = 'descripcion';
        $columnaId = 'idobjetivo';
        break;
    case 'resultado':
        $tabla = 'resultado';
        $columnaDescripcion = 'descripcion';
        $columnaId = 'idresultado';
        break;
    case 'politica':
        $tabla = 'politica';
        $columnaDescripcion = 'descripcion';
        $columnaId = 'idpolitica';
        break;
    case 'medida':
        $tabla = 'medida';
        $columnaDescripcion = 'descripcion';
        $columnaId = 'idmedida';
        break;
    default:
        die("Tipo inválido.");
}

$sql = "UPDATE $tabla SET $columnaDescripcion = '$descripcion' WHERE $columnaId = $id";

if (mysqli_query($cn, $sql)) {
    header("Location: objetivo1admin.php");
} else {
    echo "Error al actualizar: " . mysqli_error($cn);
}
mysqli_close($cn);
?>
