<?php

namespace backend\controllers;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * User controller
 */
class UserController extends CRUDController
{

    protected $modelForSearch = '\common\models\search\UserSearch';
    protected $modelForView = '\common\models\domain\User';
    protected $modelForCreate = '\common\models\domain\User';
    protected $modelForUpdate = '\common\models\domain\User';
    protected $modelForDelete = '\common\models\domain\User';

    protected function getContainerClass()
    {
        return 'user';
    }

    protected function getControllerViewPath()
    {
        return '@backend/views/user';
    }

    protected function getAreaTitle()
    {
        return Yii::t('backend', 'User.Area.Title');
    }

    protected function afterValidateOnCreate(&$model)
    {
        if ($model->password) {
            $model->setPassword($model->password);
        }

        return parent::afterValidateOnCreate($model);
    }

    protected function afterValidateOnUpdate(&$model)
    {
        if ($model->password) {
            $model->setPassword($model->password);
        }

        return parent::afterValidateOnUpdate($model);
    }

    protected function getModelForUpdate()
    {
        $model = parent::getModelForUpdate();

        if ($model) {
            if (!Yii::$app->request->isPost) {
                $model->_groups = ArrayHelper::map($model->getGroups()->asArray()->all(), 'id', 'id');
            }
        }

        return $model;
    }

    protected function getModelForView()
    {
        $model = parent::getModelForView();

        if ($model) {
            $model->_groups = ArrayHelper::map($model->getGroups()->asArray()->all(), 'id', 'id');
        }

        return $model;
    }

}