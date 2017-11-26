<?php

use common\models\domain\Permission;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\domain\User */
/* @var $group \common\models\domain\Group */
/* @var $form yii\bootstrap\ActiveForm */

$checked = false;
$objectId = $group['id'];

if ($model->_groups) {
    if (isset($model->_groups[$objectId])) {
        if ($model->_groups[$objectId] == $objectId) {
            $checked = true;
        }
    }
}
?>
<div class="form-group field-group_<?= $objectId ?>">
    <div class="checkbox">
        <label for="group_<?= $objectId ?>">
            <?= Html::checkbox("User[_groups][{$objectId}]", $checked, [
                'id' => "group_{$objectId}",
                'value' => $objectId,
            ]); ?>

            <?= Yii::t('backend', $group['name']) ?>
        </label>
    </div>
</div>
