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

            // [
            //     'attribute' => 'temporada',
            //     'width' => '150px',
            //     'filterType' => GridView::FILTER_SELECT2,
            //     'filter' => $temporadas,
            //     'filterWidgetOptions'=>[
            //         'pluginOptions'=>['allowClear'=>true],
            //     ],
            //     'filterInputOptions'=>['placeholder'=>'Temporada'],
            // ],

            [
                'value' => function ($model, $key, $index, $column) {
                    return Html::a(
                        'Entrar',
                        ['estadisticas-equipos/index', 'id_equipo' => $model->id],
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
