<?php
$nombreUser = $_POST["nombreUser"];
$email = $_POST["email"];
$contraseña = $_POST["contraseña"];
$servername = "127.0.0.1";
$database = "Metalized";
$username = "alumno";
$password = "alumnoipm";

$conexion = mysqli_connect($servername, $username, $password, $database);

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
} 
else {
    $query = "INSERT INTO Usuario VALUES (null, '$nombreUser', '$email', '$contraseña');";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        header("Location: metalized.php");
        exit();
    } else {
        echo "Error en la inserción: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
