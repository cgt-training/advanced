<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
                    'css/bootstrap.min.css',
                    'css/select2.min.css',
                    'dist/css/AdminLTE.min.css',
                    'dist/css/skins/_all-skins.min.css',
                    'plugins/iCheck/flat/blue.css',
                    'plugins/morris/morris.css',
                    'plugins/datatables/dataTables.bootstrap.css',
                    'plugins/jvectormap/jquery-jvectormap-1.2.2.css',
                    'plugins/select2/select2.min.css',
                    'plugins/datepicker/datepicker3.css',
                    'plugins/daterangepicker/daterangepicker.css',
                    'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
                    '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
                    '//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
                ];

    public $js = [
                    'js/main.js',
                    'js/select2.full.js',
                    '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
                    'js/jquery-ui.min.js',
                    'js/bootstrap.min.js',
                    //'plugins/morris/morris.min.js',
                    'plugins/sparkline/jquery.sparkline.min.js',
                    'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
                    'plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
                    'plugins/knob/jquery.knob.js',
                    'plugins/datatables/jquery.dataTables.min.js',
                    'plugins/datatables/dataTables.bootstrap.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
                    'plugins/daterangepicker/daterangepicker.js',
                    'plugins/datepicker/bootstrap-datepicker.js',
                    'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
                    'plugins/slimScroll/jquery.slimscroll.min.js',
                    'plugins/fastclick/fastclick.js',
                    'dist/js/app.min.js',
                    'dist/js/pages/dashboard.js',
                    'dist/js/demo.js',
                ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
