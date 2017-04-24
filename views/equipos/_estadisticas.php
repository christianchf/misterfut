<?php

use app\assets\AppAsset;

AppAsset::register($this);

?>


<h3>Estadísticas</h3>

<table id="statsEquipo" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Partidos jugados</th>
            <th>Partidos ganados</th>
            <th>Partidos empatados</th>
            <th>Partidos perdidos</th>
            <th>Goles a favor</th>
            <th>Goles en contra</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <?php for ($i = 0; $i < 5; $i++) { ?>
                <td><button class="btn btn-xs btn-info"><span class="glyphicon glyphicon-plus"></span></button></td>
            <?php } ?>
        </tr>
        <tr>
            <td><?= $model->partidosJugados ?></td>
            <td><?= $model->partidos_ganados ?></td>
            <td><?= $model->partidos_empatados ?></td>
            <td><?= $model->partidos_perdidos ?></td>
            <td><?= $model->goles_a_favor ?></td>
            <td><?= $model->goles_en_contra ?></td>
        </tr>
        <tr>
            <td></td>
            <?php for ($i = 0; $i < 5; $i++) { ?>
                <td><button class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-minus"></span></button></td>
            <?php } ?>
        </tr>
    </tbody>
</table>
