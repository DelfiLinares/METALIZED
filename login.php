<?php
    $nombreUser= $_GET["nombreUser"];
    $contraseña = $_GET["contraseña"];
    $servername = "127.0.0.1";
    $database = "Metalized";
    $username = "alumno";
    $password = "alumnoipm";

    $conexion = mysqli_connect($servername, $username, $password, $database);
    if (!$conexion) {
        die("Conexion fallida: " . mysqli_connect_error());
    }
    else{
        $query = "SELECT id FROM Usuario WHERE nombreUser = '$nombreUser';";
        $resultado = mysqli_query($conexion, $query);
        $fila = mysqli_fetch_assoc($resultado);

        session_start();
        $_SESSION["idUsuario"] = $fila["id"];
        header("Location: metalized.php");
    }


    <?php }
    mysqli_close($conexion);?>
