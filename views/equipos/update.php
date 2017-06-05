<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = 'Modificar: ' . Html::encode($model->nombre);
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->nombre), 'url' => ['view', 'id' => Html::encode($model->id)]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="equipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
