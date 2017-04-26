<?php
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);

$url = Url::to(['/equipos/actualizar', 'id' => Yii::$app->request->get('id')]);

$js = <<<EOT
    var btns = $('.btnActualizar');

    $(document).on('ready', function () {
        $.ajax({
            url: "$url",
            method: 'POST',
            success: function(data, textStatus, Xhr) {
                var datos = JSON.parse(data);
                $('#jugados').text(datos['jugados']);
                $('#ganados').text(datos['ganados']);
                $('#empatados').text(datos['empatados']);
                $('#perdidos').text(datos['perdidos']);
                $('#golesFavor').text(datos['golesFavor']);
                $('#golesContra').text(datos['golesContra']);
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
                $('#ganados').text(datos['ganados']);
                $('#empatados').text(datos['empatados']);
                $('#perdidos').text(datos['perdidos']);
                $('#golesFavor').text(datos['golesFavor']);
                $('#golesContra').text(datos['golesContra']);
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
