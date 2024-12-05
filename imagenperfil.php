<?php

include("auth.php");
include("conexion.php");
include("cabecerados.php");

$cod=$_SESSION["usuario"]; // obtiene al usuario




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
    
   
    <br>
    
    
<?php
    
?>
<br>
<form action="p_imagenperfil.php" method="post" enctype="multipart/form-data">

Escoger la foto(formato png)
<input type="file" name="archivo" >
<input type="submit" value="cambiar foto" >
</form>
    </center>
    


  




</body>
</html>