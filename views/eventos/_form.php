<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
    '/js/validaEvento.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(['id' => 'anadirEvento']); ?>

    <?= $form->field($model, 'tipo')->widget(Select2::classname(), [
            'data' => $tipos,
            'options' => ['placeholder' => 'Tipo de evento'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?php if (!$model->isNewRecord || (Yii::$app->request->get('dia') == null && Yii::$app->request->get('hora') == null)) { ?>
        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'fecha_inicio')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Introduzca la fecha de inicio del evento'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayBtn' => true,
                        'format' => 'yyyy-mm-dd',
                    ],
                    'readonly' => true,
                ]); ?>
            </div>
            <div class="col-xs-4">
                <?= $form->field($model, 'hora_inicio')->widget(TimePicker::classname(), [
                    'pluginOptions' => [
                        'showMeridian' => false,
                        'minuteStep' => 5,
                    ]
                ]) ?>
            </div>
        </div>
    <?php } elseif (Yii::$app->request->get('hora') == null) { ?>
        <?= $form->field($model, 'hora_inicio')->widget(TimePicker::classname(), [
            'pluginOptions' => [
                'showMeridian' => false,
                'minuteStep' => 5,
            ]
        ]) ?>
    <?php } ?>

    <div class="row">
        <div class="col-xs-8">
            <?= $form->field($model, 'fecha_fin')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Introduzca la fecha de fin del evento'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayBtn' => true,
                    'format' => 'yyyy-mm-dd',
                ],
                'readonly' => true,
            ]); ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'hora_fin')->widget(TimePicker::classname(), [
                'pluginOptions' => [
                    'showMeridian' => false,
                    'minuteStep' => 5,
                ]
                ]) ?>
        </div>
    </div>


    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
