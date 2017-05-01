<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registro histórico de ' . Yii::$app->request->get('nombre');
$this->params['breadcrumbs'][] = ['label' => 'Historial de equipos', 'url' => ['historial']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'resizableColumns' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            [
                'label' => 'PJ',
                'attribute' => 'partidos_jugados',
                'width' => '70px',
            ],
            [
                'label' => 'PG',
                'attribute' => 'partidos_ganados',
                'width' => '70px',
            ],
            [
                'label' => 'PE',
                'attribute' => 'partidos_empatados',
                'width' => '70px',
            ],
            [
                'label' => 'PP',
                'attribute' => 'partidos_perdidos',
                'width' => '70px',
            ],
            [
                'label' => 'GF',
                'attribute' => 'goles_a_favor',
                'width' => '70px',
            ],
            [
                'label' => 'GC',
                'attribute' => 'goles_en_contra',
                'width' => '70px',
            ],
            [
                'attribute' => 'temporada',
                'width' => '150px',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $temporadas,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Temporada'],
            ],

            [
                'label' => 'Plantilla',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a(
                        'Ver plantilla',
                        ['jugadores/index', 'id_equipo' => $model->id],
                        ['class' => 'btn-sm btn-primary']
                    );
                },
                'format' => 'html',
                'width' => '100px',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'responsive'=>true,
        'hover'=>true,
    ]); ?>
</div>
