Instrucciones de instalación en la nube
========================================

Para la instalación de la aplicación en la nube Heroku seran necesarios realizar los siguientes pasos:

1.  Tener una cuenta en heroku y crear una aplicación. Además, debes instalar el comando heroku para trabajar por linea de comandos o bien hacerlo desde la página web.

2.  Crear las mismas variables de entorno que tengas en local añadiendole una más, la cual es:
    > `YII_ENV=prod`

3.  Añadir el addon heroku-postgresql y crear la base de datos de la aplicación en la nube.

4.  Ejecutar los siguientes comandos:
```zsh
cd misterfut
heroku login
heroku git:remote -a nombre_aplicacion_heroku
git push heroku master
```
