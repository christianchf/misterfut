<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Asset para la vista del calendario.
 */
class CalendarioAsset extends AssetBundle
{
    /**
     * @var string El directorio que contiene los archivos de este asset.
     */
    public $basePath = '@webroot';
    /**
     * @var string La url base para los archivos del asset.
     */
    public $baseUrl = '@web';
    /**
     * @var array Los archivos css del asset.
     */
    public $css = [
        'js/fullcalendar/fullcalendar.css',
    ];
    /**
     * @var array Los archivos js del asset.
     */
    public $js = [
        'js/fullcalendar/lib/moment.min.js',
        'js/fullcalendar/fullcalendar.js',
        'js/fullcalendar/locale/es.js',
        'js/calendario.js',
    ];
    /**
     * @var array Las dependencias del asset.
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
