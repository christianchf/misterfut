<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>

<br />
<p>
    <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => '¿Estás seguro de borrar este equipo?',
            'method' => 'post',
        ],
    ]) ?>
    <?= Html::a('Calendario', ['/eventos/index', 'id_equipo' => $model->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Nueva temporada', ['nueva-temp', 'equipo' => $model->nombre], ['class' => 'btn btn-primary']) ?>
</p>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'nombre',
        'temporada',
    ],
]) ?>

<?= $this->render('_estadisticas', [
    'model' => $model,
]) ?>
