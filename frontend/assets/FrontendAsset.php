<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class FrontendAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/site.css?r=23-11-2017-12-00-00',
    ];

    public $js = [
        'js/app.js?r=23-11-2017-12-00-00',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'frontend\assets\EkkoLightboxAsset',
    ];

}