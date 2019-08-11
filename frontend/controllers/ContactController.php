<?php

namespace frontend\controllers;

use frontend\models\form\ContactForm;
use Yii;
use yii\filters\AccessControl;

/**
 * Contact controller
 */
class ContactController extends BaseController
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
     * @throws \Throwable
     */
    public function actionIndex()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                return $this->redirect('/contact/success');
            } else {
                Yii::$app->session->setFlash('error', Yii::t('common', 'Contact.Error'));
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
