<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = Html::encode($model->nombre);
$this->params['breadcrumbs'][] = (Yii::$app->user->esAdmin) ? ['label' => 'Usuarios', 'url' => ['index']] : 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => Html::encode($model->id)], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => Html::encode($model->id)], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro que quieres borrar este usuario?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'email:email',
            'created_at:datetime',
        ],
    ]) ?>

    <?= ListView::widget([
        'summary' => 'Número de equipos: <b>{count}</b>',
        'dataProvider' => $equipos,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::encode($model->nombre);
        },
    ]) ?>

</div>
