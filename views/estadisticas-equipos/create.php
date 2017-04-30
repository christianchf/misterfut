<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EstadisticasEquipo */

$this->title = 'Create Estadisticas Equipo';
$this->params['breadcrumbs'][] = ['label' => 'Estadisticas Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estadisticas-equipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
