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
        'css/site.css',
        /*'css/bootstrap-select.css',
        'css/bootstrap.min.css',
        'css/bootstrap-select.css.map',
        'css/bootstrap-select.min.css',*/
    ];
    public $js = [
        'js/main.js',
        /*'js/bootstrap-select.js',
        'js/bootstrap-select.min.js',*/
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
