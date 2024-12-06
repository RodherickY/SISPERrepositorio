<?php
include("conexion.php");

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

// Preparar los datos para Plotly
$estados = [];
$cantidades = [];
while ($row = mysqli_fetch_assoc($result)) {
    $estados[] = $row['estado'];
    $cantidades[] = $row['cantidad'];
}
?>

<div id="graficoEstadoSugerencias"></div>
<script type="text/javascript">
var data = [
  {
    labels: <?php echo json_encode($estados); ?>,
    values: <?php echo json_encode($cantidades); ?>,
    type: 'pie'
  }
];
Plotly.newPlot('graficoEstadoSugerencias', data);
</script>
