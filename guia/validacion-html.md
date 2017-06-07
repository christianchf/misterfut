Anexo III: Validación HTML
========================

La validación html se ha llevado a cabo sobre las siguientes páginas:

[Index](http://misterfut.herokuapp.com/index.php)
---------

![Index](images/validacion-html/index.PNG)

-------------------------------------------------

[Mis equipos](http://misterfut.herokuapp.com/index.php?r=equipos%2Findex)
---------

![Equipos index](images/validacion-html/equipos-index.PNG)

-------------------------------------------------

[Ver equipo](http://misterfut.herokuapp.com/index.php?r=equipos%2Fview&id=1)
---------

![Equipos view](images/validacion-html/equipos-view.PNG)

-------------------------------------------------

[Plantilla](http://misterfut.herokuapp.com/index.php?r=jugadores%2Findex&id_equipo=1)
---------

![Plantilla](images/validacion-html/plantilla.PNG)

-------------------------------------------------

[Añadir jugador](http://misterfut.herokuapp.com/index.php?r=jugadores%2Fcreate&id_equipo=1)
---------

![Añadir jugador](images/validacion-html/añadir-jugador.PNG)

-------------------------------------------------

[Calendario](http://misterfut.herokuapp.com/index.php?r=eventos%2Findex&idEquipo=1)
---------

![Calendario](images/validacion-html/calendario.PNG)

-------------------------------------------------

[Añadir evento](http://misterfut.herokuapp.com/index.php?r=eventos%2Fcreate&idEquipo=1)
---------

![Añadir evento](images/validacion-html/añadir-evento.PNG)

-------------------------------------------------

[Historial de equipos](http://misterfut.herokuapp.com/index.php?r=equipos%2Fhistorial)
---------

![Historial de equipos](images/validacion-html/historial-equipos.PNG)

-------------------------------------------------

[Ejercicios](http://misterfut.herokuapp.com/index.php?r=ejercicios%2Findex)
---------

![Ejercicios](images/validacion-html/ejercicios.PNG)

-------------------------------------------------

[Añadir ejercicio](http://misterfut.herokuapp.com/index.php?r=ejercicios%2Fcreate)
---------

![Añadir ejercicio](images/validacion-html/añadir-ejercicio.PNG)

-------------------------------------------------

Conclusión
-----------------

En resumen, todas las páginas validadas han pasado correctamente la validación, exceptuando el caso del "warning" que aparece en todas las páginas sobre el `role="navigation"` que tiene asignado la etiqueta `<nav>`, el cual es generado automaticamente por el framework Yii2 y no se puede eliminar.
