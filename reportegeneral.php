<?php

include("conexion.php");
include("cabecera.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br><br><br><br><br>
<center>
    <table border="0" cellspacing="0" cellpadding="9">
        <tr align="center">
            <td bgcolor="white">REPORTE GENERAL POR PERSONA</td>
            <td bgcolor="white">REPORTE GENERAL POR INSTITUCION</td>
        </tr>
        <tr align="center">
            <td>
                <a target="_parent" href="reportegeneralpersona.php">
                <img src="img/reportegeneralpersona.png" width="190" height="140">
                </a>
            </td>
            <td>
                <a target="_parent" href="reportegeneralinstitucion.php">
                <img src="img/reportegeneralinstitucion.png" width="192" height="142">
                </a>
            </td>
        </tr>
    </table>
</center>




</body>
</html>