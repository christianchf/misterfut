<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

            'posicion.posicion',
            'nombre',
            'dorsal',
            'partidos_jugados',
            'goles_marcados',
            // 'goles_encajados',
            'asistencias',
            'fecha_nac:date',
            // 'equipo.nombre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
