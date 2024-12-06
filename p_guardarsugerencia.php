<?php
include("conexion.php");

$codigo = $_POST["codigo"]; // Código de la persona/institución
$tipo = $_POST["tipo"];     // Tipo: objetivo, resultado, política o medida
$id = $_POST["id"];         // ID del elemento seleccionado
$descripcion = $_POST["comentario"]; // Comentario o sugerencia

// Definir tabla y columna para obtener el contenido del elemento
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
}

// Consultar contenido del elemento
$sqlItem = "SELECT $columnaDescripcion FROM $tabla WHERE $columnaId = $id";

$resultItem = mysqli_query($cn, $sqlItem);

$rowItem = mysqli_fetch_assoc($resultItem);

$item = $rowItem[$columnaDescripcion];

// Insertar la sugerencia en la base de datos
$sql = "INSERT INTO sugerencia (codigo, tipo, descripcion, item, fecha, estado) 
        VALUES ('$codigo', '$tipo', '$descripcion', '$item', NOW(), 1)";

mysqli_query($cn, $sql);

mysqli_close($cn);

header('location: missugerencias.php');
?>
