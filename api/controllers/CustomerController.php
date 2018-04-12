<?php

namespace api\controllers;

/**
 * Customer controller
 */
class CustomerController extends BaseController
{

    protected $accessControlExceptActions = [
        'login'
    ];

    public function actionLogin()
    {
        exit;
        return 'OK';
    }

}
