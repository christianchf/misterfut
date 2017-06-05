<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ejercicio */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Ejercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$attributes = [
    'tipo',
    'nombre',
    'descripcion:ntext',
];
if ($model->num_jugadores != null) {
    $attributes[] = 'num_jugadores';
}
if ($model->material != null) {
    $attributes[] = 'material:ntext';
}
if ($model->dimensiones != null) {
    $attributes[] = 'dimensiones';
}
?>
<div class="ejercicio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => Html::encode($model->id)], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => Html::encode($model->id)], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estás seguro de borrar este ejercicio?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
    ]) ?>

</div>
