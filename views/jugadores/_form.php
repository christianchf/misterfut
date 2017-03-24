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

    <?= $form->field($model, 'id_posicion')->dropDownList($posiciones) ?>

    <?php if (!$model->isNewRecord) { ?>

    <?= $form->field($model, 'partidos_jugados')->input('number') ?>

    <?= $form->field($model, 'goles_marcados')->input('number') ?>

    <?= $form->field($model, 'goles_encajados')->input('number') ?>

    <?= $form->field($model, 'asistencias')->input('number') ?>

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
