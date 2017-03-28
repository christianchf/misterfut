<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de borrar este equipo?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            [
                'label' => 'Partidos jugados',
                'value' => $model->partidosJugados,
            ],
            [
                'label' => 'Partidos ganados',
                'value' => $model->partidos_ganados,
            ],
            [
                'label' => 'Partidos empatados',
                'value' => $model->partidos_empatados,
            ],
            [
                'label' => 'Partidos perdidos',
                'value' => $model->partidos_perdidos,
            ],
            [
                'label' => 'Goles a favor',
                'value' => $model->goles_a_favor,
            ],
            [
                'label' => 'Goles en contra',
                'value' => $model->goles_en_contra,
            ],
            'temporada',
        ],
    ]) ?>

</div>
