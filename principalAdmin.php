<?php

session_start();
include("conexion.php");
//include("cabecera.php");

$cod=$_SESSION["usuario"];
$sql = "SELECT p.*, d.* 
        FROM persona p, datoespecifico d 
        WHERE p.codigo = d.codigo 
        AND p.codigo = '$cod'";

$f=mysqli_query($cn,$sql);

$r=mysqli_fetch_assoc($f);
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

    Bienvenido(a) <?php echo $r["nombre"]." ". $r["apaterno"]." ".$r["amaterno"];      ?>

</center>
<br>

<table border="1" cellspacing="0" align="center" bgcolor="white" width="600">
    <tr>
        <!-- <td rowspan="6" align="center" valign="middle" >
            <img src="imgalumnos/<?php echo $r["codalumno"]?>.png" width="200" height="200">
        </td> -->
        <td align="right">CODIGO</td>
        <td><?php echo $r["codigo"];  ?></td>
    </tr>
    <tr>
        
        <td align="right">AP. PATERNO</td>
        <td><?php echo $r["apaterno"];  ?></td>
    </tr>
    <tr>
        
        <td align="right">AP. MATERNO</td>
        <td><?php echo $r["amaterno"];  ?></td>
    </tr>
    <tr>
        
        <td align="right">NOMBRES</td>
        <td><?php echo $r["nombre"];  ?></td>
    </tr>
    <tr>
        
        <td align="right">EDAD</td>
        <td><?php echo $r["fnacimiento"];  ?></td>
    </tr>
    <tr>
    
        <td align="right">PROVINCIA</td>
        <td><?php echo $r["provincia"];  ?></td>
    </tr>
</table>

<br>
<?php
if ($r["estado"]==0) {
    echo "<center><h1 style='color:white;'>ACTUALIZE SUS DATOS ESPECÍFICOS<h1></center>";
} else {
    
?>

<table align="center" border="1" cellspacing="0" bgcolor="white" width="600" >
    <tr>
        <td>CORREO:</td>
        <td colspan="2"><?php echo $r["correo"]; ?></td>
      
    </tr>
    <tr>
        <td>DIRECCION:</td>
        <td colspan="2"><?php echo $r["direccion"]; ?></td>
   
    </tr>
    <tr>
        <td>CELULAR:</td>
        <td>SEXO</td>
    </tr>
    <tr>
        <td><?php echo $r["telefono"]; ?></td>
        <td><?php echo $r["sexo"] ?></td>
    </tr>
</table>





<?php

}




?>

<br>
<br>

</body>
</html>