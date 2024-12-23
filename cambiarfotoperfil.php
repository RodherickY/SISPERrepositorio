<?php

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

<form action="p_cambiarfotoperfil.php" method="post" enctype="multipart/form-data">
    <center>
    Escoger la foto (formato png)
    <input type="file" name="archivo">
    <input type="submit" value="Cambiar foto de perfil">
    </center>
</form>




</body>
</html>