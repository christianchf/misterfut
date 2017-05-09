<?php
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);

$pos = $model->id_posicion;
$url = Url::to(['/jugadores/actualizar', 'id' => Yii::$app->request->get('id')]);

$js = <<<EOT
    var btns = $('.btnActualizar');

    $(document).on('ready', function () {
        generarBtnsPortero();
        $.ajax({
            url: "$url",
            method: 'POST',
            success: function(data, textStatus, Xhr) {
                var datos = JSON.parse(data);
                mostrarDatos(datos);
            }
        });
    });

    btns.on('click', ajaxBotones);

    function mostrarDatos(datos) {
        $('#jugados').text(datos['jugados']);
        $('#golesMarcados').text(datos['golesMarcados']);
        $('#golesEncajados').text(datos['golesEncajados']);
        $('#asistencias').text(datos['asistencias']);
        $('#golesPartido').text(datos['golesPartido'] + ' %');
    }

    function ajaxBotones() {
        var idBtn = $(this).attr('id');
        $.ajax({
            url: "$url",
            method: 'POST',
            data: JSON.stringify({'idBtn': idBtn}),
            success: function(data, textStatus, Xhr) {
                var datos = JSON.parse(data);
                mostrarDatos(datos);
            }
        });
    }

    function generarBtnsPortero() {
        var cabGolesEncaj = '<th>Goles encajados</th>';
        var sumGolesEncaj = '<td><button id="suma3" class="btn btn-xs btn-info btnMas btnActualizar">' +
            '<span class="glyphicon glyphicon-plus"></span></button></td>';
        var golesEncaj = '<td id="golesEncajados"></td>';
        var restGolesEncaj = '<td><button id="resta3" class="btn btn-xs btn-warning btnMenos btnActualizar">' +
        '<span class="glyphicon glyphicon-minus"></span></button></td>';

        if ($pos == 1) {
            $("#cabecera").append(cabGolesEncaj);
            $("#btnsSuma").append(sumGolesEncaj);
            $("#datosJugador").append(golesEncaj);
            $("#btnsResta").append(restGolesEncaj);
            $("#suma3").on('click', ajaxBotones);
            $("#resta3").on('click', ajaxBotones);
        }
    }

EOT;
$this->registerJs($js);

?>


<h3>Estadísticas</h3>

<table id="statsEquipo" class="table table-striped table-bordered">
    <thead>
        <tr id="cabecera">
            <th>Partidos jugados</th>
            <th>Goles marcados</th>
            <!-- <th>Goles encajados</th> -->
            <th>Asistencias</th>
            <th>Goles por partido</th>
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
            <!-- <td id="golesEncajados"></td> -->
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
