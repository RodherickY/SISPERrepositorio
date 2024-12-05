<?php
include("conexion.php");
include("cabecera.php");

$cod = $_SESSION["usuario"];

// Consulta para obtener sugerencias relacionadas con la persona o institución
$sql = "SELECT s.*
        FROM SUGERENCIA s 
        INNER JOIN PERSONA p 
        ON s.codigo = p.codigo
        WHERE p.codigo = '$cod'";

$query = mysqli_query($cn, $sql);
?>

<br>

<div>
    <center>
        <table border="1" cellspacing="0" align="center" bgcolor="white" width="1000">
            <tr>
                <th>APORTE</th>
                <th>INDICADOR</th>
                <th>FECHA Y HORA</th>
                <th>ACCIONES</th>

            </tr>
            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?php echo $row['descripcion']; ?></td>
                    <td><?php echo $row['tipo']; ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                    
                    
                    <td style="width: 20%;">
                        <center>
                            <a href="editar.php?id=<?php echo $row["idsugerencia"] ?>" target="_parent" style="width: 20px; height:20px">
                                <img src="img/editar.png" class="icono" style="width: 20%; height:20%">
                            </a>
                            <a href="eliminar.php?id=<?php echo $row["idsugerencia"] ?>" target="_parent" style="width: 15px; height:15px">
                                <img src="img/eliminar.png" class="icono" style="width: 15%; height:15%">
                            </a>

                        </center>    


                    </td>
                </tr>
            <?php } ?>
        </table>
    </center>
</div>
