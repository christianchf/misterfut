<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstadisticasEquipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estadisticas Equipos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estadisticas-equipo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Estadisticas Equipo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_temporada',
            'id_equipo',
            'partidos_jugados',
            'partidos_ganados',
            'partidos_empatados',
            // 'partidos_perdidos',
            // 'goles_a_favor',
            // 'goles_en_contra',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
