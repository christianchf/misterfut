<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JugadorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jugador-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'fecha_nac') ?>

    <?= $form->field($model, 'dorsal') ?>

    <?= $form->field($model, 'partidos_jugados') ?>

    <?php // echo $form->field($model, 'goles_marcados') ?>

    <?php // echo $form->field($model, 'goles_encajados') ?>

    <?php // echo $form->field($model, 'asistencias') ?>

    <?php // echo $form->field($model, 'id_equipo') ?>

    <?php // echo $form->field($model, 'id_posicion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
