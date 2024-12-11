<?php
// Incluir archivo de conexión y librerías necesarias
include("conexion.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_bar.php');

// Inicializar los grupos de edad y sus cantidades en 0
$grupos = ['0-17', '18-24', '25-34', '35-44', '45+'];
$cantidades = array_fill(0, count($grupos), 0);

// Consulta SQL para obtener los datos agrupados por grupos de edad
$sql = "
    SELECT 
        CASE 
            WHEN TIMESTAMPDIFF(YEAR, p.fnacimiento, CURDATE()) BETWEEN 0 AND 17 THEN '0-17'
            WHEN TIMESTAMPDIFF(YEAR, p.fnacimiento, CURDATE()) BETWEEN 18 AND 24 THEN '18-24'
            WHEN TIMESTAMPDIFF(YEAR, p.fnacimiento, CURDATE()) BETWEEN 25 AND 34 THEN '25-34'
            WHEN TIMESTAMPDIFF(YEAR, p.fnacimiento, CURDATE()) BETWEEN 35 AND 44 THEN '35-44'
            WHEN TIMESTAMPDIFF(YEAR, p.fnacimiento, CURDATE()) >= 45 THEN '45+'
            ELSE 'Desconocido'
        END AS grupo_edad,
        COUNT(*) AS cantidad
    FROM sugerencia s
    JOIN persona p ON s.codigo = p.codigo
    GROUP BY grupo_edad
    ORDER BY grupo_edad;
";

// Ejecutar la consulta y manejar posibles errores
$result = mysqli_query($cn, $sql);
if (!$result) {
    die("Error en la consulta: " . mysqli_error($cn));
}

// Actualizar las cantidades según los resultados de la consulta
while ($row = mysqli_fetch_assoc($result)) {
    $index = array_search($row['grupo_edad'], $grupos);
    if ($index !== false) {
        $cantidades[$index] = (int)$row['cantidad'];
    }
}

// Crear el gráfico
$grafico = new Graph(600, 400);
$grafico->SetScale("textlin");

// Configuración del gráfico
$grafico->title->Set('Sugerencias por Grupos de Edad');
$grafico->xaxis->title->Set('Grupo de Edad');
$grafico->yaxis->title->Set('Cantidad de Sugerencias');
$grafico->xaxis->SetTickLabels($grupos);
$grafico->xaxis->SetLabelAngle(45); // Inclinar etiquetas para mejor visibilidad

// Crear las barras
$barras = new BarPlot($cantidades);
$barras->SetFillColor('blue');
$barras->value->Show(); // Mostrar valores encima de las barras
$barras->value->SetFormat('%d'); // Formatear los valores como enteros

// Agregar las barras al gráfico
$grafico->Add($barras);

// Mostrar el gráfico
$grafico->Stroke();
?>
