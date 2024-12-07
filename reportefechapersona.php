<?php
include('conexion.php');
include('cabecera.php');

$fechaInit = isset($_POST['f_inicio']) ? date("Y-m-d", strtotime($_POST['f_inicio'])) : null;
$fechaFin = isset($_POST['f_fin']) ? date("Y-m-d", strtotime($_POST['f_fin'])) : null;
$persona = isset($_POST['persona']) ? $_POST['persona'] : null;

$sqlPersonas = "select p.codigo as codigo_persona, p.*, d.codigo as codigo_dato, d.* 
                     from persona p
                     left join datoespecifico d
                     on p.codigo = d.codigo where 1=1";

if ($fechaInit && $fechaFin) {
    $sqlPersonas .= " and `fregistro` between '$fechaInit' and '$fechaFin'";
}

if ($persona) {
    $sqlPersonas .= " and `nombre_persona` = '$persona'";
}

$sqlPersonas .= " order by p.fregistro ASC";

$fila = mysqli_query($cn, $sqlPersonas);
$total = mysqli_num_rows($fila);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar Instituciones por Fecha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Filtrar Personas por Rango de Fechas</h2>
    <form action="" method="POST" class="mb-4">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="f_inicio">Fecha Inicio</label>
                <input type="date" id="f_inicio" name="f_inicio" class="form-control" value="<?php echo isset($_POST['f_inicio']) ? $_POST['f_inicio'] : ''; ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="f_fin">Fecha Fin</label>
                <input type="date" id="f_fin" name="f_fin" class="form-control" value="<?php echo isset($_POST['f_fin']) ? $_POST['f_fin'] : ''; ?>">
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <h4>Total Resultados: <?php echo $total; ?></h4>
    <table class="table table-hover">
        <thead>
            <tr align="center">
            <td>FOTO</td>
            <td>NOMBRES</td>
            <td>EDAD</td>
            <td>PROVINCIA</td>
            <td>CORREO</td>
            <td>TELEFONO</td>
            <td>DIRECCION</td>
            <td>SEXO</td>
            <td>FECHA REGISTRO</td>
            <td>SUGERENCIAS</td>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($total > 0) {
            while ($r = mysqli_fetch_array($fila)) { 
                $imgPath = "imgusuario/" . $r["codigo_persona"] . ".png";

                if (file_exists($imgPath)) {
                    $imgTag = "<img src='$imgPath' width='50' height='50'>";
                } else {
                    $imgTag = "Sin foto";
                }

                $fnacimiento = $r["fnacimiento"];
                $fechaactual = new DateTime();
                $fnacimientodatetime = new DateTime($fnacimiento);
                $edad = $fechaactual->diff($fnacimientodatetime)->y;
                
                ?>
            
                <tr>
                <td><?php echo $imgTag; ?></td>
                <td><?php echo $r["nombre"]." ".$r["apaterno"]." ".$r["amaterno"]; ?></td>
                <td><?php echo $edad; ?></td>
                <td><?php echo $r["provincia"]; ?></td>
                <td><?php echo $r["correo"]; ?></td>
                <td><?php echo $r["telefono"]; ?></td>
                <td><?php echo $r["direccion"]; ?></td>
                <td><?php echo $r["sexo"]; ?></td>
                <td><?php echo $r["fregistro"]; ?></td>
                    <td>
                        <a target="_parent" href="versugerencias.php?codigo=<?php echo $r["codigo"]; ?>">
                        VER SUGERENCIAS
                        </a>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="5" class="text-center">No se encontraron resultados</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>