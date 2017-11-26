<?php

/* @var $this yii\web\View */
/* @var $model \common\models\domain\User */
/* @var $group \common\models\domain\Group */

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
            <?= $checked ? '<i class="fa fa-circle text-success"></i>' : '<i class="fa fa-circle text-danger"></i>' ?>
            <?= Yii::t('backend', $group['name']) ?>
        </label>
    </div>
</div>
