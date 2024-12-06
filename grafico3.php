<?php
include("conexion.php");

// Consultar los datos agrupados por grupo de edad
$sql = "SELECT 
            CASE 
                WHEN edad BETWEEN 0 AND 17 THEN '0-17'
                WHEN edad BETWEEN 18 AND 24 THEN '18-24'
                WHEN edad BETWEEN 25 AND 34 THEN '25-34'
                WHEN edad BETWEEN 35 AND 44 THEN '35-44'
                WHEN edad >= 45 THEN '45+'
                ELSE 'Desconocido'
            END AS grupo_edad,
            COUNT(*) AS cantidad
        FROM sugerencia
        GROUP BY grupo_edad
        ORDER BY grupo_edad";

$result = mysqli_query($cn, $sql);

// Preparar los datos para Plotly
$grupos = [];
$cantidades = [];
while ($row = mysqli_fetch_assoc($result)) {
    $grupos[] = $row['grupo_edad'];
    $cantidades[] = $row['cantidad'];
}
?>

<div id="graficoGrupoEdad"></div>
<script type="text/javascript">
var data = [
  {
    x: <?php echo json_encode($grupos); ?>,
    y: <?php echo json_encode($cantidades); ?>,
    type: 'bar'
  }
];
Plotly.newPlot('graficoGrupoEdad', data);
</script>
