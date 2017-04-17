<?php

use app\models\Equipo;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jugador */

$equipo = Equipo::find()->where(['id' => $model->id_equipo])->one()->nombre;
$this->title = 'Modificar Jugador: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['/equipos/index']];
$this->params['breadcrumbs'][] = ['label' => 'Plantilla ' . $equipo, 'url' => ['index', 'id_equipo' => $model->id_equipo]];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="jugador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'posiciones' => $posiciones,
    ]) ?>

</div>
