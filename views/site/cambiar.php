<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Recuperar Contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-recuperar">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->session->hasFlash('tokenInvalido')): ?>

        <div class="alert alert-danger">
            No se ha podido encontrar el usuario.
        </div>

    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('contraseniaCambiada')): ?>

        <div class="alert alert-success">
            La contraseña se ha cambiado correctamente.
        </div>

    <?php else: ?>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'recuperar-form']); ?>

                    <?= $form->field($model, 'pass')->passwordInput() ?>

                    <?= $form->field($model, 'repeatPass')->passwordInput() ?>

                    <?= $form->field($model, 'token')->hiddenInput(['value' => Yii::$app->request->get('token')])->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Cambiar', ['class' => 'btn btn-primary', 'name' => 'recuperar-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>


    <?php endif; ?>
</div>
