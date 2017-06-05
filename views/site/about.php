<?php

/* @var $this yii\web\View */

use app\assets\AboutAsset;
use yii\helpers\Html;

AboutAsset::register($this);

$this->title = 'Sobre MisterFut';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about" itemscope itemtype="https://schema.org/LocalBusiness">
    <h1 itemprop="name"><?= Html::encode($this->title) ?></h1>

    <section>
        <h2>¿Que es MisterFut?</h2>
        <div>
            <article>
                <p itemprop="description"><span itemprop="name">MisterFut</span> es
                un proyecto desarrollado por <span itemprop="founder">Christian
                Hidalgo Ferrero</span>, con el objetivo de ofrecer una herramienta
                que facilite la gestión y organización de un equipo de fútbol, ya
                sea de nivel profesional o amateur, por parte de su entrenador.</p>

                <p>La idea de <span itemprop="name">MisterFut</span> comienza a
                desarrollarse en <span itemprop="address">Sanlúcar de Barrameda
                (Cádiz)</span>, como parte de la realizar del proyecto integrado del
                 C.F.G.S de Desarrollo de Aplicaciones Web.</p>

                <p>Esta web dispone a sus usuarios de una serie de características,
                las cuales se detallan mas abajo, para facilitar la tarea de
                organizar un equipo por parte de su entrenador.</p>

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

                <p>Para realizar cualquier consulta o sugerencia, no dudes en
                ponerte en contacto con nosotros a través de nuestra sección de
                <span itemprop="url"><?= Html::a('contacto', ['contact']) ?></span>
                .</p>
            </article>
            <article>
                <img itemprop="image" src="/images/logo-M.png" alt="Logo de la web">
            </article>
        </div>
    </section>
</div>
