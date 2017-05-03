<?php

use app\models\Equipo;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\jui\DatePicker;
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
                // padre.actualizacionPlantilla();
                // $('#contenedor-flash').load("$urlDestino" + ' #flash');
                $('#indice').load("$urlDestino" + ' #w1-container');
                // setTimeout(function(){
                //     $('#flash').fadeOut();
                // }, 1500);
            }
        });
        setTimeout(function(){
            close();
        }, 1500);
    });
EOT;
$this->registerJs($js);


$this->title = 'Traspasar plantilla';
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['/equipos/index']];
$this->params['breadcrumbs'][] = ['label' => $equipo, 'url' => ['/equipos/view', 'id' => Yii::$app->request->get('id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jugador-index">
    <!-- <div id="contenedor-flash">
        <div id="flash">
            <?php if (Yii::$app->session->hasFlash('anadido')): ?>
                <p id="alerta" class="alert alert-success"><?= Yii::$app->session->getFlash('anadido') ?></p>
            <?php endif; ?>
        </div>
    </div> -->


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
            <!-- <label for="origen">Año origen:</label> -->
            <!-- <input type="number" id="origen" class="form-control" placeholder="Equipo de origen" min="2000"> -->
        </div>
        <div class="flecha col-xs-1">
            <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
        </div>
        <div class="col-xs-3">
            <input type="text" name="destino" class="form-control" value="<?= $equipo ?>" disabled />
            <!-- <label for="destino">Año destino:</label> -->
            <!-- <input type="number" id="destino" class="form-control" placeholder="Año de destino" min="2000"> -->
        </div>
        <div class="col-xs-2">
            <input type="button" id="traspaso" value="Traspasar plantilla" class="btn btn-primary">
        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <!-- <div class="indice">
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'resizableColumns' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'label' => 'Posición',
                    'attribute' => 'nombrePosicion',
                    'group' => true,
                    'width' => '110px',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => $posiciones,
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Posición'],
                ],
                'nombre',
                [
                    'attribute' => 'dorsal',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => $dorsales,
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Dorsal'],
                ],
                [
                    'label' => 'Partidos',
                    'attribute' => 'partidos_jugados',
                    'width' => '70px',
                ],
                [
                    'label' => 'Goles',
                    'attribute' => 'goles_marcados',
                    'width' => '70px',
                ],
                [
                    'label' => 'Asistencias',
                    'attribute' => 'asistencias',
                    'width' => '70px',
                ],
                [
                    'label' => 'Goles/Partido',
                    'attribute' => 'goles_por_partido',
                    'width' => '70px',
                    'format' => 'percent',
                ],
                [
                    'label' => 'Fecha nacimiento',
                    'value' => 'fecha_nac',
                    'filter' => DatePicker::widget([
                        'language' => 'es',
                        'dateFormat' => 'yyyy-MM-dd',
                        'options' => ['class' => 'form-control'],
                        'clientOptions' => [
                            'yearRange' => '-115:+0',
                            'changeYear' => true
                        ],
                        'model' => $searchModel,
                        'attribute' => 'fecha_nac',
                    ]),
                    'attribute' => 'fecha_nac',
                    'format' => 'date',
                    'width' => '100px',
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
            'responsive'=>true,
            'hover'=>true,
        ]); ?> -->
    </div>
</div>
