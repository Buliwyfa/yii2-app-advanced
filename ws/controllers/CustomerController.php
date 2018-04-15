<?php

namespace ws\controllers;

use common\models\domain\Customer;
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
        'signup',
        'avatar',
        'request-password-reset',
        'reset-password',
    ];

    public function actionLogin()
    {
        $model = new LoginForm();
        $data = ['LoginForm' => Yii::$app->request->post()];

        if ($model->load($data) && $model->login()) {
            $token = Yii::$app->user->getIdentity()->getTokenForLogin();

            $response = new Response();
            $response->setSuccess(true);
            $response->setMessage('login-ok');
            $response->addData('token', (string)$token);

            return $response;
        }

        $response = new Response();
        $response->setSuccess(false);
        $response->setMessage('login-fail');
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

    public function actionAvatar()
    {
        $id = (int)Yii::$app->request->get('id');
        $customer = Customer::find($id)->id($id)->one();

        if ($customer) {
            $this->redirect($customer->getAvatar(Yii::getAlias('/images/profile-default.png')));
        } else {
            $this->redirect(Yii::getAlias('/images/profile-default.png'));
        }
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
        $response->setSuccess(false);
        $response->setMessage('reset-password-fail');
        return $response;
    }

    public function actionCheck()
    {
        $user = Yii::$app->user;

        if (!$user->isGuest) {
            $customer = $user->getIdentity();
            $customer->setScenario('check');
            $customer->avatar = Yii::$app->urlManager->createAbsoluteUrl($customer->getAvatar(Yii::getAlias('/images/profile-default.png')), true);

            $response = new Response();
            $response->setSuccess(true);
            $response->setMessage('check-ok');
            $response->addData('user', $customer->getAttributes($customer->safeAttributes()));
            return $response;
        }

        $response = new Response();
        $response->setSuccess(false);
        $response->setMessage('check-fail');
        return $response;
    }

}
