<?php

namespace frontend\controllers;

use frontend\models\form\ContactForm;
use Yii;

/**
 * Test mail controller
 */
class TestMailController extends BaseController
{

    protected $accessControlRules = [
        [
            'allow' => true,
            'roles' => ['@'],
        ],
    ];

    public function actionContact()
    {
        $to = Yii::$app->request->get('to');

        $model = new ContactForm();
        $model->body = "This is a test message\nfrom contact form.\n\nYou are receiving it because you are the administrator.";
        $sent = $model->sendEmail($to);

        if ($sent) {
            echo('OK');
        } else {
            echo('ERROR');
        }

        Yii::$app->end();
    }

}
