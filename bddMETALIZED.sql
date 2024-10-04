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

CREATE TABLE Usuario_guarda_Playlist(

);
