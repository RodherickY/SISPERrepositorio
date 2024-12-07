<?php
include("conexion.php");

$tipo = $_GET['tipo']; 
$id = intval($_GET['id']);

switch ($tipo) {
    case 'objetivo':
        $tabla = 'objetivos';
        $columnaId = 'idobjetivo';
        $columnaDescripcion = 'descripcion';
        break;
    case 'resultado':
        $tabla = 'resultado';
        $columnaId = 'idresultado';
        $columnaDescripcion = 'descripcion';
        break;
    case 'politica':
        $tabla = 'politica';
        $columnaId = 'idpolitica';
        $columnaDescripcion = 'descripcion';
        break;
    case 'medida':
        $tabla = 'medida';
        $columnaId = 'idmedida';
        $columnaDescripcion = 'descripcion';
        break;
    default:
        die("Tipo inválido.");
}

$sql = "SELECT $columnaDescripcion FROM $tabla WHERE $columnaId = $id";
$result = mysqli_query($cn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $descripcionActual = $row[$columnaDescripcion];
} else {
    die("Elemento no encontrado.");
}

mysqli_close($cn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?php echo ucfirst($tipo); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        textarea {
            width: 100%;
            height: 150px;
            margin-bottom: 15px;
            padding: 10px;
            font-size: 14px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-save {
            background-color: #28a745;
            color: #fff;
        }
        .btn-cancel {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar <?php echo ucfirst($tipo); ?></h2>

        <form action="p_editarobjetivo.php" method="POST">
            <label>Ha seleccionado un(a) <?php echo ucfirst($tipo); ?></label>
            <p><strong>La información actual es:</strong></p>
            <p><i><?php echo $descripcionActual; ?></i></p>
            
            <label for="descripcion">Nueva información:</label>
            <textarea id="descripcion" name="descripcion" rows="4" cols="50"><?php echo htmlspecialchars($descripcionActual); ?></textarea>

            <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <div>
                <button type="submit" class="btn-save">Guardar</button>
                <button type="button" class="btn-cancel" onclick="window.location.href='objetivo1admin.php';">Cancelar</button>
            </div>
        </form>

    </div>
</body>
</html>