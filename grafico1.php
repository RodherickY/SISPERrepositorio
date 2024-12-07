<?php
include("conexion.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_bar.php');

$sql = "SELECT u.tipo_usuario, COUNT(*) AS cantidad
        FROM sugerencia s
        JOIN usuario u ON s.codigo = u.codigo
        GROUP BY u.tipo_usuario
        ORDER BY cantidad DESC";

$result = mysqli_query($cn, $sql);

$tiposUsuario = [];  
$cantidades = [];  
while ($row = mysqli_fetch_assoc($result)) {

    if ($row['tipo_usuario'] == 1) {
        $tiposUsuario[] = 'Persona';  
    } elseif ($row['tipo_usuario'] == 2) {
        $tiposUsuario[] = 'Institución';  
    }
    
    $cantidades[] = $row['cantidad']; 
}


$grafico = new Graph(600, 400);
$grafico->SetScale("textlin");

$grafico->title->Set('Sugerencias por Tipo de Usuario');

$grafico->xaxis->title->Set('Tipo de Usuario');
$grafico->xaxis->SetTickLabels($tiposUsuario);

$grafico->yaxis->title->Set('Cantidad de Sugerencias');

$barras = new BarPlot($cantidades);

$barras->SetFillColor('blue'); 

$grafico->Add($barras);

$grafico->Stroke();
?>
