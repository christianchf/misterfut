<?php

namespace app\assets;

use yii\web\AssetBundle;

class CalendarioAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/fullcalendar/fullcalendar.css',
    ];
    public $js = [
        'js/fullcalendar/lib/moment.min.js',
        'js/fullcalendar/fullcalendar.js',
        'js/fullcalendar/locale/es.js',
        'js/calendario.js',
        'js/crearEvento.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
