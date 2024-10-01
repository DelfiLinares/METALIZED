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
        $query = "insert into Usuario values(null, '$nombreUser', '$email', '$contraseña');";
        $resultado = mysqli_query($conexion, $query);
        echo "Datos que hay en la base:\n";
        $resultados = mysqli_query($conexion,"select * from Usuario;");
        while($fila = mysqli_fetch_assoc($resultados)){?>
            <p><?php echo $fila['nombreUser']. " " .$fila['email']. " " .$fila['contraseña']?></p>
            <?php }
    }

    function mostrarDatosTabla($conexion){  ?>
        <table>
            <th>Nombre</th>
            <th>Email</th>
            <th>Contraseña</th>
<?php   $resultados = mysqli_query($conexion,"select * from Usuario;");
        while($fila = mysqli_fetch_assoc($resultados)){ ?>
        <tr>
            <td> <?php echo $fila['nombreUser']?> </td>
            <td> <?php echo $fila['email']?> </td>
            <td> <?php echo $fila['contraseña']?> </td>
        </tr>
        <?php }?>
        </table>
    <?php }
    mysqli_close($conexion);?>
