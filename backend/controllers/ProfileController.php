<?php

namespace backend\controllers;

use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\filters\VerbFilter;

/**
 * Profile controller
 */
class ProfileController extends BaseController
{

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get', 'post'],
                ],
            ],
        ]);
    }

    public function actions()
    {
        return [
            'avatar-upload' => [
                'class' => UploadAction::className(),
                'deleteRoute' => 'avatar-delete',
                'fileStorage' => 'userProfileFileStorage',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->fit(256, 256);
                    $file->put($img->encode());
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::className(),
                'fileStorage' => 'userProfileFileStorage',
            ]
        ];
    }

    public function actionIndex()
    {
        $model = Yii::$app->user->getIdentity();
        $model->setScenario('update-profile');

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->password) {
                    $model->setPassword($model->password);
                }

                if ($model->save()) {
                    Yii::$app->session->setFlash('flash', [
                        'options' => ['class' => 'alert-success'],
                        'body' => Yii::t('backend', 'Profile.Index.MessageProfileUpdated')
                    ]);

                    return $this->refresh();
                }
            }
        } else {
            $model->load(Yii::$app->user->getIdentity()->getAttributes(), '');

            $model->password = null;
            $model->repeat_password = null;
        }

        return $this->render($this->action->id, [
            'model' => $model,
        ]);
    }

}
