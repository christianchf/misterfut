<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JugadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plantilla ' . $equipo;
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'label' => 'Posición',
                'filter' => $posiciones,
                'attribute' => 'nombrePosicion',
                'group' => true,
            ],
            'nombre',
            'dorsal',
            'partidos_jugados',
            'goles_marcados',
            // 'goles_encajados',
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
            // 'equipo.nombre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'responsive'=>true,
        'hover'=>true,
    ]); ?>
</div>
