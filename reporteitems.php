<?php
//include("cabecera.php");
include("conexion.php");

include("cabeceraLogo.php");
include("barralateral.php");

$filtroItem = isset($_POST['filtro_item']) ? $_POST['filtro_item'] : '';

$sql = " select s.idsugerencia, s.codigo, s.tipo, s.item, s.descripcion, s.fecha,
        COALESCE(CONCAT(p.nombre, ' ', p.apaterno, ' ', p.amaterno), i.nombre) as nombre_completo
    from sugerencia s
    left join persona p on s.codigo = p.codigo
    left join institucion i on s.codigo = i.codigo
    where s.item like '%$filtroItem%'
    order by s.fecha desc";
$result = mysqli_query($cn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Sugerencias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Reporte de Sugerencias</h2>

        <form method="POST" id="formFiltro">
            <div class="form-row mb-4">
                <div class="form-group col-md-6">
                    <label for="filtro_item">Buscar por Item:</label>
                    <input type="text" class="form-control" id="filtro_item" name="filtro_item" value="<?php echo $filtroItem; ?>" placeholder="Escribe para buscar..." oninput="filtrarResultados()">
                </div>
            </div>
        </form>

        <h4>Total Resultados: <?php echo mysqli_num_rows($result); ?></h4>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre Completo</th>
                    <th>Tipo</th>
                    <th>Item</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody id="tablaResultados">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($r = mysqli_fetch_assoc($result)) {
                        $imgPath = "imgusuario/" . $r['codigo'] . ".png";

                        if (file_exists($imgPath)) {
                            $imgTag = "<img src='$imgPath' width='50' height='50'>";
                        } else {
                            $imgTag = "Sin foto";
                        }

                        $nombreCompleto = $r['nombre_completo'];
                        ?>
                        <tr>
                            <td><?php echo $imgTag; ?></td>
                            <td><?php echo $nombreCompleto; ?></td>
                            <td><?php echo $r['tipo']; ?></td>
                            <td><?php echo $r['item']; ?></td>
                            <td><?php echo $r['descripcion']; ?></td>
                            <td><?php echo $r['fecha']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No se encontraron resultados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function filtrarResultados() {
            var filtro = $('#filtro_item').val();

            $.ajax({
                url: 'reporteitems.php',
                type: 'POST',
                data: { filtro_item: filtro },
                success: function(data) {
                    $('#tablaResultados').html($(data).find('#tablaResultados').html());
                }
            });
        }
    </script>

    <br>
    
</body>
</html>