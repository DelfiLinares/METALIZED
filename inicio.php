<?php
session_start();    

$servername = "127.0.0.1";
$database = "Metalized";
$username = "alumno";
$password = "alumnoipm";

$nombreUser = $_POST["nombreUser"];
$email = $_POST["email"];
$contraseña = $_POST["contraseña"];
$_SESSION['usuario'] = $nombreUser;

$conexion = mysqli_connect($servername, $username, $password, $database);

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
} 
else {
    $ee = "SELECT COUNT(*) as count FROM Usuario WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $ee);
    
    if($resultado){
        $fila = mysqli_fetch_assoc($resultado);
        
        if($fila['count'] > 0){
            echo "Ya existe ese email, debe ingresar con uno nuevo";
        } 
        else{
            $query = "INSERT INTO Usuario (nombreUser, email, contraseña) VALUES ('$nombreUser', '$email', '$contraseña')";
            $resultado = mysqli_query($conexion, $query);

            if ($resultado) {
                $query = "SELECT id FROM Usuario WHERE nombreUser = '$nombreUser'";
                $resultado = mysqli_query($conexion, $query);
                $fila = mysqli_fetch_assoc($resultado);
                // Redirigir al usuario a la página correspondiente
                header("Location: metalized.php");
                exit();
            } else {
                echo "Error en la inserción: " . mysqli_error($conexion);
            }
        }
    } else {
        echo "Error al consultar el correo: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
