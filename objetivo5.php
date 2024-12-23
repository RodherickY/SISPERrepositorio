<?php

//include("cabecera.php");
include("conexion.php");

include("cabeceraLogo.php");
include("barralateral.php");

$idObjetivo = 5; // ID del objetivo fijo para este archivo

// Obtener el objetivo
$sqlObjetivo = "SELECT * FROM objetivos WHERE idobjetivo = $idObjetivo";
$resultObjetivo = mysqli_query($cn, $sqlObjetivo);

if ($resultObjetivo && mysqli_num_rows($resultObjetivo) > 0) {
    $rowObjetivo = mysqli_fetch_assoc($resultObjetivo);
    $descripcionObjetivo = $rowObjetivo['descripcion'];
} else {
    die("No se encontró el objetivo con ID: $idObjetivo.");
}

// Obtener resultados relacionados
$sqlResultados = "SELECT * FROM resultado WHERE idobjetivo = $idObjetivo";
$resultResultados = mysqli_query($cn, $sqlResultados);

if (!$resultResultados) {
    die("Error en la consulta de resultados: " . mysqli_error($cn));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objetivo 5</title>
    <link rel="stylesheet" href="estilo.css"> <!-- Incluye tu CSS personalizado -->
</head>
<body>
    <center>
        <h5>Aquí tienes toda la matriz del PER Lima - Provincias, con sus medidas</h5>
        <h5>Haz clic en el ícono <img src="img/lapiz.jpg" style="width: 20px; height: auto;">, ubicado en cada medida, política o resultado para escribir tus aportes o sugerencias</h5>
    </center>
    <br>
    <center>
        <h4>OBJETIVO N° 5</h4>
        <div class="tabla-contenedor">
        <table border="0" cellspacing="0" align="center" width="800">
            <td><?php echo $descripcionObjetivo;?></td>
        </table>
        </div>
    </center>
    <br>

<?php
if (mysqli_num_rows($resultResultados) > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 85%; margin: auto; font-size: 12px;'>";
    echo "<tr>
            <th>Objetivo</th>
            <th>Resultados</th>
            <th>Políticas</th>
            <th>Medidas</th>
          </tr>";

    $objetivoImpreso = false;
    $rowspanResultado = [];
    $rowspanPolitica = [];

    // Calcular rowspans
    while ($rowResultado = mysqli_fetch_assoc($resultResultados)) {
        $idResultado = $rowResultado['idresultado'];
        
        $sqlPoliticas = "SELECT * FROM politica WHERE idresultado = $idResultado";
        $resultPoliticas = mysqli_query($cn, $sqlPoliticas);
        
        $totalFilasPorResultado = 0;
        while ($rowPolitica = mysqli_fetch_assoc($resultPoliticas)) {
            $idPolitica = $rowPolitica['idpolitica'];
            $sqlMedidas = "SELECT COUNT(*) as total FROM medida WHERE idpolitica = $idPolitica";
            $resultMedidas = mysqli_query($cn, $sqlMedidas);
            $totalMedidas = mysqli_fetch_assoc($resultMedidas)['total'];
            $totalFilasPorResultado += max(1, $totalMedidas);
            $rowspanPolitica[$idPolitica] = max(1, $totalMedidas);
        }
        $rowspanResultado[$idResultado] = $totalFilasPorResultado;
    }

    mysqli_data_seek($resultResultados, 0);

    while ($rowResultado = mysqli_fetch_assoc($resultResultados)) {
        $idResultado = $rowResultado['idresultado'];
        $descripcionResultado = $rowResultado['descripcion'];

        $sqlPoliticas = "SELECT * FROM politica WHERE idresultado = $idResultado";
        $resultPoliticas = mysqli_query($cn, $sqlPoliticas);

        if (mysqli_num_rows($resultPoliticas) > 0) {
            $primeraFilaResultado = true;

            while ($rowPolitica = mysqli_fetch_assoc($resultPoliticas)) {
                $idPolitica = $rowPolitica['idpolitica'];
                $descripcionPolitica = $rowPolitica['descripcion'];

                $sqlMedidas = "SELECT * FROM medida WHERE idpolitica = $idPolitica";
                $resultMedidas = mysqli_query($cn, $sqlMedidas);
                
                $primeraFilaPolitica = true;
                $medidasExisten = mysqli_num_rows($resultMedidas) > 0;

                if ($medidasExisten) {
                    while ($rowMedida = mysqli_fetch_assoc($resultMedidas)) {
                        echo "<tr>";
                        
                        if (!$objetivoImpreso) {
                            $totalFilas = array_sum($rowspanResultado);
                            echo "<td rowspan='$totalFilas'>{$descripcionObjetivo} 
                                    <a href='sugerenciaobjetivo5.php?tipo=objetivo&id=$idObjetivo'>
                                        <img src='img/lapiz.jpg' alt='Editar' style='width: 16px; height: auto;'>
                                    </a>
                                  </td>";
                            $objetivoImpreso = true;
                        }
                        
                        if ($primeraFilaResultado) {
                            echo "<td rowspan='{$rowspanResultado[$idResultado]}'>{$descripcionResultado}
                                  <a href='sugerenciaobjetivo5.php?tipo=resultado&id=$idResultado'><img src='img/lapiz.jpg' alt='Editar' style='width: 16px; height: auto;'></a></td>";
                            $primeraFilaResultado = false;
                        }
                        
                        if ($primeraFilaPolitica) {
                            echo "<td rowspan='{$rowspanPolitica[$idPolitica]}'>{$descripcionPolitica}
                                  <a href='sugerenciaobjetivo5.php?tipo=politica&id=$idPolitica'><img src='img/lapiz.jpg' alt='Editar' style='width: 16px; height: auto;'></a></td>";
                            $primeraFilaPolitica = false;
                        }
                        
                        echo "<td>{$rowMedida['descripcion']}
                              <a href='sugerenciaobjetivo5.php?tipo=medida&id={$rowMedida['idmedida']}'><img src='img/lapiz.jpg' alt='Editar' style='width: 16px; height: auto;'></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    if (!$objetivoImpreso) {
                        $totalFilas = array_sum($rowspanResultado);
                        echo "<td rowspan='$totalFilas'>{$descripcionObjetivo}</td>";
                        $objetivoImpreso = true;
                    }
                    if ($primeraFilaResultado) {
                        echo "<td rowspan='{$rowspanResultado[$idResultado]}'>{$descripcionResultado}
                                  <a href='sugerenciaobjetivo5.php?tipo=resultado&id=$idResultado'><img src='img/lapiz.jpg' alt='Editar' style='width: 16px; height: auto;'></a></td>";
                        $primeraFilaResultado = false;
                    }
                    echo "<td>{$descripcionPolitica}
                          <a href='sugerenciaobjetivo5.php?tipo=politica&id=$idPolitica'><img src='img/lapiz.jpg' alt='Editar' style='width: 16px; height: auto;'></a></td>";
                    echo "<td>[Sin medidas]</td>";
                    echo "</tr>";
                }
            }
        }
    }
    echo "</table>";
} else {
    echo "<p>No se encontraron resultados para este objetivo.</p>";
}

mysqli_close($cn);
?>

<br>

</body>
</html>
