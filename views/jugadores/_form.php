<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Jugador */
/* @var $form yii\widgets\ActiveForm */

$js = <<<EOT
$('#calendarioNac').on('click', function(){
    $('#jugador-fecha_nac').trigger('focus');
});
EOT;
$this->registerJs($js);

$templateNac = '{label}<div class="input-group"><span class="input-group-btn">
<button type="button" class="btn btn-default" aria-label="Left Align" id="calendarioNac">
<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></button>
</span>{input}</div>{hint}{error}';
?>

<div class="jugador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nac', ['template' => $templateNac])->widget(DatePicker::classname(), [
        'language' => 'es',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control'],
        'clientOptions' => [
            'yearRange' => '-115:+0',
            'changeYear' => true
        ],
    ]) ?>

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
