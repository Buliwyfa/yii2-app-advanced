<?php

namespace frontend\controllers;

use frontend\models\form\ContactForm;
use frontend\models\form\LoginForm;
use frontend\models\form\PasswordResetRequestForm;
use frontend\models\form\ResetPasswordForm;
use frontend\models\form\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Contact controller
 */
class ContactController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'success'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['success'],
                        'allow' => true,
                    ],
                ],
            ]
        ];
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                return $this->redirect('/contact/success');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render($this->action->id, [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays contact success page.
     *
     * @return mixed
     */
    public function actionSuccess()
    {
        return $this->render($this->action->id);
    }

}
