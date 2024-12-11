<?php
include("conexion.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_bar.php');

// Inicializar las provincias y sus cantidades en 0
$provincias = ["Barranca", "Cajatambo", "Canta", "Cañete", "Huaral", "Huarochiri", "Huaura", "Oyon", "Yauyos"];
$cantidades = array_fill(0, count($provincias), 0);

// Consulta SQL
$sql = "
    SELECT 
        COALESCE(i.provincia, p.provincia) AS provincia, COUNT(*) AS cantidad
    FROM sugerencia s
    LEFT JOIN institucion i ON s.codigo = i.codigo
    LEFT JOIN persona p ON s.codigo = p.codigo
    GROUP BY provincia
    ORDER BY cantidad DESC;
";

$result = mysqli_query($cn, $sql);

// Actualizar las cantidades según los resultados
while ($row = mysqli_fetch_assoc($result)) {
    $index = array_search($row['provincia'], $provincias);
    if ($index !== false) {
        $cantidades[$index] = (int)$row['cantidad'];
    }
}

// Crear el gráfico
$grafico = new Graph(600, 400);
$grafico->SetScale("textlin");

// Configuración del gráfico
$grafico->title->Set('Sugerencias por Provincia');
$grafico->xaxis->title->Set('Provincia');
$grafico->xaxis->SetTickLabels($provincias);
$grafico->xaxis->SetLabelAngle(45); // Inclinar etiquetas para mejor visibilidad
$grafico->yaxis->title->Set('Cantidad de Sugerencias');

// Crear las barras
$barras = new BarPlot($cantidades);
$barras->SetFillColor('green');
$barras->value->Show();
$barras->value->SetFormat('%d'); // Mostrar valores como enteros

// Agregar las barras al gráfico
$grafico->Add($barras);

// Mostrar el gráfico
$grafico->Stroke();
?>
