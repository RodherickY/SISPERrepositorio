<?php
include("conexion.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_bar.php');

$sql = "SELECT 
        COALESCE(i.provincia, p.provincia) AS provincia, COUNT(*) AS cantidad
    FROM sugerencia s
    LEFT JOIN institucion i ON s.codigo = i.codigo
    LEFT JOIN persona p ON s.codigo = p.codigo
    GROUP BY provincia
    ORDER BY cantidad DESC
";

$result = mysqli_query($cn, $sql);

$provincias = [];  
$cantidades = [];  
while ($row = mysqli_fetch_assoc($result)) {
    $provincias[] = $row['provincia'];  
    $cantidades[] = $row['cantidad'];  
}


$grafico = new Graph(600, 400);
$grafico->SetScale("textlin");

$grafico->title->Set('Sugerencias por Provincia');

$grafico->xaxis->title->Set('Provincia');
$grafico->xaxis->SetTickLabels($provincias);

$grafico->yaxis->title->Set('Cantidad de Sugerencias');

$barras = new BarPlot($cantidades);

$barras->SetFillColor('green');

$grafico->Add($barras);

$grafico->Stroke();
?>
