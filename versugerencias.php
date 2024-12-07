<?php

include("conexion.php");
include("cabecera.php");

$codigo = $_GET["codigo"];

    $sql = "select *
    from sugerencia
    where codigo = '$codigo'";
    $result = mysqli_query($cn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<br><br><table border='1' align='center' cellpadding='7' cellspacing='0' bgcolor='white'>";
        echo "<tr>
                <th>ID</th>
                <th>Indicador</th>
                <th>Item</th>
                <th>Descripcion</th>
                <th>Fecha</th>
              </tr>";
              $contador = 0;

        while ($r = mysqli_fetch_assoc($result)) {
            $contador++;
            echo "<tr>
                    <td>" . $contador . "</td>
                    <td>{$r['tipo']}</td>
                    <td>{$r['item']}</td>
                    <td>{$r['descripcion']}</td>
                    <td>{$r['fecha']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<br><br><br><center><h3>El usuario con código: $codigo todavía no ha realizado sugerencias.</h3></center>";
    }

    echo "<br><br><center><a href='" . $_SERVER['HTTP_REFERER'] . "' class='btn btn-secondary'>Volver a la página anterior</a></center>";

?>
