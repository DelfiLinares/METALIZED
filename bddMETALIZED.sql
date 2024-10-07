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
    idUsuario int,
    idCancion int,
    primary key (idUsuario, idCancion),
    foreign key (idUsuario) references Usuario(id),
    foreign key (idCancion) references Cancion(id)
);

INSERT INTO Usuario_escucha_Cancion VALUES
(1,4, "2024-09-27 15:46:45"), 
(1,5,"2024-09-27 15:45:45"), 
(1,3,"2024-09-26 18:45:35"), 
(1,6,"2024-09-27 13:56:45"), 
(1,2,"2024-09-25 16:25:15"),
(1,5,"2024-08-27 14:35:45"),
(1,5,"2024-09-27 15:59:49"),  
(1,5,"2024-09-25 13:45:45"), 
(1,5,"2024-09-27 15:45:45"), 
(1,2,"2024-05-27 15:45:45"), 
(1,3,"2024-09-08 12:45:45"), 
(1,6,"2024-06-27 13:45:15"), 
(1,3,"2024-09-21 15:05:45"), 
(1,6,"2024-09-23 17:45:45");


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