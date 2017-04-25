<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$js = <<<EOT
    $(document).ready(function() {
       $('a[data-toggle=\"tab\"]').on('show.bs.tab', function (e) {
          localStorage.setItem('lastTab', $(this).attr('href'));
       });
       var lastTab = localStorage.getItem('lastTab');
       if (lastTab) {
          $('[href=\"' + lastTab + '\"]').tab('show');
       }
    });
EOT;
$this->registerJs($js);

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
