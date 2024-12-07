<?php
include("conexion.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_pie.php');

$sql = "SELECT tipo, COUNT(*) AS cantidad
        FROM sugerencia
        GROUP BY tipo
        ORDER BY tipo";

$result = mysqli_query($cn, $sql);

$tipos = []; 
$cantidades = []; 
while ($row = mysqli_fetch_assoc($result)) {
    $tipos[] = ucfirst($row['tipo']); 
    $cantidades[] = $row['cantidad'];  
}

$grafico = new PieGraph(600, 400);
$grafico->SetShadow();


$piedata = new PiePlot($cantidades);
$piedata->SetLegends($tipos);  

$piedata->SetSliceColors(array('blue', 'green', 'orange', 'red', 'yellow'));

$grafico->title->Set('Distribución por Tipo de Sugerencia');

$grafico->Add($piedata);


$grafico->Stroke();
?>
