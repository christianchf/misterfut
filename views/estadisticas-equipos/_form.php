<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadisticasEquipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estadisticas-equipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_temporada')->textInput() ?>

    <?= $form->field($model, 'id_equipo')->textInput() ?>

    <?= $form->field($model, 'partidos_jugados')->textInput() ?>

    <?= $form->field($model, 'partidos_ganados')->textInput() ?>

    <?= $form->field($model, 'partidos_empatados')->textInput() ?>

    <?= $form->field($model, 'partidos_perdidos')->textInput() ?>

    <?= $form->field($model, 'goles_a_favor')->textInput() ?>

    <?= $form->field($model, 'goles_en_contra')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
