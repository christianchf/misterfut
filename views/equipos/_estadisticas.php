<?php
use app\assets\AppAsset;
use yii\web\View;
use yii\helpers\Url;

AppAsset::register($this);

$urlEquipos = Url::to(['/equipos/actualizar', 'id' => Yii::$app->request->get('id')]);

$js = <<<EOT
    var urlEquipos = "$urlEquipos";
EOT;
$this->registerJs($js, View::POS_END);
$this->registerJsFile(
    '/js/ajaxEquipos.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>


<h3>Estadísticas</h3>

<table id="statsEquipo" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Partidos jugados</th>
            <th>Partidos ganados</th>
            <th>Partidos empatados</th>
            <th>Partidos perdidos</th>
            <th>Goles a favor</th>
            <th>Goles en contra</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <?php for ($i = 0; $i < 5; $i++) { ?>
                <td>
                    <button id="suma<?= $i ?>" class="btn btn-xs btn-info btnMas btnActualizar">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </td>
            <?php } ?>
        </tr>
        <tr>
            <td id="jugados"></td>
            <td id="ganados"></td>
            <td id="empatados"></td>
            <td id="perdidos"></td>
            <td id="golesFavor"></td>
            <td id="golesContra"></td>
        </tr>
        <tr>
            <td></td>
            <?php for ($i = 0; $i < 5; $i++) { ?>
                <td>
                    <button id="resta<?= $i ?>" class="btn btn-xs btn-warning btnMenos btnActualizar">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                </td>
            <?php } ?>
        </tr>
    </tbody>
</table>
