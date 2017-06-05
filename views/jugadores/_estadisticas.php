<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;

AppAsset::register($this);

$posJugador = Html::encode($model->id_posicion);
$urlJugador = Url::to(['/jugadores/actualizar', 'id' => Html::encode(Yii::$app->request->get('id'))]);

$js = <<<EOT
    var urlJugador = "$urlJugador";
    var posJugador = "$posJugador";
EOT;
$this->registerJs($js, View::POS_END);
$this->registerJsFile(
    '/js/ajaxJugadores.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<h3>Estadísticas</h3>

<table id="statsEquipo" class="table table-striped table-bordered">
    <thead>
        <tr id="cabecera" class="fila-ampliada">
            <th>Partidos jugados</th>
            <th>Goles marcados</th>
            <th>Asistencias</th>
            <th>Goles por partido</th>
        </tr>
        <tr id="cabecera2" class="fila-cerrada">
            <th>PJ</th>
            <th>Nº G</th>
            <th>Nª A</th>
            <th>G/P</th>
        </tr>
    </thead>
    <tbody>
        <tr id="btnsSuma">
            <?php for ($i = 0; $i < 3; $i++) { ?>
                <td>
                    <button id="suma<?= $i ?>" class="btn btn-xs btn-info btnMas btnActualizar">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </td>
            <?php } ?>
            <td></td>
        </tr>
        <tr id="datosJugador">
            <td id="jugados"></td>
            <td id="golesMarcados"></td>
            <td id="asistencias"></td>
            <td id="golesPartido"></td>
        </tr>
        <tr id="btnsResta">
            <?php for ($i = 0; $i < 3; $i++) { ?>
                <td>
                    <button id="resta<?= $i ?>" class="btn btn-xs btn-warning btnMenos btnActualizar">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                </td>
            <?php } ?>
            <td></td>
        </tr>
    </tbody>
</table>
