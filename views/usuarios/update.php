<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Modificar Usuario: ' . Html::encode($model->nombre);
$this->params['breadcrumbs'][] = (Yii::$app->user->esAdmin) ? ['label' => 'Usuarios', 'url' => ['index']] : 'Usuarios';
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->nombre), 'url' => ['view', 'id' => Html::encode($model->id)]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
