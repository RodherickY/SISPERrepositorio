<?php
include("conexion.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_bar.php');

// Consultar los datos agrupados por provincia (haciendo JOIN entre sugerencia y las tablas institucion o persona)
$sql = "
    SELECT 
        COALESCE(i.provincia, p.provincia) AS provincia, COUNT(*) AS cantidad
    FROM sugerencia s
    LEFT JOIN institucion i ON s.codigo = i.codigo
    LEFT JOIN persona p ON s.codigo = p.codigo
    GROUP BY provincia
    ORDER BY cantidad DESC
";

$result = mysqli_query($cn, $sql);

// Preparar los datos
$provincias = [];  // Provincias
$cantidades = [];  // Cantidad de sugerencias por provincia
while ($row = mysqli_fetch_assoc($result)) {
    $provincias[] = $row['provincia'];  // Nombre de la provincia
    $cantidades[] = $row['cantidad'];  // Agregar la cantidad
}

// Crear el gráfico de barras
$grafico = new Graph(600, 400);
$grafico->SetScale("textlin");

// Título del gráfico
$grafico->title->Set('Sugerencias por Provincia');

// Establecer etiquetas del eje X (provincias)
$grafico->xaxis->title->Set('Provincia');
$grafico->xaxis->SetTickLabels($provincias);

// Establecer título en el eje Y
$grafico->yaxis->title->Set('Cantidad de Sugerencias');

// Crear las barras
$barras = new BarPlot($cantidades);

// Configuración de colores (opcional)
$barras->SetFillColor('green');  // Color para las barras

// Añadir las barras al gráfico
$grafico->Add($barras);

// Mostrar el gráfico
$grafico->Stroke();
?>
