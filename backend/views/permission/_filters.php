<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\search\PermissionSearch */
/* @var $form yii\bootstrap\ActiveForm */

?>

<div class="search-filters">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'action') ?>

    <?= $form->field($model, 'status')->dropDownList(ArrayHelper::map(Content::getStatusList()), ['prompt' => null]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Button.Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Button.Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
