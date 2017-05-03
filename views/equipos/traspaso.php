<?php

use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JugadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$url = Url::to(['/equipos/traspasar']);
$idEquipo = Yii::$app->request->get('id');
$urlDestino = Url::to(['/equipos/view', 'id' => $idEquipo]);
$js = <<<EOT
    var padre = window.opener;
    $('#traspaso').on('click', function(){
        var origen = $('#jugadorsearch-nombre').val();
        var destino = "$idEquipo";
        var equipos = JSON.stringify({'origen': origen, 'destino': destino});

        $.ajax({
            url: "$url",
            contentType: 'application/json',
            method: 'POST',
            data: equipos,
            success: function(data, textStatus, Xhr) {
                $('#indice').load("$urlDestino" + ' #w1-container');
            }
        });
        setTimeout(function(){
            padre.location.href="$urlDestino";
            close();
        }, 1500);
    });
EOT;
$this->registerJs($js);


$this->title = 'Traspasar plantilla';
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['/equipos/index']];
$this->params['breadcrumbs'][] = ['label' => $equipo->nombre, 'url' => ['/equipos/view', 'id' => Yii::$app->request->get('id')]];
$this->params['breadcrumbs'][] = $this->title;
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
            <input type="text" name="destino" class="form-control" value="<?= $equipo->nombre . '(' . $equipo->temporada . ')' ?>" disabled />
        </div>
        <div class="col-xs-2">
            <input type="button" id="traspaso" value="Traspasar plantilla" class="btn btn-primary">
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
