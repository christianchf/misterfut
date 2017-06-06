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

insert into ejercicios (id_usuario, nombre, tipo, descripcion, num_jugadores, material, dimensiones)
    values (1, 'Circuito físico con finalizaciones', 'Físico', 'El circuito comienza con un pase largo desde la posta número 1 hacia el jugador atacante de la zona 2 (en este caso, el dorsal 3). En esta zona se disputa un 1 contra 1 y, una vez superado el defensor, se busca el tiro a puerta. A continuación, el jugador que ha tirado a puerta se dirige hacia uno de los balones colocados en la frontal, lo envía al jugador que espera en la posta 3 y rápidamente corre a defender. Por su parte, el jugador que recibe deberá sortear las picas (conducción o auto-pase y zig-zag) y tirar a puerta', 'Según el equipo', 'Conos, picas, aros y balones', 'Según la categoría'),
           (1, 'Rondo 4×4+4 por equipos', 'Táctico', 'Se forma un espacio en el que se sitúan 4 jugadores atacantes en el exterior del espacio, 4 atacantes en el interior y 4 defensores en el interior. El objetivo es mantener la posesión del balón entre los atacantes exteriores e interiores. Cada diez pases se consigue un punto. Si se produce recuperación del equipo que defiendo, el equipo que perdió será el que pase a recuperar. Si es el equipo que se encuentra en el exterior, rápidamente los que estaban dentro manteniendo la posesión deberán salir fuera', '12', 'Conos, petos y balón', 'Según la categoria'),
           (1, '2×1 con caída en banda', 'Táctico', 'Dividiremos el ejercicio en tres puntos: Punto 1 – salida de jugador con balón, punto 2 – jugador que realiza desmarque y punto 3 – salida del jugador defensor. El jugador del punto 2 (DL) realiza una caída a banda para que el jugador del punto 1 (BD o BI) le de el pase o continúe en función del movimiento del defensor. En el momento que se produce esto, el jugador del punto 1 hace un movimiento hacia el interior y se produce la situación de 2×1, contra el jugador defensor del punto 3 (DF). No siempre el jugador con balón deberá realizar el pase a banda, habrá total libertad para que los jugadores resuelvan dicha situación y finalicen la jugada.', '3 + un portero', 'Conos, petos, portería y balones', 'Medio campo fútbol 7'),
           (1, 'Pases dinámicos', 'Técnico', 'Colocados por parejas, un jugador se coloca por detrás de los conos situados en forma de portería y el compañero frente a él en un cono. El jugador que se encuentra solo tendrá que ir realizando pases por el exterior de la portería y el jugador situado por detrás, tendrá que ir desplazándose de un extremo a otro devolviendo el balón al compañero.', '2', 'Conos y balón', 'Según la categoría'),
           (1, 'Ocupa los aros', 'Técnico', 'Se colocarán aros por todo el espacio limitado, cada jugador tendrá un balón e irán conduciendo por el espacio en cualquier dirección. El entrenador irá indicado que tipo conducción hacer y a la señal del silbato todos tendrán que ocupar un aro con el balón controlado. Habrá que eliminar aros conforme pase el tiempo o las rondas. Los que queden fuera de los aros tendrán una penalización.', 'Todos los jugadores', 'Conos, aros y balones', 'Según la categoría'),
           (1, 'Transición ofensiva 4×3 por equipos', 'Táctico', 'En mitad de campo de F7 se crea un espacio de 15×20 m. En el que se jugará un 4×4+4 comodines exteriores. En cada una de las porterías habrá un portero (PO) y un defensor que estará permanente (DF) y no participará en la posesión. Los equipos en el interior del espacio (N y J) tienen dos toques y el equipo exterior donde los jugadores actúan de comodines (R), tienen un toque. Un equipo mantiene la posesión de balón y otro intenta recuperar. Cuando el equipo defensor roba, realiza un ataque a una de las dos porterías (cuatro jugadores) y solo podrán defender dos jugadores del equipo contrario más el defensor permanente. El equipo que mas goles consiga meter, será el ganador.', '14 + 2 porteros', 'Conos, petos, porterías y balón.', 'Campo Fútbol 7'),
           (1, 'Tiempo reacción en círculo', 'Físico', 'Se coloca todo el equipo en círculo, con el entrenador en el centro de este. Los jugadores comienzan a desplazarse hacia la izquierda o hacia la derecha, dependiendo de lo que vaya indicando el entrenador y en función de la mano que levante, deberán realizar un cambio de ritmo hacia el entrenador o alejándose de este.', 'Todo el equipo', null, 'Según la categoría');
