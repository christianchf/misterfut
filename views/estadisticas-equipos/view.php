<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EstadisticasEquipo */

$this->title = $model->id_temporada;
$this->params['breadcrumbs'][] = ['label' => 'Estadisticas Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estadisticas-equipo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_temporada' => $model->id_temporada, 'id_equipo' => $model->id_equipo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_temporada' => $model->id_temporada, 'id_equipo' => $model->id_equipo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_temporada',
            'id_equipo',
            'partidos_jugados',
            'partidos_ganados',
            'partidos_empatados',
            'partidos_perdidos',
            'goles_a_favor',
            'goles_en_contra',
        ],
    ]) ?>

</div>
