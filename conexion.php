
<?php

$cn = mysqli_connect("localhost", "root", "", "sisper");

            if (!$cn) {
                die("Error de conexión: " . mysqli_connect_error());
            }
?>