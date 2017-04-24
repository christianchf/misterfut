<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <p><?= Html::a('Ver detalles de plantilla', ['/jugadores/index', 'id_equipo' => $model->id], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $jugadores,
        'resizableColumns' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Posición',
                'attribute' => 'nombrePosicion',
                'group' => true,
            ],
            'nombre',
            'dorsal',
            'fecha_nac:date',

            [
                'value' => function ($model, $key, $index, $column) {
                    return Html::a(
                        '',
                        ['jugadores/view', 'id' => $model->id],
                        ['class' => 'glyphicon glyphicon-eye-open']
                    );
                },
                'format' => 'html',
            ],

        ],
    ]); ?>

</div>
