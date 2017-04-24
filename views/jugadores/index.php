<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\jui\DatePicker;

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
            'nombre',
            [
                'attribute' => 'dorsal',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $dorsales,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Dorsal'],
            ],
            'partidos_jugados',
            'goles_marcados',
            'goles_encajados',
            'asistencias',
            'golesPorPartido',
            [
                'label' => 'Fecha nacimiento',
                'value' => 'fecha_nac',
                'filter' => DatePicker::widget([
                    'language' => 'es',
                    'dateFormat' => 'yyyy-MM-dd',
                    'options' => ['class' => 'form-control'],
                    'clientOptions' => [
                        'yearRange' => '-115:+0',
                        'changeYear' => true
                    ],
                    'model' => $searchModel,
                    'attribute' => 'fecha_nac',
                ]),
                'attribute' => 'fecha_nac',
                'format' => 'date',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'responsive'=>true,
        'hover'=>true,
    ]); ?>
</div>
