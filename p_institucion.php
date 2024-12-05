<?php
// Configuración de la conexión a la base de datos
$servidor = "localhost";
$usuario = "root"; 
$contrasena = ""; 
$base_datos = "sisper"; 

// Conexión a la base de datos
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos enviados desde el formulario
$num_institucion = $_POST['numinstitucion'];
$nombre = $_POST['nombre'];
$provincia = $_POST['provincia'];
$director = $_POST['director'];
$nalumnos = $_POST['nalumnos'];
$ndocentes = $_POST['ndocentes'];
$nadministrativos = $_POST['nadministrativos'];

// Validar que los datos no estén vacíos
if (empty($num_institucion) || empty($nombre) || empty($provincia) || empty($director) || empty($nalumnos) || empty($ndocentes) || empty($nadministrativos)) {
    die("Error: Todos los campos son obligatorios.");
}

// Función para generar una contraseña aleatoria
function generapass() {
    $plantilla = "qwertyuiopasdfghjklzxcvbnm1234567890";
    $password = "";

    for ($i = 1; $i <= 8; $i++) {
        $password .= substr($plantilla, rand(0, strlen($plantilla) - 1), 1);
    }

    return $password;
}

// Generar la contraseña
$password_generada = generapass();

// Iniciar una transacción
$conexion->begin_transaction();

try {
    // Insertar datos en la tabla `institucion`
    $sql_institucion = "INSERT INTO institucion (
                            codigo, 
                            nombre, 
                            provincia, 
                            director, 
                            nalumnos, 
                            ndocentes, 
                            nadministrativos
                        ) VALUES (
                            '$num_institucion', 
                            '$nombre', 
                            '$provincia', 
                            '$director', 
                            $nalumnos, 
                            $ndocentes, 
                            $nadministrativos
                        )";

    if (!$conexion->query($sql_institucion)) {
        throw new Exception("Error al insertar en la tabla institucion: " . $conexion->error);
    }

    // Insertar datos en la tabla `usuario`
    $sql_usuario = "INSERT INTO usuario (
                        codigo, 
                        tipo_usuario, 
                        passwoard
                    ) VALUES (
                        '$num_institucion', 
                        1, 
                        '$password_generada'
                    )";

    if (!$conexion->query($sql_usuario)) {
        throw new Exception("Error al insertar en la tabla usuario: " . $conexion->error);
    }

    // Confirmar la transacción
    $conexion->commit();
    echo "Institución y usuario guardados exitosamente.<br>";
    echo "Código de institución: $num_institucion<br>";
    echo "Contraseña generada: $password_generada";

} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conexion->rollback();
    echo "Se produjo un error: " . $e->getMessage();
}

// Cerrar la conexión
$conexion->close();
?>
