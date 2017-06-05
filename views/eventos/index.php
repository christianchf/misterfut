<?php

use app\assets\CalendarioAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

CalendarioAsset::register($this);

$urlCreate = Url::to(['/eventos/create', 'id_equipo' => Html::encode(Yii::$app->request->get('id_equipo'))]);
$urlEventos = Url::to(['/eventos/actualizar']);
$eventos = Json::htmlEncode($events);

$js = <<<EOT
    var urlCreate = "$urlCreate";
    var eventos = $eventos;
    var urlEventos = "$urlEventos";
EOT;
$this->registerJs($js, View::POS_END);

$this->title = 'Calendario';
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['/equipos/index']];
$this->params['breadcrumbs'][] = ['label' => Html::encode($equipo->nombre), 'url' => ['/equipos/view', 'id' => Html::encode(Yii::$app->request->get('id_equipo'))]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <h1><?= Html::encode($this->title . ' ' . Html::encode($equipo->nombre) . ' (' . Html::encode($equipo->temporada) . ')') ?></h1>

    <p>
        <?= Html::a('Añadir Evento', ['create', 'id_equipo' => Html::encode(Yii::$app->request->get('id_equipo'))], ['class' => 'btn btn-success']) ?>
    </p>

    <div id='calendar'></div>

</div>
