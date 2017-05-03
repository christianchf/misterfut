<?php

use yii\helpers\Html;
use kartik\grid\GridView;

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

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('Ver', ['equipos/view', 'id' => $model->id,], ['class' => 'btn btn-xs btn-info btnsAction']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('Modificar', ['equipos/update', 'id' => $model->id,], ['class' => 'btn btn-xs btn-warning btnsAction']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('Borrar', ['equipos/delete', 'id' => $model->id,], ['class' => 'btn btn-xs btn-danger btnsAction']);
                    },
                ],

            ],
        ],
        'responsive'=>true,
        'hover'=>true,
    ]); ?>
</div>
