<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ejercicio */

$this->title = 'Modificar Ejercicio: ' . Html::encode($model->nombre);
$this->params['breadcrumbs'][] = ['label' => 'Ejercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->nombre), 'url' => ['view', 'id' => Html::encode($model->id)]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="ejercicio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tipos' => $tipos,
    ]) ?>

</div>
