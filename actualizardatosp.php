<?php

include("conexion.php");
include("cabecera.php");

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
    <title>Actualizar datos</title>
</head>
<body>


<br>
<center>

    Bienvenido(a) <?php echo $r["nombre"]." ". $r["apaterno"]." ".$r["amaterno"];      ?>

</center>
<br>

<form action="p_actualizar.php" method="post">
<table align="center" border="1" cellspacing="0" bgcolor="lightblue" width="600" >
    <tr>
        <td>CORREO:</td>
        <td colspan="2"><input type="email" name="txtcorreo" size="60" value="<?php echo $r["correo"]; ?>"></td>
      
    </tr>
    <tr>
        <td>DIRECCION:</td>
        <td colspan="2"><input type="text" name="txtdireccion" size="60" value="<?php echo $r["direccion"]; ?>"></td>
   
    </tr>
    <tr>
        <td>CELULAR:</td>
        <td><input type="text" name="txtcelular" value="<?php echo $r["telefono"]; ?>"></td>

    </tr>
    <tr>
        <td>SEXO</td>
    
    
        
        <td>

        <?php
        
        $valorM="";
        $valorF="";

if ($r["sexo"]=="M") {
    $valorM= " checked";
} else {
    $valorF=" checked";
}


        ?>


        <input type="radio" name="opcsexo" value="M"<?php echo $valorM; ?>>Masculino
        <input type="radio" name="opcsexo" value="F"<?php echo $valorF; ?>>Femenino

        </td>
    </tr>
</table>
<br>
<center><input type="submit" value="Actualizar Datos"></center>

</form>




</body>
</html>