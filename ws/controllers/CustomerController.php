<?php

namespace ws\controllers;

use common\models\web\Response;
use frontend\models\form\LoginForm;
use frontend\models\form\PasswordResetRequestForm;
use frontend\models\form\ResetPasswordForm;
use frontend\models\form\SignupForm;
use Yii;

/**
 * Customer controller
 */
class CustomerController extends BaseController
{

    protected $accessControlExceptActions = [
        'login',
        'signup'
    ];

    public function actionLogin()
    {
        $model = new LoginForm();
        $data = ['LoginForm' => Yii::$app->request->post()];

        if ($model->load($data) && $model->login()) {
            $token = Yii::$app->user->getIdentity()->getTokenForLogin();

            $response = new Response();
            $response->setSuccess(true);
            $response->setMessage('auth-ok');
            $response->addData('token', (string)$token);

            return $response;
        }

        $response = new Response();
        $response->setSuccess(false);
        $response->setMessage('auth-fail');
        $response->merge($model);

        return $response;
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        $data = ['SignupForm' => Yii::$app->request->post()];

        if ($model->load($data)) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    $token = Yii::$app->user->getIdentity()->getTokenForLogin();

                    $response = new Response();
                    $response->setSuccess(true);
                    $response->setMessage('signup-ok');
                    $response->addData('token', (string)$token);

                    return $response;
                }
            }
        }

        $response = new Response();
        $response->setSuccess(false);
        $response->setMessage('signup-fail');
        $response->merge($model);

        return $response;
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        $data = ['PasswordResetRequestForm' => Yii::$app->request->post()];

        if ($model->load($data) && $model->validate()) {
            if ($model->sendEmail()) {
                $response = new Response();
                $response->setSuccess(true);
                $response->setMessage('request-password-reset-ok');
                return $response;
            } else {
                $response = new Response();
                $response->setSuccess(false);
                $response->setMessage('request-password-reset-fail');
                $response->addDataError('email', Yii::t('common', 'RequestPasswordReset.Error'));
                return $response;
            }
        }

        $response = new Response();
        $response->setSuccess(false);
        $response->setMessage('request-password-reset-fail');
        return $response;
    }

    public function actionResetPassword($token)
    {
        $model = new ResetPasswordForm($token);
        $data = ['ResetPasswordForm' => Yii::$app->request->post()];

        if ($model->load($data) && $model->validate() && $model->resetPassword()) {
            $response = new Response();
            $response->setSuccess(true);
            $response->setMessage('reset-password-ok');
            return $response;
        }

        $response = new Response();
        $response->setSuccess(true);
        $response->setMessage('reset-password-fail');
        return $response;
    }

}
