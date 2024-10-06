CREATE DATABASE Metalized;
USE Metalized;

CREATE TABLE Usuario (
    id int not null auto_increment,
    nombreUser varchar(30),
    email varchar(45),
    contraseña varchar(45),
    primary key (id)
);
 
CREATE TABLE Cancion (
    id int not null,
    titulo varchar(45) NOT NULL,
    genero varchar(45),
    duracion time,
    idAlbum int, 
    primary key (id),
    foreign key (idAlbum) references Album(id)
);

CREATE TABLE Usuario_escucha_Cancion(
    imagen varchar(45),
    idUsuario int,
    idCancion int,
    plays datetime,
    primary key (idUsuario, idCancion),
    foreign key (idUsuario) references Usuario(id),
    foreign key (idCancion) references Cancion(id)
);

CREATE TABLE Album (
    id int not null,
    titulo varchar(45),
    imagen varchar(45),
    fecha date,
    genero varchar(45),
    idArtista int,
    primary key (id),
    foreign key (idArtista) references Artista(id)
    );

CREATE TABLE Artista (
    id int not null,
    imagen varchar(45),
    nombre varchar(45),
    genero varchar(45),
    primary key (id)
    );
 
CREATE TABLE Playlist (
    id int not null,
    imagen varchar(45),
    nombre varchar(45),
    idUsuario int,
    primary key (id),
    foreign key (idUsuario) references Usuario(id)
);
 
CREATE TABLE Playlist_tiene_Cancion(
    idPlaylist int,
    idCancion int,
    diayhora_añadida datetime,
    primary key (idCancion, idPlaylist),
    foreign key (idPlaylist) references Playlist(id),
    foreign key (idCancion) references Cancion(id)
);

INSERT INTO Playlist VALUES (1, "playlist1.jpg", "Lo mejor del metal", 1 ),
                            (2, "playlist2.jpg", "80s rock n roll", 1),
                            (3, "playlist3.jpg", "Clasicos", 2),
                            (4, "playlist4.jpg", "Rock en español", 2),
                            (5, "playlist5.jpg", "Rock Anthems", 2),
                            (6, "playlist6.jpg", "Baladas de rock", 3),
                            (7, "playlist7.jpg", "Hard Rock", 3);


INSERT INTO Playlist_tiene_Cancion VALUES
(1, 1, "2023-07-06 15:30:42"),
(1, 2, "2024-09-06 15:50:42"),
(1, 3, "2021-07-06 16:00:42"),
(1, 4, "2024-09-06 16:10:42"),
(1, 5, "2024-07-06 16:30:42"),
(1, 6, "2024-09-06 16:40:42"),
(1, 7, "2024-07-06 17:00:42"),
(1, 8, "2021-09-06 17:10:42"),
(1, 9, "2024-07-06 17:30:42"),
(1, 10, "2021-09-06 17:40:42"),
(1, 11, "2021-07-06 18:00:42"),
(1, 12, "2024-09-06 18:10:42"),
(1, 13, "2023-07-06 18:30:42"),

(2, 14, "2022-09-06 18:40:42"),
(2, 15, "2024-08-06 19:00:42"),
(2, 16, "2021-08-06 19:10:42"),
(2, 17, "2024-07-06 19:30:42"),
(2, 18, "2024-09-06 19:40:42"),
(2, 19, "2024-05-06 20:00:42"),
(2, 20, "2024-05-06 20:10:42"),
(2, 21, "2024-05-06 20:30:42"),
(2, 22, "2024-05-06 20:40:42"),
(2, 23, "2024-07-06 21:00:42"),
(2, 24, "2024-09-06 21:10:42"),

(3, 25, "2024-07-06 21:30:42"),
(3, 26, "2024-09-26 21:40:42"),
(3, 27, "2024-05-06 22:00:42"),
(3, 28, "2024-09-16 22:10:42"),
(3, 29, "2024-07-06 22:30:42"),
(3, 30, "2024-09-16 22:40:42"),
(3, 31, "2024-07-06 23:00:42"),
(3, 32, "2024-09-06 23:10:42"),
(3, 33, "2024-02-06 23:30:42"),
(3, 34, "2024-09-06 23:40:42"),
(3, 35, "2024-09-09 00:00:42"),

(4, 36, "2024-05-07 00:10:42"),
(4, 37, "2024-07-07 00:30:42"),
(4, 38, "2024-09-07 00:40:42"),
(4, 39, "2024-03-07 01:00:42"),
(4, 40, "2024-08-07 01:10:42"),
(4, 41, "2024-07-07 01:30:42"),

(5, 36, "2024-05-07 00:10:42"),
(5, 37, "2024-07-07 00:30:42"),
(5, 38, "2024-09-07 00:40:42"),
(5, 39, "2024-03-07 01:00:42"),
(5, 40, "2024-08-07 01:10:42"),
(5, 41, "2024-07-07 01:30:42"),
(5, 36, "2024-05-07 00:10:42"),

(6, 37, "2024-07-07 00:30:42"),
(6, 38, "2024-09-07 00:40:42"),
(6, 39, "2024-03-07 01:00:42"),
(6, 40, "2024-08-07 01:10:42"),
(6, 41, "2024-07-07 01:30:42"),

(7, 42, "2024-09-07 01:40:42"),
(7, 43, "2024-01-07 02:00:42"),
(7, 44, "2024-02-07 02:10:42"),
(7, 45, "2024-06-07 02:30:42"),
(7, 46, "2024-04-07 02:40:42"),
(7, 47, "2024-03-03 03:00:42"),
(7, 48, "2024-09-07 03:10:42"),
(7, 49, "2024-07-07 03:30:42"),
(7, 50, "2024-09-07 03:40:42");

