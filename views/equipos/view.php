<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = Html::encode($model->nombre);
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-view">

    <?php if (Yii::$app->session->hasFlash('error')) { ?>
        <div class="alert alert-danger">Ya has creado este equipo en la temporada indicada.</div>
    <?php } ?>
    <?php if (Yii::$app->session->hasFlash('exito')) { ?>
        <div class="alert alert-success">La nueva temporada ha sido creada correctamente.</div>
    <?php } ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Tabs::widget([
        'id' => 'pestanias',
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
