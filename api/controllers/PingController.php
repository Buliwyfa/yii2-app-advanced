<?php

namespace api\controllers;

use yii\web\Controller;

/**
 * Ping controller
 */
class PingController extends Controller
{

    public function actionIndex()
    {
        return 'OK';
    }

}
