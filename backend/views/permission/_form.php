<?php

use common\helpers\SimpleArrayHelper;
use common\models\domain\Permission;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\domain\Permission */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $areaTitle string */

?>

<?php $this->beginContent('@backend/views/_partial/shared/areaContainer.php'); ?>

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'action')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'status')->dropDownList(SimpleArrayHelper::map(Permission::getStatusList()), ['prompt' => null]) ?>

	<div class="box-footer">
        <?= Html::submitButton($model->isNewRecord
		? Yii::t('backend', 'Button.Create', ['modelClass' => $areaTitle])
		: Yii::t('backend', 'Button.Update', ['modelClass' => $areaTitle]), ['class' => 'btn btn-success']) ?>

		<?= Html::a(Yii::t('backend', 'Button.Back', ['modelClass' => $areaTitle]),
		['index'], ['class' => 'btn btn-primary']); ?>
	</div>

    <?php ActiveForm::end(); ?>

<?php $this->endContent(); ?>