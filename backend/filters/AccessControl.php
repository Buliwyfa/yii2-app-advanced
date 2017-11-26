<?php

namespace backend\filters;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class AccessControl extends ActionFilter
{

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function beforeAction($action)
    {
        // check for except actions
        $this->except[] = 'error';

        foreach ($this->except as $exceptActionId) {
            if ($action->id === $exceptActionId) {
                return true;
            }
        }

        // not logged user cannot access nothing here
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }

        // check for permission with the logged user
        $permissionName = ($action->controller->id . '.' . $action->id);
        $permissionName = str_replace('/', '.', $permissionName);

        if (Yii::$app->user->can($permissionName, [], true)) {
            return true;
        }

        throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
    }

}