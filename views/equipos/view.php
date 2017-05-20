<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Datos',
                'content' => $this->render('_datos', [
                    'model' => $model,
                ]),
                'active' => true
            ],
            [
                'label' => 'Plantilla',
                'content' => $this->render('_plantilla', [
                    'model' => $model,
                    'jugadores' => $jugadores,
                ]),
            ],
            [
                'label' => 'Lesionados',
                'content' => $this->render('_lesionados', [
                    'model' => $model,
                    'lesionados' => $lesionados,
                ]),
            ],
            [
                'label' => 'Sancionados',
                'content' => $this->render('_sancionados', [
                    'model' => $model,
                    'sancionados' => $sancionados,
                ]),
            ],
        ],
    ]); ?>

</div>
