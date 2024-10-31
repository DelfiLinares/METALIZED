<?php 
    session_start();
    $servername = "127.0.0.1";
    $database = "Metalized";
    $username = "alumno";
    $password = "alumnoipm";

    $conexion = mysqli_connect($servername, $username, $password, $database);
    if (!$conexion) {
        die("Conexion fallida: " . mysqli_connect_error());
    }
    else {
        if (isset($_GET['artista'])) {
            $a_id = $_GET['artista'];            

            
            $queryAlbum = "SELECT imagen, titulo FROM Album WHERE idArtista = ? ORDER BY titulo DESC";
            $stmt = $conexion->prepare($queryAlbum);
            $stmt->bind_param("i", $a_id);
            $stmt->execute();
            $resultadoA = $stmt->get_result();

            
            $queryArtista = "SELECT nombre, imagen, bio FROM Artista WHERE id = ?";
            $stmtArtista = $conexion->prepare($queryArtista);
            $stmtArtista->bind_param("i", $a_id);
            $stmtArtista->execute();
            $resultadoAr = $stmtArtista->get_result();

           
            $queryCancion = "SELECT Cancion.titulo, Cancion.duracion, Album.imagen FROM Usuario_escucha_Cancion 
            JOIN Cancion ON idCancion = Cancion.id
            JOIN Album ON idAlbum = Album.id
            JOIN Artista ON Album.idArtista = Artista.id
            WHERE Artista.id = ? 
            GROUP BY Cancion.titulo, Cancion.duracion, Album.imagen
            ORDER BY COUNT(*) DESC";
            $stmtCancion = $conexion->prepare($queryCancion);
            $stmtCancion->bind_param("i", $a_id);
            $stmtCancion->execute();
            $resultadoC = $stmtCancion->get_result();

            // Consulta para la canción actual
            $queryCanAct = "SELECT Cancion.titulo, Album.imagen, Artista.nombre FROM Cancion 
            JOIN Album ON idAlbum = Album.id 
            JOIN Artista ON idArtista = Artista.id
            WHERE Cancion.id = (
                SELECT idCancion FROM Usuario_escucha_Cancion 
                WHERE plays = CURRENT_DATE()
                )";
            $cancionActual = mysqli_query($conexion, $queryCanAct);
        } else {
            echo "No se ha proporcionado un ID de artista válido.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&display=swap');
    </style>
    <link rel="icon" type="image/png" href="calavera.png">
    <link rel="stylesheet" href="InfoArtista.css" type="text/css"/>
    <title>Metalized</title>
</head>
<body>
    <header>
        <section id="contenedor">
            <div class="nyl">
                <img src="calavera.png">
                <h2>Metalized</h2>
            </div>
            <div class="menu">
                <ul>
                    <li id="inicio"><a href="metalized.php">Inicio</a></li>
                    <li id="descubre"><a href="descubre.php">Descubre</a></li>
                    <li id="mi_libreria"><p>Mi libreria</p>
                        <ul class="milibreria">
                            <li id="uno"><a href="canciones.php">Canciones</a></li>
                            <li id="dos"><a href="artistas.php">Artistas</a></li>
                            <li id="tres"><a href="albumes.php">Albumes</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </section>
    </header>

    <main>
        <div class="barra_horizontal">
            <div class="solapa">
                <h1>Metallica</h1>
            </div>
            <div class="seccionUsuario">
                <img src="ftPerfil.jpg">
                <h2><?php echo $_SESSION['usuario'] ?></h2>
            </div>
            <div class="barraBusq">
                <h3>Buscar</h3>
                <img src="lupa.png" id="lupa"/>
            </div>
        </div>
        
        <div id="artista">
            <?php while($fila = mysqli_fetch_assoc($resultadoAr)) { ?>
                <section class="fotoynombre">
                    <img src="<?php echo $fila['imagen']; ?>" alt="Imagen del artista">
                    <div class="info">
                        <h1 class="nombre"><?php echo $fila['nombre']; ?></h1>
                        <p><?php echo $fila['bio']; ?></p>
                    </div>
                </section>
            <?php } ?>

            <div class="contenedor2">
                <section id="canciones">
                    <h1>Populares</h1>
                    <?php while($fila = mysqli_fetch_assoc($resultadoC)) { ?>
                        <div class="cancion">
                            <img src="<?php echo $fila['imagen'] ?>">
                            <div class="info-popular">
                                <h3 class="tituloC"><?php echo $fila['titulo']; ?></h3>
                                <h3 class="duracion"><?php echo $fila['duracion']; ?></h3>
                            </div>
                        </div>
                    <?php } ?>
                </section>

                <section id="albumes">
                    <h1>Álbumes</h1>
                    <section id="gridAlbums">
                        <?php while($fila = mysqli_fetch_assoc($resultadoA)) { ?>
                            <div class="album">
                                <img src="<?php echo $fila['imagen']; ?>">
                                <h3 class="titulo"><?php echo $fila['titulo']; ?></h3>
                            </div>
                        <?php } ?>
                    </section>
                </section>
            </div>
        </div>
    </main>

    <footer>
        <div id="imagenCancion">
            <?php while($fila = mysqli_fetch_assoc($cancionActual)) { ?> 
                <img src="<?php echo $fila['imagen']; ?>">
                <div id="infoCancion">
                    <h2><?php echo $fila['titulo']; ?></h2>
                    <h3><?php echo $fila['nombre']; ?></h3>
                </div>
            <?php } ?>
        </div>
    </footer>
</body>
</html>
