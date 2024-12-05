<?php

//include("auth.php");
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
    <center><h2>SUGERENCIA</h2></center>

    <br>

    <center><h4>Usted escogió opinar sobre esta medida</h4></center>

    <br>

    <center><h4>ASEGURAR UNA EDUCACIÓN DE CALIDAD CON EQUIDAD, INNOVADORA, SIN EXCLUSIÓN SOCIAL QUE DESARROLLE PLENAMENTE LAS CAPACIDADES DEL ESTUDIANTE CON LA PARTICIPACIÓN ACTIVA Y COMPROMETIDA DEL DOCENTE Y LA SOCIEDAD.</h4></center>

    
    <center>
    
    <div class="container mt-5">

    <form action="p_escribirsugerencia.php" method="post">
            <div class="mb-3">
                <label for="tiposugerencia" class="form-label">1.- Mi sugerencia es para:</label>
                <select class="form-select" id="tiposugerencia" name="tiposugerencia" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Objetivo">Objetivo</option>
                    <option value="Resultado">Resultado</option>
                    <option value="Politica">Política</option>
                    <option value="Medida">Medida</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="redacte" class="form-label">2.- Redacte su sugerencia:</label>
                <textarea class="form-control" id="redacte" name="redacte" rows="8" required></textarea>
            </div>
            <div>
                <input type="hidden" name="id" value=<?php echo $cod?>>
            </div>
            <br>
            <center>
                <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
            </center>
    </form>

    </div>

    </center>

</body>
</html>