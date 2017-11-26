<?php

namespace backend\controllers;

use common\models\util\PermissionUtil;
use Yii;
use yii\filters\VerbFilter;

/**
 * Settings controller
 */
class SettingsController extends BaseController
{

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get', 'post'],
                    'update-permissions' => ['post'],
                ],
            ],
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpdatePermissions()
    {
        PermissionUtil::updatePermissions();

        Yii::$app->session->setFlash('flash', [
            'options' => ['class' => 'alert-success'],
            'body' => Yii::t('backend', 'Settings.Area.UpdatePermissions.FinishedOK')
        ]);

        return Yii::$app->getResponse()->redirect('index');
    }

}
