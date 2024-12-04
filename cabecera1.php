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
                <!-- <a href="#">CONSOLIDADO</a> -->
                <a href="objetivos.php">OBJETIVOS</a>
                <a href="missugerencias.php">MIS SUGERENCIAS</a>
                <a href="cerrarsesion.php">CERRAR SESIÓN</a>
            </nav>
        </div>
    </header>
</body>
</html>