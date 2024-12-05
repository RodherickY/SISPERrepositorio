<?php

include("auth.php");
include("conexion.php");
include("cabecerados.php");

$cod=$_SESSION["usuario"]; // obtiene al usuario

$sql="SELECT a.* 

 from institucion a
  where a.codigo 
  and a.codigo= '$cod'";//consulta

$f=mysqli_query($cn,$sql);// ejecuta la consulta

$r=mysqli_fetch_assoc($f);// asocia la consulta

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estiloprinc.css">
</head>
<body>
    <br>
    <center>
    BIENVENIDO I.E <?php echo  $r['nombre']?>
    </center>
    <br>
    <table border="1" cellspacing="0" align="center" bgcolor="lightblue" width="600">
        <tr>
            <td rowspan="4" align="center" valign="middle">
                <img src="img_alumno/<?php echo $r['codigo']?>.png" width="150" height="150" alt="">
            </td>
           
        </tr>
        <tr>
            
           <td align="center">I.E.</td>
            <td align="center"><?php echo $r['nombre']?></td>
        </tr>
        <tr>
            
            <td align="right">Provincia</td>
            <td align="center"><?php echo $r['provincia']?></td>
        </tr>
        <tr>
            
            <td align="right">Responsable</td>
            <td align="center"><?php echo $r['director']?></td>
        </tr>
        
        
       
    </table>
 
<br>
<br>
<br>


    
</body>
</html>