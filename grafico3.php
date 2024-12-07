<?php
include("conexion.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_bar.php');

// Consultar los datos agrupados por grupo de edad calculado
$sql = "SELECT 
            CASE 
                WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 0 AND 17 THEN '0-17'
                WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 18 AND 24 THEN '18-24'
                WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 25 AND 34 THEN '25-34'
                WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 35 AND 44 THEN '35-44'
                WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) >= 45 THEN '45+'
                ELSE 'Desconocido'
            END AS grupo_edad,
            COUNT(*) AS cantidad
        FROM sugerencia
        GROUP BY grupo_edad
        ORDER BY grupo_edad";

$result = mysqli_query($cn, $sql);

// Preparar los datos
$grupos = [];  // Grupos de edad
$cantidades = [];  // Cantidad de sugerencias por grupo de edad
while ($row = mysqli_fetch_assoc($result)) {
    $grupos[] = $row['grupo_edad'];  // Grupo de edad (0-17, 18-24, etc.)
    $cantidades[] = $row['cantidad'];  // Agregar la cantidad
}

// Crear el gráfico de barras
$grafico = new Graph(600, 400);
$grafico->SetScale("textlin");

// Título del gráfico
$grafico->title->Set('Sugerencias por Grupo de Edad');

// Establecer etiquetas del eje X (grupos de edad)
$grafico->xaxis->title->Set('Grupo de Edad');
$grafico->xaxis->SetTickLabels($grupos);

// Establecer título en el eje Y
$grafico->yaxis->title->Set('Cantidad de Sugerencias');

// Crear las barras
$barras = new BarPlot($cantidades);

// Configuración de colores (opcional)
$barras->SetFillColor('orange');  // Color para las barras

// Añadir las barras al gráfico
$grafico->Add($barras);

// Mostrar el gráfico
$grafico->Stroke();
?>
