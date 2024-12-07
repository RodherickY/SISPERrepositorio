<?php

include("conexion.php");
include("cabecera.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<br><br><br>
<table align="center" border="0" cellpadding="7" cellspacing="0" bgcolor="white">
    <tr align="center">
        <td>FOTO</td>
        <td>NOMBRE</td>
        <td>CORREO</td>
        <td>TELEFONO</td>
        <td>DIRECCION</td>
        <td>PROVINCIA</td>
        <td>DIRECTOR</td>
        <td>N° ALUMNOS</td>
        <td>N° DOCENTES</td>
        <td>N° ADMINISTRATIVOS</td>
        <td>FECHA REGISTRO</td>
        <td>SUGERENCIAS</td>
    </tr>

<?php

$cantidad = 30;
    if (isset($_GET["valor"])) {
        $limite = $_GET["valor"];
    } else {
        $limite = 0;
    }

$sql="select i.*,d.*
from institucion i, datoespecifico d
where i.codigo=d.codigo
LIMIT $limite, $cantidad";

$fila=mysqli_query($cn,$sql);
while ($r=mysqli_fetch_assoc($fila)) {
    // Ruta de la imagen
    $imgPath = "imgusuario/" . $r["codigo"] . ".png";

    // Comprobar si la imagen existe
    if (file_exists($imgPath)) {
        $imgTag = "<img src='$imgPath' width='50' height='50'>";
    } else {
        $imgTag = "Sin foto";
    }
?>

    <tr>
        <td><?php echo $imgTag; ?></td>
        <td><?php echo $r["nombre"]; ?></td>
        <td><?php echo $r["correo"]; ?></td>
        <td><?php echo $r["telefono"]; ?></td>
        <td><?php echo $r["direccion"]; ?></td>
        <td><?php echo $r["provincia"]; ?></td>
        <td><?php echo $r["director"]; ?></td>
        <td><?php echo $r["nalumnos"]; ?></td>
        <td><?php echo $r["ndocentes"]; ?></td>
        <td><?php echo $r["nadministrativos"]; ?></td>
        <td><?php echo $r["fregistro"]; ?></td>
        <!-- <td></td> -->
        <td>
            <a target="_parent" href="versugerencias.php?codigo=<?php echo $r["codigo"]; ?>">
            VER SUGERENCIAS
            </a>
        </td>
    </tr>

<?php

}

?>


</table>   

<br><br>

<center>
<?php
$sqli = "select *
from institucion i, datoespecifico d
where i.codigo = d.codigo";
$filas = mysqli_query($cn, $sqli);
$total = mysqli_num_rows($filas);
$numpaginas = ceil($total / $cantidad);

for ($i = 0; $i < $numpaginas; $i++) {
    $parametro = $i * $cantidad;
    echo "<a target='_parent' href='reporteinstitucion.php?valor=$parametro'>" . ($i + 1) . "</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
?>
</center>


</body>
</html>