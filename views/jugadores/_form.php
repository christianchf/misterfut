<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Jugador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jugador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nac')->textInput() ?>

    <?= $form->field($model, 'dorsal')->textInput() ?>

    <?= $form->field($model, 'partidos_jugados')->textInput() ?>

    <?= $form->field($model, 'goles_marcados')->textInput() ?>

    <?= $form->field($model, 'goles_encajados')->textInput() ?>

    <?= $form->field($model, 'asistencias')->textInput() ?>

    <?= $form->field($model, 'id_equipo')->textInput() ?>

    <?= $form->field($model, 'id_posicion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
