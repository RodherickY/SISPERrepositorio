<?php
include("conexion.php");

// Consultar los datos agrupados por tipo de usuario
$sql = "SELECT tipo_usuario, COUNT(*) AS cantidad
        FROM sugerencia
        GROUP BY tipo_usuario
        ORDER BY cantidad DESC";

$result = mysqli_query($cn, $sql);

// Preparar los datos para Plotly
$tiposUsuario = [];
$cantidades = [];
while ($row = mysqli_fetch_assoc($result)) {
    $tiposUsuario[] = ucfirst($row['tipo_usuario']); // Capitalizar el tipo de usuario
    $cantidades[] = $row['cantidad'];
}
?>

<div id="graficoTipoUsuario"></div>
<script type="text/javascript">
var data = [
  {
    x: <?php echo json_encode($tiposUsuario); ?>,
    y: <?php echo json_encode($cantidades); ?>,
    type: 'bar'
  }
];
Plotly.newPlot('graficoTipoUsuario', data);
</script>
