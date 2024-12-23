<?php

include("conexion.php");
//include("cabecera.php");
include("cabeceraLogo.php");
include("barralateral.php");

$cod = $_SESSION["usuario"];

// Consulta unificada para personas e instituciones
$sql = "SELECT * 
        FROM usuario u
        LEFT JOIN persona p ON u.codigo = p.codigo
        LEFT JOIN institucion i ON u.codigo = i.codigo
        LEFT JOIN datoespecifico d ON u.codigo = d.codigo
        WHERE u.codigo = '$cod'";

$f = mysqli_query($cn, $sql);
$r = mysqli_fetch_assoc($f);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar datos</title>
</head>
<body>

<br>
<center>
    Bienvenido(a) 
    <?php 
    if ($r["tipo_usuario"] == '1') { // Institución
        echo "a la institución: " . $r["nombre"];
    } else { // Persona
        echo $r["nombre"] . " " . $r["apaterno"] . " " . $r["amaterno"];
    }
    ?>
</center>
<br>

<form action="p_actualizar.php" method="post">
<div class="tabla-contenedor">
<table align="center" border="1" cellspacing="0" bgcolor="white" width="600">
    <tr>
        <td>CORREO:</td>
        <td colspan="2">
            <input type="email" name="txtcorreo" size="60" value="<?php echo $r["correo"]; ?>">
        </td>
    </tr>
    <tr>
        <td>DIRECCIÓN:</td>
        <td colspan="2">
            <input type="text" name="txtdireccion" size="60" value="<?php echo $r["direccion"]; ?>">
        </td>
    </tr>
    <tr>
        <td>CELULAR:</td>
        <td colspan="2">
            <input type="text" name="txtcelular" value="<?php echo $r["telefono"]; ?>">
        </td>
    </tr>
    <?php if ($r["tipo_usuario"] != '1') { // Mostrar sexo solo si no es institución ?>
    <tr>
        <td>SEXO:</td>
        <td>
            <?php
            $valorM = $r["sexo"] == "M" ? "checked" : "";
            $valorF = $r["sexo"] == "F" ? "checked" : "";
            ?>
            <input type="radio" name="opcsexo" value="M" <?php echo $valorM; ?>> Masculino
            <input type="radio" name="opcsexo" value="F" <?php echo $valorF; ?>> Femenino
        </td>
    </tr>
    <?php } ?>
</table>
</div>
<br>
<center>
    <input type="submit" value="Actualizar Datos">
</center>
</form>

</body>
</html>
