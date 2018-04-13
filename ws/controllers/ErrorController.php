<?php

namespace ws\controllers;

use yii\web\Controller;

/**
 * Error controller
 */
class ErrorController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

}
