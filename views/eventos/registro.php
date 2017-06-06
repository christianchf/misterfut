<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registro de eventos';
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['/equipos/index']];
$this->params['breadcrumbs'][] = ['label' => Html::encode($equipo->nombre), 'url' => ['/equipos/view', 'id' => Html::encode(Yii::$app->request->get('idEquipo'))]];
$this->params['breadcrumbs'][] = ['label' => 'Calendario', 'url' => ['/eventos/index', 'idEquipo' => Html::encode(Yii::$app->request->get('idEquipo'))]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Tipo',
                'attribute' => 'tipo',
                'width' => '140px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $tipos,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Tipos'],
            ],
            'nombre',
            [
                'label' => 'Fecha de inicio',
                'value' => 'fecha_inicio',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'fecha_inicio',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                    ]
                ]),
                'attribute' => 'fecha_inicio',
                'format' => 'date',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('Ver', [
                            'eventos/view', 'id' => Html::encode($model->id),
                        ], [
                            'class' => 'btn btn-xs btn-info btnsAction'
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('Modificar', [
                            'eventos/update', 'id' => Html::encode($model->id),
                        ], [
                            'class' => 'btn btn-xs btn-warning btnsAction'
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('Borrar', [
                            'eventos/delete', 'id' => Html::encode($model->id),
                        ], [
                            'class' => 'btn btn-xs btn-danger btnsAction',
                            'data' => [
                                'confirm' => '¿Estás seguro de eliminar este evento?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
