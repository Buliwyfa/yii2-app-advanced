<?php

namespace ws\controllers;

use common\components\jwt\JWTHttpBearerAuth;
use yii\web\Controller;

/**
 * Base controller
 */
class BaseController extends Controller
{

    protected $accessControlExceptActions = [];
    protected $accessControlOnlyActions = [];
    protected $accessControlRules = [];

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => JWTHttpBearerAuth::class,
                'except' => $this->accessControlExceptActions,
                'only' => $this->accessControlOnlyActions,
            ],
        ]);
    }

}
