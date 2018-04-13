<?php

namespace ws\controllers;

use common\models\web\Response;
use yii\web\Controller;

/**
 * Ping controller
 */
class PingController extends Controller
{

    public function actionIndex()
    {
        $response = new Response();
        $response->setSuccess(true);
        $response->setMessage('pong');
        return $response;
    }

}
