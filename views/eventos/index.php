<?php

use yii\helpers\Html;
use yii2fullcalendar\yii2fullcalendar;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventos';
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['/equipos/index']];
$this->params['breadcrumbs'][] = ['label' => $equipo, 'url' => ['/equipos/view', 'id' => Yii::$app->request->get('id_equipo')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir Evento', ['create', 'id_equipo' => Yii::$app->request->get('id_equipo')], ['class' => 'btn btn-success']) ?>
    </p>

    <?= yii2fullcalendar::widget([
        'events'=> $events,
        'options' => [
            'lang' => 'es',
        ],
    ]); ?>

</div>
