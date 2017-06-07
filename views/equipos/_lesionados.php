<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use kartik\grid\GridView;

AppAsset::register($this);

?>

<br />
<div id="lesionados">
<?= GridView::widget([
    'summary' => 'Número de jugadores lesionados: <em>{count}</em>',
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
        'edad',
        'fecha_alta:date',
        [
            'label' => 'Dias restantes de lesión',
            'attribute' => 'diasLesion',
        ],

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
