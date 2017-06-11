<?php

use yii\helpers\Html;

/*@var $this yii\web\View*/

?>

<sethtmlpagefooter name="pie" value="on" show-this-page="1" />

<div class="eventos-pdf">
    <div id="cabecera">
        <img src="/images/logo.png" alt="Logotipo">
        <span>MisterFut</span>
    </div>

    <div id="contenido">
        <h3>Registro de eventos de <?= Html::encode($equipo->nombre . ' ' . $equipo->temporada) ?></h3>
        <p>
            <table id="eventos">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Nombre</th>
                        <th>Fecha inicio</th>
                        <th>Hora inicio</th>
                        <th>Fecha fin</th>
                        <th>Hora fin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($eventos as $evento) { ?>
                        <tr>
                            <td><?= Html::encode($evento->tipo) ?></td>
                            <td><?= Html::encode($evento->nombre) ?></td>
                            <td><?= Yii::$app->formatter->asDate($evento->fecha_inicio, 'dd/MM/yyyy') ?></td>
                            <td><?= Yii::$app->formatter->asTime($evento->hora_inicio, 'HH:mm') ?></td>
                            <td><?= Yii::$app->formatter->asDate($evento->fecha_fin, 'dd//MM/yyyy') ?></td>
                            <td><?= Yii::$app->formatter->asTime($evento->hora_fin, 'HH:mm') ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </p>
    </div>


    <htmlpagefooter name="pie">
        <footer>
            <p class="footer pagina"><?= date('d/m/Y') ?> Página: {PAGENO}/{nbpg}</p>
            <p class="footer equipo">MisterFut<br /><?= Html::encode($equipo->nombre . ' ' . $equipo->temporada) ?></p>
        </footer>
    </htmlpagefooter>
</div>
