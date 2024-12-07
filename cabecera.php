<?php
include("./auth.php");
include("./conexion.php");
$cod = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="menu_assets/estilo.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/estilo2.css"> <!-- Estilo para las cabeceras -->
</head>

<body>

    <?php if ($cod == "admin001") { ?>
        <!-- Cabecera para el administrador -->
        <header class="cabecera">
            <div class="logo-container">
                <img src="img/gobierno.png" alt="Logo Gobierno Regional de Lima" class="logo">
            </div>

            <div class="menu-container">
                <nav class="menu">
                    <a href="datosprincipales.php">DATOS PRINCIPALES</a>
                    <div class="dropdown">
                        <a>ACTUALIZACIÓN DATOS ▼</a>
                        <div class="dropdown-content">
                            <a href="actualizardatosp.php">ACTUALIZACIÓN DATOS PERSONALES</a>
                            <a href="cambiarfotoperfil.php">CAMBIAR FOTO PERFIL</a>
                            <a href="cambiarcontrasena.php">CAMBIAR CONTRASEÑA</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="dropbtn">REPORTE ▼</a>
                        <div class="dropdown-content">
                            <a href="reportegeneral.php">REPORTE GENERAL</a>
                            <a href="reportefecha.php">REPORTE POR FECHA REGISTRO</a>
                            <a href="reporteitems.php">REPORTE POR ITEMS SUGERENCIAS</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="dropbtn">GRÁFICOS ▼</a>
                        <div class="dropdown-content">
                            <a href="graficotipousuario.php">Cantidad de sugerencias según tipo usuario</a>
                            <a href="graficoprovincia.php">Cantidad de sugerencias por provincias</a>
                            <a href="graficoedad.php">Cantidad de sugerencias por grupo de edad</a>
                            <a href="graficotiposugerencia.php">Cantidad de sugerencias según item</a>
                            <a href="graficoestadosugerencia.php">Cantidad de sugerencias según estado</a>
                        </div>
                    </div>

                    <div>
                        <a href="comentarioseliminados.php">VER COMENTARIO ELIMINADOS</a>
                    </div>

                    <div class="dropdown">
                        <a class="dropbtn">EDITAR OBJETIVOS ▼</a>
                        <div class="dropdown-content">
                            <a href="objetivo1admin.php">OBJETIVO 1</a>
                            <a href="objetivo2admin.php">OBJETIVO 2</a>
                            <a href="objetivo3admin.php">OBJETIVO 3</a>
                            <a href="objetivo4admin.php">OBJETIVO 4</a>
                            <a href="objetivo5admin.php">OBJETIVO 5</a>
                            <a href="objetivo6admin.php">OBJETIVO 6</a>
                        </div>
                    </div>

                    <div><a href="busqueda.php">BÚSQUEDA</a></div>
                    <div><a href="consolidado.php">CONSOLIDADO</a></div>
                    <div></div><a href="cerrarsesion.php">CERRAR SESIÓN</a>
                </nav>
            </div>
        </header>
        <?php
        
        } else {
        
        ?>
        <!-- Cabecera para los usuarios -->
        <header class="cabecera">
            <div class="logo-container">
                <img src="img/gobierno.png" alt="Logo Gobierno Regional de Lima" class="logo">
            </div>
            <div class="menu-container">
                <nav class="menu">
                    <a href="datosprincipales.php">DATOS PRINCIPALES</a>
                    <div class="dropdown">
                        <a>ACTUALIZACIÓN DATOS ▼</a>
                        <div class="dropdown-content">
                            <a href="actualizardatosp.php">ACTUALIZACIÓN DATOS PERSONALES</a>
                            <a href="cambiarfotoperfil.php">CAMBIAR FOTO PERFIL</a>
                            <a href="cambiarcontrasena.php">CAMBIAR CONTRASEÑA</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="dropbtn">OBJETIVOS ▼</a>
                        <div class="dropdown-content">
                            <a href="objetivo1.php">OBJETIVO 1</a>
                            <a href="objetivo2.php">OBJETIVO 2</a>
                            <a href="objetivo3.php">OBJETIVO 3</a>
                            <a href="objetivo4.php">OBJETIVO 4</a>
                            <a href="objetivo5.php">OBJETIVO 5</a>
                            <a href="objetivo6.php">OBJETIVO 6</a>
                        </div>
                    </div>
                    <a href="missugerencias.php">MIS SUGERENCIAS</a>
                    <a href="cerrarsesion.php">CERRAR SESIÓN</a>
                </nav>
            </div>
        </header>
    <?php } ?>

</body>

</html>
