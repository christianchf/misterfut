<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use kartik\grid\GridView;

AppAsset::register($this);

?>

<br />
<div id="sancionados">
<?= GridView::widget([
    'summary' => 'Número de jugadores sancionados: <em>{count}</em>',
    'dataProvider' => $sancionados,
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
        'edad',
        'fecha_nac:date',

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('Ver', ['jugadores/view', 'id' => Html::encode($model->id),], ['class' => 'btn btn-xs btn-info btnsAction']);
                },
            ],

        ],

    ],
]); ?>
</div>
