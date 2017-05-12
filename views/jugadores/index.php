<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JugadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plantilla';
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['/equipos/index']];
$this->params['breadcrumbs'][] = ['label' => $equipo, 'url' => ['/equipos/view', 'id' => Yii::$app->request->get('id_equipo')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jugador-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir Jugador', ['create', 'id_equipo' => Yii::$app->request->get('id_equipo')], ['class' => 'btn btn-success']) ?>
    </p>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'resizableColumns' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Posición',
                'attribute' => 'nombrePosicion',
                'group' => true,
                'width' => '110px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $posiciones,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Posición'],
            ],
            [
                'attribute' => 'nombre',
                'width' => '145px',

            ],
            [
                'attribute' => 'dorsal',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $dorsales,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Dorsal'],
                'width' => '100px',
            ],
            [
                'label' => 'Partidos',
                'attribute' => 'partidos_jugados',
                'width' => '60px',
            ],
            [
                'label' => 'Goles',
                'attribute' => 'goles_marcados',
                'width' => '50px',
            ],
            [
                'label' => 'Asistencias',
                'attribute' => 'asistencias',
                'width' => '60px',
            ],
            [
                'label' => 'Goles/Partido',
                'attribute' => 'goles_por_partido',
                'width' => '60px',
            ],
            [
                'label' => 'Fecha nacimiento',
                'value' => 'fecha_nac',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'fecha_nac',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                    ]
                ]),
                'attribute' => 'fecha_nac',
                'format' => 'date',
                'width' => '100px',
            ],
            [
                'attribute' => 'esta_lesionado',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ['1' => 'Si', '0' => 'No'],
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Lesionado'],
                'width' => '60px',
                'format' => 'boolean',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('Ver', ['jugadores/view', 'id' => $model->id,], ['class' => 'btn btn-xs btn-info btnsAction']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('Modificar', ['jugadores/update', 'id' => $model->id,], ['class' => 'btn btn-xs btn-warning btnsAction']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('Borrar', ['jugadores/delete', 'id' => $model->id,], ['class' => 'btn btn-xs btn-danger btnsAction']);
                    },
                ],
            ],
        ],
        'responsive'=>true,
        'hover'=>true,
    ]); ?>
</div>
