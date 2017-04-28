<?php
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);

$url = Url::to(['/jugadores/actualizar', 'id' => Yii::$app->request->get('id')]);

$js = <<<EOT
    var btns = $('.btnActualizar');

    $(document).on('ready', function () {
        $.ajax({
            url: "$url",
            method: 'POST',
            success: function(data, textStatus, Xhr) {
                var datos = JSON.parse(data);
                $('#jugados').text(datos['jugados']);
                $('#golesMarcados').text(datos['golesMarcados']);
                $('#golesEncajados').text(datos['golesEncajados']);
                $('#asistencias').text(datos['asistencias']);
                $('#golesPartido').text(datos['golesPartido'] + ' %');
            }
        });
    });

    btns.on('click', function() {
        var idBtn = $(this).attr('id');
        $.ajax({
            url: "$url",
            method: 'POST',
            data: JSON.stringify({'idBtn': idBtn}),
            success: function(data, textStatus, Xhr) {
                var datos = JSON.parse(data);
                $('#jugados').text(datos['jugados']);
                $('#golesMarcados').text(datos['golesMarcados']);
                $('#golesEncajados').text(datos['golesEncajados']);
                $('#asistencias').text(datos['asistencias']);
                $('#golesPartido').text(datos['golesPartido'] + ' %');
            }
        });
    });

EOT;
$this->registerJs($js);

?>


<h3>Estadísticas</h3>

<table id="statsEquipo" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Partidos jugados</th>
            <th>Goles marcados</th>
            <th>Goles encajados</th>
            <th>Asistencias</th>
            <th>Goles por partido</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php for ($i = 0; $i < 4; $i++) { ?>
                <td>
                    <button id="suma<?= $i ?>" class="btn btn-xs btn-info btnMas btnActualizar">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </td>
            <?php } ?>
            <td></td>
        </tr>
        <tr>
            <td id="jugados"></td>
            <td id="golesMarcados"></td>
            <td id="golesEncajados"></td>
            <td id="asistencias"></td>
            <td id="golesPartido"></td>
        </tr>
        <tr>
            <?php for ($i = 0; $i < 4; $i++) { ?>
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
