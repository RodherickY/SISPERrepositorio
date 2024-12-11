<?php
include("conexion.php");
include("cabecera.php");

$cod = $_SESSION["usuario"];

// Determinar el límite inicial para la consulta según la paginación
$cantidad = 5; // Cantidad de elementos por página
$limite = isset($_GET["valor"]) ? $_GET["valor"] : 0;

// Consulta para obtener las sugerencias relacionadas con la persona o institución
$sql = "SELECT s.* FROM SUGERENCIA s 
        INNER JOIN PERSONA p ON s.codigo = p.codigo 
        WHERE p.codigo = '$cod' AND s.estado = 1 
        LIMIT $limite, $cantidad";
$query = mysqli_query($cn, $sql);

// Consulta para obtener el total de sugerencias
$sqlTotal = "SELECT COUNT(*) as total FROM SUGERENCIA s 
             INNER JOIN PERSONA p ON s.codigo = p.codigo 
             WHERE p.codigo = '$cod' AND s.estado = 1";
$queryTotal = mysqli_query($cn, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($queryTotal);
$totalSugerencias = $rowTotal['total'];

// Calcular el número total de páginas
$totalPaginas = ceil($totalSugerencias / $cantidad);
?>

<br>
<h2><center>SUGERENCIAS REALIZADAS</center></h2>
<br>
<div>
    <center>
        <table border="1" cellspacing="0" align="center" bgcolor="white" width="1000">
            <tr>
                <th>APORTE</th>
                <th>INDICADOR</th>
                <th>ITEM</th>
                <th>FECHA Y HORA</th>
                <th>ACCIONES</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?php echo $row['descripcion']; ?></td>
                    <td><?php echo $row['tipo']; ?></td>
                    <td><?php echo $row['item']; ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                    <td style="width: 20%;">
                        <center>
                            <a href="editarsugerencia.php?id=<?php echo $row["idsugerencia"] ?>" target="_parent" style="width: 20px; height:20px">
                                <img src="img/editar.png" class="icono" style="width: 20%; height:20%">
                            </a>
                            <a href="p_eliminarsugerencia.php?id=<?php echo $row["idsugerencia"] ?>" target="_parent" style="width: 15px; height:15px">
                                <img src="img/eliminar.png" class="icono" style="width: 15%; height:15%">
                            </a>
                        </center>    
                    </td>
                </tr>
            <?php } ?>
        </table>
    </center>
</div>

<br>

<!-- Paginación -->
<center>
    <?php
    // Mostrar la paginación solo si hay más de una página
    if ($totalPaginas > 1) {
        echo '<div class="pagination">';
        
        // Enlace para la primera página
        if ($limite > 0) {
            echo '<a class="prev" href="missugerencias.php?valor=0">«</a>';
        } else {
            echo '<a class="prev disabled">«</a>';
        }

        // Mostrar enlaces de paginación numerados con guion entre ellos
        for ($i = 0; $i < $totalPaginas; $i++) {
            $parametro = $i * $cantidad;

            if ($parametro == $limite) {
                echo '<a class="active" href="missugerencias.php?valor=' . $parametro . '">' . ($i + 1) . '</a>';
            } else {
                echo '<a href="missugerencias.php?valor=' . $parametro . '">' . ($i + 1) . '</a>';
            }

            // Agregar el guion entre las páginas, pero no después de la última
            if ($i < $totalPaginas - 1) {
                echo ' - ';
            }
        }

        // Enlace para la última página
        if ($limite + $cantidad < $totalSugerencias) {
            echo '<a class="next" href="missugerencias.php?valor=' . (($totalPaginas - 1) * $cantidad) . '">»</a>';
        } else {
            echo '<a class="next disabled">»</a>';
        }

        echo '</div>';
    }
    ?>
</center>


