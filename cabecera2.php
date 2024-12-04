<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo2.css">
    <title>Cabecera Usuario</title>
</head>
<body>
    <header class="cabecera">
        <div class="logo-container">
            <img src="../img/gobierno.png" alt="Logo Gobierno Regional de Lima" class="logo">
        </div>
        <div class="menu-container">
            <nav class="menu">
                <a href="datosprincipales.php">DATOS PRINCIPALES</a>
                <div class="dropdown">
                <a>ACTUALIZACIÓN DATOS ▼</a>
                    <div class="dropdown-content">
                        <a href="actualizardatosp.php">ACTUALIZACIÓN DATOS PERSONALES</a>
                        <a href="cambiarfotoperfil.php">CAMBIAR FOTO PERFIL</a>  
                        <a href="cambiarcontraseña.php">CAMBIAR CONTRASEÑA</a>                             
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
                        <a href="grafico1.php">Cantidad de sugerencias según tipo usuario</a>
                        <a href="grafico2.php">Cantidad de sugerencias por provincias</a>
                        <a href="grafico3.php">Cantidad de sugerencias por grupo de edad</a>
                        <a href="grafico4.php">Gráfico 4</a>
                        <a href="grafico5.php">Gráfico 5</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a class="dropbtn">GESTION ▼</a>
                    <div class="dropdown-content">
                        <a href="editarobjetivos.php">EDITAR OBJETIVOS</a>
                        <a href="comentarioseliminados.php">VER COMENTARIO ELIMINADOS</a>
                    </div>
                </div>
                <!-- <a href="#">CONSOLIDADO</a> -->
                <a href="busqueda.php">BÚSQUEDA</a>
                <a href="cerrarsesion.php">CERRAR SESIÓN</a>
            </nav>
        </div>
    </header>
</body>
</html>