<?php

namespace app\assets;

use yii\web\AssetBundle;

class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/js/slick/slick.css',
        '/js/slick/slick-theme.css',
        '/css/index-contenido.css',
    ];
    public $js = [
        '/js/slick/slick.min.js',
        '/js/carrusel.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
