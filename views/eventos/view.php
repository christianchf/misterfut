<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$attributes = [
    'tipo',
    'nombre',
    'fecha_inicio:date',
    'hora_inicio',
];
if ($model->fecha_fin != null) {
    $attributes[] = 'fecha_fin:date';
}
if ($model->hora_fin != null) {
    $attributes[] = 'hora_fin';
}
if ($model->descripcion != '') {
    $attributes[] = 'descripcion:ntext';
}

$this->title = Html::encode($model->tipo) . ': ' . Html::encode($model->nombre);
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['/equipos/index']];
$this->params['breadcrumbs'][] = ['label' => Html::encode($equipo), 'url' => ['/equipos/view', 'id' => Html::encode($model->id_equipo)]];
$this->params['breadcrumbs'][] = ['label' => 'Calendario', 'url' => ['index', 'idEquipo' => Html::encode($model->id_equipo)]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => Html::encode($model->id)], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => Html::encode($model->id)], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estás seguro de eliminar este evento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
    ]) ?>

</div>
