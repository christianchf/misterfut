<?php

use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JugadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$urlTraspasar = Url::to(['/equipos/traspasar']);
$idEquipoTraspasar = Html::encode(Yii::$app->request->get('id'));
$urlDestinoTraspasar = Url::to(['/equipos/view', 'id' => Html::encode($idEquipoTraspasar)]);
$js = <<<EOT
    var urlTraspasar = "$urlTraspasar";
    var idEquipoTraspasar = "$idEquipoTraspasar";
    var urlDestinoTraspasar = "$urlDestinoTraspasar";
EOT;
$this->registerJs($js, View::POS_END);
$this->registerJsFile(
    '/js/traspaso.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);


$this->title = 'Traspasar plantilla';
?>

<div class="jugador-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-xs-3">
            <?= $form->field($searchModel, 'nombre')->widget(Select2::classname(), [
                    'data' => $equiposOrigen,
                    'options' => ['placeholder' => 'Equipo de origen'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false) ?>
        </div>
        <div class="flecha col-xs-1">
            <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
        </div>
        <div class="col-xs-3">
            <input type="text" name="destino" class="form-control" value="<?= Html::encode($equipo->nombre) . '(' . Html::encode($equipo->temporada) . ')' ?>" disabled />
        </div>
        <div class="col-xs-2">
            <input type="button" id="traspaso" value="Traspasar plantilla" class="btn btn-primary">
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
