<?php
include("auth.php");
include("conexion.php");
include("cabecera.php");

$query = "SELECT idobjetivo, descripcion FROM objetivos";
$result = mysqli_query($cn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserte su Comentario</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <center>
        <form action="p_comentario.php" method="post">
            <table class="comen">
                <tr>
                    <td><label for="opcion">Tipo de Objetivo:</label></td>
                    <td>
                        <select name="tipo" id="opcion" required>
                            <option value="" disabled selected>Seleccione un objetivo</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row["idobjetivo"] . '">' . $row["descripcion"] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="descripcion">Descripción:</label></td>
                    <td>
                        <textarea name="descripcion" id="descripcion" rows="5" cols="30" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" value="Enviar Mensaje">
                    </td>
                </tr>
            </table>
        </form>
    </center>
</body>
</html>