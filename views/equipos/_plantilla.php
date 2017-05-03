<?php

use app\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;

AppAsset::register($this);

$url = Url::to(['traspaso']);
$idEquipo = Yii::$app->request->get('id');
$urlDestino = Url::to(['/equipos/view', 'id' => $idEquipo]);
$js = <<<EOT
    $("#btnTraspasar").on("click", function(){
        var ventana = open("$url" + "&id=" + "$idEquipo", "ventana", "width=800,height=400,toolbar=0,top=100,left=350");
    });

    function actualizacionPlantilla() {
        $('#contenedor-flash').load("$urlDestino" + ' #flash');
        $('#indice').load("$urlDestino" + ' #w1');
        setTimeout(function(){
            $('#flash').fadeOut();
        }, 1500);
    }
EOT;
$this->registerJs($js);

?>

<br />
<p>
    <?= Html::a('Ver detalles de plantilla', ['/jugadores/index', 'id_equipo' => $model->id], ['class' => 'btn btn-success']) ?>
    <!-- <?= Html::a('Traspasar plantilla', ['traspaso', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']) ?> -->
    <!-- <?= Html::a('Traspasar plantilla', ['', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary', 'id' => 'btnTraspasar']) ?> -->
    <button type="button" class="btn btn-primary" id="btnTraspasar">Traspasar plantilla</button>
</p>

<div id="indice">
<?= GridView::widget([
    'dataProvider' => $jugadores,
    'resizableColumns' => false,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'label' => 'Posición',
            'attribute' => 'nombrePosicion',
            'group' => true,
        ],
        'nombre',
        'dorsal',
        'fecha_nac:date',

        [
            'value' => function ($model, $key, $index, $column) {
                return Html::a(
                    '',
                    ['jugadores/view', 'id' => $model->id],
                    ['class' => 'glyphicon glyphicon-eye-open']
                );
            },
            'format' => 'html',
        ],

    ],
]); ?>
</div>
