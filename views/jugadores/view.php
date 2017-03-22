<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Jugador */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jugadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jugador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'nombre',
            'fecha_nac',
            'dorsal',
            'partidos_jugados',
            'goles_marcados',
            'goles_encajados',
            'asistencias',
            'id_equipo',
            'id_posicion',
        ],
    ]) ?>

</div>
