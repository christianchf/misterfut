Dificultades encontradas y soluciones aplicadas
===============================================

Calendario
-----------

Para la realización del calendario interactivo de la aplicación, opté por la opción de una extensión de Yii2 llamada yii2fullcalendar, la cual adapta el plugin de Jquery fullcalendar para su uso en Yii2.

El principal problema que encontré fue al realizar la funcionalidad de que las fechas de los eventos se actualizaran al arrastrar un evento, ya que, a pesar de existir una función para esta acción, esta no funcionaba correctamente, ya que al arrastrar el evento saltaban errores internos de la extensión.

Al encontrar este error, abrí una incidencia en el repositorio de GitHub de la extensión.

Al no recibir respuesta por parte del desarrollador de la extensión de yii2fullcalendar, opté para solucionar este error, por eliminar la extensión de yii2fullcalendar y usar directamente el plugin de Jquery fullcalendar, con el cual no tuve ningún problema.
