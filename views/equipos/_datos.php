<?php

use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

?>

<br />
<p>
    <?= Html::a('Modificar', ['update', 'id' => Html::encode($model->id)], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('Borrar', ['delete', 'id' => Html::encode($model->id)], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => '¿Estás seguro de borrar este equipo?',
            'method' => 'post',
        ],
    ]) ?>
    <?= Html::a('Calendario <span class="glyphicon glyphicon-calendar"></span>', ['/eventos/index', 'idEquipo' => Html::encode($model->id)], ['class' => 'btn btn-success']) ?>
    <?= Html::button('Nueva temporada', ['value' => Url::to(['/equipos/nueva-temp', 'equipo' => Html::encode($model->nombre), 'idEquipo' => Html::encode($model->id)]), 'class' => 'btn btn-primary', 'id' => 'nuevaTemp']) ?>
</p>

<?php Modal::begin([
    'header' => '<h4>Añadir nueva temporada a ' . Html::encode($model->nombre) . '</h4>',
    'id' => 'modal',
    'size' => 'modal-lg',
]);

echo '<div id="modalContent"></div>';

Modal::end(); ?>

<?= DetailView::widget([
    'model' => $model,
    'id' => 'detailEquipo',
    'attributes' => [
        'nombre',
        'temporada',
    ],
]) ?>

<?= $this->render('_estadisticas', [
    'model' => $model,
]) ?>
