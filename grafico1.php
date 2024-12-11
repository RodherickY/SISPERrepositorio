<?php
include("conexion.php");
require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_bar.php');

// Inicializar los tipos de usuario y cantidades en 0
$tiposUsuario = ['Persona', 'Institución'];
$cantidades = [0, 0];

// Consulta SQL
$sql = "
    SELECT u.tipo_usuario, COUNT(*) AS cantidad
    FROM sugerencia s
    JOIN usuario u ON s.codigo = u.codigo
    GROUP BY u.tipo_usuario
    ORDER BY u.tipo_usuario;
";

$result = mysqli_query($cn, $sql);

// Actualizar las cantidades según los resultados
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['tipo_usuario'] == 2) {
        $cantidades[0] = (int)$row['cantidad']; // Persona
    } elseif ($row['tipo_usuario'] == 1) {
        $cantidades[1] = (int)$row['cantidad']; // Institución
    }
}

// Crear el gráfico
$grafico = new Graph(600, 400);
$grafico->SetScale("textlin");

// Configuración del gráfico
$grafico->title->Set('Sugerencias por Tipo de Usuario');
$grafico->xaxis->title->Set('Tipo de Usuario');
$grafico->xaxis->SetTickLabels($tiposUsuario);

$grafico->yaxis->title->Set('Cantidad de Sugerencias');

// Crear las barras
$barras = new BarPlot($cantidades);
$barras->SetFillColor('blue');
$barras->value->Show();
$barras->value->SetFormat('%d');

// Agregar las barras al gráfico
$grafico->Add($barras);

// Mostrar el gráfico
$grafico->Stroke();
?>