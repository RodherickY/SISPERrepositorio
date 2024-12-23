<?php

//include("auth.php");
//include("cabecera.php");

include("cabeceraLogo.php");
include("barralateral.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<br>
<center>

</center>
<br>

<form action="p_cambiarcontrasena.php" method="post">

<div class="tabla-contenedor">
<table border="1" cellspacing="0" bgcolor="white" align="center" width="600">
    <tr>
        <td>Ingresar nueva contraseña</td>
        <td><input type="password" name="txtpass" maxlength="8"></td>
    </tr>
    <tr>
        <td>Repetir nueva contraseña</td>
        <td><input type="password" name="txtrepass" maxlength="8"></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <input type="submit" value="Cambiar contraseña">
        </td>
        
    </tr>
</table>
</div>


</form>




</body>
</html>