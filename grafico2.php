<?php
include("conexion.php");

// Consultar los datos agrupados por provincia
$sql = "SELECT provincia, COUNT(*) AS cantidad
        FROM sugerencia
        GROUP BY provincia
        ORDER BY cantidad DESC";

$result = mysqli_query($cn, $sql);

// Preparar los datos para Plotly
$provincias = [];
$cantidades = [];
while ($row = mysqli_fetch_assoc($result)) {
    $provincias[] = $row['provincia']; // Nombre de la provincia
    $cantidades[] = $row['cantidad'];
}
?>

<div id="graficoProvincia"></div>
<script type="text/javascript">
var data = [
  {
    x: <?php echo json_encode($provincias); ?>,
    y: <?php echo json_encode($cantidades); ?>,
    type: 'bar'
  }
];
Plotly.newPlot('graficoProvincia', data);
</script>
