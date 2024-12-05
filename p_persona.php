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
$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];
$fnacimiento = $_POST['fnacimiento'];
$provincia = $_POST['provincia'];

// Verificar si el DNI ya existe
$sql_verificar = "SELECT codigo FROM persona WHERE codigo = '$dni'";
$resultado = $conexion->query($sql_verificar);

if ($resultado->num_rows > 0) {
    die("El usuario con el DNI '$dni' ya está registrado.");
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

// Iniciar una transacción para asegurar consistencia de datos
$conexion->begin_transaction();

try {
    // Insertar datos en la tabla `persona`
    $sql_persona = "INSERT INTO persona (
                        codigo, 
                        nombre, 
                        apaterno, 
                        amaterno, 
                        fnacimiento, 
                        provincia
                    ) VALUES (
                        '$dni', 
                        '$nombre', 
                        '$apaterno', 
                        '$amaterno', 
                        '$fnacimiento', 
                        '$provincia'
                    )";

    if (!$conexion->query($sql_persona)) {
        throw new Exception("Error al insertar en la tabla persona: " . $conexion->error);
    }

    // Insertar datos en la tabla `usuario`
    $sql_usuario = "INSERT INTO usuario (
                        codigo, 
                        tipo_usuario, 
                        passwoard
                    ) VALUES (
                        '$dni', 
                        2, 
                        '$password_generada'
                    )";

    if (!$conexion->query($sql_usuario)) {
        throw new Exception("Error al insertar en la tabla usuario: " . $conexion->error);
    }

    // Insertar datos en la tabla `datoespecifico`
    $sql_datoespecifico = "INSERT INTO datoespecifico(codigo) VALUES('$dni')";

    if (!$conexion->query($sql_datoespecifico)) {
        throw new Exception("Error al insertar en la tabla datoespecifico: " . $conexion->error);
    }

    // Confirmar la transacción
    $conexion->commit();
    echo "Usuario registrado correctamente.<br>";
    echo "Código de usuario: $dni<br>";
    echo "Contraseña: $password_generada<br>";

} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conexion->rollback();
    echo "Se produjo un error: " . $e->getMessage();
}

// Cerrar la conexión
$conexion->close();
?>
