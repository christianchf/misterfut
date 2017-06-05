<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$this->title = 'Modificar Evento: ' . Html::encode($model->tipo) . ': ' . Html::encode($model->nombre);
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['/equipos/index']];
$this->params['breadcrumbs'][] = ['label' => Html::encode($equipo), 'url' => ['/equipos/view', 'id' => Html::encode($model->id_equipo)]];
$this->params['breadcrumbs'][] = ['label' => 'Calendario', 'url' => ['index', 'id_equipo' => $model->id_equipo]];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->tipo) . ': ' . Html::encode($model->nombre), 'url' => ['view', 'id' => Html::encode($model->id)]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="evento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'equipo' => $equipo,
        'tipos' => $tipos,
    ]) ?>

</div>
