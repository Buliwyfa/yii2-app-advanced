<?php

namespace common\models\util;

use common\models\domain\GroupPermission;
use common\models\domain\Permission;
use Yii;

class PermissionUtil
{

    public static function updatePermissions()
    {
        $permisions = Yii::$app->params['permissions'];

        if ($permisions) {
            // remove permissions that no longer exist
            $currentPermissions = Permission::find()->all();

            if ($currentPermissions) {
                foreach ($currentPermissions as $currentPermission) {
                    $exists = false;

                    foreach ($permisions as $permision) {
                        if ($permision['action'] == $currentPermission->action) {
                            $exists = true;
                            break;
                        }
                    }

                    if (!$exists) {
                        $currentPermission->delete();
                    }
                }
            }

            // update remaining permissions
            $currentPermissions = Permission::find()->all();

            if ($currentPermissions) {
                foreach ($currentPermissions as $currentPermission) {
                    foreach ($permisions as $permision) {
                        if ($permision['action'] == $currentPermission->action) {
                            $currentPermission->description = $permision['description'];
                            $currentPermission->action_group = $permision['action_group'];

                            if (isset($permision['status'])) {
                                $currentPermission->status = $permision['status'];
                            } else {
                                $currentPermission->status = Permission::STATUS_ACTIVE;
                            }

                            $currentPermission->save();

                            break;
                        }
                    }
                }
            }

            // add new permissions
            foreach ($permisions as $permision) {
                $exists = false;

                foreach ($currentPermissions as $currentPermission) {
                    if ($permision['action'] == $currentPermission->action) {
                        $exists = true;
                        break;
                    }
                }

                if (!$exists) {
                    $newPermision = new Permission();
                    $newPermision->action = $permision['action'];
                    $newPermision->action_group = $permision['action_group'];
                    $newPermision->description = $permision['description'];

                    if (isset($permision['status'])) {
                        $newPermision->status = $permision['status'];
                    } else {
                        $newPermision->status = Permission::STATUS_ACTIVE;
                    }

                    $newPermision->save();
                }
            }
        } else {
            Permission::deleteAll();
            GroupPermission::deleteAll();
        }
    }

}