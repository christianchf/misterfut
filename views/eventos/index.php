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

$urlCreate = Url::to(['/eventos/create', 'idEquipo' => Html::encode(Yii::$app->request->get('idEquipo'))]);
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
$this->params['breadcrumbs'][] = ['label' => Html::encode($equipo->nombre), 'url' => ['/equipos/view', 'id' => Html::encode(Yii::$app->request->get('idEquipo'))]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <h1><?= Html::encode($this->title . ' ' . Html::encode($equipo->nombre) . ' (' . Html::encode($equipo->temporada) . ')') ?></h1>

    <p>
        <?= Html::a('Añadir Evento', ['create', 'idEquipo' => Html::encode(Yii::$app->request->get('idEquipo'))], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Registro de eventos', ['registro', 'idEquipo' => Html::encode(Yii::$app->request->get('idEquipo'))], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Descargar pdf de eventos', ['download', 'idEquipo' => Html::encode(Yii::$app->request->get('idEquipo'))], ['class' => 'btn btn-info']) ?>
    </p>

    <div id='calendar'></div>

</div>
