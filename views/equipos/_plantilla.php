<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use kartik\grid\GridView;

AppAsset::register($this);

?>

<br />
<p><?= Html::a('Ver detalles de plantilla', ['/jugadores/index', 'id_equipo' => $model->id], ['class' => 'btn btn-success']) ?></p>

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
