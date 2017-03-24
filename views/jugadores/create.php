<?php

use app\models\Equipo;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jugador */

$equipo = Equipo::find()->where(['id' => Yii::$app->request->get('id_equipo')])->one()->nombre;
$this->title = 'Crear Jugador';
$this->params['breadcrumbs'][] = ['label' => 'Plantilla ' . $equipo, 'url' => ['index', 'id_equipo' => Yii::$app->request->get('id_equipo')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jugador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'posiciones' => $posiciones,
    ]) ?>

</div>
