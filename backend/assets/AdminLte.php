<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AdminLte extends AssetBundle
{
    public $sourcePath = '@bower/admin-lte/dist';
    public $js = [
        'js/adminlte.min.js',
    ];
    public $css = [
        'css/AdminLTE.min.css',
        'css/skins/skin-blue.min.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'backend\assets\FontAwesome',
        'backend\assets\JquerySlimScroll',
        'backend\assets\Html5shiv',
        'backend\assets\Respond',
    ];
}
