<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'dist/bootstrap-4.3.1/dist/css/bootstrap.css',
        'dist/bootstrap-4.3.1/dist/css/bootstrap-reboot.css',
        'dist/bootstrap-4.3.1/dist/css/bootstrap-grid.css',
//        'css/site.css',

        'https://use.fontawesome.com/releases/v5.4.1/css/all.css',
        '/dist/growl/jquery.growl.css',
//        '/dist/fancybox/jquery.fancybox.min.css',


    ];
    public $js = [
//        'dist/bootstrap-4.3.1/dist/js/bootstrap.js',
        'dist/bootstrap-4.3.1/dist/js/bootstrap.bundle.js',
        '/dist/growl/jquery.growl.js',
        '/dist/jquery-ui-custom.js',
        '/js/slimscroll.js',
        '/js/main.js',
        '/dist/SimpleAjaxUploader.js',
        '/dist/fancybox/jquery.fancybox.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jsrender/1.0.2/jsrender.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
