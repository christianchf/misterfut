Decisiones adoptadas y su justificación
========================================

A la hora de realizar el requisito opcional R57: AÑADIR NUEVA TEMPORADA A UN EQUIPO, me encontré ante dos opciones.

La primera era mas correcta pero implicaba que tenia que cambiar la base de datos por completo, con el consiguiente cambio en cadena de los modelos, los controladores, etc., ya que tenia que contemplar relaciones que no había tenido en cuenta hasta ese momento para realizar este requisito opcional, es decir, al añadir nuevas temporadas, un equipo tendría unas estadísticas en cada temporada y un jugador tendría unas estadísticas en un equipo en una temporada.

La segunda opción consiste en modificar la base de datos para que la combinación de las columnas nombre, temporada e id_usuario de la tabla Equipos sean únicas, y al crear una nueva temporada, lo que realmente se hace es crear nuevamente el equipo con el mismo nombre y el mismo id_usuario pero con la nueva temporada asignada por el usuario.

Debido a que este requisito es opcional, y fue añadido con posterioridad, y a la falta de tiempo para realizar la gran cantidad de modificaciones necesarias para llevar a cabo la primera opción, opté por realizar la segunda opción, que, aun siendo menos correcta, creo que es factible.
