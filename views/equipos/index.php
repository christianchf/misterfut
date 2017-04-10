<?php

use app\models\Equipo;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Equipo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'resizableColumns' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'partidosJugados',
            'partidos_ganados',
            'partidos_empatados',
            'partidos_perdidos',
            'goles_a_favor',
            'goles_en_contra',
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
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'responsive'=>true,
        'hover'=>true,
    ]); ?>
</div>
