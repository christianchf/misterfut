<?php

use app\assets\AppAsset;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Jugador */
/* @var $form yii\widgets\ActiveForm */

AppAsset::register($this);

$templateNac = '{label}<div class="input-group"><span class="input-group-btn">
<button type="button" class="btn btn-default" aria-label="Left Align" id="calendarioNac">
<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></button>
<button type="button" class="btn btn-default" aria-label="Left Align" id="borrarFecha">
<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</span>{input}</div>{hint}{error}';
?>

<div class="jugador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nac', ['template' => $templateNac])
        ->widget(DatePicker::classname(), [
            'language' => 'es',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control'],
            'clientOptions' => [
                'yearRange' => '-115:+0',
                'changeYear' => true
            ],
        ]) ?>

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

        <?= $form->field($model, 'tiempo_lesion')->textInput(['maxlength' => true]) ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
