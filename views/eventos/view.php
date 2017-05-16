<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$attributes = [
    'tipo',
    'nombre',
    'fecha_inicio:datetime',
];
if ($model->fecha_fin != null) {
    $attributes[] = 'fecha_fin:datetime';
}
if ($model->descripcion != '') {
    $attributes[] = 'descripcion:ntext';
}

$this->title = $model->tipo . ': ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['/equipos/index']];
$this->params['breadcrumbs'][] = ['label' => $equipo, 'url' => ['/equipos/view', 'id' => $model->id_equipo]];
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index', 'id_equipo' => $model->id_equipo]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
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
