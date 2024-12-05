<?php

include("conexion.php");
include("cabecera.php");

$cod = $_SESSION["usuario"];

// Obtener tipo de usuario
$sqlTipo = "SELECT tipo_usuario FROM usuario WHERE codigo = '$cod'";
$fTipo = mysqli_query($cn, $sqlTipo);
$rTipo = mysqli_fetch_assoc($fTipo);

// Verificar si es institución o persona
if ($rTipo['tipo_usuario'] == '1') { // Institución
    $sql = "SELECT i.*, d.* 
            FROM institucion i 
            LEFT JOIN datoespecifico d ON i.codigo = d.codigo 
            WHERE i.codigo = '$cod'";
    $f = mysqli_query($cn, $sql);
    $r = mysqli_fetch_assoc($f);
} else { // Persona
    $sql = "SELECT p.*, d.* 
            FROM persona p 
            LEFT JOIN datoespecifico d ON p.codigo = d.codigo 
            WHERE p.codigo = '$cod'";
    $f = mysqli_query($cn, $sql);
    $r = mysqli_fetch_assoc($f);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrincipalAdmin</title>
</head>
<body>

<br>
<center>
<?php if ($rTipo['tipo_usuario'] == '1') { ?>
    Bienvenido(a) institución: <?php echo $r["nombre"]; ?>
<?php } else { ?>
    Bienvenido(a) <?php echo $r["nombre"] . " " . $r["apaterno"] . " " . $r["amaterno"]; ?>
<?php } ?>
</center>
<br>

<table border="1" cellspacing="0" align="center" bgcolor="white" width="600">
    <?php if ($rTipo['tipo_usuario'] == '1') { // Mostrar datos de institución ?>
        <tr>
            <td rowspan="7" align="center" valign="middle">
                <img src="imgusuario/<?php echo $r["codigo"] ?>.png" width="200" height="200">
            </td>
            <td align="right">Código:</td>
            <td><?php echo $r["codigo"]; ?></td>
        </tr>
        <tr>
            <td align="right">Nombre:</td>
            <td><?php echo $r["nombre"]; ?></td>
        </tr>
        <tr>
            <td align="right">Provincia:</td>
            <td><?php echo $r["provincia"]; ?></td>
        </tr>
        <tr>
            <td align="right">Director:</td>
            <td><?php echo $r["director"]; ?></td>
        </tr>
        <tr>
            <td align="right">N. Alumnos:</td>
            <td><?php echo $r["nalumnos"]; ?></td>
        </tr>
        <tr>
            <td align="right">N. Docentes:</td>
            <td><?php echo $r["ndocentes"]; ?></td>
        </tr>
        <tr>
            <td align="right">N. Administrativos:</td>
            <td><?php echo $r["nadministrativos"]; ?></td>
        </tr>
    <?php } else { // Mostrar datos de persona ?>
        <tr>
            <td rowspan="6" align="center" valign="middle">
                <img src="imgusuario/<?php echo $r["codigo"] ?>.png" width="200" height="200">
            </td>
            <td align="right">Código:</td>
            <td><?php echo $r["codigo"]; ?></td>
        </tr>
        <tr>
            <td align="right">Ap. Paterno:</td>
            <td><?php echo $r["apaterno"]; ?></td>
        </tr>
        <tr>
            <td align="right">Ap. Materno:</td>
            <td><?php echo $r["amaterno"]; ?></td>
        </tr>
        <tr>
            <td align="right">Nombres:</td>
            <td><?php echo $r["nombre"]; ?></td>
        </tr>
        <tr>
            <td align="right">Provincia:</td>
            <td><?php echo $r["provincia"]; ?></td>
        </tr>
        <tr>
            <td align="right">F. Nacimiento:</td>
            <td><?php echo $r["fnacimiento"]; ?></td>
        </tr>
    <?php } ?>
</table>

<br>

<?php 
// Verificar si los datos específicos están completos
if ($r["estado"] == 0) { ?>
    <center>
        <h1 style="color:black;">ACTUALICE SUS DATOS ESPECÍFICOS</h1>
    </center>
<?php } else { ?>
    <table align="center" border="1" cellspacing="0" bgcolor="white" width="600">
        <tr>
            <td>CORREO:</td>
            <td colspan="2"><?php echo $r["correo"]; ?></td>
        </tr>
        <tr>
            <td>DIRECCIÓN:</td>
            <td colspan="2"><?php echo $r["direccion"]; ?></td>
        </tr>
        <tr>
            <td>CELULAR:</td>
            <td><?php echo $r["telefono"]; ?></td>
        </tr>

        <?php if ($rTipo['tipo_usuario'] != '1') {?>
        <tr>
            <td>SEXO:</td>
            <td><?php echo $r["sexo"]; ?></td>
        </tr>
        <?php } ?>

    </table>
<?php } ?>

<br>
</body>
</html>
