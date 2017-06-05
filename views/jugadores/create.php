<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jugador */

$this->title = 'Añadir Jugador';
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['/equipos/index']];
$this->params['breadcrumbs'][] = ['label' => Html::encode($equipo), 'url' => ['/equipos/view', 'id' => Html::encode(Yii::$app->request->get('id_equipo'))]];
$this->params['breadcrumbs'][] = ['label' => 'Plantilla', 'url' => ['index', 'id_equipo' => Html::encode(Yii::$app->request->get('id_equipo'))]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jugador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'posiciones' => $posiciones,
    ]) ?>

</div>
