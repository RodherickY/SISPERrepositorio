<?php
include("conexion.php");

$idObjetivo = 1; // ID del objetivo fijo para este archivo

// Obtener el objetivo
$sqlObjetivo = "SELECT * FROM objetivos WHERE idobjetivo = $idObjetivo";
$resultObjetivo = mysqli_query($cn, $sqlObjetivo);

if ($resultObjetivo && mysqli_num_rows($resultObjetivo) > 0) {
    $rowObjetivo = mysqli_fetch_assoc($resultObjetivo);
    $descripcionObjetivo = $rowObjetivo['descripcion'];
} else {
    die("No se encontró el objetivo con ID: $idObjetivo.");
}

echo "<h2>Objetivo: $descripcionObjetivo</h2>";

// Obtener resultados relacionados
$sqlResultados = "SELECT * FROM resultado WHERE idobjetivo = $idObjetivo";
$resultResultados = mysqli_query($cn, $sqlResultados);

if (!$resultResultados) {
    die("Error en la consulta de resultados: " . mysqli_error($cn));
}

if (mysqli_num_rows($resultResultados) > 0) {
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>
            <th>Objetivo</th>
            <th>Resultados</th>
            <th>Políticas</th>
            <th>Medidas</th>
          </tr>";

    $objetivoImpreso = false;
    $resultadoAnterior = null;
    $rowspanResultado = [];
    $politicaAnterior = null;
    $rowspanPolitica = [];

    // Primer recorrido para calcular rowspans
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
                            echo "<td rowspan='$totalFilas'>{$descripcionObjetivo}</td>";
                            $objetivoImpreso = true;
                        }
                        
                        if ($primeraFilaResultado) {
                            echo "<td rowspan='{$rowspanResultado[$idResultado]}'>{$descripcionResultado}
                                  <a href='editar_resultado.php?id=$idResultado'><img src='lapiz.png' alt='Editar' width='16'></a></td>";
                            $primeraFilaResultado = false;
                        }
                        
                        if ($primeraFilaPolitica) {
                            echo "<td rowspan='{$rowspanPolitica[$idPolitica]}'>{$descripcionPolitica}
                                  <a href='editar_politica.php?id=$idPolitica'><img src='lapiz.png' alt='Editar' width='16'></a></td>";
                            $primeraFilaPolitica = false;
                        }
                        
                        echo "<td>{$rowMedida['descripcion']}
                              <a href='editar_medida.php?id={$rowMedida['idmedida']}'><img src='lapiz.png' alt='Editar' width='16'></a></td>";
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
                              <a href='editar_resultado.php?id=$idResultado'><img src='lapiz.png' alt='Editar' width='16'></a></td>";
                        $primeraFilaResultado = false;
                    }
                    echo "<td>{$descripcionPolitica}
                          <a href='editar_politica.php?id=$idPolitica'><img src='lapiz.png' alt='Editar' width='16'></a></td>";
                    echo "<td>[Sin medidas]</td>";
                    echo "</tr>";
                }
            }
        }
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados para este objetivo.";
}

mysqli_close($cn);
?>
