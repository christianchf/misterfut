insert into usuarios(nombre, email, password)
    values  ('christian','christianhf.chf@gmail.com', crypt('christian', gen_salt('bf', 13))),
            ('pepe','pepe@gmail.com', crypt('pepe', gen_salt('bf', 13)));

insert into equipos(nombre, temporada, id_usuario)
    values  ('Real Madrid', '2016/2017', 1),
            ('Cadiz', '2014/2015', 1),
            ('Fruteria Pepe', '2016/2017', 2);

insert into posiciones(posicion)
    values  ('POR'), ('CAD'), ('LD'), ('DFC'), ('LI'), ('CAI'), ('MCD'), ('MD'),
            ('MC'), ('MI'), ('MCO'), ('SDD'), ('SD'), ('SDI'), ('ED'), ('DC'),
            ('EI');

insert into jugadores(nombre,fecha_nac,dorsal,id_equipo,id_posicion)
    values  ('Keylor Navas', '1986-12-15',1,1,1),
            ('Kiko Casilla', '1986-10-02',13,1,1),
            ('Ruben Yañez', '1993-10-12',25,1,1),
            ('Daniel Carvajal', '1992-01-11',2,1,3),
            ('Danilo', '1991-07-15',23,1,3),
            ('Pepe', '1983-02-26',3,1,4),
            ('Sergio Ramos', '1986-03-30',4,1,4),
            ('Raphael Varane', '1993-04-25',5,1,4),
            ('Nacho Fernandez', '1990-01-18',6,1,4),
            ('Marcelo', '1988-05-12',12,1,5),
            ('Fabio Coentrao', '1988-03-11',15,1,5),
            ('Casemiro', '1992-02-23',14,1,7),
            ('Toni Kroos', '1990-01-04',8,1,9),
            ('Mateo Kovacic', '1994-05-06',16,1,9),
            ('Luka Modric', '1985-09-09',19,1,9),
            ('James Rodriguez', '1991-07-12',10,1,11),
            ('Marco Asensio', '1996-01-21',20,1,11),
            ('Isco', '1992-04-21',22,1,11),
            ('Cristiano Ronaldo', '1985-02-05',7,1,17),
            ('Karim Benzema', '1987-12-19',9,1,16),
            ('Gareth Bale', '1989-07-16',11,1,15),
            ('Lucas Vazquez', '1991-07-01',17,1,15),
            ('Mariano', '1993-08-01',18,1,16),
            ('Alvaro Morata', '1992-10-23',21,1,16),
            ('Cifuentes', '1987-11-23',1,2,1),
            ('Aridane', '1985-10-02',5,2,4),
            ('Jose Mari', '1990-01-20',6,2,9),
            ('Salvi', '1990-11-23',7,2,15),
            ('Ortuño', '1990-05-12',19,2,16),
            ('Jose Garcia', '1987-11-23',1,3,1),
            ('Juan Gutierrez', '1988-10-20',2,3,4),
            ('Isaac Perez', '1986-01-03',3,3,9),
            ('Iñigo Arrizabalaga', '1987-11-23',9,3,16);

insert into eventos (tipo, nombre, fecha_inicio, hora_inicio, fecha_fin, hora_fin, id_equipo)
    values  ('Partido', 'Real Madrid vs Malaga', '2017-06-10', '20:00', '2017-06-10', '22:00', 1),
            ('Partido', 'Juventus vs Real Madrid', '2017-06-15', '17:30', '2017-06-15', '18:20', 1),
            ('Entrenamiento', 'Entrenamiento físico', '2017-06-03', '09:00', '2017-06-03', '11:30', 1),
            ('Entrenamiento', 'Entrenamiento táctico', '2017-06-04', '08:00', '2017-06-04', '10:30', 1),
            ('Entrenamiento', 'Entrenamiento físico', '2017-06-07', '10:00', '2017-06-07', '11:30', 1),
            ('Entrenamiento', 'Entrenamiento físico', '2017-06-14', '09:00', '2017-06-14', '10:30', 1),
            ('Entrenamiento', 'Entrenamiento táctico', '2017-06-14', '10:30', '2017-06-14', '12:30', 1),
            ('Evento publicitario', 'Adidas', '2017-06-25', '19:00', '2017-06-25', '21:00', 1),
            ('Evento publicitario', 'Microsoft', '2017-06-30', '12:00', '2017-06-30', '13:30', 1),
            ('Otros', 'Celebración Champions', '2017-06-15', '18:30', '2017-06-15', '23:00', 1);
