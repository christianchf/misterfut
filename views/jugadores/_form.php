<?php

use app\assets\AppAsset;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Jugador */
/* @var $form yii\widgets\ActiveForm */

AppAsset::register($this);

$this->registerJsFile(
    '/js/lesionado.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>

<div class="jugador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nac')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Introduzca la fecha de nacimiento'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd',
        ]
    ]); ?>

    <?= $form->field($model, 'dorsal')->input('number') ?>

    <?= $form->field($model, 'id_posicion')->widget(Select2::classname(), [
            'data' => $posiciones,
            'options' => ['placeholder' => 'Posición'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>

    <?php if (!$model->isNewRecord) { ?>
        <?= $form->field($model, 'esta_lesionado')->checkbox() ?>

        <?= $form->field($model, 'fecha_alta')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Introduzca la fecha prevista de alta'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd',
            ]
        ]); ?>

        <?= $form->field($model, 'esta_sancionado')->checkbox() ?>

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
