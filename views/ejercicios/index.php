<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EjercicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ejercicios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ejercicio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Ejercicio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'tipo',
                'width' => '200px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $tipos,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Tipo de ejercicio'],
            ],
            'nombre',
            'descripcion:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('Ver', [
                            'ejercicios/view', 'id' => $model->id,
                        ], [
                            'class' => 'btn btn-xs btn-info btnsAction'
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('Modificar', [
                            'ejercicios/update', 'id' => $model->id,
                        ], [
                            'class' => 'btn btn-xs btn-warning btnsAction'
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('Borrar', [
                            'ejercicios/delete', 'id' => $model->id,
                        ], [
                            'class' => 'btn btn-xs btn-danger btnsAction',
                            'data' => [
                                'confirm' => '¿Estás seguro de eliminar este ejercicio?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
