<?php
include("./auth.php");
include("./conexion.php");
$cod = $_SESSION['usuario'];

$sql = "SELECT u.tipo_usuario, 
               CASE 
                   WHEN u.tipo_usuario = 1 THEN i.nombre 
                   WHEN u.tipo_usuario = 2 THEN CONCAT(p.nombre, ' ', p.apaterno, ' ', p.amaterno) 
                   ELSE 'Administrador'
               END AS nombre, 
               CASE 
                   WHEN u.tipo_usuario = 1 THEN 'Institución'
                   WHEN u.tipo_usuario = 2 THEN 'Persona'
                   ELSE 'Administrador'
               END AS tipo 
        FROM usuario u
        LEFT JOIN persona p ON u.codigo = p.codigo
        LEFT JOIN institucion i ON u.codigo = i.codigo
        WHERE u.codigo = '$cod'";

$f = mysqli_query($cn, $sql);
$r = mysqli_fetch_assoc($f);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Barra lateral</title>
  <!-- Enlace para iconos de Google -->
  <link rel="stylesheet" href="css/barralateral.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  
</head>
<body>
  <aside class="sidebar">
    <div class="sidebar-header">
      <img src="img/logogobiernoregional.png" alt="Logo Gobierno Regional de Lima" />
      <h2> PER</h2>
    </div>
    <ul class="sidebar-links">
      <!-- Menú principal -->

      <?php if ($cod == "admin001") { ?>

      <h4>
        <span>Menú Principal</span>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="datosprincipales.php">
          <span class="material-symbols-outlined"> dashboard </span>Datos Principales</a>
      </li>
      <li>
        <a href="actualizardatosp.php">
          <span class="material-symbols-outlined"> edit </span>Actualización de Datos</a>
      </li>
      <li>
        <a href="cambiarfotoperfil.php">
          <span class="material-symbols-outlined"> image </span>Cambiar Foto de Perfil</a>
      </li>
      <li>
        <a href="cambiarcontrasena.php">
          <span class="material-symbols-outlined"> lock </span>Cambiar Contraseña</a>
      </li>

      <h4>
        <span>Reportes</span>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="reportegeneral.php">
          <span class="material-symbols-outlined"> report </span>Reporte General</a>
      </li>
      <li>
        <a href="reportefecha.php">
          <span class="material-symbols-outlined"> calendar_today </span>Reporte por Fecha</a>
      </li>
      <li>
        <a href="reporteitems.php">
          <span class="material-symbols-outlined"> list </span>Reporte por Ítems</a>
      </li>


      <h4>
        <span>Gráficos</span>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="graficotipousuario.php">
          <span class="material-symbols-outlined"> pie_chart </span>Sugerencias por Usuario</a>
      </li>
      <li>
        <a href="graficoprovincia.php">
          <span class="material-symbols-outlined"> map </span>Sugerencias por Provincia</a>
      </li>
      <li>
        <a href="graficoedad.php">
          <span class="material-symbols-outlined"> bar_chart </span>Sugerencias por Edad</a>
      </li>
      <li>
        <a href="graficotiposugerencia.php">
          <span class="material-symbols-outlined"> insights </span>Sugerencias por Ítem</a>
      </li>
      <li>
        <a href="graficoestadosugerencia.php">
          <span class="material-symbols-outlined"> check_circle </span>Sugerencias por Estado</a>
      </li>

      <h4>
        <span>Editar Objetivos</span>
        <div class="menu-sparator"></div>
      </h4>

      <li>
        <a href="objetivo1admin.php">
          <span class="material-symbols-outlined"> edit </span>Editar Objetivo 1</a>
      </li>
      <li>
        <a href="objetivo2admin.php">
          <span class="material-symbols-outlined"> edit </span>Editar Objetivo 2</a>
      </li>
      <li>
        <a href="objetivo3admin.php">
          <span class="material-symbols-outlined"> edit </span>Editar Objetivo 3</a>
      </li>
      <li>
        <a href="objetivo4admin.php">
          <span class="material-symbols-outlined"> edit </span>Editar Objetivo 4</a>
      </li>
      <li>
        <a href="objetivo5admin.php">
          <span class="material-symbols-outlined"> edit </span>Editar Objetivo 5</a>
      </li>
      <li>
        <a href="objetivo6admin.php">
          <span class="material-symbols-outlined"> edit </span>Editar Objetivo 6</a>
      </li>

      <h4>
        <span>Otros</span>
        <div class="menu-separator"></div>
      </h4>
      
      <li>
        <a href="comentarioseliminados.php">
          <span class="material-symbols-outlined"> delete </span>Comentarios Eliminados</a>
      </li>
      <li>
        <a href="busqueda.php">
          <span class="material-symbols-outlined"> search </span>Búsqueda</a>
      </li>
      <li>
        <a href="consolidado.php">
          <span class="material-symbols-outlined"> table_chart </span>Consolidado</a>
      </li>
      <li>
        <a href="cerrarsesion.php">
          <span class="material-symbols-outlined"> logout </span>Cerrar Sesión</a>
      </li>
    
    </ul>
    <div class="user-account">
      <div class="user-profile">
        <img src="imgusuario/persona1.png" alt="Imagen de Perfil" />
        <div class="user-detail">
          <h3><?php echo $r["nombre"]; ?></h3>
          <span>Rol</span>
        </div>
      </div>
    </div>

      <?php
        
        } else {
        
      ?>

    <ul class="sidebar-links">

    <h4>
        <span>Menú Principal</span>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="datosprincipales.php">
          <span class="material-symbols-outlined"> dashboard </span>Datos Principales</a>
      </li>
      <li>
        <a href="actualizardatosp.php">
          <span class="material-symbols-outlined"> edit </span>Actualización de Datos</a>
      </li>
      <li>
        <a href="cambiarfotoperfil.php">
          <span class="material-symbols-outlined"> image </span>Cambiar Foto de Perfil</a>
      </li>
      <li>
        <a href="cambiarcontrasena.php">
          <span class="material-symbols-outlined"> lock </span>Cambiar Contraseña</a>
      </li>

      <h4>
        <span>Objetivos</span>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="objetivo1.php">
          <span class="material-symbols-outlined"> lock </span>Objetivo 1</a>
      </li>
      <li>
        <a href="objetivo2.php">
          <span class="material-symbols-outlined"> lock </span>Objetivo 2</a>
      </li>
      <li>
        <a href="objetivo3.php">
          <span class="material-symbols-outlined"> lock </span>Objetivo 3</a>
      </li>
      <li>
        <a href="objetivo4.php">
          <span class="material-symbols-outlined"> lock </span>Objetivo 4</a>
      </li>
      <li>
        <a href="objetivo5.php">
          <span class="material-symbols-outlined"> lock </span>Objetivo 5</a>
      </li>
      <li>
        <a href="objetivo6.php">
          <span class="material-symbols-outlined"> lock </span>Objetivo 6</a>
      </li>

      <h4>
        <span>Sugerencias realizadas</span>
        <div class="menu-separator"></div>
      </h4>

      <li>
        <a href="missugerencias.php">
          <span class="material-symbols-outlined"> lock </span>Mis Sugerencias</a>
      </li>

      <h4>
        <span>Otros</span>
        <div class="menu-separator"></div>
      </h4>

      <li>
        <a href="cerrarsesion.php">
          <span class="material-symbols-outlined"> logout </span>Cerrar Sesión</a>
      </li>

    </ul>
    <div class="user-account">
  <div class="user-profile">
    <img src="imgusuario/<?php echo $cod; ?>.png" alt="Imagen de Perfil"/>
    <div class="user-detail">
      <h3><?php echo $r["nombre"]; ?></h3>
      <span><?php echo $r["tipo"]; ?></span>
    </div>
  </div>
</div>

    <?php
        
        }
        
    ?>

  </aside>
</body>
</html>
