<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Ekko Lightbox asset bundle.
 */
class EkkoLightboxAsset extends AssetBundle
{

    public $sourcePath = '@vendor/drmonty/ekko-lightbox';

    public $css = [
        'css/ekko-lightbox.css',
    ];

    public $js = [
        'js/ekko-lightbox.min.js',
    ];

}
