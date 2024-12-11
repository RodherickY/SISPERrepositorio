<?php
include("conexion.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_bar.php');

// Categorías predefinidas
$categoriasPredefinidas = ['Activas', 'Eliminadas'];
$valores = array_fill(0, count($categoriasPredefinidas), 0); // Inicializar valores en 0

// Consulta SQL para obtener los datos reales
$sql = "SELECT 
            CASE 
                WHEN estado = 1 THEN 'Activas'
                WHEN estado = 0 THEN 'Eliminadas'
            END AS estado,
            COUNT(*) AS cantidad
        FROM sugerencia
        GROUP BY estado";

$result = mysqli_query($cn, $sql);

// Actualizar las cantidades según los resultados de la consulta
while ($row = mysqli_fetch_assoc($result)) {
    $estado = $row['estado'];
    $index = array_search($estado, $categoriasPredefinidas);
    if ($index !== false) {
        $valores[$index] = (int)$row['cantidad'];
    }
}

// Crear el gráfico
$grafico = new Graph(600, 400, 'auto');
$grafico->SetScale('textlin');

// Configurar el gráfico
$grafico->title->Set('Estado de las Sugerencias');
$grafico->xaxis->title->Set('Estado');
$grafico->yaxis->title->Set('Cantidad');
$grafico->xaxis->SetTickLabels($categoriasPredefinidas);

// Crear las barras
$barras = new BarPlot($valores);
$barras->SetFillColor(['blue', 'red']); // Azul para "Activas", rojo para "Eliminadas"
$barras->SetWidth(50);

// Agregar las barras al gráfico
$grafico->Add($barras);

// Mostrar el gráfico
$grafico->Stroke();
?>