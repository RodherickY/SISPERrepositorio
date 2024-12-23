<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario Institución Educativa</title>
  <link rel="stylesheet" href="css/institucion.css">
</head>
<body>
  <div class="form-container">
    <h1>¡Gracias! Has podido reunir a tu comunidad educativa y has pedido su opinión, ahora nos las compartes para mejorar. Gracias</h1>
    
    <form action="p_institucion.php" method="post">

    <label for="numinstitucion">1.- Nro de la Institución Educativa (*):</label>
      <input type="text" id="numinstitucion" name="numinstitucion" required>

      <label for="nombre">2.- Nombre de la Institución Educativa (*):</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="provincia">3.- Provincia (*):</label>
      <select id="provincia" name="provincia" required>
        <option value="Barranca">Barranca</option>
        <option value="Huaral">Huaral</option>
        <option value="Cañete">Cañete</option>
        <option value="Huaura">Huaura</option>
        <OPtion value="Oyon">Oyon</OPtion>
        <OPtion value="Cajatambo">Cajatambo</OPtion>
        <OPtion value="Yauyos">Yauyos</OPtion>
        <OPtion value="Huarochiri">Huarochiri</OPtion>
        <OPtion value="Canta">Canta</OPtion>
      </select>

      <label for="director">4.- Director(a) responsable:</label>
      <input type="text" id="director" name="director">

      <fieldset>
        <legend>5.- Número de personas de la comunidad educativa que participaron (*):</legend>
        <label for="nalumnos">Nro. de Alumnos:</label>
        <input type="number" id="nalumnos" name="nalumnos" required>

        <label for="ndocentes">Nro. de Docentes:</label>
        <input type="number" id="ndocentes" name="ndocentes" required>

        <label for="nadministrativos">Nro. de Administrativos:</label>
        <input type="number" id="nadministrativos" name="nadministrativos" required>
      </fieldset>

      <label for="contrasena">6.- Contraseña:</label>
      <input type="text" id="contrasena" name="contrasena" maxlength="8">

      <button type="submit">Clic aquí para guardar tus datos</button>
    </form>
  </div>
</body>
</html>