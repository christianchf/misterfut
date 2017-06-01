<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ejercicio */

$this->title = 'Crear Ejercicio';
$this->params['breadcrumbs'][] = ['label' => 'Ejercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ejercicio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tipos' => $tipos,
    ]) ?>

</div>
