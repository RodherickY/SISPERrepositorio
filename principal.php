<?php

include("auth.php");
include("conexion.php");
include("cabecerados.php");

$cod=$_SESSION["usuario"]; // obtiene al usuario

$sql="SELECT a.*,d.* 

 from persona a, datoespecifico d
  where a.codigo = d.codigo
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
    BIENVENIDO <?php echo $r['apaterno'] . " " . $r['amaterno'] . " " . $r['nombre']?>
    </center>
    <br>
    <table border="1" cellspacing="0" align="center" bgcolor="lightblue" width="600">
        <tr>
            <td rowspan="4" align="center" valign="middle">
                <img src="img_sisper/<?php echo $r['codigo']?>.png" width="150" height="150" alt="">
            </td>
           
        </tr>
        <tr>
            
           <td align="center">AP.Paterno</td>
            <td align="center"><?php echo $r['apaterno']?></td>
        </tr>
        <tr>
            
            <td align="right">AP.Materno</td>
            <td align="center"><?php echo $r['amaterno']?></td>
        </tr>
        <tr>
            
            <td align="right">Nombres</td>
            <td align="center"><?php echo $r['nombre']?></td>
        </tr>
        
        
       
    </table>
    
<?php
     if ($r['estado']==0) {
        echo "<center><h2>Debes de completar algunos datos si deseas usar nuestro servicio</h2></center>";
     }else {
?>


<table border="1" cellspacing="0" align="center" bgcolor="lightblue" width="600">
    <tr>
        <td>CORREO</td>
        <td colspan="2"><?php echo $r['correo'];?></td>
        
    </tr>

   <tr> 
        <td>CELULAR</td>
        <td colspan="2"><?php echo $r['telefono'];?></td>
   </tr>

   <tr> 
        <td>DIRECCION</td>
        <td colspan="2"><?php echo $r['direccion'];?></td>
   </tr>
   <tr> 
        <td>SEXO</td>
        <td colspan="2"><?php echo $r['sexo'];?></td>
   </tr>


</table>
<br>
<br>
<br>

<?php
}

?>
    
</body>
</html>