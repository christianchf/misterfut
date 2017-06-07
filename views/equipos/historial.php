<?php

use app\assets\HistorialAsset;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

HistorialAsset::register($this);

$this->title = 'Historial de equipos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
        'summary' => 'Número de equipos: <em>{count}</em>',
        'dataProvider' => $equipos,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->nombre), ['historico', 'nombre' => Html::encode($model->nombre)], ['class' => 'tituloNombre']);
        },
    ]) ?>


</div>
