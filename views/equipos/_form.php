<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipo-form col-md-6">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?php if (!$model->isNewRecord) { ?>

    <?= $form->field($model, 'partidos_ganados')->input('number') ?>

    <?= $form->field($model, 'partidos_empatados')->input('number') ?>

    <?= $form->field($model, 'partidos_perdidos')->input('number') ?>

    <?= $form->field($model, 'goles_a_favor')->input('number') ?>

    <?= $form->field($model, 'goles_en_contra')->input('number') ?>

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
