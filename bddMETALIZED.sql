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
    plays datetime,
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

INSERT INTO Cancion VALUES (1, "Highway to Hell", "Hard Rock","03:29" , 1),
							(2, "Master of Puppets", "Thrash Metal", "08:03", 2),
                            (3, "Girls got Rythm", "Hard Rock", "03:24", 1),
							(4, "Psychotron", "Heavy Metal", "04:42", 4),		
						   (5, "Wind of Change", "Hard Rock", "05:12", 5),
                           (6, "Heaven's on Fire", "Glam Metal", "03:20", 6);
                        
INSERT INTO Artista VALUES (1, "hth.jpg", "AC/DC", "Hard Rock"),
						   (2, "metallica.png", "Metallica", "Metal"),
						   (3, "kiss.jpg", "Kiss", "Glam Metal"),
						   (4, "scorpions.jpg", "Scorpions", "Metal"),
						   (5, "megadeth.jpeg", "Megadeth", "Heavy Metal"),
						   (6, "mayhem.jpeg", "Mayhem", "Black Metal"),
						   (7, "motleyCrue.jpg", "Motley Crue", "Glam Metal"),
						   (8, "sodaStereo.jpg", "Soda Stereo", "Rock Nacional"),
                           (9, "soad.jpg", "System Of A Down", "Nu Metal"),
                           (10, "nirvana.jpg", "Nirvana", "Grunge"),
                           (11, "pantera.jpeg", "Pantera", "Metal"),
                           (12, "gnr.jpg", "Guns N' Roses", "Glam Metal"),
                           (13, "thesmiths.jpg", "The Smiths", "Rock Alternativo");

                                                 
INSERT INTO Album VALUES (1, "Highway to Hell", "hth.jpg", "1997-07-29", "Hard Rock", 1),
						(2, "Master of Puppets", "mopp.jpg", "1986-03-03", "Heavy Metal", 2);
						(4, "Countdown To Extinction", "cdte.jpg", "1992-07-06", "Heavy Metal", 5),
						 (5, "Crazy World", "crazyWorld.jpeg", "1990-11-06", "Hard Rock", 4),
                         (6, "Animalize", "animalize.jpg", "1984-09-13", "Hard Rock",3),
                         (7, "Appetite for destruction", "afd-gnr.jpg", "1987-07-21", "Hard Rock",12),
                         (8, "Dynasty", "dynasty.jpeg", "1979-05-23", "Hard Rock",3),
                         (9, "In Utero", "inutero.jpg", "1993-09-23", "Grunge",10),
                         (10, "Black Album", "black.jpeg", "1991-08-12", "Heavy Metal",2),
                         (11, "Daemon", "daemon-mayhem.jpg", "2019-10-25", "Black Metal",6),
                         (12, "De Mysteriis Dom Sathanas", "dd-mayhem.jpg", "1994-05-24", "Black Metal",6),
                         (13, "Love Gun", "lovegun.jpg", "1977-06-30", "Glam Metal",3),
                         (14, "Ride The Lightning", "rtl.jpg", "1984-07-27", "Heavy Metal",2),
                         (15, "Vulgar Display Of Power", "vdop-pantera.jpeg", "1992-02-25", "Groove Metal",11),
                         (16, "The Queen Is Dead", "tqid.jpeg", "1986-06-16", "Indie Rock",13);
                         
                         
                         
INSERT INTO Playlist VALUES (1, "hth.jpg", "Top 15", 1);

INSERT INTO Playlist_tiene_Cancion VALUES (1, 1, "2024-09-20 17:12"),
										  (1, 2, "2024-09-20 17:13");
                                        
INSERT INTO Usuario_escucha_Cancion VALUES ();
