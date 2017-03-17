<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Registrar Usuario';
$this->params['breadcrumbs'][] = (Yii::$app->user->esAdmin) ? ['label' => 'Usuarios', 'url' => ['index']] : 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
