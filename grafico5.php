<?php
include("conexion.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_bar.php');

$sql = "SELECT 
            CASE 
                WHEN estado = 1 THEN 'Activas'
                WHEN estado = 0 THEN 'Eliminadas'
            END AS estado,
            COUNT(*) AS cantidad
        FROM sugerencia
        GROUP BY estado";

$result = mysqli_query($cn, $sql);


$categorias = []; 
$valores = [];    
while ($row = mysqli_fetch_assoc($result)) {
    $categorias[] = $row['estado'];  
    $valores[] = $row['cantidad']; 
}

$grafico = new Graph(600, 400, 'auto');
$grafico->SetScale('textlin');

$grafico->title->Set('Estado de las Sugerencias');
$grafico->xaxis->title->Set('Estado');
$grafico->yaxis->title->Set('Cantidad');

$grafico->xaxis->SetTickLabels($categorias);


$barras = new BarPlot($valores);

$barras->SetFillColor(['blue', 'red']);
$barras->SetWidth(50);

$grafico->Add($barras);

$grafico->Stroke();
?>
