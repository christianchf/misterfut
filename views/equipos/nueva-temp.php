<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

?>

<div class="equipo-create">

    <div class="equipo-form col-md-6">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'temporada')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Añadir', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
