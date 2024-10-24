<?php
    $servername = "127.0.0.1";
    $database = "Metalized";
    $username = "alumno";
    $password = "alumnoipm";

    $nombreUser= $_POST["nombreUser"];
    $contraseña = $_POST["contraseña"];
    $conexion = mysqli_connect($servername, $username, $password, $database);
    
    $stmt = $conexion->prepare("SELECT id FROM Usuario WHERE nombreUser = ? AND contraseña = ? ");
    $stmt->bind_param("ss", $nombreUser, $contraseña);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $fila = $resultado->fetch_assoc();

    if ($fila) {
        session_start();
        $_SESSION["idUsuario"] = $fila["id"];
        header("Location: metalized.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
 
mysqli_close($conexion);
?>
