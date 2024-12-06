<?php
include("conexion.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_bar.php');

// Consultar los datos agrupados por estado
$sql = "SELECT 
            CASE 
                WHEN estado = 1 THEN 'Activas'
                WHEN estado = 0 THEN 'Eliminadas'
            END AS estado,
            COUNT(*) AS cantidad
        FROM sugerencia
        GROUP BY estado";

$result = mysqli_query($cn, $sql);

// Preparar los datos
$categorias = []; // Etiquetas de las barras (Activas, Eliminadas)
$valores = [];    // Cantidad correspondiente a cada categoría
while ($row = mysqli_fetch_assoc($result)) {
    $categorias[] = $row['estado'];  // 'Activas' o 'Eliminadas'
    $valores[] = $row['cantidad'];  // Cantidad de cada estado
}

// Crear el gráfico
$grafico = new Graph(600, 400, 'auto');
$grafico->SetScale('textlin');

// Configurar títulos
$grafico->title->Set('Estado de las Sugerencias');
$grafico->xaxis->title->Set('Estado');
$grafico->yaxis->title->Set('Cantidad');

// Configurar etiquetas del eje X
$grafico->xaxis->SetTickLabels($categorias);

// Crear el plot de barras
$barras = new BarPlot($valores);

// Configuración de las barras
$barras->SetFillColor(['blue', 'red']); // Azul para Activas, Rojo para Eliminadas
$barras->SetWidth(50); // Ancho de las barras

// Añadir el plot al gráfico
$grafico->Add($barras);

// Mostrar el gráfico
$grafico->Stroke();
?>
