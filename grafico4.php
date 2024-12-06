<?php
include("conexion.php");

// Consultar los datos agrupados por tipo de contenido
$sql = "SELECT tipo, COUNT(*) AS cantidad
        FROM sugerencia
        GROUP BY tipo
        ORDER BY tipo";

$result = mysqli_query($cn, $sql);

// Preparar los datos para Plotly
$tipos = [];
$cantidades = [];
while ($row = mysqli_fetch_assoc($result)) {
    $tipos[] = ucfirst($row['tipo']); // Capitalizar el tipo
    $cantidades[] = $row['cantidad'];
}
?>

<div id="graficoTipoContenido"></div>
<script type="text/javascript">
var data = [
  {
    labels: <?php echo json_encode($tipos); ?>,
    values: <?php echo json_encode($cantidades); ?>,
    type: 'pie'
  }
];
Plotly.newPlot('graficoTipoContenido', data);
</script>
