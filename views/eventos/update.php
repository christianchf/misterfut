<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$this->title = 'Modificar Evento: ' . $model->tipo . ': ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['/equipos/index']];
$this->params['breadcrumbs'][] = ['label' => $equipo, 'url' => ['/equipos/view', 'id' => $model->id_equipo]];
$this->params['breadcrumbs'][] = ['label' => 'Calendario', 'url' => ['index', 'id_equipo' => $model->id_equipo]];
$this->params['breadcrumbs'][] = ['label' => $model->tipo . ': ' . $model->nombre, 'url' => ['view', 'id' => $model->id]];
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
