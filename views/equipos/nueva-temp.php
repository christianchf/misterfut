<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = 'Añadir nueva temporada a ' . Yii::$app->request->get('equipo');
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="equipo-form col-md-6">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'temporada')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Añadir', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
