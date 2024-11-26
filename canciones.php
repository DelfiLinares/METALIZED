<?php 
session_start();
$servername = "127.0.0.1";
$database = "Metalized";
$username = "alumno";
$password = "alumnoipm";

$conexion = mysqli_connect($servername, $username, $password, $database);
if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
} else {        
    $queryPopular = "SELECT Album.imagen, Cancion.titulo, Artista.nombre, Artista.id as a_id FROM Usuario
    JOIN Usuario_escucha_Cancion ON idUsuario = Usuario.id
    JOIN Cancion ON idCancion = Cancion.id
    JOIN Album ON idAlbum = Album.id
    JOIN Artista ON idArtista = Artista.id 
    GROUP BY Album.imagen, Cancion.titulo, Artista.nombre, Artista.id
    ORDER BY COUNT(*) DESC LIMIT 15;";

    $queryMasEsc = 
    "SELECT Album.imagen, Cancion.titulo, Artista.nombre, Artista.id as a_id FROM Artista 
    JOIN Album ON idArtista = Artista.id
    JOIN Cancion ON idAlbum = Album.id
    JOIN Usuario_escucha_Cancion ON Cancion.id = Usuario_escucha_Cancion.idCancion  
    JOIN Usuario ON idUsuario = Usuario.id
    WHERE nombreUser = '".$_SESSION["usuario"]."'
    GROUP BY Album.imagen, Cancion.titulo, Artista.nombre, Artista.id
    ORDER BY COUNT(*) DESC LIMIT 15;";
    ;

    $queryMTSE = 
    "SELECT Album.imagen, Cancion.titulo, Artista.nombre, MAX(plays) AS ult_escucha, Artista.id as a_id
    FROM Usuario
    JOIN Usuario_escucha_Cancion ON idUsuario = Usuario.id
    JOIN Cancion ON idCancion = Cancion.id
    JOIN Album ON idAlbum = Album.id
    JOIN Artista ON idArtista = Artista.id 
    WHERE nombreUser = '".$_SESSION["usuario"]."'
    GROUP BY Cancion.id, Album.imagen, Artista.nombre, Artista.id
    ORDER BY ult_escucha ASC LIMIT 15;";


    $queryCancion = 
    "SELECT Album.imagen, Artista.nombre, Cancion.titulo
    FROM Cancion JOIN Album ON idAlbum = Album.id
    JOIN Artista ON idArtista = Artista.id;";

    $resultadoP = mysqli_query($conexion, $queryPopular);
    $resultadoME = mysqli_query($conexion, $queryMasEsc);
    $resultadoMTSE = mysqli_query($conexion, $queryMTSE);
    $resultadoC = mysqli_query($conexion, $queryCancion);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="canciones.css">
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
                <h1>Canciones</h1>
            </div>

            <button class="seccionUsuario" onclick="cerrarSesion()">
                    <img src="ftPerfil.jpg" >
                    <h2><?php echo $_SESSION['usuario'] ?></h2>
                </button>

                    <script>
                    function cerrarSesion() {
                        // fetch para enviar una solicitud al servidor
                        fetch('cerrar_sesion.php', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/x-www-form-urlencoded',},
                        })
                        .then(response => response.text())
                        .then(data => {
                            // si la sesión fue cerrada correctamente, redirige al usuario
                            window.location.href = 'login.html';
                        })
                        .catch(error => console.error('Error:', error));
                    }
                    </script>

            <div class="barraBusq">
                <h3>Buscar</h3>
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAXBJREFUSEu1lH1VA0EMxGcUgAUUAAoAB1QBVAGgAKqAooCigFZBWwdFAeCgVRDe8LK8Pbp7TT8u/93b2/1lkkmIjoMdv48iwMyOAdwBuAZw5kksAIwBvJBcRhNbA5jZLYBnAIKUQo8/kBxFIA2AP/7qFycAhiRn+jazSwBPAC78vEdSilrjD+Bl+fTM+7UMzUyQRwBScrKpXDkgXZyQVO2rYWZSJSUDkrpXjRygJp4CuEplqd3yck0BLEieRwGmH0mGrGtmof9zBaELKVsHrEjW3Pb7664lUo/eAcxJyl2hHqQmj0n2gk3WPAyjAEn9AnAkv5MclC5mNv3WlIdt6sOUpOtTVhRong2a/J9KstGijR5kzdOqkGwpKcXKzwWTtTXtb7UytS27e192mg3Fhy87Pbg0szQ3OhuR7JcgIc9XeiGlaW9VITsDvC/aqDdZAmtK9gJEIHsDCpDGJj4IIIPM/q/5gwG2smnb6G971rmCH/JPnxkOXXf0AAAAAElFTkSuQmCC" id="lupa" />
            </div>
        </div>
        
        <div id="canciones">
            <section id="populares">
                <div class="descripcion">
                    <h2>Popular</h2>
                </div>

                <div class="carousel carouselP">
                    <section class="seccionBoton">
                        <button class="prev" onclick="changeSlide(this, -1)">&#10094;</button>
                    </section>
                    <div class="slides">
                        <?php while ($canciones = mysqli_fetch_assoc($resultadoP)): 
                            
                        ?>
                        <div class="slide">
                            <img src="<?php echo $canciones['imagen']; ?>" alt="<?php echo $canciones['nombre']; ?>">
                            <h3 class="titulo"><?php echo $canciones['titulo']; ?></h3>
                            <h3 class="artista"><a href="infoArtista.php?artista=<?php echo $canciones['a_id'] ?>"><?php echo $canciones['nombre']; ?></a></h3>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <section class="seccionBoton">
                        <button class="next" onclick="changeSlide(this, 1)">&#10095;</button>
                    </section>
                </div>
            </section>

            <section id="masEscuchadas">
                <div class="descripcion">
                    <h2>Más Escuchadas</h2>
                </div>

                <div class="carousel carouselME">
                    <section class="seccionBoton">
                        <button class="prev" onclick="changeSlide(this, -1)">&#10094;</button>
                    </section>
                    <div class="slides">
                        <?php while ($canciones = mysqli_fetch_assoc($resultadoME)): ?>
                        <div class="slide">
                            <img src="<?php echo $canciones['imagen']; ?>" alt="<?php echo $canciones['nombre']; ?>">
                            <h3 class="titulo"><?php echo $canciones['titulo']; ?></h3>
                            <h3 class="artista"><a href="infoArtista.php?artista=<?php echo $canciones['a_id'] ?>"><?php echo $canciones['nombre']; ?> </a></h3>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <section class="seccionBoton">
                        <button class="next" onclick="changeSlide(this, 1)">&#10095;</button>
                    </section>
                </div>
            </section>

            <section id="masTiempoSinEscuchar">
                <div class="descripcion">
                    <h2>Volver a Escuchar</h2>
                </div>

                <div class="carousel carouselRTS">
                    <section class="seccionBoton">
                        <button class="prev" onclick="changeSlide(this, -1)">&#10094;</button>
                    </section>
                    <div class="slides">
                        <?php while ($canciones = mysqli_fetch_assoc($resultadoMTSE)): ?>
                        <div class="slide">
                            <img src="<?php echo $canciones['imagen']; ?>" alt="<?php echo $canciones['nombre']; ?>">
                            <h3 class="titulo"><?php echo $canciones['titulo']; ?></h3>
                            <h3 class="artista"><a href="infoArtista.php?artista=<?php echo $canciones['a_id'] ?>"><?php echo $canciones['nombre']; ?></a></h3>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <section class="seccionBoton">
                        <button class="next" onclick="changeSlide(this, 1)">&#10095;</button>
                    </section>
                </div>
            </section>

        </div>
    </main>

    <footer>
    <div id="imagenCancion">
            <img src="imagen.png">
            <div id="infoCancion">
                <h2>Peace sells</h2>
                <h3>Megadeth</h3>
            </div>
        </div>
        <section id="barraReproduccion">
            <div id="barraReproductora-iconos">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAK9JREFUSEvtle0NgzAMRB+TQTcpm3UU2KDdpJ2g1VWACB+ynQoVCfw3yT37LpCCjavYWJ/dAG7ANWda7wRv4A5cgGcEFAFIV+KCCOaqMaABStcpqAHZptJ005KWGklCXtq4xrMAg/Z4gh6wZFu/9gIqw6JEJwJ4dOJWyFmAyDXNAjizT0L/uuO16ATMvYt4Mtn7/5B/aD45OrtFkX+R1UTbfZT7eXCsjlfXve/BgQEfPOsqGYVSOv8AAAAASUVORK5CYII=" id="repetir"/>
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAALNJREFUSEvtlMERwjAMBDcVJB2EDkIJKYF0AJVAB6ED6ABKZMTAjElysj5+YX9P1snrsxsKr6Zwf6pBlvB/IeqAGzBtcJFaFNH4ab6DVfI8LRTTC3BOpk6H8rT3Fu8ENu0D2C+Q2B5P+ylXBkdgBoztcp0cbdXPM7gCrTBQWtjA+hqGJzAIREoLIUqLil1yamJRvAO9iKnSQjH9GtmFW6ODeGibWvShZT81VVANsugqoiyiFyspFBnP0GyFAAAAAElFTkSuQmCC" id="para-atras"/>
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAIFJREFUSEvtlUEOgCAQA8vDTfQ9+iB/o2kiN6XLmkYPcAV26CyBAvMo5voYAGn4c0UrgAnALo/6sEAlOK59M4AlA4kCWJspmGbrAfUAal0CwtoygAoKaXsDCGn7NYC3ipqaI5PA1mTrNQ3puHOlFNmfCtVDOa8SyAJqwQAoQ/5P/wRI2x4ZwEPsdgAAAABJRU5ErkJggg==" id="play-boton"/>
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAALBJREFUSEvtlNENhCAQRJ8dagdnB5bgdXId3JWgHViCduBV4GUTScieC0jCj5HfmeWFGaCi8KoK788NiCZ83YheQAesBxmEtD+7FdEGzEADTGoqpJ0COHMPPL1JAVhaFkCGBqDdT+UDtJYNkEHpQyDvg16c9tFaqAPt/QIPA+C0bMC4by7F64h8LSsiKViKdssHaO0UYAFq45paWjKg+EOLfmKphut+dqkJRH13RNGIfg4wMhkmyB+fAAAAAElFTkSuQmCC" id="para-adelante"/>
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAU1JREFUSEvVlNtRAkEQRQ8RSAaaAZoBRIBGgEaAZIIZYASYgYYgEYAZaARal+reasad2Vlr+bB/Z/eeftzuEWeO0Zn1+TeADXDf1o2hKvgG3oEZ8BlBQwKkewDuDHbkRICy8GjNJryPgVfguqUtqmAFqG1ZgN5ykJK48wRYpwB/lIDELy2LhyTLF2AOfFgFytir/wJugTf/JzcDla6PLhKIyl4AEpqGXguwM3HNoYnSkCPkCXg0mDKM4hL7s00lpGEq1CoJXZlbqo5AjU29LRFSJZ4bcvxZ7dgmalqmZohdpK4ZqD1ylWagWNqmCiKnefSegQbs4s/hzni7ZM0I6XUqlPHeMo/inq3vgex4YxX5HqTg4ibL13LRyfEysGYwKfTfHZcF5MTjtpcgrYAuQ5Te46k4WcKaPagB+6n41dKhAL1tWpN11TdDVZCF/QB4WlQZfSD04wAAAABJRU5ErkJggg==" id="aleatorio"/>
            </div>
            <div id="barraProgreso">
                <div class="progress">
                    <div class="progress-bar" style="width:75%;"></div>
                </div> 
            </div>
        </section>
    </footer>
    
    <script>
    const slidesToShow = 4; 
    const slideWidth = 100 / slidesToShow; 

    function changeSlide(button, direction) {
        const carousel = button.closest('.carousel');
        const slides = carousel.querySelector('.slides');
        const totalSlides = slides.children.length;

        let currentStartIndex = [...slides.children].findIndex(slide => slide.classList.contains('active'));
        if (currentStartIndex === -1) currentStartIndex = 0;

        for (let i = 0; i < slidesToShow; i++) {
            const index = (currentStartIndex + i) % totalSlides;
            slides.children[index].classList.remove('active');
        }

        currentStartIndex = (currentStartIndex + direction + totalSlides) % totalSlides;

        for (let i = 0; i < slidesToShow; i++) {
            const index = (currentStartIndex + i) % totalSlides;
            slides.children[index].classList.add('active');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const carousels = document.querySelectorAll('.carousel .slides');
        carousels.forEach((carousel) => {
            for (let i = 0; i < slidesToShow && i < carousel.children.length; i++) {
                carousel.children[i].classList.add('active');
            }
        });
    });

    let isPlaying = false;

    document.getElementById('play-boton').addEventListener('click', function() {
        isPlaying = !isPlaying; 

        if (isPlaying) {
            this.src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAIFJREFUSEvtlUEOgCAQA8vDTfQ9+iB/o2kiN6XLmkYPcAV26CyBAvMo5voYAGn4c0UrgAnALo/6sEAlOK59M4AlA4kCWJspmGbrAfUAal0CwtoygAoKaXsDCGn7NYC3ipqaI5PA1mTrNQ3puHOlFNmfCtVDOa8SyAJqwQAoQ/5P/wRI2x4ZwEPsdgAAAABJRU5ErkJggg=='; // Pausa
        } else {
            this.src = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAERJREFUSEtjZKAxYKSx+QyjFhAM4ZERRP+RwgHmY2xiWIOLmCAatYBgShsNotEgwl8iE5PRCIYhPgWjFhAMvtEgIhhEAKEpFBmRjTAEAAAAAElFTkSuQmCC'; // Playing
        }
    });

</script>

</body>
</html>