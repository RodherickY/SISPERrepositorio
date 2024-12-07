<?php
include("conexion.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_pie.php');

// Consultar los datos agrupados por tipo de contenido
$sql = "SELECT tipo, COUNT(*) AS cantidad
        FROM sugerencia
        GROUP BY tipo
        ORDER BY tipo";

$result = mysqli_query($cn, $sql);

// Preparar los datos
$tipos = [];  // Tipos de sugerencia (por ejemplo, 'Queja', 'Recomendación')
$cantidades = [];  // Cantidad de sugerencias por tipo
while ($row = mysqli_fetch_assoc($result)) {
    $tipos[] = ucfirst($row['tipo']);  // Capitalizar el tipo
    $cantidades[] = $row['cantidad'];  // Agregar la cantidad
}

// Crear el gráfico de torta
$grafico = new PieGraph(600, 400);
$grafico->SetShadow();

// Crear el gráfico de torta
$piedata = new PiePlot($cantidades);
$piedata->SetLegends($tipos);  // Usar los tipos como leyendas

// Configuración de colores (opcional)
$piedata->SetSliceColors(array('blue', 'green', 'orange', 'red', 'yellow'));

// Título del gráfico
$grafico->title->Set('Distribución por Tipo de Sugerencia');

// Añadir el gráfico de torta al gráfico principal
$grafico->Add($piedata);

// Mostrar el gráfico
$grafico->Stroke();
?>
