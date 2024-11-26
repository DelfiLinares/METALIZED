<?php
    $nombreUsuario= $_POST["nombreUser"];
    $contrasenia = $_POST["contraseña"];

    $servername = "127.0.0.1";
    $database = "Metalized";
    $username = "alumno";
    $password = "alumnoipm";
    
    $conexion = mysqli_connect($servername, $username, $password, $database);
 
    if (!$conexion) {
        die("Conexion fallida: " . mysqli_connect_error());
    }
    else{
      
        $query = "select contraseña, nombreUser from Usuario where nombreUser = '$nombreUsuario'";
        $resultado = mysqli_query($conexion, $query);

        if(mysqli_num_rows($resultado)  == 0){
            header("Location: login.html");
        }
        else {
            $fila = mysqli_fetch_assoc($resultado);
            if($fila["contraseña"] == $contrasenia){
                session_start();
                $_SESSION['usuario'] = $fila["nombreUser"]; 
                header("Location: metalized.php");

            }
            else{
                header("Location: index.html");
            }
        }
    }
    mysqli_close($conexion);
?>