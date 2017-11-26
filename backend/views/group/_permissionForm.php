<?php

use common\models\domain\Permission;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\domain\Group */
/* @var $permission \common\models\domain\Permission */
/* @var $form yii\bootstrap\ActiveForm */

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
            <?= Html::checkbox("Group[_permissions][{$objectId}]", $checked, [
                'id' => "permission_{$objectId}",
                'value' => $objectId,
            ]); ?>

            <?= Yii::t('backend', $permission['description']) ?>
        </label>
    </div>
</div>
