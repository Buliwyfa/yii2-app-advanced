<?php

use common\models\domain\Language;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\search\UserSearch */
/* @var $form yii\bootstrap\ActiveForm */

?>
<div class="search-filters">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'language_id')->dropDownList(ArrayHelper::map(Language::find()->all(), 'id', 'name')) ?>

	<div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Button.Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Button.Reset'), ['class' => 'btn btn-default']) ?>
	</div>

    <?php ActiveForm::end(); ?>

</div>