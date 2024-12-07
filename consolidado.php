<?php
// Conexión a la base de datos
include("cabecera.php");

$conexion = new mysqli("localhost", "root", "", "sisper");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Inicializar variables para el consolidado
$totalPersonas = 0;
$totalInstituciones = 0;
$totalGeneral = 0;
$totalSugerenciasPersonas = 0;
$totalSugerenciasInstituciones = 0;
$totalSugerenciasGeneral = 0;

// Provincias a considerar
$provincias = ["Barranca", "Cajatambo", "Canta", "Cañete", "Huaral", "Huarochirí", "Huaura", "Oyón", "Yauyos"];

// Datos por provincia
$datosPersonas = [];
$datosInstituciones = [];

// Inicializar arrays de conteo
foreach ($provincias as $provincia) {
    $datosPersonas[$provincia] = ["num" => 0, "sug" => 0];
    $datosInstituciones[$provincia] = ["num" => 0, "sug" => 0];
}

// Consultar datos para personas
$queryPersonas = "SELECT provincia, COUNT(*) as totalPersonas, SUM(sugerencias) as totalSugerencias 
                  FROM sugerencia 
                  WHERE tipo_usuario = 'persona' 
                  GROUP BY provincia";
$resultPersonas = $conexion->query($queryPersonas);
if ($resultPersonas) {
    while ($row = $resultPersonas->fetch_assoc()) {
        $provincia = $row['provincia'];
        $datosPersonas[$provincia]['num'] = $row['totalPersonas'];
        $datosPersonas[$provincia]['sug'] = $row['totalSugerencias'];
        $totalPersonas += $row['totalPersonas'];
        $totalSugerenciasPersonas += $row['totalSugerencias'];
    }
}

// Consultar datos para instituciones
$queryInstituciones = "SELECT provincia, COUNT(*) as totalInstituciones, SUM(sugerencias) as totalSugerencias 
                       FROM sugerencia 
                       WHERE tipo_usuario = 'institucion' 
                       GROUP BY provincia";
$resultInstituciones = $conexion->query($queryInstituciones);
if ($resultInstituciones) {
    while ($row = $resultInstituciones->fetch_assoc()) {
        $provincia = $row['provincia'];
        $datosInstituciones[$provincia]['num'] = $row['totalInstituciones'];
        $datosInstituciones[$provincia]['sug'] = $row['totalSugerencias'];
        $totalInstituciones += $row['totalInstituciones'];
        $totalSugerenciasInstituciones += $row['totalSugerencias'];
    }
}

// Calcular totales generales
$totalGeneral = $totalPersonas + $totalInstituciones;
$totalSugerenciasGeneral = $totalSugerenciasPersonas + $totalSugerenciasInstituciones;

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consolidado</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #4CAF50; color: white; }
        .header { background-color: #007BFF; color: white; font-weight: bold; text-align: left; padding: 10px; }
    </style>
</head>
<body>
    <div class="header">CONSOLIDADO</div>
    <table>
        <tr>
            <th>Total de Personas</th>
            <th>Total de Instituciones</th>
            <th>Total General</th>
            <th>Total Sugerencias x Personas</th>
            <th>Total Sugerencias x Instituciones</th>
            <th>Total General de Sugerencias</th>
        </tr>
        <tr>
            <td><?= $totalPersonas ?></td>
            <td><?= $totalInstituciones ?></td>
            <td><?= $totalGeneral ?></td>
            <td><?= $totalSugerenciasPersonas ?></td>
            <td><?= $totalSugerenciasInstituciones ?></td>
            <td><?= $totalSugerenciasGeneral ?></td>
        </tr>
    </table>

    <div class="header">CANTIDAD DE PERSONAS POR PROVINCIAS</div>
    <table>
        <tr>
            <th>Provincia</th>
            <?php foreach ($provincias as $provincia): ?>
                <th><?= $provincia ?></th>
            <?php endforeach; ?>
            <th>Total</th>
        </tr>
        <tr>
            <td>N°</td>
            <?php $totalPersonasProv = 0; foreach ($provincias as $provincia): ?>
                <td><?= $datosPersonas[$provincia]['num'] ?></td>
                <?php $totalPersonasProv += $datosPersonas[$provincia]['num']; ?>
            <?php endforeach; ?>
            <td><?= $totalPersonasProv ?></td>
        </tr>
        <tr>
            <td>Sug.</td>
            <?php $totalSugPersonasProv = 0; foreach ($provincias as $provincia): ?>
                <td><?= $datosPersonas[$provincia]['sug'] ?></td>
                <?php $totalSugPersonasProv += $datosPersonas[$provincia]['sug']; ?>
            <?php endforeach; ?>
            <td><?= $totalSugPersonasProv ?></td>
        </tr>
    </table>

    <div class="header">CANTIDAD DE INSTITUCIONES POR PROVINCIAS</div>
    <table>
        <tr>
            <th>Provincia</th>
            <?php foreach ($provincias as $provincia): ?>
                <th><?= $provincia ?></th>
            <?php endforeach; ?>
            <th>Total</th>
        </tr>
        <tr>
            <td>N°</td>
            <?php $totalInstitucionesProv = 0; foreach ($provincias as $provincia): ?>
                <td><?= $datosInstituciones[$provincia]['num'] ?></td>
                <?php $totalInstitucionesProv += $datosInstituciones[$provincia]['num']; ?>
            <?php endforeach; ?>
            <td><?= $totalInstitucionesProv ?></td>
        </tr>
        <tr>
            <td>Sug.</td>
            <?php $totalSugInstitucionesProv = 0; foreach ($provincias as $provincia): ?>
                <td><?= $datosInstituciones[$provincia]['sug'] ?></td>
                <?php $totalSugInstitucionesProv += $datosInstituciones[$provincia]['sug']; ?>
            <?php endforeach; ?>
            <td><?= $totalSugInstitucionesProv ?></td>
        </tr>
    </table>

    <div class="header">CANTIDAD TOTAL POR PROVINCIAS</div>
    <table>
        <tr>
            <th>Provincia</th>
            <?php foreach ($provincias as $provincia): ?>
                <th><?= $provincia ?></th>
            <?php endforeach; ?>
            <th>Total</th>
        </tr>
        <tr>
            <td>N° Total</td>
            <?php $totalGeneralProv = 0; foreach ($provincias as $provincia): ?>
                <?php 
                    $totalProvincia = $datosPersonas[$provincia]['num'] + $datosInstituciones[$provincia]['num'];
                    $totalGeneralProv += $totalProvincia;
                ?>
                <td><?= $totalProvincia ?></td>
            <?php endforeach; ?>
            <td><?= $totalGeneralProv ?></td>
        </tr>
        <tr>
            <td>Sug. Total</td>
            <?php $totalSugGeneralProv = 0; foreach ($provincias as $provincia): ?>
                <?php 
                    $totalSugProvincia = $datosPersonas[$provincia]['sug'] + $datosInstituciones[$provincia]['sug'];
                    $totalSugGeneralProv += $totalSugProvincia;
                ?>
                <td><?= $totalSugProvincia ?></td>
            <?php endforeach; ?>
            <td><?= $totalSugGeneralProv ?></td>
        </tr>
    </table>
</body>
</html>