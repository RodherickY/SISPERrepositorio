<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario Persona</title>
  <link rel="stylesheet" href="css/institucion.css">
</head>
<body>
  <div class="form-container">
    <h1>Que bueno que te has animado a dar tu opinion y tus aportes</h1>
    <form action="p_persona.php" method="post">

      <label for="dni">1.- DNI (*):</label>
      <input type="text" id="dni" name="dni" required>

      <label for="nombre">2.- Nombre  (*):</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="apaterno">3.- Apellido Paterno  (*):</label>
      <input type="text" id="apaterno" name="apaterno" required>

      <label for="amaterno">3.- Apellido Paterno  (*):</label>
      <input type="text" id="amaterno" name="amaterno" required>

      <label for="fnacimiento">4.- Fecha de nacimiento:</label>
      <input type="date" id="fnacimiento" name="fnacimiento">

      <label for="provincia">5.- Provincia (*):</label>
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

      

      

      <button type="submit">Clic aquí para guardar tus datos</button>
    </form>
  </div>
</body>
</html>