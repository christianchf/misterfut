<?php
use app\assets\IndexAsset;

/* @var $this yii\web\View */

IndexAsset::register($this);

$this->title = 'MisterFut';
?>
<div class="site-index">
    <div class="body-content">
        <br><br><br>
        <div class="carrusel-slick">
            <div><img src="/images/pelota-campo.jpg" alt="Pelota en campo de fútbol"></div>
            <div><img src="/images/pizarra-tactica.jpg" alt="Pizarra de tácticas"></div>
        </div>
    </div>
    <div id="contenido">
        <h1>MisterFut</h1>
        <p>MisterFut es la aplicación perfecta para los entrenadores para llevar
         el control sobre la organización de sus equipos. Organiza las
        estadísticas de los equipos y tus jugadores, además dispon de un
        calendario para tener todos los eventos deportivos de tus equipos al
        día.</p>
        <section>
            <h2>Características</h2>
            <div>
                <article>
                    <p>En MisterFut dispones de las siguientes características para
                    gestionar tus equipos:</p>
                    <ul>
                        <li>Gestión de todos los equipos que has entrenado durante
                        tu carrera deportiva.</li>
                        <li>Historial de equipos entrenados.</li>
                        <li>Historial de estadísticas por temporadas de cada equipo.</li>
                        <li>Gestión de la plantilla de cada equipo en cada temporada.</li>
                        <li>Posibilidad de traspasar a todos los jugadores de uno de
                        tus equipos a la nueva temporada o a un equipo nuevo.</li>
                        <li>Calendario interactivo. Cada equipo dispone de un
                        calendario donde poder tener un control de todos los eventos
                        (partidos, entrenamientos, etc.) del equipo.</li>
                    </ul>
                </article>
                <article>
                    <video controls>
                        <source src="/videos/tacticas.mp4" type="video/mp4">
                    </video>
                </article>
            </div>
        </section>
    </div>
</div>
