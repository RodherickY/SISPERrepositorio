<?php
//include("cabecera.php");
include("conexion.php");
include("./auth.php");

$cod = $_SESSION["usuario"];

// Verificar que los parámetros tipo e id sean proporcionados
if (!isset($_GET['tipo']) || !isset($_GET['id'])) {
    die("Datos no especificados.");
}

$tipo = $_GET['tipo']; // tipo: objetivo, resultado, politica, medida
$id = intval($_GET['id']); // ID del elemento seleccionado

// Definir la tabla y columna según el tipo de elemento
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

// Consultar el elemento de la base de datos
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
    <title>Sugerencia sobre <?php echo ucfirst($tipo); ?></title>
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
        .btn-accept {
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
    <br>
    <div class="container">
        <center><h1>SUGERENCIA</h1></center>
        <h2>Usted ha elegido opinar sobre un(a) <?php echo ucfirst($tipo); ?></h2>
        <p><strong>Contenido:</strong> <?php echo $descripcionActual; ?></p>
        
        <label for="comentario">Escriba su sugerencia:</label>
        <form action="p_guardarsugerencia.php" method="POST">
            <textarea id="comentario" name="comentario" rows="4" cols="50"></textarea>
            
            <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="codigo" value="<?php echo $cod; ?>">

            <div>
                <button type="submit" class="btn-accept">Aceptar</button>
                <button type="button" class="btn-cancel" onclick="window.location.href='objetivo6.php';">Cancelar</button>
            </div>
        </form>
    </div>
</body>
</html>