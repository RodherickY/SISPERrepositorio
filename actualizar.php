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
    <link rel="stylesheet" href="css/estiloact.css">
   
</head>
<body>
    <br>
    <center>
    BIENVENIDO <?php echo $r['apaterno'] . " " . $r['amaterno'] . " " . $r['nombre']?>
   
    <br>
    
    
<?php
    
?>
<br>
<form action="p_actualizar.php" method="post">
<table border="1" cellspacing="0" align="center" bgcolor="lightblue" width="600">
    <tr>
        <td>CORREO</td>
        <td colspan="2">
            <input type="email" name="txtcorreo" size="60" value="<?php echo $r['correo'];?>" id="">
        </td>
        
    </tr>

    <tr>
        <td>CELULAR</td>
        <td colspan="2">
            <input type="text" name="txtcelular" size="60" value="<?php echo $r['telefono'];?>" id="">
        </td>
        
    </tr>

    <tr>
        <td>DIRECCION</td>
        <td colspan="2">
            <input type="text" name="txtdireccion" size="60" value="<?php echo $r['direccion'];?>" id="">
        </td>
        
    </tr>

    <tr>
        <td>SEXO</td>
        <td colspan="2">
            <?php
            // Determinar cuál opción debe ser seleccionada
            $valorM = $r['sexo'] == 'M' ? "selected" : "";
            $valorF = $r['sexo'] == 'F' ? "selected" : "";
            ?>
            <select name="lssexo" id="lssexo">
                <option value="M" <?php echo $valorM; ?>>MASCULINO</option>
                <option value="F" <?php echo $valorF; ?>>FEMENINO</option>
            </select>
        </td>
    </tr>
   
</table>
<br>

<button type="submit" id="boton" >ACTUALIZAR</button>
</form>
</center>
<br>
<br>

    


  




</body>
</html>