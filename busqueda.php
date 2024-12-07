<?php
include("cabecera.php");
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Usuario</title>
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center;">Buscar Usuario</h2>

        <form action="p_busqueda.php" method="GET">
            <label for="criterio">Ingrese el dato de búsqueda:</label>
            <input type="text" id="criterio" name="criterio" placeholder="DNI, apellido, nombre, etc." required>

            <label for="tipo">Seleccione el tipo de usuario:</label>
            <select id="tipo" name="tipo" required>
                <option value="persona">Persona</option>
                <option value="institucion">Institución</option>
            </select>

            <button type="submit">Buscar</button>
            <button type="button" onclick="window.location.href='datosprincipales.php';">Cancelar</button>
        </form>
    </div>
</body>
</html>