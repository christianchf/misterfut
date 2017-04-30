<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EstadisticasEquipo */

$this->title = 'Update Estadisticas Equipo: ' . $model->id_temporada;
$this->params['breadcrumbs'][] = ['label' => 'Estadisticas Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_temporada, 'url' => ['view', 'id_temporada' => $model->id_temporada, 'id_equipo' => $model->id_equipo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estadisticas-equipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
