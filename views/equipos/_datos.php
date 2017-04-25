<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>

<br />
<p>
    <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => '¿Estas seguro de borrar este equipo?',
            'method' => 'post',
        ],
    ]) ?>
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
