<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Asset genérico para la aplicación.
 */
class AppAsset extends AssetBundle
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
        'css/site.css',
        'css/estadisticas.css',
        'css/pelota.css',
    ];
    /**
     * @var array Los archivos js del asset.
     */
    public $js = [
        'js/localTabs.js',
        'js/modalNuevaTemp.js',
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
