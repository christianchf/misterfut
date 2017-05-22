<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii2fullcalendar\yii2fullcalendar;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$urlCreate = Url::to(['/eventos/create', 'id_equipo' => Yii::$app->request->get('id_equipo')]);
$js = <<<EOT
    var urlCreate = "$urlCreate";
    $(document).on('ready', function () {

        $('.fc-day').on('click', function() {
            var fecha = $(this).data('date');
            window.location.href = urlCreate + '&fecha=' + fecha;
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
