<?php

use app\models\Evento;
use yii\helpers\Url;
use yii\helpers\Html;
use yii2fullcalendar\yii2fullcalendar;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$eventos = Json::htmlEncode(Evento::find()->select('id')
    ->where(['id_equipo' => Yii::$app->request->get('id_equipo')])
    ->orderBy('fecha_inicio, hora_inicio')->column());

$urlCreate = Url::to(['/eventos/create', 'id_equipo' => Yii::$app->request->get('id_equipo')]);
$urlView = Url::to(['/eventos/view']);
$js = <<<EOT
    $(document).on('ready', function () {
        var eventos = $eventos;
        var contentEvent = $('.fc-event-container');

        for (var i = 0; i < eventos.length; i++) {
            $(contentEvent[i]).attr("id", eventos[i]);
        }

        var urlCreate = "$urlCreate";
        var urlView = "$urlView";

        $('.fc-day').on('click', function() {
            var fecha = $(this).data('date');
            window.location.href = urlCreate + '&fecha=' + fecha;
        });
        $('.fc-event-container').on('click', function() {
            var id = $(this).attr("id");
            window.location.href = urlView + '&id=' + id;
        });
    });
EOT;
$this->registerJs($js);

$this->title = 'Calendario';
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['/equipos/index']];
$this->params['breadcrumbs'][] = ['label' => $equipo->nombre, 'url' => ['/equipos/view', 'id' => Yii::$app->request->get('id_equipo')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <h1><?= Html::encode($this->title . ' ' . $equipo->nombre . ' (' . $equipo->temporada . ')') ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Añadir Evento', ['create', 'id_equipo' => Yii::$app->request->get('id_equipo')], ['class' => 'btn btn-success']) ?>
    </p>

    <?= yii2fullcalendar::widget([
        'events'=> $events,
        'options' => [
            'lang' => 'es',
        ],
        'clientOptions' => [
            'editable' => true,
        ],
    ]); ?>

</div>
