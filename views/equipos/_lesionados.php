<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use kartik\grid\GridView;

AppAsset::register($this);

?>

<br />
<div id="indice">
<?= GridView::widget([
    'summary' => 'Número de jugadores lesionados: <b>{count}</b>',
    'dataProvider' => $lesionados,
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
