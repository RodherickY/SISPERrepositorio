<?php
include("conexion.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_bar.php');

// Consultar los datos agrupados por tipo de usuario (haciendo JOIN entre sugerencia y usuario)
$sql = "SELECT u.tipo_usuario, COUNT(*) AS cantidad
        FROM sugerencia s
        JOIN usuario u ON s.codigo = u.codigo
        GROUP BY u.tipo_usuario
        ORDER BY cantidad DESC";

$result = mysqli_query($cn, $sql);

// Preparar los datos
$tiposUsuario = [];  // Tipos de usuario (por ejemplo, 'Persona', 'Institución')
$cantidades = [];  // Cantidad de sugerencias por tipo de usuario
while ($row = mysqli_fetch_assoc($result)) {
    // Asignar nombres personalizados según el tipo de usuario
    if ($row['tipo_usuario'] == 1) {
        $tiposUsuario[] = 'Persona';  // Si tipo_usuario es 1, se muestra "Persona"
    } elseif ($row['tipo_usuario'] == 2) {
        $tiposUsuario[] = 'Institución';  // Si tipo_usuario es 2, se muestra "Institución"
    }
    
    $cantidades[] = $row['cantidad'];  // Agregar la cantidad
}

// Crear el gráfico de barras
$grafico = new Graph(600, 400);
$grafico->SetScale("textlin");

// Título del gráfico
$grafico->title->Set('Sugerencias por Tipo de Usuario');

// Establecer etiquetas del eje X (tipos de usuario)
$grafico->xaxis->title->Set('Tipo de Usuario');
$grafico->xaxis->SetTickLabels($tiposUsuario);

// Establecer título en el eje Y
$grafico->yaxis->title->Set('Cantidad de Sugerencias');

// Crear las barras
$barras = new BarPlot($cantidades);

// Configuración de colores (opcional)
$barras->SetFillColor('blue');  // Color para las barras

// Añadir las barras al gráfico
$grafico->Add($barras);

// Mostrar el gráfico
$grafico->Stroke();
?>
