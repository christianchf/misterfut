<?php

use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo')->widget(Select2::classname(), [
            'data' => $tipos,
            'options' => ['placeholder' => 'Tipo de evento'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?php if (!$model->isNewRecord) { ?>
        <?= $form->field($model, 'fecha_inicio')->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Introduzca la fecha y la hora de inicio del evento'],
            'value' => $model->fecha_inicio,
            'pluginOptions' => [
                'autoclose' => true,
                'todayBtn' => true,
            ],
        ]); ?>
    <?php } else { ?>
        <?= $form->field($model, 'fecha_inicio')->widget(TimePicker::classname(), [
            'pluginOptions' => [
                'showMeridian' => false,
                'minuteStep' => 5,
            ]
        ]) ?>
    <?php } ?>

    <?= $form->field($model, 'fecha_fin')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Introduzca la fecha y la hora de fin del evento'],
        'pluginOptions' => [
            'autoclose' => true,
            'todayBtn' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
