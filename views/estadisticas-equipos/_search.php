<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadisticasEquipoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estadisticas-equipo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_temporada') ?>

    <?= $form->field($model, 'id_equipo') ?>

    <?= $form->field($model, 'partidos_jugados') ?>

    <?= $form->field($model, 'partidos_ganados') ?>

    <?= $form->field($model, 'partidos_empatados') ?>

    <?php // echo $form->field($model, 'partidos_perdidos') ?>

    <?php // echo $form->field($model, 'goles_a_favor') ?>

    <?php // echo $form->field($model, 'goles_en_contra') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
