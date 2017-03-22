<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jugador */

$this->title = 'Create Jugador';
$this->params['breadcrumbs'][] = ['label' => 'Jugadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jugador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
