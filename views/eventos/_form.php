<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo')->dropDownList($tipos) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'fecha')->textInput() ?> -->

    <?= $form->field($model, 'fecha')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Introduzca la fecha y la hora del evento'],
        'pluginOptions' => ['autoclose' => true],
    ]); ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
