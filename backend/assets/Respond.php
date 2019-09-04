<?php

namespace backend\assets;

use yii\web\AssetBundle;

class Respond extends AssetBundle
{
    public $sourcePath = '@bower/respond';
    public $js = [
        'dest/respond.min.js'
    ];
    public $jsOptions = [
        'condition' => 'lt IE 9'
    ];
}
