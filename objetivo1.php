<?php

include("cabecera.php");
include("conexion.php"); // Incluye tu archivo de conexión

// Consulta SQL
$sql = "SELECT * 
        FROM objetivos o
        LEFT JOIN resultado r ON o.idobjetivo = r.idobjetivo
        LEFT JOIN politica p ON r.idresultado = p.idresultado
        LEFT JOIN medida m ON p.idpolitica = m.idpolitica
        WHERE o.idobjetivo = 1
        ORDER BY o.idobjetivo, r.idresultado, p.idpolitica, m.idmedida";

// Ejecutar la consulta
$resultado = mysqli_query($cn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriz PER Lima - Provincias</title>
    <link rel="stylesheet" href="tu_estilo.css"> <!-- Incluye tu CSS personalizado -->
</head>
<body>
    <center><h5>Aqui tienes toda la matriz del PER Lima - Provincias, con sus medidas</h5></center>
    <center><h5>Haz click en el ícono, ubicado en cada medida, política o resultado para escribir tus aportes o sugerencias</h5></center>

    <br>
    <center><h4>OBJETIVO N° 01</h4></center>
    <center><h4>ASEGURAR UNA EDUCACIÓN DE CALIDAD CON EQUIDAD, INNOVADORA, SIN EXCLUSIÓN SOCIAL QUE DESARROLLE PLENAMENTE LAS CAPACIDADES DEL ESTUDIANTE CON LA PARTICIPACIÓN ACTIVA Y COMPROMETIDA DEL DOCENTE Y LA SOCIEDAD.</h4></center>

    <!-- Tabla para mostrar los datos -->
    <table border="1" bgcolor="white">
        <thead>
            <tr>
                <th>Objetivo</th>
                <th>Resultado</th>
                <th>Política</th>
                <th>Medida</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Recorrer los resultados y mostrar cada fila
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>{$fila['descripcion']}</td>"; // Objetivo
                echo "<td>{$fila['descripcion']}</td>"; // Resultado
                echo "<td>{$fila['descripcion']}</td>"; // Política
                echo "<td>{$fila['descripcion']}</td>"; // Medida
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
