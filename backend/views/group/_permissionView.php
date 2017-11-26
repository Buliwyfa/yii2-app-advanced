<?php

use common\models\domain\Permission;

/* @var $this yii\web\View */
/* @var $model common\models\domain\Group */
/* @var $permission Permission */

$checked = false;
$objectId = $permission['id'];

if ($model->_permissions) {
    if (isset($model->_permissions[$objectId])) {
        if ($model->_permissions[$objectId] == $objectId) {
            $checked = true;
        }
    }
}
?>
<div class="form-group field-permission_<?= $objectId ?>">
    <div class="checkbox">
        <label for="permission_<?= $objectId ?>">
            <?= $checked ? '<i class="fa fa-circle text-success"></i>' : '<i class="fa fa-circle text-danger"></i>' ?>
            <?= Yii::t('backend', $permission['description']) ?>
        </label>
    </div>
</div>
