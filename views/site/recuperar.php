<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Recuperar Contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-recuperar">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('emailInvalido')): ?>

        <div class="alert alert-danger">
            El email no coincide con el de ningún usuario.
        </div>

    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('emailEnviado')): ?>

        <div class="alert alert-success">
            Se ha enviado un email a tu cuenta con un enlace para recuperar la contraseña.
        </div>

    <?php else: ?>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'recuperar-form']); ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'recuperar-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
