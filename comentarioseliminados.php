<?php
include("conexion.php");
include("cabecera.php");

$sql = "SELECT * FROM sugerencia WHERE estado = 0 ORDER BY fecha ASC";
$result = mysqli_query($cn, $sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios Eliminados</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Historial de Comentarios Eliminados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Sugerencia</th>
                    <th>Usuario (Código)</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Item</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['idsugerencia']; ?></td>
                        <td><?php echo $row['codigo']; ?></td>
                        <td><?php echo ucfirst($row['tipo']); ?></td>
                        <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                        <td><?php echo $row['item']; ?></td>
                        <td><?php echo $row['fecha']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
mysqli_close($cn);
?>