INSERT INTO Cancion VALUES (4, "Psychotron", "Heavy Metal", "04:42", 4),		
						   (5, "Wind of Change", "Hard Rock", "05:12", 5),
                           (6, "Heaven's on Fire", "Glam Metal", "03:20", 6);
                        
INSERT INTO Artista VALUES (3, "kiss.jpg", "Kiss", "Glam Metal"),
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

                                                 
INSERT INTO Album VALUES (4, "Countdown To Extinction", "cdte.jpg", "1992-07-06", "Heavy Metal", 5),
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