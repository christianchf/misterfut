<?php

use app\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;

AppAsset::register($this);

$url = Url::to(['traspaso']);
$idEquipo = Yii::$app->request->get('id');
$js = <<<EOT
    $("#btnTraspasar").on("click", function(){
        var ventana = open("$url" + "&id=" + "$idEquipo", "ventana", "width=1000,height=400,toolbar=0,top=100,left=250");
    });
EOT;
$this->registerJs($js);

?>

<br />
<p>
    <?= Html::a('Ver detalles de plantilla', ['/jugadores/index', 'id_equipo' => $model->id], ['class' => 'btn btn-success']) ?>
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
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('Ver', ['jugadores/view', 'id' => $model->id,], ['class' => 'btn btn-xs btn-info']);
                },
            ],

        ],

    ],
]); ?>
</div>
