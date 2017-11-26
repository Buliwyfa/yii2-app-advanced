<?php

namespace backend\controllers;

use Yii;

/**
 * Permission controller
 */
class PermissionController extends CRUDController
{

    protected $modelForSearch = '\common\models\search\PermissionSearch';
    protected $modelForView = '\common\models\domain\Permission';
    protected $modelForCreate = '\common\models\domain\Permission';
    protected $modelForUpdate = '\common\models\domain\Permission';
    protected $modelForDelete = '\common\models\domain\Permission';

    protected function getContainerClass()
    {
        return 'permission';
    }

    protected function getControllerViewPath()
    {
        return '@backend/views/permission';
    }

    protected function getAreaTitle()
    {
        return Yii::t('backend', 'Permission.Area.Title');
    }

}
