<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "Usuario no está definido en la sesión.";
    exit();
}

$servername = "127.0.0.1";
$database = "Metalized";
$username = "alumno";
$password = "alumnoipm";

$conexion = mysqli_connect($servername, $username, $password, $database);

if (isset($_GET['idC'])) {
    $queryID = "SELECT id FROM Usuario WHERE nombreUser = '".$_SESSION['nombreUser']."'; ";
    $idUsuario = mysqli_query($conexion,$queryID);

    $idCancion = intval($_GET['idC']);

    $query = 
    "INSERT INTO Usuario_escucha_Cancion (idUsuario, idCancion, plays) 
    VALUES ($idUsuario, $idCancion, NOW())";

    mysqli_query($conexion, $query);

    $cancionQuery = "SELECT Cancion.titulo, Artista.nombre FROM Cancion JOIN Artista ON Cancion.idArtista = Artista.id WHERE Cancion.id = $idCancion";
    $resultado = mysqli_query($conexion, $cancionQuery);
    $cancion = mysqli_fetch_assoc($resultado);

    echo json_encode($cancion);
}
?>
<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo json_encode(['error' => 'Usuario no está definido en la sesión.']);
    exit();
}

$servername = "127.0.0.1";
$database = "Metalized";
$username = "alumno";
$password = "alumnoipm";

$conexion = mysqli_connect($servername, $username, $password, $database);
if (!$conexion) {
    die(json_encode(['error' => 'Conexión fallida: ' . mysqli_connect_error()]));
}

if (isset($_GET['idCancion'])) {
    // Obtener el ID del usuario utilizando el nombre de usuario de la sesión
    $nombreUsuario = mysqli_real_escape_string($conexion, $_SESSION['usuario']);
    $queryID = "SELECT id FROM Usuario WHERE nombreUser = '$nombreUsuario'";
    
    $resultadoID = mysqli_query($conexion, $queryID);
    if ($filaID = mysqli_fetch_assoc($resultadoID)) {
        $idUsuario = $filaID['id'];
    } else {
        echo json_encode(['error' => 'Usuario no encontrado.']);
        exit();
    }

    $idCancion = intval($_GET['idCancion']);

    // Insertar en la tabla Usuario_escucha_Cancion
    $query = "INSERT INTO Usuario_escucha_Cancion (idUsuario, idCancion, plays) VALUES (?, ?, NOW())";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $idUsuario, $idCancion);
    mysqli_stmt_execute($stmt);

    // Recuperar información de la canción
    $cancionQuery = "SELECT Cancion.titulo, Artista.nombre FROM Cancion JOIN Artista ON Cancion.idArtista = Artista.id WHERE Cancion.id = ?";
    $stmtCancion = mysqli_prepare($conexion, $cancionQuery);
    mysqli_stmt_bind_param($stmtCancion, 'i', $idCancion);
    mysqli_stmt_execute($stmtCancion);
    $resultadoCancion = mysqli_stmt_get_result($stmtCancion);
    
    if ($cancion = mysqli_fetch_assoc($resultadoCancion)) {
        echo json_encode($cancion);
    } else {
        echo json_encode(['error' => 'Canción no encontrada.']);
    }
} else {
    echo json_encode(['error' => 'ID de canción no proporcionado.']);
}

mysqli_close($conexion);
?>
